@extends('layouts.app')

@section('content')
    

<section class="vh-100" style="background-image: url('{{ asset('uploads/seas1.png') }}'); background-size: cover; background-repeat: no-repeat;
    background-position: center; 
    position: relative;">

<div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col col-xl-10">
        <div class="card" style="border-radius: 1rem;">
          <div class="row g-0">
            <div class="col-md-6 col-lg-5 d-none d-md-block">
              <img src="{{ asset('uploads/logo.png') }}"
                alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
              
            </div>
            <div class="col-md-6 col-lg-7 d-flex align-items-center">
              <div class="card-body p-4 p-lg-5 text-black">

    
            <div class="col-md-9 register-right">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                       
                        <form action="{{ route('reg') }}" method="post" enctype="multipart/form-data">
                        <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Create account</h5>
                            @csrf
                            <div class="row register-form">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="input-group mb-3">
                                            <input name="username" type="text" class="form-control"
                                                placeholder="Username" value="{{ old('username') }}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group mb-3">
                                            <input name="password" type="password" class="form-control"
                                                placeholder="Password">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group mb-3">
                                            <input name="password_confirmation" type="password" class="form-control"
                                                placeholder="Retype password">
                                        </div>
                                        @error('password')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group mb-3">
                                            <input name="fname" type="text" class="form-control"
                                                placeholder="First Name" value="{{ old('fname') }}">
                                        </div>
                                        @error('fname')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group mb-3">
                                            <input name="mname" type="text" class="form-control"
                                                placeholder="Middle Name" value="{{ old('mname') }}">
                                        </div>
                                        @error('mname')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group mb-3">
                                            <input name="lname" type="text" class="form-control"
                                                placeholder="Last Name" value="{{ old('lname') }}">
                                        </div>
                                        @error('lname')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="input-group mb-3">
                                            <input name="address" type="text" class="form-control" placeholder="Address"
                                                value="{{ old('address') }}">
                                        </div>
                                        @error('address')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group mb-3">
                                            <input name="contact_number" type="number" class="form-control"
                                                placeholder="Contact Number" value="{{ old('contact_number') }}">
                                        </div>
                                        @error('contact_number')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group mb-3">
                                            <input name="email" type="email" class="form-control" placeholder="Email"
                                                value="{{ old('email') }}">
                                        </div>
                                        @error('email')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group mb-3">
                                            <div class="captcha">
                                                <span>{!! captcha_img('math') !!}</span>
                                                <button type="button" class="btn btn-danger " onclick="qwe()">
                                                    <i class="fa-solid fa-arrows-rotate"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="input-group mb-3">
                                            <input type="text" name="captcha" class="form-control"
                                                placeholder="Captcha">
                                        </div>
                                        @error('captcha')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="text-center text-lg-start mt-4 pt-2">
                            <button type="submit" class="btn btn-dark btn-lg btn-block"
                                style="padding-left: 2.5rem; padding-right: 2.5rem;"  class="btnRegister" value="Register">Register</button>

                                    
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
  
    </section>
@endsection
