@extends('admin.admin_layout')
@section('content')
            <section class="content-header">
                <h1>
                    Stripe API Creation Guideline
                </h1>
            </section>
            <section class="content">
		        <div class="col-md-12">
		          <div class="box box-solid">
		            <div class="box-header with-border">
		              <i class="fa fa-text-width"></i>
		              <h3 class="box-title">Let us start!</h3>
		            </div>
		            <div class="box-body">
		              <ul>
		                <li>Register at <a href="https://dashboard.stripe.com/register" target="_blank">https://dashboard.stripe.com/register</a></li>
		                <li>Confirm your Stripe email address </li>
		                <li> Once logged in, turn button to LIVE in top left </li>
		                <li>Enter Requested information, You can use <a href="http://fakenamegenerator.com/" target="_blank">fakegenerator</a>. ( <span class="text-red">WARNING! Country : US , Business type change to CORPERATION</span> )</li>
		                <li>After accounts actived, turn button to LIVE in top left ( again )</li>
		                <li>Go to <a href="https://dashboard.stripe.com/account" target="_blank">https://dashboard.stripe.com/account</a> ( <span class="text-red">WARNING! Uncheck Sellect CVC verification</span> )</li>
		                <li>Go to <a href="https://dashboard.stripe.com/account/apikeys" target="_blank">https://dashboard.stripe.com/account/apikeys</a> ( <span class="text-red">Copy the Live Secret Key : <span class="text-green">sk_live_xxxxxxxxx</span></span> ) <span class="text-red">Live Secret Key = APIKEY</span> </li>
		                <li>Finished :) Happy Checking :) </li>
		              </ul>
		              <b>
		              <ul>
		              	<li>Routing (ABA) : 312270379</li>
		              	<li>Account Number : 00003526113916232</li>
		              	<li>TAX ID Number : 942737593</li>
		              </ul>
		              </b>
		            </div>
		            <div class="box-footer">
		            	<a href="{{ url('/checker/stripe') }}" class="btn btn-primary">Back to Checker</a>
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