@extends('admin.admin_layout')
@section('content')
            <section class="content-header">
                <h1>
                    Update setting
                </h1>
            </section>
            <section class="content">
            	<div class="col-md-6 col-md-offset-3">
            		<center>
            			<img src="{{ Auth::user()->avatar }}" width="100px" height="100px" style="border-radius:100px 100px;border:1px solid #222">
            		</center><br>
					<center>
				        <a class="btn btn-primary" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
				          Change Info
				        </a>
				        <a class="btn btn-primary" class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
				          Change Password
				        </a>
					</center><br>
					@if(session('success'))
					<div class="alert alert-success">
						{{ session('success') }}
					</div>
					@endif
					@if(session('failed'))
					<div class="alert alert-danger">
						{{ session('failed') }}
					</div>
					@endif
					<div class="box" id="accordion" role="tablist" aria-multiselectable="true">
					    <div id="collapseOne" class="box-body panel-collapse collapse in" role="tabpanel">
					    	<div class="alert alert-warning">
					    		You`re not allowed yet to update your personal information. Contact Administrator to do it for you.
					    	</div>
		            		<form role="form" action="{{ url('/user/setting/info') }}" method="post">
		            			{{ csrf_field() }}
		            			<div class="form-group">
		            				<label for="name">Name : </label>
		            				<input type="text" name="name" disabled value="{{ Auth::user()->name }}" class="form-control" required>
		            			</div>
		            			<div class="form-group">
		            				<label for="email">Email : </label>
		            				<input type="text" name="email" disabled value="{{ Auth::user()->email }}" class="form-control" required>
		            			</div>
		            			<center>
		            				<button class="btn btn-success" type="submit" disabled="">Update</button>
		            				<button class="btn btn-danger" type="reset">Clear All</button>
		            			</center>
		            		</form>
					    </div>
					    <div id="collapseTwo" class="box-body panel-collapse collapse" role="tabpanel">
		            		<form role="form" action="{{ url('/user/setting/password') }}" method="post">
		            			{{ csrf_field() }}
		            			<div class="form-group">
		            				<label for="opass">Old Password : </label>
		            				<input type="password" name="opass" class="form-control" placeholder="Enter Old Password here." required>
		            			</div>
		            			<div class="form-group">
		            				<label for="npass">New Password : </label>
		            				<input type="password" name="npass" class="form-control" placeholder="Enter New Password here." required>
		            			</div>
		            			<div class="form-group">
		            				<label for="cpass">Confirm Password : </label>
		            				<input type="password" name="cpass" class="form-control" placeholder="Confirm New Password here." required>
		            			</div>
		            			<center>
		            				<button class="btn btn-success" type="submit">Update</button>
		            				<button class="btn btn-danger" type="reset">Clear All</button>
		            			</center>
		            		</form>
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