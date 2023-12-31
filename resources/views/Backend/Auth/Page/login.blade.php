@extends('Backend.Auth.Layouts.app')
@section('Style-Area')
<style>
  .first-heading {
    color: #5C61F2;
    font-size: 35px;
    font-weight: 700;
  }

  .first-heading-1 {
    font-size: 24px;
    font-weight: 700;
  }

  .first-heading-p {
    color: #777777;
    font-size: 14px;
    font-weight: 400;
  }

  .login-card {
    background-repeat: no-repeat;
    background-size: cover;
  }
</style>
@endsection
@section('Cantent-Area')
@if (session('error'))
<div class="alert alert-danger" role="alert">
  <p>{{ session('error') }}</p>
  <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<div class="container-fluid p-0">
  <div class="row m-0">
    <div class="col-12 p-0">
      <div class="login-card">
        <div>
          <div><a class="logo" href="index.html"><img class="img-fluid for-light" src="{{asset('Backend/assets/images/IT-Assets/logo.svg')}}" alt="looginpage"></a></div>
          <div class="login-main">
            <form method="POST" action="{{ route('check-login') }}">
              @csrf
              <h2 class="text-center first-heading">Admin Login</h2>
              <h4 class="text-center pt-3 first-heading-1">Sign in to account</h4>
              <p class="text-center first-heading-p">Enter your email & password to login</p>
              <div class="form-group">
                <label class="col-form-label">Email Address</label>
                <input class="form-control" type="email" name="email" placeholder="User@gmail.com">
              </div>
              <div class="form-group">
                <label class="col-form-label">Password</label>
                <div class="form-input position-relative">
                  <input class="form-control" type="password" id="password" name="password" required="" placeholder="*********">
                  <span class="show" id="password-toggle" style="position: absolute; top: 50%; right: 10px; transform: translateY(-50%); cursor: pointer;"><i class="fa fa-eye"></i></span>
                </div>
              </div>
              <div class="form-group mb-0">
                <div class="checkbox p-0">
                </div><a class="link" href="{{ route('forget.password') }}">Forgot password?</a>
                <div class="text-end mt-3">
                  <button class="btn btn-primary btn-block w-100" type="submit">Sign In </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script>
    const passwordInput = document.getElementById('password');
    const passwordToggle = document.getElementById('password-toggle');
    let isPasswordVisible = false;

    passwordToggle.addEventListener('click', function() {
      isPasswordVisible = !isPasswordVisible;
      passwordInput.type = isPasswordVisible ? 'text' : 'password';
      passwordToggle.innerHTML = isPasswordVisible ? '<i class="fa fa-eye-slash"></i>' : '<i class="fa fa-eye"></i>';
    });
  </script>
  @endsection
  @section('script-area')
  @endsection
