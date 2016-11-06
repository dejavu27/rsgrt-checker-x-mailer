<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
Auth::routes();
Route::get('/', function () {
	if(Auth::guest()){
    	return view('auth.login');
	}else{
    	return redirect('/home');
	}
});
Route::get('/login', function () {
    return redirect('');
});
Route::get('/home', function () {
	if(!Auth::guest() && Auth::user()->approved == 1){
    	return view('admin.admin_home',['navi' => 'home','treeview' => false]);
	}
	else if (!Auth::guest() && Auth::user()->approved == 0){
    	return redirect('/verify');
	}
	else{
    	return redirect('/');
	}
});
Route::get('verify',function(){
	if(!Auth::guest() && Auth::user()->approved == 1){
    	return redirect('/home');
	}
	else if(Auth::guest()){
    	return redirect('/');
	}else{
		return view('admin.verify_page');
	}
});
Route::get('/redirect','SocialAuthController@redirect');
Route::get('/callback','SocialAuthController@callback');
//Users
Route::post('/user/status_change','UsersController@status_change');
Route::get('/user/setting',function(){
    if(!Auth::guest() && Auth::user()->approved == 1){
    	return view('admin.admin_user_setting',['navi' => 'as','treeview' => false]);
    }else{
    	return redirect('/verify');
    }
});
Route::get('/user/avatar','UsersController@avatar_view');
Route::post('/change/avatar','UsersController@avatar_change');
Route::post('/user/setting/password','UsersController@change_password');
Route::get('/user/{id}','UsersController@view_timeline');
Route::post('/email/create','UsersController@create_email');
Route::get('/email/create','UsersController@create_email_view');
Route::post('/email/list','UsersController@delete_email');
Route::get('/email/list','UsersController@list_email');
Route::post('/email/bugs','UsersController@submitted_bugs_email');
Route::get('/email/bugs','UsersController@bugs_email');
Route::get('/email/bugs/list','UsersController@list_bugs_email');
Route::get('/email/bugs/view/{id}','UsersController@view_bugs_email');
Route::post('/email/bugs/update','UsersController@update_bugs_email');
Route::get('/email/bugs/delete/all','UsersController@truncate_bugs_email');
Route::get('/checker/stripe','UsersController@stripe_vew');
Route::post('/checker/stripe','UsersController@stripe_main_process');
Route::get('/checker/stripe/guide',function(){
    if(!Auth::guest() && Auth::user()->approved == 1){
    	return view('admin.admin_stripe_api_guide',['navi' => 'stripe','treeview' => 'checker']);
    }else{
    	return redirect('/verify');
    }
});
Route::get('/checker/stripe/proxified','UsersController@stripe_main_process_socks5_view');
Route::post('/checker/stripe/proxified','UsersController@stripe_main_process_socks5');
Route::post('/checker/stripe/proxified/2','UsersController@stripe_main_process_socks5_2');
Route::get('/checker/bin',function(){
    if(!Auth::guest() && Auth::user()->approved == 1){
        return view('admin.admin_bin_checker',['navi' => 'BIN','treeview' => 'checker']);
    }else{
        return redirect('/verify');
    }
});
Route::post('/checker/bin','UsersController@bin_checker');
Route::get('/checker/proxy',function(){
    if(!Auth::guest() && Auth::user()->approved == 1){
        return view('admin.admin_proxy_checker',['navi' => 'proxychecker','treeview' => 'checker']);
    }else{
        return redirect('/verify');
    }
});
Route::post('/checker/proxy','UsersController@proxy_checker');
Route::get('/account/list',function(){
    if(!Auth::guest() && Auth::user()->approved == 1){
        if(Auth::user()->isAdmin == 3){
            return view('admin.admin_all_accounts',['navi' => 'al','treeview' => 'accounts']);
        }else{
            return redirect('/home')->with('message','<div class="alert alert-danger"><h4><i class="fa fa-ban icon"></i> Opps!</h4>You dont have a right access to that page.</div>');
        }
    }else{
        return redirect('/verify');
    }
});
Route::get('/account/list/unapproved',function(){
    if(!Auth::guest() && Auth::user()->approved == 1){
        if(Auth::user()->isAdmin == 3){
            return view('admin.admin_pending_accounts',['navi' => 'pl','treeview' => 'accounts']);
        }else{
            return redirect('/home')->with('message','<div class="alert alert-danger"><h4><i class="fa fa-ban icon"></i> Opps!</h4>You dont have a right access to that page.</div>');
        }
    }else{
        return redirect('/verify');
    }
});
Route::get('/account/edit/{id}','UsersController@view_edit_user');
Route::post('/account/edit','UsersController@edit_user');