@extends('welcome')

@section('content')
        <div class="login-box">
          <div class="login-logo">
            <a href="/"><b>RSG</b>RT
            <div style="font-size:11px;margin:-5px 0px 0px 0px;">SHARING IS CARING</div></a>
          </div>
          <div class="login-box-body">
            <p class="login-box-msg">Sign in to start your session</p>
            @if ($errors->has('email'))
                <span class="help-block" style="color:red"><strong>{{ $errors->first('email') }}</strong></span>
            @endif
            @if ($errors->has('password'))
                <span class="help-block" style="color:red"><strong>{{ $errors->first('password') }}</strong></span>
            @endif
            <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
            {{ csrf_field() }}
              <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <input type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}" required autofocus>
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
              </div>
              <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <input type="password" class="form-control" placeholder="Password" name="password" required>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
              </div>
              <div class="row">
                <div class="col-xs-8">
                  <div class="checkbox icheck">
                    <label>
                      <input type="checkbox" name="remember"> Remember Me
                    </label>
                  </div>
                </div>
                <div class="col-xs-4">
                  <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                </div>
              </div>
            </form>

            <div class="social-auth-links text-center">
              <p>- OR -</p>
              <a href="{{ url('/redirect') }}" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
                Facebook</a>
            </div>

            <a href="{{ url('/password/reset') }}">I forgot my password</a><br>
            <a href="{{ url('/register') }}" class="text-center">Register a new membership</a>

          </div>
        </div>
@endsection
