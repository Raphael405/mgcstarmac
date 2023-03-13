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

              <form action="{{ route('log') }}" method="post">
              <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Sign into your account</h5>
                <!-- USERNAME -->
                        @csrf
                        @if (session('status'))
                            <div class="bg-danger p-3 rounded-lg mb-4 text-white text-center">
                                {{ session('status') }}
                            </div>
                        @endif
                        
                        <div class="form-outline mb-4">
                    <input type="text" name="username" placeholder="Username" id="form2Example17" class="form-control form-control-lg" />

                    <label class="form-label" for="form2Example17">Username</label>
                  </div>
                        @error('username')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                        <!-- PASSWORD -->
                        <div class="form-outline mb-4">
                    <input type="password" name="password" id="form2Example27" placeholder="Password" class="form-control form-control-lg" />
                    <label class="form-label" for="form2Example27">Password</label>
                  </div>

                        @error('password')
                            <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror

                            <!-- CAPTCHA -->
                        <div class="input-group mb-4">
                            <div class="captcha">
                                <span>{!! captcha_img('math') !!}</span>
                                <button type="button" class="btn btn-danger "  onclick="qwe()">
                                    <i class="fa-solid fa-arrows-rotate"></i>
                                </button>
                            </div>
                        </div>
                            <div class="input-group mb-4">
                            <input type="text" name="captcha" class="form-control form-control-lg"placeholder="Input Captcha">
                          
                        </div>
                        @error('captcha')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                      
                      <!-- REMEMBER ME -->
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="form-check mb-0">
                                <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3" />
                                <label class="form-check-label" for="form2Example3">
                                    Remember me
                                </label>
                            </div>
                        </div>

                      

                        <div class="text-center text-lg-start mt-4 pt-2">
                            <button type="submit" class="btn btn-dark btn-lg btn-block"
                                style="padding-left: 2.5rem; padding-right: 2.5rem;">Login</button>

                                
                            <p class="small fw-bold mt-2 pt-1 mb-0">Don't have an account? <a href="{{ route('register') }}"
                                    class="link-danger">Register</a></p>
                        </div>
                    </form>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


@endsection
<script>

    
    function qwe() {
        $.ajax({
            type: 'GET',
            url: 'reload-captcha',
            success: function(data) {
                $(".captcha span").html(data.captcha)
            }
        });
    }
</script>
