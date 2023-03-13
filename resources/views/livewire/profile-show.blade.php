<div  style=" background-image: url('{{ asset('uploads/seas2.png') }}'); background-size: cover; background-repeat: no-repeat;
background-position: center; 
position: relative; height:100vh;" >
    <section >
        <div class=" py-5">
            <div class="row">
                {{-- <div class="col-md-2" style="height: 680px">
                    <div class="card mb-4">
                        <div class="card-body text-center text-dark">
                            <a href="{{ asset($user->valid_id) }}"><img src="{{ asset($user->valid_id) }}" width="250"
                                    height="250" class=""></a>
                            <h5 class="my-3"> <span class="text-bold">{{ $user->fullname() }}</span></h5>
                            <p class="mb-1">Email: <span class="text-bold text-success">{{ $user->email }}</span></p>
                            <p class="mb-1">Address: <span class="text-bold text-success">{{ $user->address }}</span>
                            </p>
                            <p class="mb-1">Contact Number <span
                                    class="text-bold text-success">{{ $user->contact_number }}</span></p>
                        </div>
                    </div>
                </div> --}}

                @if (
                    ($booking != null && ($booking->status != 'Finished' && $booking->status != 'Canceled')) ||
                        $user->id != auth()->user()->id)

                    @if ($booking != null && ($booking->status != 'Finished' && $booking->status != 'Canceled'))
                        <div class="col-md-6" style="height: 100%">
                            <div class="card d-flex text-dark" style="width:100%; height: 100%">
                                <div class="row pt-3 pb-3">

                                    <div class="col-md-2 d-flex justify-content-center">
                                        <button wire:click="change(1)"
                                            class="btn rounded-pill @if ($type === 1) btn-primary @endif">
                                            <h5><i class="fa-solid fa-hotel"></i><br>Rooms</h5>
                                        </button>
                                    </div>
                                    <div class="col-md-2 d-flex justify-content-center">
                                        <button wire:click="change(2)"
                                            class="btn rounded-pill  @if ($type === 2) btn-primary @endif">
                                            <h5><i class="fa-solid fa-vihara"></i><br> Cottages</h5>
                                        </button>
                                    </div>
                                    <div class="col-md-2 d-flex justify-content-center">
                                        <button wire:click="change(6)"
                                            class="btn rounded-pill  @if ($type === 6) btn-primary @endif">
                                            <h5><i class="fa-solid fa-bowl-food"></i><br> Food</h5>
                                        </button>
                                    </div>
                                    <div class="col-md-2 d-flex justify-content-center">
                                        <button wire:click="change(3)"
                                            class="btn rounded-pill  @if ($type === 3) btn-primary @endif">
                                            <h5><i class="fa-solid fa-hands-asl-interpreting"></i><br> Activities</h5>
                                        </button>
                                    </div>
                                    <div class="col-md-2 d-flex justify-content-center">
                                        <button wire:click="change(4)"
                                            class="btn rounded-pill  @if ($type === 4) btn-primary @endif">
                                            <h5><i class="fa-solid fa-person-shelter"></i><br> Entrance</h5>
                                        </button>
                                    </div>
                                    <div class="col-md-2 d-flex justify-content-center">
                                        <button wire:click="change(5)"
                                            class="btn rounded-pill  @if ($type === 5) btn-primary @endif">
                                            <h5><i class="fa-solid fa-peso-sign"></i><br> Excess</h5>
                                        </button>
                                    </div>

                                </div>
                            </div>
                            <div class="d-flex justify-content-center">
                                <div class="card" style="width: 1200px; height: 600px">
                                    @if ($type == 6)
                                        <div class="row">
                                            <div class="col-md-4">

                                            </div>
                                            <div class="col-md-4 d-flex">
                                                <label for="" class="mr-4">Foodtype</label>
                                                <select name="location" class="form-control" wire:model="food">
                                                    <option value="" selected>All</option>
                                                    <option value="Breakfast">Breakfast</option>
                                                    <option value="Lunch">Lunch</option>
                                                    <option value="Dinner">Dinner</option>
                                                    <option value="Softdrink">Softdrink</option>
                                                    <option value="Dessert">Dessert</option>
                                                </select>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="wrapper pt-5 pl-5 pr-5">
                                        <div class="row overflow-auto" style="height: 350px">
                                            @php
                                                $holder = [];
                                                if ($type == 1) {
                                                    $holder = $hotels;
                                                } elseif ($type == 2) {
                                                    $holder = $cottages;
                                                } elseif ($type == 3) {
                                                    $holder = $activities;
                                                } elseif ($type == 4) {
                                                    $holder = $entrance;
                                                } elseif ($type == 5) {
                                                    $holder = $additionals;
                                                } else {
                                                    $holder = $foods;
                                                }
                                            @endphp

                                            @foreach ($holder as $h)
                                                <div class="col-md-4 overflow-auto pb-2" style="height: 250px">
                                                    <div class="text-center">
                                                        <div class="form-check">
                                                            <input type="checkbox"
                                                                wire:model="selected.{{ $h->id }}"
                                                                value="{{ $h->id }}"
                                                                id="flexCheckDefault{{ $h->id }}"><label
                                                                for="flexCheckDefault{{ $h->id }}"
                                                                class="h5">{{ $h->name }}</label>
                                                        </div>
                                                        <h6>Price: <i class="fa-solid fa-peso-sign"></i>
                                                            {{ number_format($h->price, 2, '.', ',') }}</h6>
                                                        <h6>Description: {{ $h->description }}</h6>
                                                        <div id="carouselExampleControls" class="carousel slide"
                                                            data-ride="carousel">
                                                            <div class="carousel-inner">
                                                                @foreach ($h->images as $im)
                                                                    <div
                                                                        class="carousel-item @if ($loop->index == 0) active @endif">
                                                                        <a href="{{ asset($im->location) }}"><img
                                                                                style="height: 100%; width: 100%; object-fit: contain"
                                                                                src="{{ asset($im->location) }}"
                                                                                alt="First slide"></a>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                            <a class="carousel-control-prev text-dark text-bold"
                                                                href="#carouselExampleControls" role="button"
                                                                data-slide="prev">
                                                                <span class="carousel-control-prev-icon"
                                                                    aria-hidden="true"></span>
                                                                <span class="sr-only">Previous</span>
                                                            </a>
                                                            <a class="carousel-control-next text-dark text-bold"
                                                                href="#carouselExampleControls" role="button"
                                                                data-slide="next">
                                                                <span class="carousel-control-next-icon"
                                                                    aria-hidden="true"></span>
                                                                <span class="sr-only">Next</span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        <br>
                                        @if ($type == 3 || $type == 4 || $type == 5 || $type == 6)
                                            <label for="">Quantity</label>
                                            <input type="number" wire:model="quantity" class="form-control"
                                                placeholder="Quantity" required min="1">
                                        @endif
                                        <br>
                                        <div class="row">
                                            @if ($type != 3 && $type != 6)
                                                <div class="col-xl-6 ">
                                                    <label for="">From: </label>
                                                    <input type="date" class="form-control form-control-lg "
                                                        wire:model="from" min="{{ date('Y-m-d') }}">
                                                </div>
                                                <div class="col-xl-6">
                                                    <label for="" class="">To: </label>
                                                    <input type="date" class="form-control form-control-lg "
                                                        wire:model="to" min="{{ $from }}">
                                                </div>
                                            @else
                                                <div class="d-flex justify-content-center">
                                                    <label for="" class="pr-3 mr-3">Date: </label>
                                                    <input type="date" class="form-control form-control-lg "
                                                        wire:model="from" min="{{ date('Y-m-d') }}">
                                                </div>
                                            @endif
                                        </div>
                                        <br>
                                        <div class="d-flex justify-content-center pt-3">
                                            @if (count($selected) != 0)
                                                <button class="btn-lg btn btn-primary " style="width: 50%"
                                                    data-toggle="modal" data-target="#book">BOOK</button>
                                                <div wire:ignore.self class="modal fade" id="book"
                                                    tabindex="-1" role="dialog" aria-labelledby="add"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog  modal-lg" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="add">BOOKING</h5>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>

                                                            <div class="modal-body">
                                                                <label>Are you sure you want to book ?</label>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary "
                                                                    data-dismiss="modal">Close</button>
                                                                <button class="btn btn-success " type="submit"
                                                                    wire:click="book">Book</button>
                                                            </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="col-md-6" style="height: 715px">
                        <div class="card" style="width: 100%; height: 100%">
                            <div class="wrapper pt-5 pl-5 pr-5">
                                <h4>Bookings</h4>
                                <table class="table" style="max-height: 400px">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Quantity</th>
                                            <th>Date</th>
                                            <th>Subtotal</th>
                                            <th>Status</th>
                                            @if ($booking->status != 'Finished')
                                                <th>Action</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($booking->booking_details as $d)
                                            <tr>
                                                <td>{{ $d->service->name }}</td>
                                                <td>{{ $d->quantity }}</td>
                                                <td>{{ $d->date }}</td>
                                                <td> <i class="fa-solid fa-peso-sign"></i>
                                                    {{ number_format($d->subtotal, 2, '.', ',') }} </td>
                                                <td> {{ $d->status }}</td>
                                                @if ($booking->status != 'Finished')
                                                    <td>
                                                        <button class="btn btn-primary"
                                                            data-target="#remove{{ $d->id }}"
                                                            data-toggle="modal">Cancel</button>
                                                        <div wire:ignore.self class="modal fade"
                                                            id="remove{{ $d->id }}" tabindex="-1"
                                                            role="dialog" aria-labelledby="add" aria-hidden="true">
                                                            <div class="modal-dialog modal-lg" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="add">Pay
                                                                            Online
                                                                        </h5>
                                                                        <button type="button" class="close"
                                                                            data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <form action="{{ route('book.remove') }}"
                                                                        method="post" enctype="multipart/form-data">
                                                                        <div class="modal-body">
                                                                            @csrf
                                                                            <input type="hidden" name="id"
                                                                                value="{{ $d->id }}">
                                                                            <h4>Are you sure you want to cancel booking
                                                                            </h4>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button"
                                                                                class="btn btn-secondary "
                                                                                data-dismiss="modal">Close</button>
                                                                            <button type="submit"
                                                                                class="btn btn-primary">Cancel</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <br>
                                <div class="d-flex">
                                    <div class="mr-auto">
                                        @if ($balance > 0)
                                            <button class="btn btn-warning" data-toggle="modal"
                                                data-target="#pay">Pay
                                            </button>
                                            <div wire:ignore.self class="modal fade" id="pay" tabindex="-1"
                                                role="dialog" aria-labelledby="add" aria-hidden="true">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="add">Pay </h5>
                                                            <button type="button" class="close"
                                                                data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form action="{{ route('book.pay') }}" method="post"
                                                            enctype="multipart/form-data">
                                                            <div class="modal-body">
                                                                @csrf
                                                                <input type="hidden" name="id"
                                                                    value="{{ $booking->id }}">
                                                                @if ($booking->reason === 'Online')
                                                                    <p class="text-muted">Please specify the amount and
                                                                        upload
                                                                        screenshot of the
                                                                        reference number.</p>
                                                                    <h6 class="">GCASH #: 09064561237 / Ralph
                                                                        Padere
                                                                    </h6>
                                                                    <h6 class="">Palawan: 09064561237 / Ralph
                                                                        Padere
                                                                    </h6>
                                                                @endif
                                                                <label for="">Amount: </label>
                                                                <input type="number" name="amount"
                                                                    class="form-control" min="{{ $balance }}"
                                                                    max="{{ $balance }}">
                                                                @error('amount')
                                                                    <div class="text-danger mt-2">{{ $message }}
                                                                    </div>
                                                                @enderror
                                                                @if ($booking->reason === 'Online')
                                                                    <label for="">Upload Proof of
                                                                        Payment</label>
                                                                    <input type="file" name="proof_of_payment"
                                                                        class="form-control">
                                                                    @error('proof_of_payment')
                                                                        <div class="text-danger mt-2">{{ $message }}
                                                                        </div>
                                                                    @enderror
                                                                @endif
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary "
                                                                    data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-success">Submit

                                                                    Payment</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        <button class="btn btn-warning" data-toggle="modal"
                                            data-target="#check">Check
                                            Payment</button>
                                        <div wire:ignore.self class="modal fade" id="check" tabindex="-1"
                                            role="dialog" aria-labelledby="add" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="add"> PAYMENTS
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                    @if ($booking->reason === 'Online')
                                                                        <th>Proof</th>
                                                                    @endif
                                                                    <th>Amount</th>
                                                                    <th>Date</th>
                                                                    <th>Status</th>
                                                                    @if (auth()->user()->user_types_id != 3)
                                                                        <th>Confirm</th>
                                                                    @endif
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($booking->payments as $p)
                                                                    <tr>
                                                                        @if ($booking->reason === 'Online')
                                                                            <td
                                                                                style="width:100px; height:100px;text-align:center; vertical-align:middle">
                                                                                <a
                                                                                    href="{{ asset($p->proof_of_payment) }}"><img
                                                                                        src="{{ asset($p->proof_of_payment) }}"
                                                                                        alt=""
                                                                                        style="border-radius: 50%;max-height:100%; max-width:100%"></a>
                                                                            </td>
                                                                        @endif
                                                                        <td><i class="fa-solid fa-peso-sign"></i>
                                                                            {{ number_format($p->amount, 2, '.', ',') }}
                                                                        </td>
                                                                        <td> {{ date('Y-m-d', strtotime($p->created_at)) }}
                                                                        </td>
                                                                        <td>{{ $p->status }}</td>
                                                                        @if (auth()->user()->user_types_id != 3)
                                                                            <td>
                                                                                @if ($p->status != 'Confirmed' && $p->status != 'Declined')
                                                                                    <form
                                                                                        action="{{ route('book.pay.confirm') }}"
                                                                                        method="post">
                                                                                        @csrf
                                                                                        <input type="hidden"
                                                                                            name="id"
                                                                                            value="{{ $p->id }}">
                                                                                        <button
                                                                                            class="btn btn-success "
                                                                                            type="submit">CONFIRM</button>
                                                                                    </form>
                                                                                    <form
                                                                                        action="{{ route('book.pay.decline') }}"
                                                                                        method="post">
                                                                                        @csrf
                                                                                        <input type="hidden"
                                                                                            name="id"
                                                                                            value="{{ $p->id }}">
                                                                                        <button class="btn btn-danger "
                                                                                            type="submit">DECLINE</button>
                                                                                    </form>
                                                                                @else
                                                                                    Confirmed
                                                                                @endif
                                                                            </td>
                                                                        @endif
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary "
                                                            data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="ml-auto">
                                        <h4 for="">TOTAL: <i class="fa-solid fa-peso-sign"></i>
                                            {{ number_format($booking->total, 2, '.', ',') }}</h4>
                                        <h4 for="">BALANCE: <i class="fa-solid fa-peso-sign"></i>
                                            {{ number_format($balance, 2, '.', ',') }} </h4>
                                        @if ($booking->status === 'Request')
                                            @if ($balance == 0)
                                                <button class="btn btn-success " data-toggle="modal"
                                                    data-target="#checkin">Check In</button>
                                                <div wire:ignore.self class="modal fade" id="checkin"
                                                    tabindex="-1" role="dialog" aria-labelledby="add"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog  modal-lg" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="add">BOOKING CHECK
                                                                    IN
                                                                </h5>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <form action="{{ route('book.checkin') }}" method="post"
                                                                enctype="multipart/form-data">
                                                                <div class="modal-body">
                                                                    @csrf
                                                                    <input type="hidden" name="id"
                                                                        value="{{ $booking->id }}">
                                                                    Are you sure you want to check in ?
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary "
                                                                        data-dismiss="modal">Close</button>
                                                                    <button class="btn btn-success"
                                                                        type="submit">Check
                                                                        In</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                @if (auth()->user()->user_types_id != 3)
                                                    <h4>Please wait for customer payment for check in </h4>
                                                @endif
                                            @endif

                                            <button class="btn btn-danger " data-toggle="modal"
                                                data-target="#cancel">Cancel</button>
                                            <div wire:ignore.self class="modal fade" id="cancel" tabindex="-1"
                                                role="dialog" aria-labelledby="add" aria-hidden="true">
                                                <div class="modal-dialog  modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="add">BOOKING CANCEL
                                                            </h5>
                                                            <button type="button" class="close"
                                                                data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form action="{{ route('book.cancel') }}" method="post"
                                                            enctype="multipart/form-data">
                                                            <div class="modal-body">
                                                                @csrf
                                                                <input type="hidden" name="id"
                                                                    value="{{ $booking->id }}">
                                                                Are you sure you want to cancel booking ?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary "
                                                                    data-dismiss="modal">Close</button>
                                                                <button class="btn btn-danger "
                                                                    type="submit">Cancel</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            @if (auth()->user()->user_types_id != 3 &&
                                                    ($booking->status != 'Finished' && $booking->status != 'Canceled') &&
                                                    $balance == 0)
                                                <button class="btn btn-danger " data-toggle="modal"
                                                    data-target="#checkout">Check Out</button>
                                                <div wire:ignore.self class="modal fade" id="checkout"
                                                    tabindex="-1" role="dialog" aria-labelledby="add"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog  modal-lg" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="add">BOOKING CHECK
                                                                    OUT
                                                                </h5>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <form action="{{ route('book.checkout') }}"
                                                                method="post" enctype="multipart/form-data">
                                                                <div class="modal-body">
                                                                    @csrf
                                                                    <input type="hidden" name="id"
                                                                        value="{{ $booking->id }}">
                                                                    Are you sure you want to check out ?
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary "
                                                                        data-dismiss="modal">Close</button>
                                                                    <button class="btn btn-success "
                                                                        type="submit">Check
                                                                        Out</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>
</div>
