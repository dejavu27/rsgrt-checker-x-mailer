<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\user;
use App\Emails;
use App\Reports;
use App\timeline;
use Validator;
use Image;
use Arcanedev\Stripe\Stripe;
use Arcanedev\Stripe\Resources\Charge;
use Arcanedev\Stripe\Exceptions\ApiException;
use Arcanedev\Stripe\Exceptions\AuthenticationException;
use Arcanedev\Stripe\Exceptions\CardException;
use Arcanedev\Stripe\Exceptions\InvalidRequestException;
use Arcanedev\Stripe\Exceptions\RateLimitException;
use App\Http\Controllers\xmlapi_cpanel;
class UsersController extends Controller
{
    public function status_change(Request $request){
    	if(Auth::user()->isAdmin == 3 || Auth::user()->isAdmin == 2){
    		$user_id = $request->input('user_id');
    		if($request->input('pending')==1){
    			$status = 0;
    		}
    		if($request->input('approved')==1){
    			$status = 1;
    		}
    		if($request->input('declined')==1){
    			$status = 2;
    		}
    		for($i=0;$i<count($user_id);$i++){
    			User::where('id','=',$user_id[$i])->update([
    				'approved' => $status
    			]);
    		}
    		return redirect('/account/list')->with('message','<div class="alert alert-success"><h4><i class="icon fa fa-check"></i> Process Completed</h4>'.count($user_id).' user has been successfully updated.</div>');
    	}
    	else{
    		return "You dont have permission here nigguh.";
    	}
    }

    public function view_timeline($id){
    	if(!Auth::guest() && Auth::user()->approved == 1){
    		return view('admin.admin_timeline',['id' => $id, 'navi' => false,'treeview' => false]);
    	}else{
    		return redirect('/verify');
    	}
    }

    public function create_email_view(){
    	if(!Auth::guest() && Auth::user()->approved == 1){
    		return view('admin.admin_email_creator',['navi' => 'cne','treeview' => 'cma', 'subnavi' => 'ce']);
    	}else{
    		return redirect('/verify');
    	}
    }

    public function create_email(Request $request){
    	if(!Auth::guest() && Auth::user()->approved == 1){
			// Default whm/cpanel account info

			$ip = "changeme";           // should be WHM ip address
			$account = "changeme";        // cpanel user account name
			$passwd ="changeme";        // cpanel user password
			$port =2083;                 // cpanel secure authentication port unsecure port# 2082

			// check if overrides passed
			$email_user = $request->input('email_user');
			$email_pass = $request->input('password');
			$email_vpass = $request->input('confirm_password');
			$email_domain = $request->input('domain');
			$email_quota = 10000;
			if (!empty($email_user))
			while(true) {


				if ($email_pass !== $email_vpass){   
					return redirect('/email/create')->with('notsuccess','The password for your email is not matched.');
					break;
				}

				$xmlapi = new xmlapi_cpanel($ip);

				$xmlapi->set_port($port);  

				$xmlapi->password_auth($account, $passwd);   

				$call = array('domain'=>$email_domain, 'email'=>$email_user, 'password'=>$email_pass, 'quota'=>$email_quota);

				$xmlapi->set_debug(0);      

				$result = $xmlapi->api2_query($account, "Email", "addpop", $call ); 

				if ($result->data->result == 1){
					Emails::create([
						'email_user' => $email_user,
						'email_domain' => $email_domain,
						'email_password' => $email_pass,
						'email_quota' => $email_quota,
						'created_by' => Auth::user()->id,
						'created_date' => time()
					]);
					timeline::create([
						'userid' => Auth::user()->id,
						'title' => 'Email Created Successfully',
						'msg' => 'You have successfully created email '.$email_user.'@'.$email_domain,
						'status' => 1
					]);
					return redirect('/email/create')->with('success',$email_user.'@'.$email_domain.' was successfully created.');
					break;

				} else {
					timeline::create([
						'userid' => Auth::user()->id,
						'title' => 'Email Creation Failed',
						'msg' => 'You tried to create email '.$email_user.'@'.$email_domain.'. Reason : '.$result->data->reason,
						'status' => 0
					]);
					return redirect('/email/create')->with('notsuccess','Creating Failed. Reason : '.$result->data->reason);
					break;
				}

				break;
			}
    	}else{
    		return redirect('/verify');
	    }
    }

    public function delete_email(Request $request){
    	if(!Auth::guest() && Auth::user()->approved == 1){
    		if($request->input('delpop') == 1 && $request->input('id') > 0){
    			$userid = $request->input('id');
    			$error = 0;
    			$success = 0;
				$ip = "changeme";           
				$account = "changeme";        
				$passwd ="changeme";        
				$port =2083;                 
    			for($i=0;$i<count($userid);$i++){
    				$chkemail = Emails::where('id','=',$userid)->first();
    				if($chkemail){
						$email_user = $chkemail->email_user;
						$email_domain = $chkemail->email_domain;
						if (!empty($email_user)){
							while(true) {

								$xmlapi = new xmlapi_cpanel($ip);

								$xmlapi->set_port($port);  

								$xmlapi->password_auth($account, $passwd);   

								$call = array('domain'=>$email_domain, 'email'=>$email_user);

								$xmlapi->set_debug(0);      

								$result = $xmlapi->api2_query($account, "Email", "delpop", $call ); 

								if ($result->data->result == 1){
    								Emails::destroy($userid[$i]);
									$success = $success + 1;
									break;

								} else {
									Emails::destroy($userid[$i]);
    								$error = $error + 1;
									break;
								}

								break;
							}
						}
    				}else{
    					$error = $error + 1;
    				}
    			}
    			return redirect('/email/list')->with('noerror','Email/s has/have successfully deleted.');
    		}else{
    			return redirect('/email/list')->with('failed','Invalid Parameter my nigguh');
    		}
    	}else{
    		return redirect('/verify');
	    }
    }

    public function change_password(Request $request){
    	if(!Auth::guest() && Auth::user()->approved == 1){
    		if($request->input('npass') == $request->input('cpass')){
	    		if(Auth::attempt(array('email' => Auth::user()->email ,'password' => $request->input('opass'))))
	    		{
					$chk = User::where('email','=',Auth::user()->email)->first();
	    			$chk->password = bcrypt($request->input('npass'));
	    			$chk->save();
					timeline::create([
						'userid' => Auth::user()->id,
						'title' => 'Password Changed Successfully',
						'msg' => 'You have successfully changed your password.',
						'status' => 1
					]);
	    			return redirect('/user/setting')->with('success','Password was successfully changed.');
	    		}else{
					timeline::create([
						'userid' => Auth::user()->id,
						'title' => 'Password Changed Failed',
						'msg' => 'You tried to change you password but it was failed. Reason : Old password not matched.',
						'status' => 0
					]);
	    			return redirect('/user/setting')->with('failed','Password was not successfully changed. Old Password is incorrect.');
	    		}
    		}else{
					timeline::create([
						'userid' => Auth::user()->id,
						'title' => 'Password Changed Failed',
						'msg' => 'You tried to change you password but it was failed. Reason : New password not matched.',
						'status' => 0
					]);
    			return redirect('/user/setting')->with('failed','Password was not successfully changed. New Password is not matched.');
    		}
    	}else{
			return redirect('/verify');
    	}
    }

    public function list_email(){
    	if(!Auth::guest() && Auth::user()->approved == 1){
    		return view('admin.admin_email_list',['navi' => 'cne','treeview' => 'cma', 'subnavi' => 'el']);
    	}else{
			return redirect('/verify');
    	}
    }

    public function bugs_email(){
    	if(!Auth::guest() && Auth::user()->approved == 1){
    		return view('admin.admin_bugs_email',['navi' => 'reb','treeview' => 'cma']);
    	}else{
			return redirect('/verify');
    	}
    }

    public function submitted_bugs_email(Request $request){
    	if(!Auth::guest() && Auth::user()->approved == 1 && $request->input('submitted') == "1"){
    		Reports::create([
    			'reported_topic' => $request->input('topic'),
    			'reported_by' => Auth::user()->id,
    			'reported_msg' => $request->input('msg'),
    			'report_status' => 0
    		]);
			timeline::create([
				'userid' => Auth::user()->id,
				'title' => 'You submitted email bug report "'.$request->input('topic').'" successfully',
				'msg' => 'Your report was successfully submitted and now being review.',
				'status' => 1
			]);
    		return redirect('/email/bugs')->with('success','Report was successfully submitted. Thank you for reporting somebugs in my site. I`ll be happy to fix it for the sake of all users.');
    	}else{
			timeline::create([
				'userid' => Auth::user()->id,
				'title' => 'You submitted email bug report "'.$request->input('topic').'" failed',
				'msg' => 'Your report was not successfully submitted and you may try it again.',
				'status' => 0
			]);
			return redirect('/email/bugs')->with('failed','Something went wrong. Please try it again.');
    	}
    }

    public function list_bugs_email(){
    	if(!Auth::guest() && Auth::user()->approved == 1 && Auth::user()->isAdmin > 0){
    		return view('admin.admin_email_bug_list',['navi' => 'reb','treeview' => 'cma','subnavi' => 'rl']);
    	}else{
			return redirect('/verify');
    	}
    }

    public function view_bugs_email($id){
    	if(!Auth::guest() && Auth::user()->approved == 1 && Auth::user()->isAdmin > 0){
    		return view('admin.admin_email_bugs_view',['navi' => 'reb','treeview' => 'cma','subnavi' => 'rl','id' => $id]);
    	}else{
			return redirect('/verify');
    	}
    }

    public function update_bugs_email(Request $request){
    	if(!Auth::guest() && Auth::user()->approved == 1 && Auth::user()->isAdmin > 0){
    		$status=0;
    		if($request->input('read') == 1){
    			$status=1;
    		}elseif($request->input('fixed') == 1){
    			$status=3;
    		}elseif($request->input('wip') == 1){
    			$status=2;
    		}
    		Reports::where('id','=',$request->input('id'))->update([
    			'report_status' => $status
    		]);	
    		return redirect('/email/bugs/view/'.$request->input('id'))->with('success','Report updated.');
    	}else{
			return redirect('/verify');
    	}
    }

    public function truncate_bugs_email(){
    	if(!Auth::guest() && Auth::user()->approved == 1 && Auth::user()->isAdmin > 0){
    		Reports::truncate();
    		return "<script>alert('All reports have been successfully deleted.');location.href='".url('/email/bugs/list')."'</script>";
    	}else{
			return redirect('/verify');
    	}
    }

    public function avatar_view(){
	    if(!Auth::guest() && Auth::user()->approved == 1){
	    	return view('admin.admin_user_avatar',['navi' => 'ca','treeview' => false]);
	    }else{
	    	return redirect('/verify');
	    }
    }

    public function avatar_change(Request $req){
	    if(!Auth::guest() && Auth::user()->approved == 1){
	    	if($req->input('own') == 1){
			    $file = $req->file('img');

			    $fileArray = array('image' => $file);

			    $rules = array(
			      'image' => 'mimes:jpeg,jpg,png,gif|required|max:2000' 
			    );

			    $validator = Validator::make($fileArray, $rules);

			    if ($validator->fails())
			    {
					timeline::create([
						'userid' => Auth::user()->id,
						'title' => 'Changing Avatar Failed',
						'msg' => 'You tried to change your avatar but it was failed. Reason : '.$validator->errors()->getMessages()['image'][0],
						'status' => 0
					]);
			        return redirect('/user/avatar')->withInput()->withErrors($validator);
			    } else
			    {
			    	$filename = md5(microtime()).'.'.$file->guessExtension();
			        $suc = $file->move('avatar/uploaded',$filename);
			        Image::make($suc)->resize(150, 150)->save($suc);
			        $upd = User::find(Auth::user()->id)->update([
			        	'avatar' => url($suc)
			        ]);
					timeline::create([
						'userid' => Auth::user()->id,
						'title' => 'Changing Avatar Successful',
						'msg' => 'You have successfully changed your avatar.',
						'status' => 1
					]);
			        return redirect('/user/avatar')->with('success','The process was successfully completed');
			    }
	    	}else{
			    $upd = User::find(Auth::user()->id)->update([
			        'avatar' => url('avatar/'.$req->input('img').'.png')
			    ]);
					timeline::create([
						'userid' => Auth::user()->id,
						'title' => 'Changing Avatar Successful',
						'msg' => 'You have successfully changed your avatar.',
						'status' => 1
					]);
	    		return redirect('/user/avatar')->with('success','The process was successfully completed');
	    	}
	    }else{
	    	return redirect('/verify');
	    }
    }

    public function stripe_vew(){
	    if(!Auth::guest() && Auth::user()->approved == 1){
	    	return view('admin.admin_stripe_checker',['navi' => 'stripe','treeview' => 'checker']);
	    }else{
	    	return redirect('/verify');
	    }	
    }

    public function stripe_main_process(Request $req){
	    if(!Auth::guest() && Auth::user()->approved == 1){
	    	if($req->input('checking') == 1){
	    		$card = array();
	    		$exp_month = array();
	    		$exp_year = array();
	    		$cvc = array();
	    		$result = array();
	    		$success = 0;
	    		$failed = 0;
	    		$ccdetails = explode(PHP_EOL,$req->input('ccdetails'));
	    		$ccdetails = str_replace(' ', '', $ccdetails);
	    		for($i=0;$i<count($ccdetails);$i++){
					try {
		    			$cc = explode('|', $ccdetails[$i]);
		    			$card[] = $cc[0];
		    			$exp_month[] = $cc[1];
		    			$exp_year[] = $cc[2];
		    			$cvc[] = preg_replace("/[^0-9]/","",$cc[3]);
						Stripe::setApiKey($req->input('apikey'));
						Charge::create([
						    'card'     => [
						        'number'    => $card[$i],
						        'exp_month' => $exp_month[$i],
						        'exp_year'  => $exp_year[$i],
						        'cvc' => $cvc[$i],
						        'name' => Auth::user()->name
						    ],
						    'amount'   => 100,
						    'currency' => 'usd'
						]);
			        	if(in_array('withouterror', $result) == false){
			        		$result[] = "withouterror";
			        	}
			        	$result[] = array(
						    'number'    => $card[$i],
						    'exp_month' => $exp_month[$i],
						    'exp_year'  => $exp_year[$i],
						    'cvc' => $cvc[$i],
						    'code' => 1
			        	);
			        	$success = $success+1;
			        }catch (CardException $e) {
			        	if($e->getJsonBody()['error']['code'] == "card_declined"){
			        		if(in_array('withouterror', $result) == false){
			        			$result[] = "withouterror";
			        		}
			        		$result[] = array(
						        'number'    => $card[$i],
						        'exp_month' => $exp_month[$i],
						        'exp_year'  => $exp_year[$i],
						        'cvc' => $cvc[$i],
						        'code' => 0
			        		);
			        	}else{
			        		$result[] = $e->getJsonBody()['error'];
			        	}
			        	$failed = $failed + 1;
			        }catch(AuthenticationException $e){
			        	if(in_array('witherror', $result) == false){
			        		$result[] = "witherror";
			        	}
			        	$result[] = $e->getJsonBody()['error'];
			        	$failed = $failed + 1;
			        }catch(ApiException $e){
			        	if(in_array('witherror', $result) == false){
			        		$result[] = "witherror";
			        	}
			        	$result[] = $e->getJsonBody()['error'];
			        	$failed = $failed + 1;
			        }catch(InvalidRequestException $e){
			        	if(in_array('witherror', $result) == false){
			        		$result[] = "witherror";
			        	}
			        	$result[] = $e->getJsonBody()['error'];
			        	$failed = $failed + 1;
			        }catch(Exception $e){
			        	if(in_array('witherror', $result) == false){
			        		$result[] = "witherror";
			        	}
			        	$result[] = $e->getMessage();
			        	$failed = $failed + 1;
			        }
	    		}
	    		if($success > 2){
					timeline::create([
						'userid' => Auth::user()->id,
						'title' => 'CC Checking via Stripe API Success',
						'msg' => 'You tried to check '.count($card).' credit card and got '.$success.' live out of '.count($card).' credit cards',
						'status' => 1
					]);
	    		}else{
					timeline::create([
						'userid' => Auth::user()->id,
						'title' => 'CC Checking via Stripe API Failed',
						'msg' => 'You tried to check '.count($card).' credit card and got '.$failed.' dead out of '.count($card).' credit cards',
						'status' => 0
					]);
	    		}
	    		return redirect('/checker/stripe')->with('results',$result)->with('oldkey',$req->input('apikey'))->with('oldtext',$req->input('ccdetails'));
	    		//return response()->json($result);
	    	}else{
	    		return redirect('/checker/stripe')->with('error',array('Parameter not set properly.'));
	    	}
	    }else{
	    	return redirect('/verify');
	    }	
    }

    public function stripe_main_process_socks5_view(){
    	if(!Auth::guest() && Auth::user()->approved == 1){
    		return view('admin.admin_stripe_checker_socks5',['navi' => 'stripe2','treeview' => 'checker']);
	    }else{
	    	return redirect('/verify');
	    }	
    }

    public function stripe_main_process_socks5(Request $req){
    	if(!Auth::guest() && Auth::user()->approved == 1){
    			if($req->input('proxy') !== null || empty($req->input('proxy')) ){
    				$proxy = explode(":",$req->input('proxy'));
    				$message = [];
					$ch = curl_init ();
					curl_setopt ($ch, CURLOPT_URL,url('/checker/stripe/proxified/2'));
					curl_setopt ($ch, CURLOPT_TIMEOUT, 50);
					curl_setopt ($ch, CURLOPT_PROXY, $proxy[0]);
					curl_setopt($ch, CURLOPT_PROXYPORT, $proxy[1]);
					curl_setopt ($ch, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5);
					curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
					curl_setopt ($ch, CURLOPT_RETURNTRANSFER, TRUE);
					curl_setopt($ch, CURLOPT_HEADER, false);
					curl_setopt($ch, CURLOPT_HTTPHEADER, array('X-CSRF-Token' => csrf_token()));
					curl_setopt($ch, CURLOPT_POST, TRUE);
					$data = array(
					    'ccdetails' => $req->input('ccdetails'),
					    'apikey' => $req->input('apikey'),
					    'own' => 1,
					    '_token' =>   csrf_token(),
					    'userid' => Auth::user()->id,
					    'username' => Auth::user()->name
					);
					curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
					$result = curl_exec($ch);
					if($result!==FALSE){
						if(in_array('witherror', json_decode($result,true)) == true){
						$message[] = 'witherror';
						$message[] = json_decode($result,true);
						}else{
						$message[] = 'withouterror';
						$message[] = json_decode($result,true);
						}
					}else{
						$message[] = 'witherror';
						$message[] = array(array('message' => 'the '.$proxy[0].':'.$proxy[1].' Proxy is dead'));
					}
					curl_close ($ch); 
					return redirect('/checker/stripe/proxified')->with('results',$message)->with('oldkey',$req->input('apikey'))->with('oldtext',$req->input('ccdetails'));
					//return response()->json($message);
					//var_dump($message);
    			}else{
    				return redirect('/checker/stripe/proxified')->with('results',array('witherror','message' => 'Proxy must be declare properly.'))->with('oldkey',$req->input('apikey'))->with('oldtext',$req->input('ccdetails'));
    			}  
	    }else{
	    	return redirect('/verify');
	    }	
    }

    public function stripe_main_process_socks5_2(Request $req){
    		if($req->input('own') == 1){
	    		$card = array();
	    		$exp_month = array();
	    		$exp_year = array();
	    		$cvc = array();
	    		$result = array();
	    		$success = 0;
	    		$failed = 0;
	    		$ccdetails = explode(PHP_EOL,$req->input('ccdetails'));
	    		$ccdetails = str_replace(' ', '', $ccdetails);
	    		for($i=0;$i<count($ccdetails);$i++){
					try {
		    			$cc = explode('|', $ccdetails[$i]);
		    			$card[] = $cc[0];
		    			$exp_month[] = $cc[1];
		    			$exp_year[] = $cc[2];
		    			$cvc[] = preg_replace("/[^0-9]/","",$cc[3]);
						Stripe::setApiKey($req->input('apikey'));
						Charge::create([
						    'card'     => [
						        'number'    => $card[$i],
						        'exp_month' => $exp_month[$i],
						        'exp_year'  => $exp_year[$i],
						        'cvc' => $cvc[$i],
						        'name' => $req->input('username')
						    ],
						    'amount'   => 100,
						    'currency' => 'usd'
						]);
			        	if(in_array('withouterror', $result) == false){
			        		$result[] = "withouterror";
			        	}
			        	$result[] = array(
						    'number'    => $card[$i],
						    'exp_month' => $exp_month[$i],
						    'exp_year'  => $exp_year[$i],
						    'cvc' => $cvc[$i],
						    'code' => 1
			        	);
			        	$success = $success+1;
			        }catch (CardException $e) {
			        	if($e->getJsonBody()['error']['code'] == "card_declined"){
			        	if(in_array('withouterror', $result) == false){
			        		$result[] = "withouterror";
			        	}
			        		$result[] = array(
						        'number'    => $card[$i],
						        'exp_month' => $exp_month[$i],
						        'exp_year'  => $exp_year[$i],
						        'cvc' => $cvc[$i],
						        'code' => 0
			        		);
			        	}else{
			        	$result[] = $e->getJsonBody()['error'];
			        	}
			        	$failed = $failed + 1;
			        }catch(AuthenticationException $e){
			        	if(in_array('witherror', $result) == false){
			        		$result[] = "witherror";
			        	}
			        	$result[] = $e->getJsonBody()['error'];
			        	$failed = $failed + 1;
			        }catch(ApiException $e){
			        	if(in_array('witherror', $result) == false){
			        		$result[] = "witherror";
			        	}
			        	$result[] = $e->getJsonBody()['error'];
			        	$failed = $failed + 1;
			        }catch(InvalidRequestException $e){
			        	if(in_array('witherror', $result) == false){
			        		$result[] = "witherror";
			        	}
			        	$result[] = $e->getJsonBody()['error'];
			        	$failed = $failed + 1;
			        }catch(Exception $e){
			        	if(in_array('witherror', $result) == false){
			        		$result[] = "witherror";
			        	}
			        	$result[] = $e->getMessage();
			        	$failed = $failed + 1;
			        }
	    		}
	    		if($success > 2){
					timeline::create([
						'userid' => $req->input('userid'),
						'title' => 'CC Checking via Stripe API Success',
						'msg' => 'You tried to check '.count($card).' credit card and got '.$success.' live out of '.count($card).' credit cards',
						'status' => 1
					]);
	    		}else{
					timeline::create([
						'userid' => $req->input('userid'),
						'title' => 'CC Checking via Stripe API Failed',
						'msg' => 'You tried to check '.count($card).' credit card and got '.$failed.' dead out of '.count($card).' credit cards',
						'status' => 0
					]);
	    		}
	    		//return redirect('/checker/stripe')->with('results',$result)->with('oldkey',$req->input('apikey'))->with('oldtext',$req->input('ccdetails'));
	    		return response()->json($result);
	    	}else{
	    		return redirect('/checker/stripe/proxified')->with('error',array('Parameter not set properly.'));
	    	}
    }

    public function bin_checker(Request $req){
    	if(!Auth::guest() && Auth::user()->approved == 1){
			$result = json_decode(file_get_contents("https://binlist.net/json/".preg_replace('/[^0-9]+/', '', $req->input('bin'))),true);
			return redirect('/checker/bin')->with('results',$result)->with('oldbin',$req->input('bin'));
			//return response()->json($result);
	    }else{
	    	return redirect('/verify');
	    }	
    }

    public function proxy_checker(Request $req){
    	if(!Auth::guest() && Auth::user()->approved == 1){
			$proxys=explode(PHP_EOL,$req->input('proxies'));
			$proxys=array_unique($proxys);
			$results = array();
			foreach($proxys AS $proxy){
				$ch = curl_init ();
				curl_setopt ($ch, CURLOPT_URL, "http://www.cpanel.net/showip.cgi");
				curl_setopt ($ch, CURLOPT_TIMEOUT, 100);
				curl_setopt ($ch, CURLOPT_PROXY, trim($proxy));
				curl_setopt ($ch, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5);
				curl_setopt ($ch, CURLOPT_RETURNTRANSFER, TRUE);
				$result = curl_exec($ch);
				if($result!==FALSE){
					$results[] = array(
						'status' => 1,
						'proxy' => $proxy
					);
				}else {
					$results[] = array(
						'status' => 0,
						'proxy' => $proxy
					);
				}
				curl_close ($ch);    
			}
			return redirect('/checker/proxy')->with('results',$results);
	    }else{
	    	return redirect('/verify');
	    }	
    }

    public function view_edit_user($id){
    	if(!Auth::guest() && Auth::user()->approved == 1){
	        if(Auth::user()->isAdmin == 3){
	            return view('admin.admin_edit_accounts',['navi' => 'al','treeview' => 'accounts','id' => $id]);
	        }else{
	            return redirect('/home')->with('message','<div class="alert alert-danger"><h4><i class="fa fa-ban icon"></i> Opps!</h4>You dont have a right access to that page.</div>');
	        }
	    }else{
	    	return redirect('/verify');
	    }	
    }

    public function edit_user(Request $req){
    	if(!Auth::guest() && Auth::user()->approved == 1){
	        if(Auth::user()->isAdmin == 3){
	            User::where('id','=',$req->input('id'))->update([
	            	'name' => $req->input('name'),
	            	'email' => $req->input('email'),
	            	'credits' => $req->input('credits')
	            ]);
	            return redirect('/account/list')->with('message','<div class="alert alert-success"><h4><i class="fa fa-check icon"></i> '.$req->input('name').'`s Account</h4>was successfully updated.</div>');
	        }else{
	            return redirect('/home')->with('message','<div class="alert alert-danger"><h4><i class="fa fa-ban icon"></i> Opps!</h4>You dont have a right access to that page.</div>');
	        }
	    }else{
	    	return redirect('/verify');
	    }	
    }

}
