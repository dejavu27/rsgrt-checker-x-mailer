@extends('admin.admin_layout')
@section('content')
            <section class="content-header">
                <h1>
                    List of Reported Email Bugs
                </h1>
            </section>
            <section class="content">
            	<div class="col-md-8">
            		<table id="pending_users" class="table table-hover table-bordered" cellspacing="0" width="100%">
            			<thead>
            				<tr>
            					<th>Reported by</th>
            					<th>Report Title</th>
            					<th>Report Message</th>
            					<th>Submitted Date</th>
            					<th>Action</th>
            				</tr>
            			</thead>
            			<tbody>
            				<?php
            					use App\Reports;
            					use App\User;
            				?>
            				@foreach(Reports::all() as $reports)
            				<tr>
            					<td>{{ User::where('id','=',$reports->reported_by)->first()->name }}</td>
            					<td>
                                                {{ $reports->reported_topic }}
                                                @if($reports->report_status == 3)
                                                      <span class="label label-success">fixed</span>
                                                @elseif($reports->report_status == 2)
                                                      <span class="label label-warning">in progress</span>
                                                @elseif($reports->report_status == 1)
                                                      <span class="label label-primary">read</span>
                                                @else
                                                      <span class="label label-danger">unread</span>
                                                @endif
                                          </td>
            					<td>@if(strlen($reports->reported_msg) <= 50) {{ substr($reports->reported_msg,0,50) }} @else {{ substr($reports->reported_msg,0,50) }}... @endif</td>
            					<td>{{ date('M d, Y H:i A',strtotime($reports->created_at)) }}</td>
            					<td align="center" valign="middle">
            						<a href="{{ url('/email/bugs/view/'.$reports->id) }}" class="btn btn-primary">View</a>
            					</td>
            				</tr>
            				@endforeach
            			</tbody>
            		</table>
            	</div>
            	<div class="col-md-4">
            		@include('admin.subs.subnavi2')
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