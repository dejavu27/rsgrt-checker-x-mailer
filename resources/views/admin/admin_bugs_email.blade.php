@extends('admin.admin_layout')
@section('content')
            <section class="content-header">
                <h1>
                    Report Email Bugs
                </h1>
            </section>
            <section class="content">
            	<div class="col-md-8">
                @if(session('success'))
                <div class="alert alert-success">
                  {{ session('success') }}
                </div>
                @endif
                @if(session('failed'))
                <div class="alert alert-success">
                  {{ session('failed') }} 
                </div>
                @endif
                <form method="post" action="{{ url('/email/bugs') }}">
                  {{ csrf_field() }}
                  <div class="form-group">
                    <label>Name : </label>
                    <input type="text" name="name" class="form-control" disabled value="{{ Auth::user()->name }}">
                  </div>
                  <div class="form-group">
                    <label>Report Topic : </label>
                    <input type="text" name="topic" class="form-control" placeholder="Enter a topic for your report." required>
                  </div>
                  <div class="form-group">
                    <label>Message : </label>
                    <textarea minlength="5" class="form-control" name="msg" autocomplete="off" rows="10" style="width:100%;resize:none" placeholder="Enter your report message here and let us review and fix it for our beloved users." required></textarea>
                  </div>
                  <button class="btn btn-success" type="submit" name="submitted" value="1">Submit</button>
                  <button class="btn btn-warning" type="reset">Clear All</button>
                </form>
              </div>
              @if(Auth::user()->isAdmin > 0)
              <div class="col-md-4">
                @include('admin.subs.subnavi2')
              </div>
              @endif
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
            </section>
            <div style="clear:both"></div>
@endsection