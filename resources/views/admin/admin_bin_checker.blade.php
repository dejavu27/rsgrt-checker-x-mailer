@extends('admin.admin_layout')
@section('content')
            <section class="content-header">
                <h1>
                    BIN Checker
                </h1>
            </section>
            <section class="content">
            	<div class="col-md-8">
	            	<form method="post" action="{{ url('/checker/bin') }}">
	            		{{ csrf_field() }}
	            		<div class="form-group">
	            			<label>BIN : </label>
							<div class="input-group">
								<input type="text" name="bin" class="form-control" placeholder="Enter your BIN here. e.g : 414720xxxxxxxxxx" required value="{{ session('oldbin') }}" minlength="6" maxlength="16" autofocus>
								<span class="input-group-btn">
									<button class="btn btn-success" type="submit">CHECK</button>
								</span>
							</div>
	            		</div>
	            	</form>
	            	@if(session('results'))
	            	<div class="form-group">
	            		<label>Results : </label>
	            		<div class="box box-primary">
	            			<div class="box-body">
	            		<table class="table table-border table-striped">
	            		<?php $res = session('results'); ?>
	            			<tr>
	            				<td style="font-weight: bolder" align="center" valign="middle">BIN</td>
	            				<td align="center" valign="middle">
	            				@if(isset($res['bin']) && $res['bin'] !== null) 
	            					{{ $res['bin'] }} 
	            				@else
	            					<span class="text-red">NOT AVAILABLE</span>
	            				@endif
	            				</td>
	            			</tr>
	            			<tr>
	            				<td style="font-weight: bolder" align="center" valign="middle">BRAND</td>
	            				<td align="center" valign="middle">
	            				@if(isset($res['brand']) && $res['brand'] !== null) 
	            					{{ $res['brand'] }}
	            				@else
	            					<span class="text-red">NOT AVAILABLE</span>
	            				@endif
	            				</td>
	            			</tr>
	            			<tr>
	            				<td style="font-weight: bolder" align="center" valign="middle">COUNTRY</td>
	            				<td align="center" valign="middle">
	            				@if(isset($res['country_name']) && $res['country_name'] !== null) 
	            					{{ $res['country_name'] }}
	            				@else
	            					<span class="text-red">NOT AVAILABLE</span>
	            				@endif
	            				</td>
	            			</tr>
	            			<tr>
	            				<td style="font-weight: bolder" align="center" valign="middle">BANK</td>
	            				<td align="center" valign="middle">
	            				@if(isset($res['bank']) && $res['bank'] !== null) 
	            					{{ $res['bank'] }}
	            				@else
	            					<span class="text-red">NOT AVAILABLE</span>
	            				@endif
	            				</td>
	            			</tr>
	            			<tr>
	            				<td style="font-weight: bolder" align="center" valign="middle">CARD TYPE</td>
	            				<td align="center" valign="middle">
	            					@if(isset($res['card_type']) && $res['card_type'] !== null) 
	            						@if($res['card_type'] == "DEBIT") 
	            							<span class="text-red">{{ $res['card_type'] }}</span> 
	            						@else 
	            							<span class="text-primary">{{ $res['card_type'] }}</span> 
	            						@endif 
	            					@else
	            						<span class="text-red">NOT AVAILABLE</span>
	            					@endif
	            				</td>
	            			</tr>
	            		</table>
	            			</div>
	            		</div>
	            	</div>
	            	@endif
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