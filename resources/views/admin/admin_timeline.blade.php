<?php
	use App\timeline;
	use App\User;
	use App\Emails;
	$user = User::find($id);
?>
@extends('admin.admin_layout')
@section('content')
		@if($user)
           <section class="content">
	          <div class="box box-widget widget-user">
	            <div class="widget-user-header bg-black">
	              <h3 class="widget-user-username">{{ $user->name }}</h3>
	              <h5 class="widget-user-desc">@if($user->isAdmin > 0) Administrator @else Member @endif</h5>
	            </div>
	            <div class="widget-user-image" >
	              <img class="img-circle" src="{{ $user->avatar }}" alt="User Avatar" style="background:#fff">
	            </div>
	            <div class="box-footer">
	              <div class="row">
	                <div class="col-sm-4 border-right">
	                  <div class="description-block">
	                    <h5 class="description-header">{{ date('M d, Y h:i A',strtotime($user->created_at)) }}</h5>
	                    <span class="description-text">DATE REGISTERED</span>
	                  </div>
	                </div>
	                <div class="col-sm-4 border-right">
	                  <div class="description-block">
	                    <h5 class="description-header">0</h5>
	                    <span class="description-text">WARNINGS</span>
	                  </div>
	                </div>
	                <div class="col-sm-4">
	                  <div class="description-block">
	                    <h5 class="description-header">{{ Emails::where('created_by','=',$user->id)->count() }}</h5>
	                    <span class="description-text">EMAIL ACCOUNTS</span>
	                  </div>
	                </div>
	              </div>
	            </div>
	          </div>
            	<?php
            		$timeline = timeline::where('userid','=',$id)->orderBy('id','desc')->get();
            	?>
            	@if($timeline)
            	<?php
            		if(timeline::where('userid','=',$id)->orderBy('id','desc')->first()){
            			$lastdate = date('d',(strtotime(timeline::where('userid','=',$id)->orderBy('id','desc')->first()->created_at)+(60*60*24)) );
            		}else{
            			$lastdate = date('d',(time() + (60*60*24)));
            		}
            	?>
				<ul class="timeline">
            	@foreach($timeline as $tm)
            		@if(date('d',strtotime($tm->created_at)) != $lastdate)
				    <li class="time-label">
				        <span class="bg-blue">
				            @if(date('d',strtotime($tm->created_at)) != date('d',time())) 
				            	{{ date('M d, Y',strtotime($tm->created_at)) }}
				            @else
				            	Today
				            @endif
				        </span>
				    </li>
            		@endif
				    <li>
				    	@if($tm->status == 1)
				        <i class="fa fa-comment bg-green"></i>
				    	@else
				        <i class="fa fa-comment bg-red"></i>
				    	@endif
				        <div class="timeline-item">
				        	<span class="time"><i class="fa fa-clock-o"></i> {{ date('h:i A',strtotime($tm->created_at)) }}</span>
				            <h3 class="timeline-header"><a href="#">{{ $tm->title }}</a></h3>

				            <div class="timeline-body">
				                {{ $tm->msg }}
				            </div>

				        </div>
				    </li>
				    <?php
				    	$lastdate = date('d',(strtotime($tm->created_at)));
				    ?>
            	@endforeach
				</ul>
            	@endif
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
		@else
           <section class="content">
           	This user could not be found.<br>
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
		@endif
@endsection