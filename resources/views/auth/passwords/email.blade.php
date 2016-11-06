@extends('welcome')

<!-- Main Content -->
@section('content')
        <div class="login-box">
          <div class="login-logo">
            <a href="/"><b>RSG</b>RT
            <div style="font-size:11px;margin:-5px 0px 0px 0px;">SHARING IS CARING</div></a>
          </div>
          <div class="login-box-body">
            <p class="login-box-msg">RESET YOUR PASSWORD</p>
            @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
            @endif
            @if ($errors->has('email'))
                <span class="help-block" style="color:red"><strong>{{ $errors->first('email') }}</strong></span>
            @endif
            <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
            {{ csrf_field() }}
              <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <input type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}" required autofocus>
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
              </div>
              <div class="row">
                <div class="col-xs-6 col-md-offset-3">
                  <button type="submit" class="btn btn-primary btn-block btn-flat">RESET PASSWORD</button>
                </div>
              </div>
            </form>

            <center><a href="{{ url('/') }}">Back to login</a></center><br>

          </div>
        </div>
@endsection
