<?php
use App\User;
?>
@extends('admin.admin_layout')
@section('content')
            <section class="content-header">
                <h1>
                    All users
                </h1>
            </section>
            <section class="content">
	            	<div class="col-md-12">
	            		@if(session('message'))
	            			<?=session('message')?>
	            		@endif
	            		<form method="post" action="{{ url('/user/status_change') }}">
	            		{{ csrf_field() }}
		            		<table id="pending_users" class="table table-striped table-bordered" cellspacing="0" width="100%">
		            			<thead class="text-center">
		            				<tr>
		            					<th>&nbsp;</th>
		            					<th>NAME</th>
		            					<th>EMAIL</th>
		            					<th>STATUS</th>
		            					<th>JOINED DATE</th>
		            					<th>IP ADDRESS</th>
		            					<th>ACTION</th>
		            				</tr>
		            			</thead>
		            			<tbody>
		            				<?php
		            					$users = User::all();
		            				?>
		            				@foreach($users as $a)
		            					<tr>
		            						<td align="center" valign="middle">
		            							<input type="checkbox" name="user_id[]" value="{{$a->id}}">
		            							<img src="{{ $a->avatar }}" width=25px height=25px>
		            						</td>
		            						<td><a href="{{ url('user/'.$a->id) }}">{{ $a->name }}</a></td>
		            						<td>{{ $a->email }}</td>
		            						<td>
		            							@if($a->approved == 0)
		            								<span class="label label-warning">pending</span>
		            							@elseif($a->approved == 1)
		            								<span class="label label-success">active</span>
		            							@else
		            								<span class="label label-danger">declined</span>
		            							@endif
		            						</td>
		            						<td>{{ date('M d,Y h:i A',strtotime($a->created_at)) }}</td>
		            						<td>{{ $a->ip_address }}</td>
		            						<td align="center" valign="middle">
		            							<a href="{{ url('/account/edit/'.$a->id) }}" class="btn btn-primary btn-sm">EDIT</a>
		            						</td>
		            					</tr>
		            				@endforeach
		            			</tbody>
		            		</table>
		            		<button class="btn btn-success" type="submit" name="approved" value="1">Approve</button>
		            		<button class="btn btn-danger" type="submit" name="declined" value="1">Decline</button>
		            		<button class="btn btn-warning" type="submit" name="pending" value="1">Pending</button>
		            		<button class="btn btn-primary" type="reset">Clear All</button>
	            		</form>
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
            <div style="clear:both"></div>r
@endsection