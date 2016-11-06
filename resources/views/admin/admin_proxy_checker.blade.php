@extends('admin.admin_layout')
@section('content')
            <section class="content-header">
                <h1>
                    Proxy Checker
                </h1>
            </section>
            <section class="content">
            	<div class="col-md-8">
            		<div class="callout callout-warning">
            			<h4>IMPORTANT NOTE!</h4>
            			<p>
            				Checking your public proxy using this tool will result to death of the proxy so you should have use a private proxy to use in here. TIMEOUT per proxy is 5 seconds.
            			</p>
            		</div>
            		<form method="post" action="{{ url('/checker/proxy') }}">
            			{{ csrf_field() }}
            			<div class="form-group">
            				<label>PROXY : (1 proxy per line)</label>
            				<textarea class="form-control" name="proxies" placeholdrer="Enter your proxies here. E.g : 172.11.114.5:8080" rows="10" style="width:100%;resize:none"></textarea>
            			</div>
            			<button type="submit" class="btn btn-primary" name="checkit" value="1">CHECK IT NIGGUH!</button>
            		</form>
            	</div>
            	<div class="col-md-4">
            	@if(session('results'))
            		<div class="box box-primary">
            			<div class="box-header box-border">
            				<h3 class="box-title">RESULTS</h3>
            			</div>
            			<div class="box-body">
		            		<table class="table table-bordered table-hover">
		            			<thead>
		            				<tr>
		            					<th>Proxies</th>
		            					<th>Status</th>
		            				</tr>
		            			</thead>
		            			<tbody>
		            				@foreach(session('results') as $result)
		            				<tr>
		            					<td>{{ $result['proxy'] }}</td>
		            					<td>@if($result['status'] == 0) <span class="label label-danger">DEAD</span> @else <span class="label label-success">LIVE</span> @endif</td>
		            				</tr>
		            				@endforeach
		            			</tbody>
		            		</table>
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