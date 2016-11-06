@extends('welcome')

@section('content')
        <div class="login-box">
          <div class="login-logo">
            <a href="/"><b>RSG</b>RT
            <div style="font-size:11px;margin:-5px 0px 0px 0px;">SHARING IS CARING</div></a>
          </div>
          <div class="login-box-body">
            <p class="login-box-msg">Register now to start your session</p>
            @if ($errors->has('name'))
                <span class="help-block" style="color:red"><strong>{{ $errors->first('name') }}</strong></span>
            @endif
            @if ($errors->has('email'))
                <span class="help-block" style="color:red"><strong>{{ $errors->first('email') }}</strong></span>
            @endif
            @if ($errors->has('password'))
                <span class="help-block" style="color:red"><strong>{{ $errors->first('password') }}</strong></span>
            @endif
            @if ($errors->has('password_confirmation'))
                <span class="help-block" style="color:red"><strong>{{ $errors->first('password_confirmation') }}</strong></span>
            @endif
            <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
            {{ csrf_field() }}
              <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <input type="text" class="form-control" placeholder="Your Full Name" name="name" value="{{ old('name') }}" required autofocus>
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
              </div>
              <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <input type="email" class="form-control" placeholder="Your Email" name="email" value="{{ old('email') }}" required autofocus>
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
              </div>
              <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <input type="password" class="form-control" placeholder="Your Password" name="password" required>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
              </div>
              <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                <input type="password" class="form-control" placeholder="Confirm your Password" name="password_confirmation" required autofocus>
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
              </div>
              <div class="row">
                <div class="col-xs-4 col-md-offset-4">
                  <button type="submit" class="btn btn-primary btn-block btn-flat">REGISTER</button>
                </div>
              </div>
            </form>

            <center><a href="{{ url('/') }}">Back to login</a></center><br>

          </div>
        </div>
@endsection
