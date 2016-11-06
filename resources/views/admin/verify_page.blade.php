@extends('welcome')

@section('content')
        <div class="login-box">
          <div class="login-logo">
            <a href="/"><b>RSG</b>RT
            <div style="font-size:11px;margin:-5px 0px 0px 0px;">SHARING IS CARING</div></a>
          </div>
          <div class="login-box-body">
            <p class="login-box-msg">Your Account is waiting for admin appproval</p>
            <p class="login-box-msg" style="background:#eee;padding:5px;text-align:justify;text-indent:35px">In order to monitor the user that wanted to use this web application. We enabled the Approval Procedure and review the account`s info if it is legit or not. Please keep on checking your email(<b>{{Auth::user()->email}}</b>) for updates in your account status.</p>
            <div class="social-auth-links text-center">
              <p>- Check your account by clicking the bottom below -</p>
              <a class="btn btn-block btn-social btn-success btn-flat text-center" onclick="location.reload()"><i class="fa fa-user"></i> Check if account was approved</a>
              <a href="{{ url('/logout') }}" class="btn btn-block btn-social btn-danger btn-flat text-center" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="fa fa-power-off"></i> Logout</a>
              <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
              /form>              
            </div>
          </div>
        </div>
              <div class="col-md-12">
                <center>
                  <p class="text-red">Excuse our ads. This will help us to keep our site up.</p>
                  <a href="http://propellerads.com/?rfd=2EF"><img src="http://promo.propellerads.com/728x90-popads_1.gif" alt="Propellerads"></a>
            <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
            <!-- RSGMAILER.IO -->
            <ins class="adsbygoogle"
                 style="display:inline-block;width:728px;height:90px"
                 data-ad-client="ca-pub-8284799866518529"
                 data-ad-slot="7401391896"></ins>
            <script>
            (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
                </center>
              </div>
@endsection
