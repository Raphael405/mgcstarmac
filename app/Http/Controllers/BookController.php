<?php

namespace App\Http\Controllers;

use App\Models\booking;
use App\Models\booking_details;
use App\Models\booking_payments;
use App\Models\services;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class BookController extends Controller
{
    public function book(Request $request)
    {
        $user = null;
        if ((!Auth::check() || auth()->user()->user_types_id != 3)) {
            if ($request->id === null) {
                $user = User::where('lname', $request->lname)->where('fname', $request->fname)->where('mname', $request->mname)->first();
                $filename = "uploads/user.png";
                if ($user === null) {
                    User::create([
                        'username' => $request->username,
                        'password' => Hash::make($request->password),
                        'user_types_id' => 3,
                        'verified' => "Verified",
                        'fname' => $request->fname,
                        'mname' => $request->mname,
                        'lname' => $request->lname,
                        'address' => $request->address,
                        'contact_number' => $request->contact_number,
                        'email' => $request->email,
                        'valid_id' => $filename,
                    ]);
                }

                if (!Auth::check()) {
                    auth()->attempt($request->only('username', 'password'), $request->remember);
                }
            }
        }
        $holder = null;
        if ($request->id == null) {
            $user = user::latest()->first();
            $holder = $user->id;
        } else {
            $holder =  $request->id;
        }
        if (Auth::check() && auth()->user()->user_types_id == 3) {
            $holder = auth()->user()->id;
        }

        if ($user != null && auth()->user()->user_types_id != 3) {
            $holder = $user->id;
        }

        $booking = booking::where('users_id', $holder)->latest()->first();

        $days = 1;
        $days += (((strtotime($request->to) - strtotime($request->from)) / 60) / 60) / 24;

        $status = "Request";
        if (auth()->user()->user_types_id != 3) {
            $status = "Ongoing";
        }
        if (($booking != null && ($booking->status === "Finished" || $booking->status === "Canceled")) || $booking === null) {
            booking::create([
                'users_id' => $holder,
                'total' => 0,
                'date' => $request->from,
                'status' => $status,
                'reason' => $request->reason,
            ]);
            $booking = booking::latest()->first();
        }
        $status = $booking->status;
        foreach ($request->service as $s) {
            if ($s != null) {
                $service = services::find($s);
                $quan = 1;
                if ($service->services_types_id != 2 && $service->services_types_id != 4) {
                    $quan = $request->quantity;
                }
                for ($x = 0; $x < $days; $x++) {
                    booking_details::create([
                        'bookings_id' => $booking->id,
                        'services_id' => $service->id,
                        'quantity' =>  $quan,
                        'price' => $service->price,
                        'subtotal' => $service->price *  $request->quantity,
                        'date' => date('Y-m-d', strtotime($request->from . ' + ' . $x . ' days')),
                        'status' => $status
                    ]);
                    $booking->total = $booking->total + $service->price *  $request->quantity;
                }
            }
        }
        $booking->save();
        return redirect()->route('profile.show', [$booking->users_id, 'current']);
    }
    public function pay(Request $request)
    {
        $this->validate($request, [
            'amount' => 'required|',
            'proof_of_payment' => 'image',
        ]);
        $booking = booking::find($request->id);
        $filename = "";
        if ($request->file('proof_of_payment')) {
            $file = $request->file('proof_of_payment');
            $filename = date('Y-m-d-H-i-s') . '.png';
            $file->move('uploads/payment', $filename);
            $filename = 'uploads/payment/' . $filename;
        }

        $status = "Unconfirmed";
        if(auth()->user()->user_types_id != 3){
            $status = "Confirmed";
        }
        booking_payments::create([
            'bookings_id' => $request->id,
            'amount' => $request->amount,
            'proof_of_payment' => $filename,
            'status' => $status
        ]);
        return redirect()->route('profile.show', [$booking->users_id, 'current']);
    }

    public function approve(Request $request)
    {
        $payment = booking_payments::where('bookings_id', $request->id)->get();
        foreach ($payment as $p) {
            $p->status = "Approved";
            $p->save();
        }
        $booking = booking::find($request->id);
        $booking->status = "Ongoing";
        $booking->save();
        foreach ($booking->booking_details as $d) {
            if ($d->service->services_types_id == 2 || $d->service->services_types_id == 4) {
                $d->status = "Ongoing";
                $d->save();
            }
        }
        return redirect()->route('bookings', "Request");
    }
    public function decline(Request $request)
    {
        $payment = booking_payments::find($request->id);
        $payment->status = "Declined";
        $payment->save();
        $booking = booking::find($payment->bookings_id);
        return redirect()->route('profile.show', [$booking->users_id, 'current']);
    }

    public function finnish(Request $request)
    {
        $booking = booking::find($request->id);
        $booking->status = "Finished";
        $booking->save();

        foreach ($booking->booking_details as $d) {
            $d->status = "Finished";
            $d->save();
        }
        return redirect()->route('bookings', "Request");
    }

    public function check($id)
    {
        $booking = booking::find($id);
        $status = 'current';
        if ($booking->status === "Finished") {
            $status = $booking->id;
        }
        return redirect()->route('profile.show', [$booking->users_id, $status]);
    }
    public function confirm(Request $request)
    {
        $payment = booking_payments::find($request->id);
        $payment->status = "Confirmed";
        $payment->save();
        $booking = booking::find($payment->bookings_id);
        return redirect()->route('profile.show', [$booking->users_id, 'current']);
    }

    public function delete(Request $request)
    {
        $det = booking_details::find($request->id);
        $booking = booking::find($det->bookings_id);
        $booking->total = $booking->total - $det->subtotal;
        $booking->save();
        $det->delete();
        return redirect()->route('book.check', ['id' => $det->bookings_id]);
    }

    public function walkin(Request $request)
    {
        booking::create([
            'users_id' => 2,
            'status' => "Finished",
            'total' => $request->total,
            'date' => date('Y-m-d'),
        ]);
        $booking = booking::latest()->first();
        foreach ($request->services_picked as $f) {
            $price = services::find($f);
            $subtotal = $request->services_quantity[$f] * $price->price;
            booking_details::create([
                'bookings_id' => $booking->id,
                'services_id' => $f,
                'quantity' => $request->services_quantity[$f],
                'price' => $price->price,
                'subtotal' => $subtotal,
                'date' => date('Y-m-d'),
                'status' => "Finished",
            ]);
        }
        return redirect()->route('walkin');
    }
    public function cancel(Request $request)
    {
        $booking = booking::find($request->id);
        $booking->status = "Canceled";
        foreach ($booking->booking_details as $d) {
            $d->status = "Canceled";
            $d->save();
        }
        $booking->save();
        return redirect()->route('profile.show', [$booking->users_id, 'current']);
    }

    public function checkin(Request $request)
    {
        $booking = booking::find($request->id);
        $booking->status = "Ongoing";
        foreach ($booking->booking_details as $d) {
            $d->status = "Ongoing";
            $d->save();
        }
        $booking->save();
        return redirect()->route('profile.show', [$booking->users_id, 'current']);
    }
    public function checkout(Request $request)
    {
        $booking = booking::find($request->id);
        $booking->status = "Finished";
        foreach ($booking->booking_details as $d) {
            $d->status = "Finished";
            $d->save();
        }
        $booking->save();
        return redirect()->route('profile.show', [$booking->users_id, 'current']);
    }

    public function remove(Request $request)
    {
        $det = booking_details::find($request->id);
        $booking = booking::find($det->bookings_id);
        $det->delete();
        $booking->total = $booking->total - $det->subtotal;
        $booking->save();
        return redirect()->route('profile.show', [$booking->users_id, 'current']);
    }

    public function chart(){
        $jan = booking::where('date','like','%'.date('Y-').'01'.'%')->where('status','Finished')->sum('total');
        $feb = booking::where('date','like','%'.date('Y-').'02'.'%')->where('status','Finished')->sum('total');
        $mar = booking::where('date','like','%'.date('Y-').'03'.'%')->where('status','Finished')->sum('total');
        $apr = booking::where('date','like','%'.date('Y-').'04'.'%')->where('status','Finished')->sum('total');
        $may = booking::where('date','like','%'.date('Y-').'05'.'%')->where('status','Finished')->sum('total');
        $jun = booking::where('date','like','%'.date('Y-').'06'.'%')->where('status','Finished')->sum('total');
        $jul = booking::where('date','like','%'.date('Y-').'07'.'%')->where('status','Finished')->sum('total');
        $aug = booking::where('date','like','%'.date('Y-').'08'.'%')->where('status','Finished')->sum('total');
        $sep = booking::where('date','like','%'.date('Y-').'09'.'%')->where('status','Finished')->sum('total');
        $oct = booking::where('date','like','%'.date('Y-').'10'.'%')->where('status','Finished')->sum('total');
        $nov = booking::where('date','like','%'.date('Y-').'11'.'%')->where('status','Finished')->sum('total');
        $dec = booking::where('date','like','%'.date('Y-').'12'.'%')->where('status','Finished')->sum('total');

        $array = [
            ['Month',"Total"],
            ['January',intval($jan)],
            ['February',intval($feb)],
            ['March',intval($mar)],
            ['April',intval($apr)],
            ['May',intval($may)],
            ['June',intval($jun)],
            ['July',intval($jul)],
            ['August',intval($aug)],
            ['September',intval($sep)],
            ['October',intval($oct)],
            ['November',intval($nov)],
            ['December',intval($dec)]
        ];
        return response()->json( $array
        );
    }
}
