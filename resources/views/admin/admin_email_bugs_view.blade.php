<?php
	use App\Reports;
	use App\User;
	$report = Reports::find($id);
?>
@extends('admin.admin_layout')
@section('content')
            <section class="content-header">
                <h1>
                	@if($report)
                    Report of {{ User::find($id)->first()->name }}
                    @else
                    This report doesn't exist.
                    @endif
                </h1>
            </section>
            @if($report)
            <section class="content">
            	<div class="col-md-8">
                        <div class="box box-primary">
                              <div class="box-header with-border">
                                    <h3 class="box-title">TOPIC : {{ $report->reported_topic }}</h3>
                                    <div class="box-tools pull-right">
                                                @if($report->report_status == 3)
                                                      <span class="label label-success">fixed</span>
                                                @elseif($report->report_status == 2)
                                                      <span class="label label-warning">in progress</span>
                                                @elseif($report->report_status == 1)
                                                      <span class="label label-primary">read</span>
                                                @else
                                                      <span class="label label-danger">unread</span>
                                                @endif
                                          <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                    </div>
                              </div>
                              <div class="box-body">
                              	@if(session('success'))
                              	<div class="alert alert-success">
                              		{{ session('success') }}
                              	</div>
                              	@endif
				            	<form method="post" action="{{ url('/email/bugs/update') }}">
				            	{{ csrf_field() }}
				            		<input type="hidden" name="id" value="{{ $id }}">
				            		<div class="well" style="text-align:justify;text-indent:15px">
				            			{{ $report->reported_msg }}
				            		</div>
				            		<span class="pull-left">
					            		<button class="btn btn-primary" type="submit" name="read" value="1">Mark as Read</button>
					            		<button class="btn btn-success" type="submit" name="fixed" value="1">Mark as Fixed</button>
					            		<button class="btn btn-warning" type="submit" name="wip" value="1">Mark as In Progress</button>
				            		</span>
				            		<a class="btn btn-danger pull-right" href="{{ url('/email/bugs/list') }}">Back to list</a>
				            	</form>
                              </div>
                        </div>
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
            @endif
            <div style="clear:both"></div>
@endsection