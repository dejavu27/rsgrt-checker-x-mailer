@extends('admin.admin_layout')
@section('content')
            <section class="content-header">
                <h1>
                    CC Checker via Stripe API
                </h1>
            </section>
            <section class="content">
            	<div class="col-md-8">
            		<div class="callout callout-warning">
            			<h4>Important Note!</h4>
            			<p>
            				If you entered a wrong pattern of the credit card details. You`ll get an error and checking will not proceed properly.
            			</p>
            		</div>
            		<form method="post" action="{{ url('/checker/stripe') }}">
            			{{ csrf_field() }}
            			<div class="form-group">
            				<label>Credit Card Details(1 cc per line)</label>
            				<textarea name="ccdetails" class="form-control" placeholder="e.g : 5121072289791131|06|2017|374" rows="15" style="width:100%;resize:none">{{ session('oldtext') }}</textarea>
            			</div>
            			<div class="form-group">
            				<label>Stripe API</label>
            				<input type="text" name="apikey" required autocomplete="on" class="form-control" placeholder="Enter API KEY here from your own or from list. e.g : sk_live_x1pXrdDxn7hQM7hkogT7ff7S" value="{{ session('oldkey') }}">
            			</div>
            			<button type="submit" name="checking" value="1" class="btn btn-success pull-left">START CHECKING NIGGUH!</button>
            			<a href="{{ url('/checker/stripe/guide') }}" class="btn btn-primary pull-right">CREATE AN API KEY</a>
            			<br><br>
            		</form>
            		<div style="clear:both"></div>
            	</div>
            	<div class="col-md-4">
            	@if(session('results') && in_array('witherror',session('results')))
            		<div class="box box-danger">
            			<div class="box-header box-border">
            				<h3 class="box-title">Error Compilation</h3>
            			</div>
            			<div class="box-body">
            				<table class="table table-striped">
            					<tbody>
            						<?php $lasterror = ""; ?>
            						@foreach(session('results') as $error)
            						@if($error != "witherror" && $lasterror != $error)
            						<tr>
            							<td>{{ $error['message'] }}</td>
            						</tr>
            						</tbody>
            						<?php $lasterror = $error; ?>
            						@endif
            						@endforeach
            					</tbody>
            				</table>
            			</div>
            		</div>
            	@endif
            	@if(session('results') && in_array('withouterror',session('results')))
            		<div class="box box-primary">
            			<div class="box-header box-border">
            				<h3 class="box-title">RESULTS</h3>
            			</div>
            			<div class="box-body">
		            		<table class="table table-bordered table-hover">
		            			<thead>
		            				<tr>
		            					<th>CC Number</th>
		            					<th>Expiration</th>
		            					<th>Cvv</th>
		            					<th>Status</th>
		            				</tr>
		            			</thead>
		            			<tbody>
		            				@foreach(session('results') as $result)
		            				@if($result != "withouterror")
		            				<tr>
		            					<td>{{ $result['number'] }}</td>
		            					<td>{{ $result['exp_month'] }}/{{ $result['exp_year'] }}</td>
		            					<td>{{ $result['cvc'] }}</td>
		            					<td>@if($result['code'] == 0) <span class="label label-danger">DEAD</span> @else <span class="label label-success">LIVE</span> @endif</td>
		            				</tr>
		            				@endif
		            				@endforeach
		            			</tbody>
		            		</table>
            			</div>
            		</div>
            	@endif
            		<div class="box box-success">
            			<div class="box-header box-border">
            				<h3 class="box-title">API Keys</h3>
            			</div>
            			<div class="box-body">
            				<div class="callout callout-info">
            					<h4>Contribute here!</h4>
            					<p>If you`d like to contribute your created Stripe Api Key, Just drop a message on my <a href="https://www.facebook.com/messages/rad.webdeveloper" target="_blank">facebook account</a>. Thank you!</p>
            				</div>
            				<table class="table table-striped">
            					<tbody>
            						<tr>
            							<td>sk_live_x1pXrdDxn7hQM7hkogT7ff7S</td>
            						</tr>
            						<tr>
            							<td>sk_live_cgOwv4NOkDjEiQDES25uJzHZ</td>
            						</tr>
            					</tbody>
            				</table>
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