@extends('admin.admin_layout')
@section('content')
            <section class="content-header">
                <h1>
                    Change Avatar
                </h1>
            </section>
            <section class="content">
            	<div class="col-md-8">
            		@if(session('success'))
            		<div class="alert alert-success">
            			{{ session('success') }}
            		</div>
            		@endif
            		@if($errors->any())
            		<div class="alert alert-danger">
            			{{ implode (' ', $errors->all())}}
            		</div>
            		@endif
					<div class="media" style="padding:10px">
					  <div class="pull-left">
					    <a>
					      <img class="media-object" src="{{ Auth::user()->avatar }}" alt="{{ Auth::user()->name }}" width="150px" height="150px">
					    </a>
					  </div>
					  <div class="media-body">
					    <h4 class="media-heading">Upload your own avatar(150px by 150px)</h4>
					    	<form method="post" action="{{ url('/change/avatar') }}" name="own" enctype="multipart/form-data">
					    		{{  csrf_field() }}
					    		<input type="hidden" name="own" value="1">
					    		<div class="form-group">
									<div class="input-group">
									  <div class="input-group-btn">			    
										<label class="btn btn-default" for="my-file-selector">
										    <input id="my-file-selector" type="file" style="display:none;" onchange="$('.path').val($(this).val());" name="img" required>
										    Upload an image
										</label>
									  </div>
									  <input type="text" class="form-control path" disabled>
									</div>	
					    		</div>	
								<button class="btn btn-success" type="submit" name="changeavatar" value="1">Change</button>
					    	</form>
					  </div>
					</div>
					<center>
					<p>
						- OR -
					</p>
					<h4>- Select from here -</h4>
					<form method="post" action="{{ url('/change/avatar') }}" name="premade">
						{{  csrf_field() }}
					    <input type="hidden" name="premade" value="1">
						@for($i=1;$i<=48;$i++)
						<button class="btn btn-default" style="width:80px;height:80px" type="submit" name="img" value="{{ $i }}">
							<img src="{{ url('avatar/'.$i.'.png') }}" width="100%" height="100%">
						</button>
						@endfor
					</form>
					</center>
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