<div
    style=" background-image: url('{{ asset('uploads/seas2.png') }}'); background-size: cover; background-repeat: no-repeat;
background-position: center; 
position: relative; height:100vh;">
    <div class="container" style="height: 100%; width:100%;">
        <div class="card d-flex text-dark">
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

            <div class="card" style="width: 100%; height: 100%">
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
                                        <input type="checkbox" wire:model="selected.{{ $h->id }}"
                                            value="{{ $h->id }}" id="flexCheckDefault{{ $h->id }}"><label
                                            for="flexCheckDefault{{ $h->id }}"
                                            class="h5">{{ $h->name }}</label>
                                    </div>
                                    <h6>Price: <i class="fa-solid fa-peso-sign"></i>
                                        {{ number_format($h->price, 2, '.', ',') }}</h6>
                                    <h6>Description: {{ $h->description }}</h6>
                                    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                                        <div class="carousel-inner">
                                            @foreach ($h->images as $im)
                                                <div
                                                    class="carousel-item @if ($loop->index == 0) active @endif">
                                                    <a href="{{ asset($im->location) }}"><img
                                                            style="height: 100%; width: 100%; object-fit: contain"
                                                            src="{{ asset($im->location) }}" alt="First slide"></a>
                                                </div>
                                            @endforeach
                                        </div>
                                        <a class="carousel-control-prev text-dark text-bold"
                                            href="#carouselExampleControls" role="button" data-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                        <a class="carousel-control-next text-dark text-bold"
                                            href="#carouselExampleControls" role="button" data-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
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
                        <input type="number" wire:model="quantity" class="form-control" placeholder="Quantity" required
                            min="1">
                    @endif
                    <br>
                    <div class="d-flex justify-content-center pt-3">
                        @if ($type != 3)
                            <div class="col-xl-3 ">
                                <label for="">From: </label>
                                <input type="date" class="form-control form-control-lg " wire:model="from"
                                    min="{{ date('Y-m-d') }}">
                            </div>
                            <div class="col-xl-3">
                                <label for="" class="">To: </label>
                                <input type="date" class="form-control form-control-lg " wire:model="to"
                                    min="{{ $from }}">
                            </div>
                        @else
                            <div class="d-flex justify-content-center">
                                <label for="" class="pr-3 mr-3">Date: </label>
                                <input type="date" class="form-control form-control-lg " wire:model="from"
                                    min="{{ date('Y-m-d') }}">
                            </div>
                        @endif
                    </div>
                    <br>
                    <div class="d-flex justify-content-center pt-3">
                        @if (count($selected) != 0)
                            <button class="btn-lg btn btn-primary " style="width: 10%" data-toggle="modal"
                                data-target="#book">BOOK</button>
                            <div wire:ignore.self class="modal fade" id="book" tabindex="-1" role="dialog"
                                aria-labelledby="add" aria-hidden="true">
                                <div class="modal-dialog  modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="add">BOOKING</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('book') }}" method="post"
                                            enctype="multipart/form-data">
                                            <div class="modal-body">
                                                @csrf
                                                <input type="hidden" value="{{ $from }}" name="from">
                                                <input type="hidden" value="{{ $to }}" name="to">

                                                @foreach ($selected as $s)
                                                    <input type="hidden" name="service[]"
                                                        value="{{ $s }}">
                                                @endforeach

                                                <input type="hidden" value="{{ $quantity }}" name="quantity">
                                                <div class="input-group mb-3">
                                                    <input name="fname" type="text" class="form-control"
                                                        placeholder="First Name" value="{{ old('fname') }}"
                                                        required>
                                                </div>
                                                @error('fname')
                                                    <div class="text-danger mt-2">{{ $message }}</div>
                                                @enderror
                                                <div class="input-group mb-3">
                                                    <input name="mname" type="text" class="form-control"
                                                        placeholder="Middle Name" value="{{ old('mname') }}"
                                                        required>
                                                </div>
                                                @error('mname')
                                                    <div class="text-danger mt-2">{{ $message }}</div>
                                                @enderror
                                                <div class="input-group mb-3">
                                                    <input name="lname" type="text" class="form-control"
                                                        placeholder="Last Name" value="{{ old('lname') }}" required>
                                                </div>
                                                @error('lname')
                                                    <div class="text-danger mt-2">{{ $message }}</div>
                                                @enderror
                                                <div class="input-group mb-3">
                                                    <input name="address" type="text" class="form-control"
                                                        placeholder="Address" value="{{ old('address') }}">
                                                </div>
                                                @error('address')
                                                    <div class="text-danger mt-2">{{ $message }}</div>
                                                @enderror
                                                <div class="input-group mb-3">
                                                    <input name="contact_number" type="number" class="form-control"
                                                        placeholder="Contact Number"
                                                        value="{{ old('contact_number') }}">
                                                </div>
                                                @error('contact_number')
                                                    <div class="text-danger mt-2">{{ $message }}</div>
                                                @enderror
                                                <div class="input-group mb-3">
                                                    <input name="email" type="email" class="form-control"
                                                        placeholder="Email" value="{{ old('email') }}">
                                                </div>
                                                @error('email')
                                                    <div class="text-danger mt-2">{{ $message }}</div>
                                                @enderror
                                                <div class="input-group mb-3">
                                                    <select name="reason" class="form-control" required>
                                                        <option value="" disabled selected> Please Select Payment
                                                            Option</option>
                                                        <option value="Walkin">Cash</option>
                                                        <option value="Online">Online</option>
                                                    </select>
                                                </div>
                                                @error('reason')
                                                    <div class="text-danger mt-2">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary "
                                                    data-dismiss="modal">Close</button>
                                                <button class="btn btn-success " type="submit">Book</button>
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
</div>
