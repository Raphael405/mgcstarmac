


<div class="container-fluid p-0">
    <div class="text-center text-white pt-5"
        style="height: 400px ; background-image: url('{{ asset('uploads/logobg.png') }}'); background-size: cover; background-repeat: no-repeat;
background-position: center; 
position: relative;">
        <h1 class="text-uppercase text-bold pt-5 mt-5"
            style="font-size: 50px; font-family:Verdana, Geneva, Tahoma, sans-serif;">MGC Star-mac Resort and Hotel</h1>
        <h4 class="">Mauswagon Laguindingan, Laguindingan, Philippines</h4>
        <h4 class="">Perfect place to relax, to have fun, and to spend your special days.</h4>
    </div>


    <div class="text-center pt-5 pb-5 "
        style=" background-image: url('{{ asset('uploads/resort/im10.png') }}'); background-size: cover; background-repeat: no-repeat;
background-position: center; position: relative;">


        <div class="d-flex justify-content-center ">
            <div class="card d-flex text-dark"  style="width: 1000px; height: 100px">
                <div class="row pt-3 pb-3">
                    <div class="col-xl-6">
                        <button wire:click="change(1)" 
                            class="btn rounded-pill @if ($type === 1) btn-primary @endif" style="width: 200px; height: 80px">
                            <h4><i class="fa-solid fa-hotel"></i><br> Hotels and Rooms</h4>
                        </button>
                    </div>
                    <div class="col-xl-6">
                        <button wire:click="change(2)"
                            class="btn rounded-pill  @if ($type === 2) btn-primary @endif" style="width: 200px; height: 80px">
                            <h4><i class="fa-solid fa-vihara"></i><br> Cottages</h4>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        
        
        
        <div class="d-flex justify-content-center">
            <div class="card" style="width: 1000px; height: 100%">
                <div class="wrapper pt-5 pl-5 pr-5">
                    <br>

                    
                    <div class="">
                        {{-- <select name="service_id" class="form-control" wire:model="selected">
                            @if ($type == 1)
                                <option value="" disabled>Please Select Hotel Room</option>
                                @foreach ($hotels as $h)
                                    <option value="{{ $h->id }}">{{ $h->name }}</option>
                                @endforeach
                            @else
                                <option value="" disabled>Please Select Cottage</option>
                                @foreach ($cottages as $h)
                                    <option value="{{ $h->id }}">{{ $h->name }}</option>
                                @endforeach
                            @endif
                        </select> --}}
                        <div class="row overflow-auto" style="height: 350px">
                            @php
                                $holder = [];
                                if ($type == 1) {
                                    $holder = $hotels;
                                } else {
                                    $holder = $cottages;
                                }
                            @endphp
                            @foreach ($holder as $h)
                                <div class="col-md-4 overflow-auto mb-2 pb-2" style="height: 250px">
                                    <div class="text-center">
                                        <div class="form-check">
                                            <input type="checkbox" wire:model="selected.{{ $h->id }}"
                                                value="{{ $h->id }}"
                                                id="flexCheckDefault{{ $h->id }}"><label
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
                    </div>
                    <br>
                    {{-- @if ($service != '')
                        <div class="text-center">
                            <h4>Price: {{ $service->price }}</h4>
                            <h4>Description: {{ $service->description }}</h4>
                            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
                                    @foreach ($service->images as $im)
                                        <div class="carousel-item @if ($loop->index == 0) active @endif">
                                            <a href="{{ asset($im->location) }}"><img
                                                    style="height: 300px; width: 400px; object-fit: contain"
                                                    src="{{ asset($im->location) }}" alt="First slide"></a>
                                        </div>
                                    @endforeach
                                </div>
                                <a class="carousel-control-prev text-dark text-bold" href="#carouselExampleControls"
                                    role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next text-dark text-bold" href="#carouselExampleControls"
                                    role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                        </div>
                    @endif --}}
                    <br>
                    
                    <div class="d-flex justify-content-center pt-3">
                        <div class="col-xl-3 d-flex">
                            <label for="">From: </label>
                            <input type="date" class="form-control form-control-lg " wire:model="from"
                                min="{{ date('Y-m-d') }}">
                        </div>
                        <div class="col-xl-3 pr-3 d-flex">
                            <label for="">To: </label>
                            <input type="date" class="form-control form-control-lg " wire:model="to"
                                min="{{ $from }}">
                        </div>
                    </div>
                    <br>
                    
                    
                    <div class="d-flex justify-content-center pt-6">
                        @if (count($selected) != 0)
                            <button class="btn btn-primary " style="width: 10%" data-toggle="modal"
                                data-target="#book">BOOK</button>
                                <br>
                            
                            
                                <div wire:ignore.self class="modal fade" id="book" tabindex="-1" role="dialog"
                                aria-labelledbys="add" aria-hidden="true">
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

                                                <input type="hidden" value="1" name="quantity">
                                                @guest
                                                    <div class="input-group mb-3">
                                                        <input name="username" type="text" class="form-control"
                                                            placeholder="Username" value="{{ old('username') }}"
                                                            required>
                                                    </div>
                                                    @error('username')
                                                        <div class="text-danger mt-2">{{ $message }}</div>
                                                    @enderror
                                                    <div class="input-group mb-3">
                                                        <input name="password" type="password" class="form-control"
                                                            placeholder="Password" required>
                                                    </div>
                                                    <div class="input-group mb-3">
                                                        <input name="password_confirmation" type="password"
                                                            class="form-control" placeholder="Retype password" required>
                                                    </div>
                                                    @error('password')
                                                        <div class="text-danger mt-2">{{ $message }}</div>
                                                    @enderror
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
                                                @endguest
                                                @auth
                                                    Are you sure you want to book ?
                                                    <div class="input-group mb-3">
                                                        <select name="reason" class="form-control" required>
                                                            <option value="" disabled selected> Please Select Payment
                                                                Option</option>
                                                            <option value="Walkin">Cash</option>
                                                            <option value="Online">Online</option>
                                                        </select>
                                                    </div>
                                                @endauth
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
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


    <div class="text-center text-dark pb-3 pt-3"
        style="background-image: url('{{ asset('uploads/seas2.png') }}'); background-size: cover; background-repeat: no-repeat;
    background-position: center; 
    position: relative;">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-3 col-lg-3 col-md-3 ">
                    <a href="{{ asset('uploads/building.png') }}"><img src="{{ asset('uploads/building.png') }}"
                            alt="" height="100%" width="100%" class=""></a>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-3">
                    <h2 class="text-bold">Hotel Building</h4>
                        <h4 class="mb-5">Our hotel includes the full service provided in any hotel - room cleaning,
                            linen
                            change,
                            security and 24-hour service. This is an excellent alternative to rental housing</h3>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-3 ">
                    <a href="{{ asset('uploads/pool.png') }}"><img src="{{ asset('uploads/pool.png') }}"
                            alt="" height="100%" width="100%" class=""></a>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-3">
                    <h2 class="text-bold">Pool</h2>
                    <h4 class="mb-5">The building is next to the pool which can be accessed anytime.</h4>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-3">
                </div>
                <div class="col-xl-3 col-lg-3 col-md-3">
                    <a href="{{ asset('uploads/seas1.png') }}"><img src="{{ asset('uploads/beach.png') }}"
                            alt="" height="100%" width="100%" class=""></a>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-3">
                    <h2 class="text-bold pt-2">Beach</h2>
                    <h4 class="mb-5">The hotel is beside a beautiful and blue beach which could help and ease the
                        stress you are having.</h4>
                </div>
            </div>
        </div>
    </div>
   


    {{-- <div class=" d-flex justify-content-center align-items-center bg-info">
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel"
            style="height: 100%; width: 100%">
            <div class="carousel-inner">
                @for ($x = 1; $x < 11; $x++)
                    @if ($x == 1)
                        <div class="carousel-item active">
                            <img class="d-block w-100" src="{{ asset('uploads/resort/im' . $x . '.png') }}">
                        </div>
                    @else
                        <div class="carousel-item">
                            <img class="d-block w-100" src="{{ asset('uploads/resort/im' . $x . '.png') }}">
                        </div>
                    @endif
                @endfor
            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div> --}}
    <div class="">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15779.4947096906!2d124.4239364!3d8.6081251!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x2b7ce0107ef807cd!2sMGC%20Star-Mac%20Resort%20and%20Hotel!5e0!3m2!1sen!2sph!4v1674521373711!5m2!1sen!2sph"
            width="100%" height="600px" style="border:0;" allowfullscreen="" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"></iframe>
        {{-- <div id="map" style="height:100%; width: 100%;" class="my-3"></div> --}}
        {{-- <img src="{{ asset('uploads/location.png') }}" alt="" height="100%" width="100%"> --}}
    </div>

    <script async defer src="https://maps.googleapis.com/maps/api/js?key=&callback=initMap" type="text/javascript"></script>
   
   
    <div class=" justify-content-center "style="background-image: url('{{ asset('uploads/resort/im10.png') }}'); background-size: cover; background-repeat: no-repeat;
    background-position: center; position: relative;">

<div class="row g-1">
<div class="col-sm-4">
 <div class="card " style="height: 150px;">
            <div class="card-body">
            
                <h2 class="card-text">About us</h2>
                <p>Ideal place for family accommodation and for those who appreciate comfort and democratic prices.</p>
            </div>
        </div>
</div>
<div class="col-sm-4">
       <div class="card " style="height: 150px;">
            <div class="card-body">
                <h2 class="card-text">Our Contacts</h2>
                <p><i class="fa-solid fa-phone"></i> 0917 794 6006</p>
                <p><i class="fa-solid fa-envelope"></i>
                    marketing.starmacresort@gmail.com</p>
            </div>
        </div>
</div>
<div class="col-sm-4">
 <div class="card " style="height: 150px;">
            <div class="card-body">
                <h2 class="card-text">Location</h2>
                <p><i class="fa-solid fa-house"></i> Mauswagon Laguindingan, Laguindingan, Philippines, 9000</p>
                <p><i class="fa-solid fa-map-location-dot"></i><a
                        href="https://www.google.com/maps/place/MGC+Star-Mac+Resort+and+Hotel/@8.6081251,124.4239364,15z/data=!4m2!3m1!1s0x0:0x2b7ce0107ef807cd?sa=X&ved=2ahUKEwjB45S36NT6AhVw4DgGHVGjC_wQ_BJ6BAhlEAU">
                        Google Map Location</a></p>
            </div>
        </div>
</div>
    
       
     
       
    </div>
    </div>
</div>


<!-- Modal
<div class="modal fade" id="romel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5 " id="exampleModalLabel">WELCOME TO !!!</h1>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
     <h1> MGC STAR-MAC RESORT AND HOTEL</h1>
      </div>
     
    </div>
  </div>
</div>
<script>
    const myModal = new bootstrap.Modal(document.getElementById('romel'));
const Popup  =()=>{
    myModal.show();
}
Popup();
</script> -->