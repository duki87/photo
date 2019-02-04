@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
      <div class="col-md-4 mx-auto">
        <form class="form-signin" method="POST" action="{{ route('login') }}">
          @csrf
          <div class="text-center mb-4">
            <img class="mb-4" src="img/logo-2.png" alt="" width="100%" height="">
          </div>

          <div class="form-label-group">
            <input type="email" id="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Email address"  name="email" value="{{ old('email') }}" required autofocus>
            <label for="inputEmail" style="color:white">Email address</label>
            @if ($errors->has('email'))
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('email') }}</strong>
              </span>
            @endif
          </div>

          <div class="form-label-group">
            <input type="password" id="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Password" name="password" required>
            <label for="inputPassword" style="color:white">Password</label>

            @if ($errors->has('password'))
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('password') }}</strong>
              </span>
            @endif
          </div>

          <div class="checkbox mb-3">

            <input class="" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

            <label class="form-check-label" for="remember" style="color:white">
                {{ __('Remember Me') }}
            </label>
          </div>
          <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>

          @if (Route::has('password.request'))
              <a class="btn btn-link" href="{{ route('password.request') }}">
                  {{ __('Forgot Your Password?') }}
              </a>
          @endif
          <p class="mt-5 mb-3 text-muted text-center">&copy; 2017-2018</p>
        </form>
      </div>
    </div>
</div>
@endsection
