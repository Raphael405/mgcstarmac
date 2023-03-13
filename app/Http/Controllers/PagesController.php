<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session ;

class PagesController extends Controller
{
    public function index(){
        Session::put('attempt', 0);
        Session::put('time', 0);
        return view('pages.home');
    }
    public function customer(){
        return view('admin.customer');
    }
    public function staff(){
        return view('admin.staff');
    }
    public function bookings(){
        return view('admin.bookings');
    }
    public function services(){
        return view('admin.services');
    }
    public function walkin(){
        return view('admin.walkin');
    }
    public function dashboard(){
        return view('admin.dashboard');
    }
    public function developers(){
        return view('admin.developers');
    }
    public function customerbookings(){
        return view('pages.customerbookings');
    }
    public function profile($id,$checker){
        return view('pages.profile',['id'=>$id,'checker'=>$checker]);
    }
    public function sales(){
        return view('admin.sales');
    }
}
