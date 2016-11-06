@extends('admin.admin_layout')
@section('content')
            <section class="content-header">
                <h1>
                    Email Creator
                </h1>
            </section>
            <section class="content">
            	<div class="col-md-8">
                        <div class="box box-primary">
                              <div class="box-header with-border">
                                    <h3 class="box-title">Create Email</h3>
                                    <div class="box-tools pull-right">
                                          <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                    </div>
                              </div>
                              <div class="box-body">
                                    @if(session('notsuccess'))
                                    <div class="alert alert-danger">
                                                {{ session('notsuccess') }}                                 
                                    </div>
                                    @endif
                                    @if(session('success'))
                                    <div class="alert alert-success">
                                                {{ session('success') }}                        
                                    </div>
                                    @endif
                                    <form role="form" method="POST" action="{{ url('/email/create') }}">
                                    {{ csrf_field() }}
                                          <div class="form-group">
                                                <label for="email_user">Username : </label>
                                                <input type="text" id="email_user" name="email_user" class="form-control" placeholder="enter your desire username for your email.">
                                          </div>
                                          <div class="form-group">
                                                <label for="email_domains">Domain : </label>
                                                <select class="form-control" name="domain">
                                                      <option value="uyemailoh.io">uyemailoh.io</option>
                                                      <option value="inputoutputisreal.io">inputoutputisreal.io</option>
                                                      <option value="leechers.io">leechers.io</option>
                                                      <option value="whyyoudothis.io">whyyoudothis.io</option>
                                                      <option value="pogingmailer.io">pogingmailer.io</option>
                                                      <option value="pogingphdejavu.io">pogingphdejavu.io</option>
                                                      <option value="rsg-gwapogi.io">rsg-gwapogi.io</option>
                                                      <option value="rsgmailer.io">rsgmailer.io</option>
                                                </select>
                                          </div>
                                          <div class="form-group">
                                                <label for="password">Password : </label>
                                                <input type="password" id="password" name="password" class="form-control" placeholder="enter your desire password for your email.">
                                          </div>
                                          <div class="form-group">
                                                <label for="confirm_password">Confirm Password : </label>
                                                <input type="password" id="confirm_password" name="confirm_password" class="form-control" placeholder="confirm your password for your email.">
                                          </div>
                                          <button type="submit" class="btn btn-success pull-left">Create</button>
                                          <button type="reset" class="btn btn-danger pull-right">Clear All</button>
                                    </form>
                              </div>
                        </div>
            	</div>
                  <div class="col-md-4">
                        @include('admin.subs.subnavi')
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
            </section>
            <div style="clear:both"></div>
@endsection