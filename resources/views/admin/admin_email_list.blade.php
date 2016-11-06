@extends('admin.admin_layout')
@section('content')
            <section class="content-header">
                <h1>
                    Email List
                </h1>
            </section>
            <section class="content">
            	<div class="col-md-8">
                        <div class="box box-primary">
                              <div class="box-header with-border">
                                    <h3 class="box-title">Email List</h3>
                                    <div class="box-tools pull-right">
                                          <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                    </div>
                              </div>
                              <div class="box-body">
                              	@if(session('noerror'))
                              	<div class="alert alert-success">
                              		{{ session('noerror') }}
                              	</div>
                              	@endif
                              	@if(session('failed'))
                              	<div class="alert alert-danger">
                              		{{ session('failed') }}
                              	</div>
                              	@endif
                              	<form action="{{ url('/email/list') }}" method="post">
                              		{{ csrf_field() }}
									<table id="pending_users" class="table table-hover table-bordered" cellspacing="0" width="100%">
									  <thead>
									  	<tr>
									  		<th>&nbsp;</th>
									  		<th>USERNAME</th>
									  		<th>DOMAIN</th>
									  		<th>PASSWORD</th>
									  		<th>QUOTA</th>
									  		<th>CREATED AT</th>
									  	</tr>
									  </thead>
									  <tbody>
									  	<?php
									  	use App\Emails;
									  	$email = Emails::where('created_by','=',Auth::user()->id)->get();
									  	?>
									  	@if($email)
									  		@foreach($email as $emails)
									  	<tr>
									  		<td align="center" valign="middle"><input type="checkbox" name="id[]" value="{{ $emails->id }}"></td>
									  		<td>{{ $emails->email_user }}</td>
									  		<td>{{ $emails->email_domain }}</td>
									  		<td>{{ $emails->email_password }}</td>
									  		<td>{{ ($emails->email_quota/1000) }}GB</td>
									  		<td>{{ date('M d, Y H:i A',$emails->created_date) }}</td>
									  	</tr>
									  		@endforeach
									  	@endif
									  </tbody>
									</table>
									<button class="btn btn-danger" type="submit" name="delpop" value="1">Delete</button>
									<button class="btn btn-warning" type="reset">Uncheck All</button>
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