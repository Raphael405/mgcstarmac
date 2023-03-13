<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('uploads/logo.png') }}">
    <title>MGC Star-mac Resort and Hotel</title>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.5/css/bootstrap-theme.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    @livewireStyles

    <style>
        h4 {
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
            font-size: 20px
        }

        h6 {
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
            font-size: 15px
        }

        h5 {
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
            font-size: 20px
        }

        h2 {
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
            font-size: 30px
        }

        h1 {
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
            font-size: 35px
        }

        h3 {
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
            font-size: 25px
        }

        p {
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
            font-size: 10px
        }

        label {
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
            font-size: 13px
        }

        .register {
            background: -webkit-linear-gradient(left, #3931af, #00c6ff);
            padding: 3%;
        }

        .register-left {
            text-align: center;
            color: #fff;
            margin-top: 4%;
        }

        .register-left input {
            border: none;
            border-radius: 1.5rem;
            padding: 2%;
            width: 60%;
            background: #f8f9fa;
            font-weight: bold;
            color: #383d41;
            margin-top: 30%;
            margin-bottom: 3%;
            cursor: pointer;
        }

        .register-right {
            background: #f8f9fa;
            border-top-left-radius: 10% 50%;
            border-bottom-left-radius: 10% 50%;
        }

        .register-left img {
            margin-top: 15%;
            margin-bottom: 5%;
            width: 25%;
            -webkit-animation: mover 2s infinite alternate;
            animation: mover 1s infinite alternate;
        }

        @-webkit-keyframes mover {
            0% {
                transform: translateY(0);
            }

            100% {
                transform: translateY(-20px);
            }
        }

        @keyframes mover {
            0% {
                transform: translateY(0);
            }

            100% {
                transform: translateY(-20px);
            }
        }

        .register-left p {
            font-weight: lighter;
            padding: 12%;
            margin-top: -9%;
        }

        .register .register-form {
            padding: 10%;
            margin-top: 10%;
        }

        .btnRegister {
            float: right;
            margin-top: 10%;
            border: none;
            border-radius: 1.5rem;
            padding: 2%;
            background: #0062cc;
            color: #fff;
            font-weight: 600;
            width: 50%;
            cursor: pointer;
        }

        .register .nav-tabs {
            margin-top: 3%;
            border: none;
            background: #0062cc;
            border-radius: 1.5rem;
            width: 28%;
            float: right;
        }

        .register .nav-tabs .nav-link {
            padding: 2%;
            height: 34px;
            font-weight: 600;
            color: #fff;
            border-top-right-radius: 1.5rem;
            border-bottom-right-radius: 1.5rem;
        }

        .register .nav-tabs .nav-link:hover {
            border: none;
        }

        .register .nav-tabs .nav-link.active {
            width: 100px;
            color: #0062cc;
            border: 2px solid #0062cc;
            border-top-left-radius: 1.5rem;
            border-bottom-left-radius: 1.5rem;
        }

        .register-heading {
            text-align: center;
            margin-top: 8%;
            margin-bottom: -15%;
            color: #495057;
        }

        body {
            margin: 0px;
            height: 20px;
        }
        .navbar-custom {
  height: 60px;
}

    </style>
</head>

<body >
    


    <nav  class="navbar navbar-expand navbar-info d-flex justify-content-between navbar navbar-light navbar navbar-custom" style="background-color: #e3f2fd; ">
      
  
    @auth
            <ul class="navbar-nav ">
                <button class="btn  btn-lg">
                    <i class="fa-solid fa-user"></i>
                    <li class="nav-item d-none d-sm-inline-block pr-3">
                        <h4><a class="nav-link text-bold text-dark" data-toggle="collapse" href="#multiCollapseExample1"
                                role="button" aria-expanded="false" aria-controls="multiCollapseExample1">Profile</a></h4>
                    </li>
                </button>
            </ul>
        @endauth
        <ul class="navbar-nav ">
            <button class="btn btn-lg ">
                <i class="fa-solid fa-house"></i>
                <li class="nav-item d-none d-sm-inline-block pr-3">

        <h4 @if (Route::currentRouteName() == 'home') style="text-decoration: underline" @endif>
        <a href="{{ route('home') }}" class="nav-link text-bold text-dark">Home</a></h4>
                </li>
            </button>
            @auth
                @if (auth()->user()->user_types_id == 1)
                    <button class="btn btn-lg">
                        <i class="fa-solid fa-hotel"></i>
                        <li class="nav-item d-none d-sm-inline-block">
                            <h4 @if (Route::currentRouteName() == 'services') style="text-decoration: underline" @endif><a
                                    href="{{ route('services') }}" class="nav-link text-bold text-dark">Amenities</a></h4>
                        </li>
                    </button>
                @endif
                @if (auth()->user()->user_types_id == 1 || auth()->user()->user_types_id == 2)
                    <button class="btn  btn-lg">
                        <i class="fa-solid fa-book"></i>
                        <li class="nav-item d-none d-sm-inline-block">
                            <h4 @if (Route::currentRouteName() == 'bookings') style="text-decoration: underline" @endif><a
                                    href="{{ route('bookings') }}" class="nav-link text-bold text-dark">Bookings</a></h4>
                        </li>
                    </button>
                    <button class="btn  btn-lg ">
                        <i class="fa-solid fa-person-walking"></i>
                        <li class="nav-item d-none d-sm-inline-block">
                            <h4 @if (Route::currentRouteName() == 'walkin') style="text-decoration: underline" @endif><a
                                    href="{{ route('walkin') }}" class="nav-link text-bold text-dark">Walk-ins</a></h4>
                        </li>
                    </button>
                    <button class="btn  btn-lg ">
                        <i class="fa-solid fa-peso-sign"></i>
                        <li class="nav-item d-none d-sm-inline-block">
                            <h4 @if (Route::currentRouteName() == 'sales') style="text-decoration: underline" @endif><a
                                    href="{{ route('sales') }}" class="nav-link text-bold text-dark">Sales</a></h4>
                        </li>
                    </button>
                @endif
            @endauth
        </ul>
        <ul class="navbar-nav">
            @auth
                @if (auth()->user()->user_types_id == 3)
                    <button class="btn  btn-lg ">
                        <li class="nav-item d-none d-sm-inline-block">
                          
                        <h4 @if (Route::currentRouteName() == 'profile.show') style="text-decoration: underline" @endif>
                        <a
                                    href="{{ route('profile.show', [auth()->user()->id, 'current']) }}"
                                    class="nav-link text-dark mr-4 text-uppercase"
                                    style="border-radius: 8px;">{{ auth()->user()->username }}</a>
                                </h4>
                        </li>
                    </button>
                @endif
                <button class="btn btn-lg text-danger">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <li class="nav-item d-none d-sm-inline-block">
                        <h4><a href="{{ route('logout') }}" class="nav-link text-danger "
                                style="border-radius: 8px;">Logout</a>
                        </h4>
                    </li>
                </button>
            @endauth
            @guest
            
                <button class="btn btn-lg ">
                    <i class="fa-solid fa-right-to-bracket"></i>
                    <li class="nav-item d-none d-sm-inline-block">
                        <h4 @if (Route::currentRouteName() == 'login') style="text-decoration: underline" @endif><a
                                href="{{ route('login') }}" class="nav-link text-bold text-dark mr-5">Login</a></h4>
                    </li>
                </button>
                <button class="btn btn-lg">
                    <i class="fa-regular fa-address-card"></i>
                    <li class="nav-item d-none d-sm-inline-block">
                        <h4 @if (Route::currentRouteName() == 'register') style="text-decoration: underline" @endif><a
                                href="{{ route('register') }}" class="nav-link text-bold text-dark mr-5"> Sign Up</a>
                        </h4>
                    </li>
                </button>
            @endguest
        </ul>
    </nav>
    @auth
        <div class="collapse multi-collapse" id="multiCollapseExample1">
            <div class="card">
                <div class="card-body text-dark">
                    <form action="{{ route('profile.update') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{ auth()->user()->id }}">
                        <div class="row gutters">
                           
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                <div class="form-group">
                                    <label for="occupation">Firstname</label>
                                    <input type="text" class="form-control" id="fname" name="fname"
                                        placeholder="Firstname " value="{{ auth()->user()->fname }}">
                                    @error('fname')
                                        <div class="text-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                <div class="form-group">
                                    <label for="occupation">Middlename</label>
                                    <input type="text" class="form-control" id="mname" name="mname"
                                        placeholder="Middlename " value="{{ auth()->user()->mname }}">
                                    @error('mname')
                                        <div class="text-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                <div class="form-group">
                                    <label for="Lastname">Lastname</label>
                                    <input type="text" class="form-control" id="lname" name="lname"
                                        placeholder="Lastname" value="{{ auth()->user()->lname }}">
                                </div>
                                @error('lname')
                                    <div class="text-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        @if (auth()->user()->id == auth()->user()->id)
                            <div class="row gutters">
                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                    <div class="form-group">
                                        <label for="occupation">Email</label>
                                        <input type="email" class="form-control" id="email" name="email"
                                            placeholder="Enter Embail" value="{{ auth()->user()->email }}">
                                        @error('email')
                                            <div class="text-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                    <div class="form-group">
                                        <label for="citizenship">Contact Number</label>
                                        <input type="number" class="form-control" id="contact_number"
                                            name="contact_number" placeholder="Enter Contasct Number"
                                            value="{{ auth()->user()->contact_number }}">
                                    </div>
                                    @error('contact_number')
                                        <div class="text-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                <div class="form-group">
                                        <label for="voters_id">Addres</label>
                                        <textarea class="form-control" id="address" name="address">{{ auth()->user()->address }}</textarea>
                                        @error('address')
                                            <div class="text-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
    </div>
                            </div>
                         
                        @endif
                        <div class="row gutters">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="text-right">
                                    <a class="btn btn-primary" data-toggle="collapse" href="#multiCollapseExample1"
                                        role="button" aria-expanded="false"
                                        aria-controls="multiCollapseExample1">Cancel</a>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    @if (auth()->user()->id == auth()->user()->id)
                        <form action="{{ route('profile.changepass') }}" method="post">
                            @csrf
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <h6 class="mb-3 text-primary">Change Password</h6>
                            </div>
                            <input type="hidden" name="id" id="id" value="{{ auth()->user()->id }}">
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                <div class="form-group">
                                    <label for="email">Old Password</label>
                                    <input type="password" class="form-control" id="old" name="old"
                                        placeholder="Old Password " value="">
                                    @error('msg')
                                        <div class="text-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                <div class="form-group">
                                    <label for="password">New Password</label>
                                    <input type="password" class="form-control" id="password" name="password"
                                        placeholder="New Password" value="">
                                </div>
                                @error('password')
                                    <div class="text-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                <div class="form-group">
                                    <label for="password">Confirm Password</label>
                                    <input type="password" class="form-control" id="password_confirmation"
                                        name="password_confirmation" placeholder="Confirm Password" value="">
                                </div>
                                @error('password_confirmation')
                                    <div class="text-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            @error('success')
                                <div class="text-success mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                            <div class="row gutters">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="text-right">
                                        <button type="submit" class="btn btn-primary">Change
                                            Password</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    @endauth
    <div class="" style="width: 100%; height:100%">
        @yield('content')
    </div>
    @livewireScripts
   
</body>

</html>
