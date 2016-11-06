<?php
use App\User;
$user = User::where('id','=',$id)->first();
?>
@extends('admin.admin_layout')
@section('content')
			@if(!$user)
            <section class="content-header">
                <h1>
                    User not found.
                </h1>
            </section>
			@else
            <section class="content-header">
                <h1>
                    Edit {{ $user->name }}
                </h1>
            </section>
            <section class="content">
            	<div class="col-md-8">
            		<form method="post" action="{{ url('account/edit') }}">
            			{{ csrf_field() }}
                        <input type="hidden" name="id" value="{{ $user->id }}">
                        <div class="form-group">
                            <label>Name : </label>
                            <input type="text" name="name" value="{{ $user->name }}" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Email : </label>
                            <input type="text" name="email" value="{{ $user->email }}" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Credits : </label>
                            <input type="text" name="credits" value="{{ $user->credits }}" class="form-control" required>
                        </div>
                        <button class="btn btn-primary pull-right" type="submit">UPDATE</button>
                        <a href="{{ url('/account/list') }}" class="btn btn-danger pull-left">CANCEL</a>
            		</form>
            	</div>
                <div class="col-md-12">
                    <center>
                        <p class="text-red">Excuse our ads. This will help us to keep our site up.</p>
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