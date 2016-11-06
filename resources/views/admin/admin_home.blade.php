<?php use App\User; ?>
<?php use App\Emails; ?>
@extends('admin.admin_layout')
@section('content')
            <section class="content-header">
                <h1>
                    Welcome {{ Auth::user()->name }}
                    <small>(Account Created : {{ date('M d, Y H:i A',strToTime(Auth::user()->created_at)) }})</small>
                </h1>
            </section>
            <section class="content">
            	@if(session('message'))
            		<?=session('message')?>
            	@endif
            	<div class="row">
            		<div class="col-md-3">
						<div class="small-box bg-green">
							<div class="inner">
								<h3>{{ Auth::user()->credits }}</h3>
								<p>Credits</p>
							</div>
							<div class="icon">
								<i class="fa fa-diamond"></i>
							</div>
							<a href="{{ url('user/'.Auth::user()->id) }}" class="small-box-footer">
								See More <i class="fa fa-arrow-circle-right"></i>
							</a>
						</div>
            		</div>
            		<div class="col-md-3">
						<div class="small-box bg-blue">
							<div class="inner">
								<h3>{{ Emails::where('created_by','=',Auth::user()->id)->count() }}</h3>
								<p>Email Accounts</p>
							</div>
							<div class="icon">
								<i class="fa fa-envelope-o"></i>
							</div>
							<a href="{{ url('email/list') }}" class="small-box-footer">
								See More <i class="fa fa-arrow-circle-right"></i>
							</a>
						</div>
            		</div>
            		<div class="col-md-3">
						<div class="small-box bg-aqua">
							<div class="inner">
								<h3>{{ User::all()->count() }}</h3>
								<p>All Users</p>
							</div>
							<div class="icon">
								<i class="fa fa-users"></i>
							</div>
							<a href="{{ url('account/list') }}" class="small-box-footer">
								See More <i class="fa fa-arrow-circle-right"></i>
							</a>
						</div>
            		</div>
            		<div class="col-md-3">
						<div class="small-box bg-orange">
							<div class="inner">
								<h3>{{ User::where('approved','=',0)->orWhere('approved','=',2)->count() }}</h3>
								<p>Pending Accounts</p>
							</div>
							<div class="icon">
								<i class="fa fa-user-times"></i>
							</div>
							<a href="{{ url('account/list/unapproved') }}" class="small-box-footer">
								See More <i class="fa fa-arrow-circle-right"></i>
							</a>
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
            </section>
            <div style="clear:both"></div>
@endsection