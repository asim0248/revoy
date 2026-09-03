<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Config;
use App\Model\Setting;
use App\Model\Common;
use App\Model\Agents;
use App\Model\UserPlans;
use App\Model\Plans;
use App\Model\Property;
use App\Model\Propertyimages;
use App\Model\Propertyinspection;
use App\Model\Propertytypes;
use App\Model\AgentReviews;
use App\Model\BookmarkProperty;
use App\Model\Propertyoptions;
use App\Model\Emailque;
use App\Model\States;
use Session;
use Cookie;
use Redirect;
use Input;
use Mail;
use Hash;
use Response;
use URL;
use View;
class AccountController extends Controller {

	

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
        
        $this->middleware('UserAuth', ['except' => ['register','signup','login','auth','auth_process','activation', 'forgotpassword','restpassword','google_login','save_img','setpassword','updatepassword','login_customer','register_customer']]);
    }

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function login()
	{
		
		if(Session::get('user_id')!=""){
          return Redirect::to('/dashboard');
     	}
		
		$email = '';
		$password = '';
		$remember = '';
		
		if(Cookie::get('my_email') && Cookie::get('my_email')!=""){
			$email = Cookie::get('my_email');
			$password = Cookie::get('my_password');
			$remember = 1;
		}
		
		
		
		return view('accounts.login', ['title' =>'Login','email' => $email, 'password' => $password, 'remember' => $remember]);
	}
	
	public function login_customer()
	{
		
		if(Session::get('user_id')!=""){
          return Redirect::to('/dashboard');
     	}
		
		$email = '';
		$password = '';
		$remember = '';
		
		if(Cookie::get('my_email') && Cookie::get('my_email')!=""){
			$email = Cookie::get('my_email');
			$password = Cookie::get('my_password');
			$remember = 1;
		}
		
		
		
		return view('accounts.login_customer', ['title' =>'Login','email' => $email, 'password' => $password, 'remember' => $remember]);
	}
	
	public function google_login(Request $request){
		if(isset($request->code)) {
		 $client = Common::get_google_client();
		
		  $token = $client->fetchAccessTokenWithAuthCode($request->code);
		  //echo '<pre>'; print_r($token); exit;
		  $client->setAccessToken($token['access_token']);
		
		  // get profile info
		  $google_oauth = new \Google_Service_Oauth2($client);
		  $google_account_info = $google_oauth->userinfo->get();
		   
		  $userinfo = [
			'email' => $google_account_info['email'],
			'first_name' => $google_account_info['givenName'],
			'last_name' => $google_account_info['familyName'],
			'gender' => $google_account_info['gender'],
			'full_name' => $google_account_info['name'],
			'picture' => $google_account_info['picture'],
			'verifiedEmail' => $google_account_info['verifiedEmail'],
			'token' => $google_account_info['id'],
		  ];
		
			//echo '<pre>'; print_r($userinfo); exit;
			
			$user = Agents::whereRaw(" email = '".$google_account_info['email']."' ")->get()->toArray();
			if(count($user)==0){
				$model = new Agents();
				$model->google_id = $google_account_info['id'];
				$model->name = $google_account_info['givenName'].' '.$google_account_info['familyName'];
				$model->role_id = 2;
				$model->email = trim($google_account_info['email']);
				$model->password = Hash::make('12345678');
				$model->status = 'Yes';
				$model->created_at = date('Y-m-d H:i:s');
				$model->image = $model->google_id."_profile.jpg";
				$model->save();
				
				Session::put('user_id', $model->id);
				Session::put('user_name', $model->name);
				Session::put('user_role_id', $model->role_id);
				Session::put('user_agency_id', 0);
				
				$this->save_img($google_account_info['picture'],$google_account_info['id']);
				return Redirect::to('/dashboard');
			}else {
				$user = Agents::whereRaw(" email = '".$google_account_info['email']."' ")->get()->toArray();
				
				$model = Agents::find($user[0]['id']);
				$model->google_id = $google_account_info['id'];
				$model->save();
				
				Session::put('user_id', $user[0]['id']);
				Session::put('user_name', $user[0]['name']);
				Session::put('user_role_id', $user[0]['role_id']);
				Session::put('user_agency_id', $user[0]['agency_id']);
				return Redirect::to('/dashboard');
			}
		
		}else {
			return Redirect::to('/login');
		}
	}
	
	public function save_img($image_url,$google_id){
		

		// Destination path (saving as profile.jpg in the same directory)
		$save_path = "public/upload/agents/".$google_id."_profile.jpg";
		
		// Initialize cURL
		$ch = curl_init($image_url);
		$fp = fopen($save_path, "wb");
		
		// Set cURL options
		curl_setopt($ch, CURLOPT_FILE, $fp);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		
		// Execute cURL request
		curl_exec($ch);
		
		// Close cURL and file pointer
		curl_close($ch);
		fclose($fp);
	}
	
	 /*
      |--------------------------------------------------------------------------
      |  Auth.
      |--------------------------------------------------------------------------
     */

    public function auth(Request $request) {
		
		$client = Agents::whereRaw(" (email = '".$request->email."') AND role_id!=4 ")->get()->toArray();
		
		if (!empty($client)){
			
			if($client[0]['status'] == 'Yes'){
					if (Hash::check($request->password, $client[0]['password'])) {
						Session::put('user_id', $client[0]['id']);
						Session::put('user_name', $client[0]['name']);
						Session::put('user_role_id', $client[0]['role_id']);
						Session::put('user_agency_id', $client[0]['agency_id']);
						if($request->remember && $request->remember  ==1){
							Cookie::queue('my_email', $request->email,360);
							Cookie::queue('my_password', $request->password,360);
						}else {
							Cookie::queue('my_email','');
							Cookie::queue('my_password','');
						}
						
						 return Response::json(array('error_code' => 0, 'status' => 'success', 'message' => ''));
					} else {
						 return Response::json(array('error_code' => 1, 'status' => 'fail', 'message' => 'Invalid login information'));
					}
			}else {
				return Response::json(array('error_code' => 1, 'status' => 'error', 'message' => 'Your account status is not active'));
			}
        } else {
            return Response::json(array('error_code' => 1, 'status' => 'fail', 'message' => 'Invalid login information'));
        }
    }
	
	public function auth_process(Request $request) {
		
		$client = Agents::whereRaw(" (email = '".$request->email_login."') AND role_id=4 ")->get()->toArray();
		
		if (!empty($client)){
			
			if($client[0]['status'] == 'Yes'){
					if (Hash::check($request->password_login, $client[0]['password'])) {
						Session::put('user_id', $client[0]['id']);
						Session::put('user_name', $client[0]['name']);
						Session::put('user_role_id', $client[0]['role_id']);
						Session::put('user_agency_id', $client[0]['agency_id']);
						
						
						 return Response::json(array('error_code' => 0, 'status' => 'success', 'message' => '','ut'=>$client[0]['role_id']));
					} else {
						 return Response::json(array('error_code' => 1, 'status' => 'fail', 'message' => 'Invalid login information'));
					}
			}else {
				return Response::json(array('error_code' => 1, 'status' => 'error', 'message' => 'Your account status is not active'));
			}
        } else {
            return Response::json(array('error_code' => 1, 'status' => 'fail', 'message' => 'Invalid login information'));
        }
    }
    
	public function register_customer()
	{
		
		if(Session::get('user_id')!=""){
          return Redirect::to('/dashboard');
     	}
		
		return view('accounts.register_customer', ['title' =>'Register']);
	}
	
	public function register()
	{
		
		if(Session::get('user_id')!=""){
          return Redirect::to('/dashboard');
     	}
		
		return view('accounts.register', ['title' =>'Register']);
	}
	
	public function signup(Request $request) {
		
				if (filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
					
					$user_dp = Agents::whereRaw('email = ? ', array($request->email))->get()->toArray();
					if (count($user_dp)==0) {
						
						$model = new Agents();
						$model->name = $request->name;
						if(isset($request->user_type) && $request->user_type!='' ){
							$model->role_id = $request->user_type;
						}else {
							$model->role_id = 2;
						}
						$model->email = trim($request->email);
						$model->password = Hash::make($request->password);
						if($model->role_id==2){
							$model->status = 'No';
						}else {
							$model->status = Setting::findByKey('AUTO_ACTIVE'); //'No';
						}
						$model->created_at = date('Y-m-d H:i:s');
						
						$model->save();
							
						$SITE_NAME = Setting::findByKey('SITE_NAME');
						$FROM_EMAIL = Setting::findByKey('FROM_EMAIL');	
							
						$subject = ' Welcome to '.$SITE_NAME;
						$msg = '';
						//$msg .= '<h3>' . $subject . '</h3>';
						//$msg .= '<hr>';
						$msg .= '<p style="line-height:25px;">Your account has been registered successfully.Please click on following button to activate account.</p>';
						 
						$msg .= '<p style="line-height:25px;"> <a target="_blank" href="'.URL::to('activation?token='.md5($model->id).'').'" style="color: #044235; cursor: pointer; background: #ffc50b; padding: 10px 40px; border-radius: 5px; display: inline; text-decoration: none;"><b>Activate Your Account</b></a> 
			
			</p>';
			//$data_email = array('name' => $request->name, 'msg' => $msg , 'subject' => $subject);
			//echo $html_email = view('emails.template',$data_email)->render();
			// exit;
						 
						 Common::overrideMailerConfig();
					   
						$data_email = array('name' => $request->name, 'msg' => $msg , 'subject' => $subject);
						
						$user_data = array('to' => $request->email, 'name' => $request->name, 'subject' => $subject, 'siteName' => $SITE_NAME, 'businessEmail' => $FROM_EMAIL);
						if($model->role_id!=2){
						Mail::send('emails.template', $data_email, function($message) use ($user_data) {
								$message->from($user_data['businessEmail'], $user_data['siteName']);
								$message->to($user_data['to'], $user_data['name'])->subject($user_data['subject']);
							});
						}
			
						/*if(Setting::findByKey('AUTO_ACTIVE')=='No') {
							$message = 'Your account has been registered successfully.Please check your email to activate account.';
						 Common::overrideMailerConfig();
					   
						$data_email = array('name' => $request->name, 'msg' => $msg , 'subject' => $subject);
						
						$user_data = array('to' => $request->email, 'name' => $request->name, 'subject' => $subject, 'siteName' => $SITE_NAME, 'businessEmail' => $FROM_EMAIL);
						$active_email = Setting::findByKey('ACTIVE_EMAIL');
						if($active_email=='Yes'){
							Mail::send('emails.template', $data_email, function($message) use ($user_data) {
								$message->from($user_data['businessEmail'], $user_data['siteName']);
								$message->to($user_data['to'], $user_data['name'])->subject($user_data['subject']);
							});
						}
						}else {
							$message = 'Your account has been registered successfully.';
						}*/
						
						 if($model->role_id==2){
							 $message = 'Your account has been registered successfully.Please contact with admin to activate account.<a href="mailto:info@revoy.com.au">info@revoy.com.au</a>';
						 }else {
						 	$message = 'Your account has been registered successfully.Please check your email to activate account.';
						 }
						
						
						return Response::json(array('error_code' => 0, 'status' => 'success', 'message' => $message));
						
					}else {
						return Response::json(array('error_code' => 1, 'status' => 'fail', 'message' => 'Email already exist'));
					}
					
					}else {
						return Response::json(array('error_code' => 1, 'status' => 'fail', 'message' => 'Invalid Email address'));
					}
		
	}
	
	public function activation(Request $request) {

		
		
        $message_str = '';

        $error = 1;

        $user = Agents::whereRaw('md5(id) = ? ', array($request->token))->get()->toArray();

		

        if (empty($user)) {

            $message_str = 'Invalid Account Access';

        } else if (!empty($user) && $user[0]['status'] == 'Yes') {

            $message_str = 'Your account is already  activated.';

            $error = 1;

        } else {

            $message_str = 'Your account has been successfully activated.';

            $error = 0;

            $user_mdl = Agents::find($user[0]['id']);

            $user_mdl->status = 'Yes';

            $user_mdl->save();

        }

       

		return view('accounts.activate',['title' => 'Account Activation' ,'message_str' => $message_str, 'error' => $error]);

    }
	
	public function setpassword(Request $request) {
		
        $message_str = '';

        $error = 1;

        $user = Agents::whereRaw('md5(id) = ? AND reset_password = 1  ', array($request->token))->get()->toArray();

		

        if (empty($user)) {
             return Redirect::to('/dashboard');

        }else {
			return view('accounts.setpassword',['title' => 'Reset Password','token'=>$request->token]);
		}

    }
	
	
	/*
      |--------------------------------------------------------------------------
      | Forgot password.
      |--------------------------------------------------------------------------
     */
	
	public function forgotpassword()
	{
		return view('accounts.forgotpassword', ['title' =>'Forgot Password']);
	}
	/*
      |--------------------------------------------------------------------------
      | Reset password.
      |--------------------------------------------------------------------------
     */
	 
	public function restpassword(Request $request) {
		
        $client = Agents::whereRaw('email = ?  AND status = ? ', array(trim($request->email),'Yes'))->get()->toArray();
		if (!empty($client)) {

            $tmp_password = rand(1111, 9999);
            $model = Agents::find($client[0]['id']);
            $model->reset_password = 1;
			$model->reset_password_expiry = date('Y-m-d H:i:s', strtotime('+1 hour'));
            $model->save();

            $SITE_NAME = Setting::findByKey('SITE_NAME');
			$FROM_EMAIL = Setting::findByKey('FROM_EMAIL');
			
			
			
					$subject = $SITE_NAME.'- Forgot Password';
					$subject_header = 'Forgot Password';
					$msg = '';
					$msg = '<p>To change your password, please click the button below:</p>
					
					<p style="line-height:25px;"> <a target="_blank" href="'.URL::to('setpassword?token='.md5($model->id).'').'" style="color: #044235; cursor: pointer; background: #ffc50b; padding: 10px 40px; border-radius: 5px; display: inline; text-decoration: none;"><b>Reset Password</b></a> 
			
					</p>
					
					<p>
					  Please take a moment to choose a password you can easily remember. 
					  You can also update your password and other account details on your <b>My Profile</b> page after logging in.
					</p>';
					//echo $msg; exit;
           
			 Common::overrideMailerConfig();
           
            $data_email = array('name' => $client[0]['name'], 'msg' => $msg , 'subject' => $subject_header);
			
            $user_data = array('to' => trim($client[0]['email']), 'name' => $client[0]['name'], 'subject' => $subject, 'siteName' => $SITE_NAME, 'businessEmail' => $FROM_EMAIL);
			
			 //$data_email = array('name' => '', 'msg' => $msg);
            //$user_data = array('to' => $client[0]['email'], 'name' => $client[0]['name'], 'subject' => $subject, 'siteName' => 'PPP', 'businessEmail' => $FROM_EMAIL);
        
			
            Mail::send('emails.template', $data_email, function($message) use ($user_data) {
                $message->from($user_data['businessEmail'], $user_data['siteName']);
                $message->to(trim($user_data['to']), $user_data['name'])->subject($user_data['subject']);
            });
			
			return Response::json(array('error_code' => 1, 'status' => 'success', 'message' => 'Your password has been reset, and an email containing instructions on how to update your account has been sent.'));
           
        } else {
			return Response::json(array('error_code' => 1, 'status' => 'fail', 'message' => 'The email you enter does not exists.'));
           
        }
    }
	
	public function updatepassword(Request $request) {
		
       
		$client = Agents::whereRaw('md5(id) = ? AND reset_password = 1  ', array($request->token))->get()->toArray();

		if (!empty($client)) {

            $tmp_password = rand(1111, 9999);
            $model = Agents::find($client[0]['id']);
            $model->password = Hash::make($request->password);
			$model->reset_password = 0;
            $model->save();
			return Response::json(array('error_code' => 1, 'status' => 'success', 'message' => 'Your password has been reset.'));
           
        } else {
			return Response::json(array('error_code' => 1, 'status' => 'fail', 'message' => 'Invalid Request.'));
           
        }
    }
	
	
	 public function restpassword_old(Request $request) {
		
        $client = Agents::whereRaw('email = ?  AND status = ? ', array(trim($request->email),'Yes'))->get()->toArray();
		if (!empty($client)) {

            $tmp_password = rand(1111, 9999);
            $model = Agents::find($client[0]['id']);
            $model->password = Hash::make($tmp_password);
            $model->save();

            $SITE_NAME = Setting::findByKey('SITE_NAME');
			$FROM_EMAIL = Setting::findByKey('FROM_EMAIL');
			
			
			
            $subject = $SITE_NAME.'- Forgot Password';
			$subject_header = 'Forgot Password';
            $msg = '';
            $msg = '<p>Your temporary password is:</p>
					
					<p>'.$tmp_password.'</p>
					
					<p>Please take the time to change your password to 
					something you can easily remember. You can change your password on your My Profile page after logging into your account. There you can update your password, as well as your account details.</p>';
           
			 Common::overrideMailerConfig();
           
            $data_email = array('name' => $client[0]['name'], 'msg' => $msg , 'subject' => $subject_header);
			
            $user_data = array('to' => trim($client[0]['email']), 'name' => $client[0]['name'], 'subject' => $subject, 'siteName' => $SITE_NAME, 'businessEmail' => $FROM_EMAIL);
			
			 //$data_email = array('name' => '', 'msg' => $msg);
            //$user_data = array('to' => $client[0]['email'], 'name' => $client[0]['name'], 'subject' => $subject, 'siteName' => 'PPP', 'businessEmail' => $FROM_EMAIL);
        
			
            Mail::send('emails.template', $data_email, function($message) use ($user_data) {
                $message->from($user_data['businessEmail'], $user_data['siteName']);
                $message->to(trim($user_data['to']), $user_data['name'])->subject($user_data['subject']);
            });
			
			return Response::json(array('error_code' => 1, 'status' => 'success', 'message' => 'Your password has been reset, and an email containing instructions on how to update your account has been sent.'));
           
        } else {
			return Response::json(array('error_code' => 1, 'status' => 'fail', 'message' => 'The email you enter does not exists.'));
           
        }
    }
	
	
	/*
      |--------------------------------------------------------------------------
      | Dashboard.
      |--------------------------------------------------------------------------
     */

    public function dashboard() {
		
		return view('accounts.dashboard', ['title' => 'Dashboard']);
    }
	
	
	 /*
      |--------------------------------------------------------------------------
      | Profile.
      |--------------------------------------------------------------------------
     */
	 
	
	 

    public function profile() {
		$data = Agents::whereRaw('id = ?  ', array(Session::get('user_id')))->first()->toArray();
		if(Session::get('user_role_id')==3) {
			return view('accounts.profile.sale_person', ['data' => $data, 'title' => 'My Account']);
		}else {
			return view('accounts.profile.index', ['data' => $data, 'title' => 'My Account']);
		}
		
        
    }
	
	
	public function update_profile(Request $request) {
        $model = Agents::find(Session::get('user_id'));
		if ($request->_token) {
			
			$image_name = '';
			$file = $request->image;
			if($file){
			$ext = $file->getClientOriginalExtension();
			$file = $request->image->getClientOriginalName();
			$image_name = rand(11111,99999).'_'.str_replace(' ','-',strtolower($file));
			$path_uploads = 'public/upload/agents/';
			$request->image->move($path_uploads, $image_name);
			//$resizeObj = new Resize($path_uploads.$image_name);
			//$resizeObj->resizeImage(200, 250, 'auto');
			//$resizeObj->saveImage($path_uploads.'thumbs/'.$image_name, 100);
			}
			
			$logo_name = '';
			$file_logo = $request->logo;
			if($file_logo){
			$ext = $file_logo->getClientOriginalExtension();
			$file_logo = $request->logo->getClientOriginalName();
			$logo_name = rand(11111,99999).'_'.str_replace(' ','-',strtolower($file_logo));
			$path_uploads = 'public/upload/agents/';
			$request->logo->move($path_uploads, $logo_name);
			}
			
			
			$banner_name = '';
			$file_banner = $request->banner;
			if($file_banner){
			$ext = $file_banner->getClientOriginalExtension();
			$file_banner = $request->banner->getClientOriginalName();
			$banner_name = rand(11111,99999).'_'.str_replace(' ','-',strtolower($file_banner));
			$path_uploads = 'public/upload/agents/';
			$request->banner->move($path_uploads, $banner_name);
			}
			
            $model->name = $request->name;
            $model->phone = $request->phone;
			$model->location = $request->location;
			$model->address = $request->address;
			$model->designation = $request->designation;
			$model->experience = $request->experience;
			$model->post_code = $request->post_code;
			$model->suburb_area = $request->suburb_area;
			$model->state_name = $request->state_name;
			$model->map_link = $request->map_link;
			$model->video_link = $request->video_link;
			$model->full_contents = $request->full_contents;
			
			$model->fb = $request->fb;
			$model->tw = $request->tw;
			$model->ln = $request->ln;
			$model->website = $request->website;
			$model->tiktok = $request->tiktok;
			$model->instagram = $request->instagram;
			
			$model->license_number = $request->license_number;
			$model->business_phone = $request->business_phone;
			$model->tagline = $request->tagline;
			$model->awards = $request->awards;
			$model->specialities = $request->specialities;
			$model->community_involvement = $request->community_involvement;
			
			
			
			if($image_name!="") {
			$model->image = $image_name;
			}
			if($logo_name!="") {
			$model->logo = $logo_name;
			}
			if($banner_name!="") {
			$model->banner = $banner_name;
			}
            $model->updated_at = date('Y-m-d H:i:s');
            $model->save();
			return Response::json(array('error_code' => 0, 'status' => 'success', 'message' => 'Account Information has been updated.'));
        }
        
    }
	
	public function update_profile_sales(Request $request) {
        $model = Agents::find(Session::get('user_id'));
		if ($request->_token) {
			
			$image_name = '';
			$file = $request->image;
			if($file){
			$ext = $file->getClientOriginalExtension();
			$file = $request->image->getClientOriginalName();
			$image_name = rand(11111,99999).'_'.str_replace(' ','-',strtolower($file));
			$path_uploads = 'public/upload/agents/';
			$request->image->move($path_uploads, $image_name);
			//$resizeObj = new Resize($path_uploads.$image_name);
			//$resizeObj->resizeImage(200, 250, 'auto');
			//$resizeObj->saveImage($path_uploads.'thumbs/'.$image_name, 100);
			}
			
			$logo_name = '';
			$file_logo = $request->logo;
			if($file_logo){
			$ext = $file_logo->getClientOriginalExtension();
			$file_logo = $request->logo->getClientOriginalName();
			$logo_name = rand(11111,99999).'_'.str_replace(' ','-',strtolower($file_logo));
			$path_uploads = 'public/upload/agents/';
			$request->logo->move($path_uploads, $logo_name);
			}
			
			
			$banner_name = '';
			$file_banner = $request->banner;
			if($file_banner){
			$ext = $file_banner->getClientOriginalExtension();
			$file_banner = $request->banner->getClientOriginalName();
			$banner_name = rand(11111,99999).'_'.str_replace(' ','-',strtolower($file_banner));
			$path_uploads = 'public/upload/agents/';
			$request->banner->move($path_uploads, $banner_name);
			}
			
            $model->name = $request->name;
            $model->phone = $request->phone;
			
			
			
			
			
			if($image_name!="") {
			$model->image = $image_name;
			}
			
            $model->updated_at = date('Y-m-d H:i:s');
            $model->save();
			return Response::json(array('error_code' => 0, 'status' => 'success', 'message' => 'Account Information has been updated.'));
        }
        
    }
	
	public function agency_profile() {
		$data = Agents::whereRaw('id = ?  ', array(Session::get('user_id')))->first()->toArray();
		if($data['role_id']==1){
       	 return view('accounts.agency.agency_profile.index', ['data' => $data, 'title' => 'Your Profile']);
		 }else {
			return Redirect::to('/dashboard');
		}
    }
	
	public function update_agency_profile(Request $request) {
        $model = Agents::find(Session::get('user_id'));
		if ($request->_token) {
			
			
			$model->address = $request->address;
			$model->suburb_area = $request->suburb_area;
			$model->post_code = $request->post_code;
			
			$model->state_name = $request->state_name;
			$model->country_name = $request->country_name;
			$model->mailing_address = $request->mailing_address;
			$model->mailing_suburb_area = $request->mailing_suburb_area;
			$model->mailing_post_code = $request->mailing_post_code;
			$model->mailing_state_name = $request->mailing_state_name;
			$model->mailing_country_name = $request->mailing_country_name;
			$model->phone = $request->phone;
			$model->fax = $request->fax;
			$model->website = $request->website;
			$model->tw = $request->tw;
			$model->fb = $request->fb;
			$model->ln = $request->ln;
			$model->video_link = $request->video_link;
			$model->tiktok = $request->tiktok;
			$model->instagram = $request->instagram;
			
			$model->principal_name = $request->principal_name;
			$model->display_email = $request->display_email;
			$model->full_contents = strip_tags($request->full_contents);
			
			$model->tagline = $request->tagline;
			$model->awards = $request->awards;
			$model->specialities = $request->specialities;
			$model->community_involvement = $request->community_involvement;
			$model->experience = $request->experience;
		
			
            $model->updated_at = date('Y-m-d H:i:s');
            $model->save();
			return Response::json(array('error_code' => 0, 'status' => 'success', 'message' => 'Data has been updated.'));
        }
        
    }
	
	
	public function agency_branding() {
		$data = Agents::whereRaw('id = ?  ', array(Session::get('user_id')))->first()->toArray();
		if($data['role_id']==1){
       	 return view('accounts.agency.agency_branding.index', ['data' => $data, 'title' => 'Your agency branding']);
		 }else {
			return Redirect::to('/dashboard');
		}
    }
	
	public function update_agency_branding(Request $request) {
        $model = Agents::find(Session::get('user_id'));
		if ($request->_token) {
			
			$image_name = '';
			$file = $request->image;
			if($file){
			$ext = $file->getClientOriginalExtension();
			$file = $request->image->getClientOriginalName();
			$image_name = rand(11111,99999).'_'.str_replace(' ','-',strtolower($file));
			$path_uploads = 'public/upload/agents/';
			$request->image->move($path_uploads, $image_name);
			
			}
			
			$logo_name = '';
			$file_logo = $request->logo;
			if($file_logo){
			$ext = $file_logo->getClientOriginalExtension();
			$file_logo = $request->logo->getClientOriginalName();
			$logo_name = rand(11111,99999).'_'.str_replace(' ','-',strtolower($file_logo));
			$path_uploads = 'public/upload/agents/';
			$request->logo->move($path_uploads, $logo_name);
			}
			
			
			$banner_name = '';
			$file_banner = $request->banner;
			if($file_banner){
			$ext = $file_banner->getClientOriginalExtension();
			$file_banner = $request->banner->getClientOriginalName();
			$banner_name = rand(11111,99999).'_'.str_replace(' ','-',strtolower($file_banner));
			$path_uploads = 'public/upload/agents/';
			$request->banner->move($path_uploads, $banner_name);
			}
			
			
			
			
			$model->primary_colour = $request->primary_colour;
			$model->secondary_colour = $request->secondary_colour;
			$model->text_colour = $request->text_colour;
			$model->font_size = $request->font_size;
			
			
			if($image_name!="") {
			$model->image = $image_name;
			}
			if($logo_name!="") {
			$model->logo = $logo_name;
			}
			if($banner_name!="") {
			$model->banner = $banner_name;
			}
			
			
			
			
			$model->updated_by = Session::get('user_id');
            $model->save();
			
			
			return Response::json(array('error_code' => 0, 'status' => 'success', 'message' => 'Data has been updated.'));
        }
        
    }
	
	
	public function suburb_muncipalities() {
		$data = Agents::whereRaw('id = ?  ', array(Session::get('user_id')))->first()->toArray();
		if($data['role_id']==1){
       	 return view('accounts.agency.suburb_muncipalities.index', ['data' => $data, 'title' => 'Servicing Muncipalities']);
		 }else {
			return Redirect::to('/dashboard');
		}
    }
	
	public function update_suburb_muncipalities(Request $request) {
        $model = Agents::find(Session::get('user_id'));
		if ($request->_token) {
			
			
				$model->your_suburbs = $request->your_suburbs;
				$model->your_municipalities = $request->your_municipalities;
				
			
			
            $model->updated_at = date('Y-m-d H:i:s');
            $model->save();
			return Response::json(array('error_code' => 0, 'status' => 'success', 'message' => 'Data has been updated.'));
        }
        
    }
	
	public function servicing_suburbs() {
		
		$data = Agents::whereRaw('id = ?  ', array(Session::get('user_id')))->first()->toArray();
		if($data['role_id']==1){
        return view('accounts.agency.servicing_suburbs.index', ['data' => $data, 'title' => 'Servicing Suburbs']);
		}else {
			return Redirect::to('/dashboard');
		}
    }
	
	public function update_servicing_suburbs(Request $request) {
        $model = Agents::find(Session::get('user_id'));
		if ($request->_token) {
			
			
				$model->suburb1 = $request->suburb1;
				$model->suburb2 = $request->suburb2;
				$model->suburb3 = $request->suburb3;
				$model->suburb4 = $request->suburb4;
				$model->suburb5 = $request->suburb5;
				$model->suburb6 = $request->suburb6;
				$model->suburb7 = $request->suburb7;
				$model->suburb8 = $request->suburb8;
				$model->suburb9 = $request->suburb9;
				$model->suburb10 = $request->suburb10;
				
			
			
            $model->updated_at = date('Y-m-d H:i:s');
            $model->save();
			return Response::json(array('error_code' => 0, 'status' => 'success', 'message' => 'Data has been updated.'));
        }
        
    }
	
	public function profile_crm() {
		$data = Agents::whereRaw('id = ?  ', array(Session::get('user_id')))->first()->toArray();
		if($data['mantis_allow']=='Yes'){
        return view('accounts.profile_crm.index', ['data' => $data, 'title' => 'CRM Settings']);
		}else {
			return Redirect::to('/dashboard');
		}
    }
	
	
	public function update_profile_crm(Request $request) {
        $model = Agents::find(Session::get('user_id'));
		if ($request->_token) {
			
			if($model->mantis_allow=='Yes'){
				$model->mantis_api_key = $request->mantis_api_key;
				$model->mantis_agency_id = $request->mantis_agency_id;
				$model->mantis_property_types = (is_array($request->mantis_property_types) && count($request->mantis_property_types)>0)?implode(',',$request->mantis_property_types):'';
			}
			
            $model->updated_at = date('Y-m-d H:i:s');
            $model->save();
			return Response::json(array('error_code' => 0, 'status' => 'success', 'message' => 'Data has been updated.'));
        }
        
    }
	
	public function profile_customer() {
		$data = Agents::whereRaw('id = ? AND role_id=4  ', array(Session::get('user_id')))->get()->toArray();
		if(count($data)>0){
        return view('accounts.profile_customer.index', ['data' => $data[0], 'title' => 'Profile']);
		}else {
			return Redirect::to('/dashboard');
		}
    }
	
	public function privacy_settings() {
		if(Session::get('user_role_id')==4) {
			return Redirect::to('/');
		}else {
			$data = Agents::whereRaw('id = ?  ', array(Session::get('user_id')))->first()->toArray();
        	return view('accounts.privacy_settings', ['title' => 'Privacy Settings','data'=>$data]);
		}
    }
	
	public function save_privacy_settings(Request $request) {
        $model = Agents::find(Session::get('user_id'));
		if ($request->_token) {
			
            $model->allow_suggested_properties = ($request->allow_suggested_properties)?$request->allow_suggested_properties:0;
            $model->allow_personalized_ads = ($request->allow_personalized_ads)?$request->allow_personalized_ads:0;
			
            $model->updated_at = date('Y-m-d H:i:s');
            $model->save();
			return Response::json(array('error_code' => 0, 'status' => 'success', 'message' => 'Data has been updated.'));
        }
        
    }
	/*
      |--------------------------------------------------------------------------
      | Password.
      |--------------------------------------------------------------------------
     */

    public function change_password() {
		$data = Agents::whereRaw('id = ?  ', array(Session::get('user_id')))->first()->toArray();
        return view('accounts.password.index', ['data' => $data, 'title' => 'Change Password']);
    }
	
	public function update_password(Request $request) {
        $model = Agents::find(Session::get('user_id'));
		if ($request->_token) {
			
            $model->password = Hash::make($request->password);
            
            $model->save();
			return Response::json(array('error_code' => 0, 'status' => 'success', 'message' => 'Password has been changed  successfully.'));
        }
        
    }
	
	
	public function invoices() {
		$data = UserPlans::whereRaw('user_id = ?  ', array(Session::get('user_id')))->get()->toArray();
        return view('accounts.invoices.index', ['data' => $data, 'title' => 'Invoices']);
    }
	
	/*public function packages() {
		$data = Plans::whereRaw('status = ?  ', array('Yes'))->get()->toArray();
        return view('accounts.packages.index', ['data' => $data, 'title' => 'Our Packages']);
    }*/
	
	public function marketing() {
		$data = Plans::whereRaw('status = ?  ', array('Yes'))->orderByRaw('sort_order')->get()->toArray();
        return view('accounts.marketing.index', ['data' => $data, 'title' => 'Marketing']);
    }
	
	public function list_reviews() {
		$result_reviews = AgentReviews::whereRaw('user_id = ?  ', array(Session::get('user_id')))->orderByRaw('id DESC')->get();
        return view('accounts.reviews.index', ['result_reviews' => $result_reviews, 'title' => 'Reviews']);
    }
	
	public function delete_review(Request $request){
		 if ($request->_token) {
		 	AgentReviews::whereRaw('md5(id) = ? AND user_id = ? ', array($request->id,Session::get('user_id')))->delete();
			return Response::json(array('error_code' => 0, 'status' => 'success', 'message' => 'Data has been removed.'));
		 }else {
			return Response::json(array('error_code' => 1, 'status' => 'fail', 'message' => 'invalid request.'));
         }
	}
	
	public function status_review(Request $request){
		
		if ($request->_token) {
			 $model = AgentReviews::find($request->id);
            
			
			if ($model->status == 'Yes') {
					 $set_status = 'No';
										  $status_class = 'pending';
										  $status_title = 'Pending';
                                $html = '<a style="text-decoration:none;" href="javascript:void(0)" onclick="change_status(' . $request->id . ',\''.url('/').'/status-review\')" ><span class="status__btn '.$status_class.'">'.$status_title.'</span></a>';
                            } else {
								 $set_status = 'Yes';
								$status_class = 'active';
										  $status_title = 'Active';
                                $html = '<a style="text-decoration:none;" href="javascript:void(0)" onclick="change_status(' . $request->id . ',\''.url('/').'/status-review\')" ><span class="status__btn '.$status_class.'">'.$status_title.'</span></a>';
                            }
			
			
            $model->status = $set_status;
            $model->save();
            return Response::json(array('error_code' => 0, 'status' => 'success', 'html' => $html));
        } else {
            return Response::json(array('error_code' => 1, 'status' => 'fail', 'message' => 'Invalid Access'));
        }
		
	}
	
	public function delete_property(Request $request){
		 if ($request->_token) {
		 	Property::whereRaw('md5(id) = ? AND user_id = ? ', array($request->id,Session::get('user_id')))->delete();
			return Response::json(array('error_code' => 0, 'status' => 'success', 'message' => 'Data has been removed.'));
		 }else {
			return Response::json(array('error_code' => 1, 'status' => 'fail', 'message' => 'invalid request.'));
         }
	}
	
	
	
	public function sales_list_property() {
		
		if(Session::get('user_role_id')!=3){
			return Redirect::to('/dashboard');
		}
		
		$user_parent = Agents::whereRaw('id ='.Session::get('user_id').' ')->select('parent_agent_id')->first()->toArray();
		$user_id = $user_parent['parent_agent_id'];
		$result_property = Property::whereRaw(" user_id IN (".$user_id.") ")->get();
        return view('accounts.property.sales_list_property', ['result_property' => $result_property, 'title' => 'Listings']);
    }
	
	public function saved_list_property() {
		$result_property = BookmarkProperty::whereRaw('user_id ='.Session::get('user_id').' ')->get()->toArray();
		//echo '<pre>'; print_r($result_property); exit;
        return view('accounts.property.saved_list_property', ['result_property' => $result_property, 'title' => 'Saved Listings']);
    }
	
	public function delete_saved_property(Request $request){
		 if ($request->_token) {
		 	BookmarkProperty::whereRaw('md5(id) = ? AND user_id = ? ', array($request->id,Session::get('user_id')))->delete();
			return Response::json(array('error_code' => 0, 'status' => 'success', 'message' => 'Data has been removed.'));
		 }else {
			return Response::json(array('error_code' => 1, 'status' => 'fail', 'message' => 'invalid request.'));
         }
	}
	
	
	public function list_property() {
		//
		if(Session::get('user_role_id')==3){
			return Redirect::to('/dashboard');
		}
		$user_id = Agents::get_user_id(Session::get('user_id'));
		/*if(Session::get('user_role_id')==2){
			$result_property = Property::whereRaw(" user_id IN (".$user_id.") ")->get();
		}else {
			$result_property = Property::whereRaw(" agency_id IN (".Session::get('user_id').") ")->get();
		}*/
		
		$result_property = Property::whereRaw(" user_id IN (".$user_id.") ")->orderByRaw('id DESC')->get();
		
        return view('accounts.property.index', ['result_property' => $result_property, 'title' => 'Listings']);
    }
	
	public function add_property() {
		if(Session::get('user_role_id')==3){
			return Redirect::to('/dashboard');
		}
        return view('accounts.property.add', ['title' => 'Add Property']);
    }
	
	public function save_property(Request $request) {
       
		if ($request->_token) {
			$Latitude = '';
			$Longitude = '';
			$map_key = Setting::findByKey('MAP_KEY');
			if($map_key!='' && $request->street_address!=''){
			 $state_name = '';
			 $state_rs = States::where('id',$request->state_id)->get()->toArray();
			 if(count($state_rs)>0){
				 $state_name = $state_rs[0]['name'];
			 }
			 $coordinates =  Common::getLatLong($request->street_address.' '.$request->suburb.' '.$request->postcode.' '.$state_name.' Austrila',$map_key);
			 if ($coordinates) {
				 $Latitude = $coordinates['lat'];
				 $Longitude = $coordinates['lng'];
			 }
			}
			$model  = new Property();
			$package_name = '';
			$package_name = Plans::whereRaw('id = ?  ', array($request->package_id))->first()->toArray();
			
			if(Session::get('user_role_id')==1){
				$model->user_id = ($request->lead_agent!='')?$request->lead_agent:Session::get('user_id');
			}else {
				$model->user_id = Session::get('user_id');
			}
			$model->agency_id = Session::get('user_agency_id');
			$model->assestant_user_id = $request->assestant_user_id;
			if($request->assestant_user_id==''){
				$model->show_assestant_user = 0;
			}else {
				$model->show_assestant_user = isset($request->show_assestant_user)?$request->show_assestant_user:0;
			}
			
            $model->package_id = $request->package_id;
            $model->package_name = $package_name['name'];
			$model->category_id = $request->category_id;
			$model->underContract = isset($request->underContract)?$request->underContract:0;
			$model->sold_date = $request->sold_date;
			$model->sold_price = $request->sold_price;
			
			$model->leased_date = $request->leased_date;
			
			$model->property_type_id = $request->property_type_id;
			$model->property_status_type = $request->property_status_type;
			$model->property_authority = $request->property_authority;
			$model->price = $request->price;
			$model->bond = $request->bond;
			$model->show_price = isset($request->show_price)?$request->show_price:0;
			$model->min_price = $request->min_price;
			$model->hide_price_show_contact_agent = isset($request->hide_price_show_contact_agent)?$request->hide_price_show_contact_agent:0;
			$model->vendor_name = $request->vendor_name;
			
			$model->vendor_email = $request->vendor_email;
			$model->vendor_phone = $request->vendor_phone;
			$model->send_public_mail_to_vender = isset($request->send_public_mail_to_vender)?$request->send_public_mail_to_vender:0;
			$model->send_weekly_mail_to_vender = isset($request->send_weekly_mail_to_vender)?$request->send_weekly_mail_to_vender:0;
			
			$model->address_unit = $request->address_unit;
			$model->street_address = $request->street_address;
			$model->hide_street_address = isset($request->hide_street_address)?$request->hide_street_address:0;
			$model->hide_street_view = isset($request->hide_street_view)?$request->hide_street_view:0;
			$model->postcode = $request->postcode;
			$model->suburb = $request->suburb;
			$model->state_id = $request->state_id;
			$model->municipality = $request->municipality;
			$model->auction_result = $request->auction_result;
			$model->latitude = $Latitude;
			$model->longitude = $Longitude;
			$model->maximum_bid = isset($request->maximum_bid)?$request->maximum_bid:0;
			$model->sort_order = 1;
			$model->published_date = date('Y-m-d H:i:s');
            $model->save();
			
			$link = url('/').'/edit-property/'.md5($model->id);
			
			return Response::json(array('error_code' => 0, 'status' => 'success', 'message' => 'Data has been updated.','link'=>$link));
        }else {
			return Response::json(array('error_code' => 1, 'status' => 'fail', 'message' => 'invalid request.'));
           
        }
        
    }
	
	public function edit_property($id) {
		if(Session::get('user_role_id')==3){
			return Redirect::to('/dashboard');
		}
		$user_id = Agents::get_user_id(Session::get('user_id'));
		$user_ids = explode(',',$user_id);
		
		if(in_array(Session::get('user_id'),$user_ids)){
		
			$result_property = Property::whereRaw(" md5(id) = '".$id."'  ")->get()->toArray();
			
			//$result_property = Property::whereRaw('user_id = ? AND md5(id) =?  ', array(Session::get('user_id'),$id))->get()->toArray();
			if(count($result_property)>0){
			return view('accounts.property.edit', ['result_property' => $result_property[0], 'title' => 'Edit Property']);
		}else {
			 return Redirect::to('/listings');
		}
		}else {
			 return Redirect::to('/listings');
		}
    }
	
	public function update_property(Request $request) {
        
		if ($request->_token) {
			
		$user_id = Agents::get_user_id(Session::get('user_id'));
		$user_ids = explode(',',$user_id);
		
		if(in_array(Session::get('user_id'),$user_ids)){
			
			$result_property = Property::whereRaw(' md5(id) =?  ', array($request->proper_token))->get()->toArray();
			if(count($result_property)>0){
				
				$Latitude = '';
				$Longitude = '';
				$map_key = Setting::findByKey('MAP_KEY');
				if($map_key!='' && $request->street_address!=''){
				 $state_rs = States::where('id',$request->state_id)->get()->toArray();
				 if(count($state_rs)>0){
					 $state_name = $state_rs[0]['name'];
				 }
				 $coordinates =  Common::getLatLong($request->street_address.' '.$request->suburb.' '.$request->postcode.' '.$state_name.' Austrila',$map_key);
				
				 if ($coordinates) {
					 $Latitude = $coordinates['lat'];
					 $Longitude = $coordinates['lng'];
				 }
				}
				
				$model = Property::find($result_property[0]['id']);
				
				$old_status = $model->category_id;
				
				$package_name = '';
				$package_name = Plans::whereRaw('id = ?  ', array($request->package_id))->first()->toArray();
				if(Session::get('user_role_id')==1){
					$model->user_id = ($request->lead_agent!='')?$request->lead_agent:Session::get('user_id');
				}else {
					$model->user_id = Session::get('user_id');
				}
				$model->agency_id = Session::get('user_agency_id');
				$model->assestant_user_id = $request->assestant_user_id;
				if($request->assestant_user_id==''){
					$model->show_assestant_user = 0;
				}else {
					$model->show_assestant_user = isset($request->show_assestant_user)?$request->show_assestant_user:0;
				}
				//$model->show_assestant_user = isset($request->show_assestant_user)?$request->show_assestant_user:0;
				$model->status = $request->status;
				$model->package_id = $request->package_id;
				$model->package_name = $package_name['name'];
				$model->category_id = $request->category_id;
				$model->underContract = isset($request->underContract)?$request->underContract:0;
				$model->sold_date = $request->sold_date;
				$model->sold_price = $request->sold_price;
				$model->leased_date = $request->leased_date;
				//$model->property_type_id = $request->property_type_id;
				$model->property_status_type = $request->property_status_type;
				$model->property_authority = $request->property_authority;
				$model->price = $request->price;
				$model->bond = $request->bond;
				$model->show_price = isset($request->show_price)?$request->show_price:0;
				$model->min_price = $request->min_price;
				$model->hide_price_show_contact_agent = isset($request->hide_price_show_contact_agent)?$request->hide_price_show_contact_agent:0;
				$model->vendor_name = $request->vendor_name;
				
				$model->vendor_email = $request->vendor_email;
				$model->vendor_phone = $request->vendor_phone;
				$model->send_public_mail_to_vender = isset($request->send_public_mail_to_vender)?$request->send_public_mail_to_vender:0;
				$model->send_weekly_mail_to_vender = isset($request->send_weekly_mail_to_vender)?$request->send_weekly_mail_to_vender:0;
				
				$model->address_unit = $request->address_unit;
				$model->street_address = $request->street_address;
				$model->hide_street_address = isset($request->hide_street_address)?$request->hide_street_address:0;
				$model->hide_street_view = isset($request->hide_street_view)?$request->hide_street_view:0;
				$model->postcode = $request->postcode;
				$model->suburb = $request->suburb;
				$model->state_id = $request->state_id;
				$model->municipality = $request->municipality;
				$model->auction_result = $request->auction_result;
				$model->maximum_bid = $request->maximum_bid;
				$model->latitude = $Latitude;
			    $model->longitude = $Longitude;
				$model->sort_order = 1;
				$model->updated_at = date('Y-m-d H:i:s');
				$model->save();
			
				if($old_status!=$request->category_id){
					$this->send_vendor_email($result_property[0]['id'],$request->category_id);
				}
			
				return Response::json(array('error_code' => 0, 'status' => 'success', 'message' => 'Data has been updated.'));
			}else {
			return Response::json(array('error_code' => 1, 'status' => 'fail', 'message' => 'invalid request.'));
           }
			
			
        }else {
			return Response::json(array('error_code' => 1, 'status' => 'fail', 'message' => 'invalid request.'));
           
        }
		
		}else {
			return Response::json(array('error_code' => 1, 'status' => 'fail', 'message' => 'invalid request.'));
           
        }
        
    }
	
	public function send_vendor_email($id,$status_id){
					
					$row_p = Property::where('id',$id)->first();
					
					$propery_sharing_address = $row_p->suburb.','.$row_p->postcode.','.$row_p->property_state->name;
					
					if($row_p->send_public_mail_to_vender==1 && $row_p->vendor_email!='') {
					
					$rs_property_options = Propertyoptions::whereRaw("id = ".$status_id." ")->orderByRaw('name')->get()->toArray();	
					$status_name = '';
					if(count($rs_property_options)>0){
						$status_name = '('.$rs_property_options[0]['name'].')';
					}
		
					$subject = Setting::findByKey('SITE_NAME').' Property Status Updated '.$status_name;
					$subject_header = 'Your Property Status Update '.$status_name;
					
					$msg = '';
					
					$listing_link = url('/').'/detail/'.$row_p->slug.'-'.$row_p->id.'.html';
					
					$msg = '<div class="mail-cont-ul" style="background-color: #e5e5e5; padding: 40px 0; text-align: center;">
            <p style="font-size: 18px; color: #044235; margin: 0 0 25px 0; padding: 0 10px;">
                Please have a look, and if you have any questions, Please let your agent know.
                Here is the Link Below for your Property.
            </p>
            <a href="'.$listing_link.'" target="_blank" style="text-decoration: none; background-color: #044235; color: #ffc50b; font-size: 16px; font-weight: 600; border-radius: 5px; padding: 10px 20px;">View Your Property</a>
            <div style="margin: 35px auto 0 auto; width: 280px; background-color: #044235; padding: 10px; border-radius: 5px;">
                <img src="'.url('/') . '/public/upload/property/'.$row_p->id.'/'.$row_p->image.'" alt="" width="280px" style="border-radius: 5px;">
                <table style="width: 100%; max-width: 300px; border-collapse: collapse;">
                    <tbody><tr>
                        
                    </tr>
                    <tr style="width: 100%;">
                        <td colspan="4" style=" padding: 10px 0px 0px 10px; text-align: left; font-weight: bold; font-size: 18px; color: #fff;">
                            Contact Agent
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 10px; text-align: left; width: 25%; vertical-align: middle;">
                            <table align="center" style="border-collapse: collapse;">
                                <tbody><tr>
                                    <td style="vertical-align: middle;">
                                        <img src="'.url('/').'/public/assets/main/img/bed-icon.png" width="25" height="25" alt>
                                    </td>
                                    <td style="vertical-align: middle; padding-left: 5px;">
                                        <!-- Number -->
                                        <span style="font-size: 18px; font-weight: bold; color: #fff;">'.$row_p->bedrooms.'</span>
                                    </td>
                                </tr>
                            </tbody></table>
                        </td>
            
                        <!-- Second Column: Bathrooms -->
                        <td style="padding: 10px; text-align: center; vertical-align: middle;">
                            <table align="center" style="border-collapse: collapse;">
                                <tbody><tr>
                                    <td style="vertical-align: middle;">
                                        <img src="'.url('/').'/public/assets/main/img/bath-icon.png" width="25" height="25" alt>
                                    </td><td style="vertical-align: middle; padding-left: 5px;">
                                        <!-- Number -->
                                        <span style="font-size: 18px; font-weight: bold; color: #fff;">'.$row_p->bathrooms.'</span>
                                    </td>
                                </tr>
                            </tbody></table>
                        </td>
                        <!-- Second Column: Bathrooms -->
                        <td style="padding: 10px; text-align: center; vertical-align: middle;">
                            <table align="center" style="border-collapse: collapse;">
                                <tbody><tr>
                                    <td style="vertical-align: middle;">
                                       <img src="'.url('/').'/public/assets/main/img/car-icon.png" width="25" height="25" alt>
                                    </td><td style="vertical-align: middle; padding-left: 5px;">
                                        <!-- Number -->
                                        <span style="font-size: 18px; font-weight: bold; color: #fff;">'.$row_p->garage_spaces.'</span>
                                    </td>
                                </tr>
                            </tbody></table>
                        </td>
                    </tr>
                    <tr style="width: 100%;">
                        <td colspan="4" style=" padding: 0px 10px 10px 10px; text-align: left; color: #fff; font-size: 18px;">
                            '.$propery_sharing_address.'
                        </td>
                    </tr>
                </tbody></table>
            
            </div>
        </div>';
	
					$data_email = array('name' => '', 'msg' => $msg,'listing_link'=>$listing_link, 'subject' => $subject_header );
	
					$html_email = view('emails.template',$data_email)->render(); 
					//echo $html_email; exit;
					
					$to_name = Setting::findByKey('SITE_NAME');
					$model_n = new Emailque();
					$model_n->email_type = 'PROPERY_PUBLIC';
					$model_n->to_name =  $row_p->vendor_name;
					$model_n->to_email = $row_p->vendor_email;
					$model_n->from_name = Setting::findByKey('SITE_NAME');
					$model_n->from_email = Setting::findByKey('CONTACT_EMAIL');
					$model_n->subject = $subject;
					$model_n->message = $html_email;
					$model_n->save();
					
					}
		
	}
	
	public function update_property_detail(Request $request) {
       
		if ($request->_token) {
			
			$result_property = Property::whereRaw('md5(id) =?  ', array($request->proper_token))->get()->toArray();
			if(count($result_property)>0){
			
				
				$model = Property::find($result_property[0]['id']);
				
				$model->bedrooms = $request->bedrooms;
				$model->bathrooms = $request->bathrooms;
				$model->ensuites = $request->ensuites;
				$model->toilets = $request->toilets;
				$model->garage_spaces = $request->garage_spaces;
				$model->carport_spaces = $request->carport_spaces;
				$model->popen_spaces = $request->popen_spaces;
				$model->living_areas = $request->living_areas;
				$model->house_size = $request->house_size;
				$model->house_size_unit = $request->house_size_unit;
				
				$model->land_size = $request->land_size;
				$model->land_size_unit = $request->land_size_unit;
				$model->energy_efficiency_rating = $request->energy_efficiency_rating;
				
				//$model->address_unit = $request->address_unit;
				//$model->street_address = $request->street_address;
				$model->outdoor_features = is_array($request->outdoor_features)?implode(',',$request->outdoor_features):'';
				$model->indoor_features = is_array($request->indoor_features)?implode(',',$request->indoor_features):'';
				$model->heating_cooling = is_array($request->heating_cooling)?implode(',',$request->heating_cooling):'';
				$model->eco_friendly_features = is_array($request->eco_friendly_features)?implode(',',$request->eco_friendly_features):'';
				$model->other_features = $request->other_features;
				
				$model->updated_at = date('Y-m-d H:i:s');
				$model->save();
			
			
			
				return Response::json(array('error_code' => 0, 'status' => 'success', 'message' => 'Data has been updated.'));
			}else {
			return Response::json(array('error_code' => 1, 'status' => 'fail', 'message' => 'invalid request.'));
           }
			
			
        }else {
			return Response::json(array('error_code' => 1, 'status' => 'fail', 'message' => 'invalid request.'));
           
        }
        
    }
	
	public function update_property_images(Request $request) {
       
		if ($request->_token) {
			
			
			$result_property = Property::whereRaw('md5(id) =?  ', array($request->proper_token))->get()->toArray();
			if(count($result_property)>0){
				
				$path_uploads = 'public/upload/property/'.$result_property[0]['id'];
				if (!file_exists($path_uploads)) {
					mkdir($path_uploads, 0755, true); // Create the folder with permissions
				}
				
				$image_name = '';
				$file = $request->image;
				if($file){
				$ext = $file->getClientOriginalExtension();
				$file = $request->image->getClientOriginalName();
				$image_name = rand(11111,99999).'_'.str_replace(' ','-',strtolower($file));
				
				$request->image->move($path_uploads, $image_name);
				}
				
				$image_front_page_image = '';
				$file_front = $request->front_page_image;
				if($file_front){
				$ext = $file_front->getClientOriginalExtension();
				$file_front = $request->front_page_image->getClientOriginalName();
				$image_front_page_image = rand(11111,99999).'_'.str_replace(' ','-',strtolower($file_front));
				
				$request->front_page_image->move($path_uploads, $image_front_page_image);
				}
				
				$image_statement_information = '';
				$file_front = $request->statement_information;
				if($file_front){
				$ext = $file_front->getClientOriginalExtension();
				$file_front = $request->statement_information->getClientOriginalName();
				$image_statement_information = rand(11111,99999).'_'.str_replace(' ','-',strtolower($file_front));
				
				$request->statement_information->move($path_uploads, $image_statement_information);
				}
				
				
				$model = Property::find($result_property[0]['id']);
				
				$model->name = $request->name;
				$model->video_url = $request->video_url;
				$model->map_link_url = $request->map_link_url;
				$model->slug =Common::slug($request->name);
				$model->full_contents = $request->full_contents;
				if($image_name!=''){
				$model->image = $image_name;
				}
				
				if($image_front_page_image!=''){
				$model->front_page_image = $image_front_page_image;
				}
				
				if($image_statement_information!=''){
				$model->statement_information = $image_statement_information;
				}
				
				$model->updated_at = date('Y-m-d H:i:s');
				$model->save();
				
				
				$image_names = []; // To store all uploaded image names
					$files = $request->images; // Retrieve the array of uploaded files
					
					if (!empty($files) && count($files) > 0) { 
						foreach ($files as $file) {
							if ($file) {
								$ext = $file->getClientOriginalExtension();
								$originalName = $file->getClientOriginalName();
								$image_name = rand(11111, 99999) . '_' . str_replace(' ', '-', strtolower($originalName));
								$file->move($path_uploads, $image_name);
								$model = new Propertyimages();
								$model->image = $image_name;
								$model->img_type = 'images';
								$model->property_id = $result_property[0]['id'];
								$model->save();
								
							}
						}
					}
					
					
					
					$files_fp = $request->floorplans_images_new; 
					//echo '<pre>'; print_r($files_fp); exit;
 					
					if (!empty($files_fp) && count($files_fp) > 0) { 
						foreach ($files_fp as $file) {
							if ($file) {
								$ext = $file->getClientOriginalExtension();
								$originalName = $file->getClientOriginalName();
								$image_name = rand(11111, 99999) . '_' . str_replace(' ', '-', strtolower($originalName));
								$file->move($path_uploads, $image_name);
								$model = new Propertyimages();
								$model->image = $image_name;
								$model->img_type = 'floorplans';
								$model->property_id = $result_property[0]['id'];
								$model->save();
								
							}
						}
					}
				
				
				
			
			
			
				return Response::json(array('error_code' => 0, 'status' => 'success', 'message' => 'Data has been updated.'));
			}else {
			return Response::json(array('error_code' => 1, 'status' => 'fail', 'message' => 'invalid request.'));
           }
			
			
        }else {
			return Response::json(array('error_code' => 1, 'status' => 'fail', 'message' => 'invalid request.'));
           
        }
        
    }
	
	public function update_property_add_images(Request $request) {
       
		if ($request->_token) {
			
			$result_property = Property::whereRaw('md5(id) =?  ', array($request->proper_token))->get()->toArray();
			if(count($result_property)>0){
				
				$path_uploads = 'public/upload/property/'.$result_property[0]['id'];
				if (!file_exists($path_uploads)) {
					mkdir($path_uploads, 0755, true); // Create the folder with permissions
				}
				
				
				
				
				$image_names = []; // To store all uploaded image names
					$files = $request->images; // Retrieve the array of uploaded files
					
					if (!empty($files) && count($files) > 0) { 
						foreach ($files as $file) {
							if ($file) {
								$ext = $file->getClientOriginalExtension();
								$originalName = $file->getClientOriginalName();
								$image_name = rand(11111, 99999) . '_' . str_replace(' ', '-', strtolower($originalName));
								$file->move($path_uploads, $image_name);
								$model = new Propertyimages();
								$model->image = $image_name;
								$model->img_type = 'images';
								$model->property_id = $result_property[0]['id'];
								$model->save();
								
							}
						}
					}
					
				$rs_images = Propertyimages::whereRaw("img_type = 'images' AND property_id = ".$result_property[0]['id']." ")->orderByRaw('id')->get()->toArray();
			
				$html = '';
				if(count($rs_images)>0){
					foreach ($rs_images as $row_img){
						$html .= '<span id="row_id_'.$row_img['id'].'"><img id="mainImage" src="'.url('/') . '/public/upload/property/'.$result_property[0]['id'].'/'.$row_img['image'].'" alt="">
						<a href="javascript:void(0)" class="cls_remove_img" onClick="delete_img('.$row_img['id'].')"><i class="fa fa-times" style="color: red;" ></i></a>
						</span>';
					}
				}
			
				return Response::json(array('error_code' => 0, 'status' => 'success', 'message' => 'Data has been updated.','html'=>$html));
			}else {
			return Response::json(array('error_code' => 1, 'status' => 'fail', 'message' => 'invalid request.'));
           }
			
			
        }else {
			return Response::json(array('error_code' => 1, 'status' => 'fail', 'message' => 'invalid request.'));
           
        }
        
    }
	
	public function update_property_floor_images(Request $request) {
       
		if ($request->_token) {
			
			$result_property = Property::whereRaw('md5(id) =?  ', array($request->proper_token))->get()->toArray();
			if(count($result_property)>0){
				
				$path_uploads = 'public/upload/property/'.$result_property[0]['id'];
				if (!file_exists($path_uploads)) {
					mkdir($path_uploads, 0755, true); // Create the folder with permissions
				}
				
				
				
				
				$image_names = []; // To store all uploaded image names
					$files = $request->images; // Retrieve the array of uploaded files
					
					if (!empty($files) && count($files) > 0) { 
						foreach ($files as $file) {
							if ($file) {
								$ext = $file->getClientOriginalExtension();
								$originalName = $file->getClientOriginalName();
								$image_name = rand(11111, 99999) . '_' . str_replace(' ', '-', strtolower($originalName));
								$file->move($path_uploads, $image_name);
								$model = new Propertyimages();
								$model->image = $image_name;
								$model->img_type = 'floorplans';
								$model->property_id = $result_property[0]['id'];
								$model->save();
								
							}
						}
					}
					
				$rs_images = Propertyimages::whereRaw("img_type = 'floorplans' AND property_id = ".$result_property[0]['id']." ")->orderByRaw('id')->get()->toArray();
			
				$html = '';
				if(count($rs_images)>0){
					foreach ($rs_images as $row_img){
						$html .= '<span id="row_id_'.$row_img['id'].'"><img id="mainImage" src="'.url('/') . '/public/upload/property/'.$result_property[0]['id'].'/'.$row_img['image'].'" alt="">
						<a href="javascript:void(0)" class="cls_remove_img" onClick="delete_img('.$row_img['id'].')"><i class="fa fa-times" style="color: red;" ></i></a>
						</span>';
					}
				}
			
				return Response::json(array('error_code' => 0, 'status' => 'success', 'message' => 'Data has been updated.','html'=>$html));
			}else {
			return Response::json(array('error_code' => 1, 'status' => 'fail', 'message' => 'invalid request.'));
           }
			
			
        }else {
			return Response::json(array('error_code' => 1, 'status' => 'fail', 'message' => 'invalid request.'));
           
        }
        
    }
	
	public function delete_property_images(Request $request){
		 if ($request->_token) {
		 	Propertyimages::whereRaw('(id) = ? ', array($request->id))->delete();
			return Response::json(array('error_code' => 0, 'status' => 'success', 'message' => 'Data has been removed.'));
		 }else {
			return Response::json(array('error_code' => 1, 'status' => 'fail', 'message' => 'invalid request.'));
         }
	}
	
	public function update_property_auction(Request $request) {
       
		if ($request->_token) {
			
			$result_property = Property::whereRaw('md5(id) =?  ', array($request->proper_token))->get()->toArray();
			if(count($result_property)>0){
				
				$model = Property::find($result_property[0]['id']);
				
				$model->auction_date = date('Y-m-d',strtotime($request->auction_date));
				$model->auction_time = $request->auction_hr.':'.$request->auction_time.':00';
				$model->auction_location = $request->auction_location;
				$model->save();
				
				return Response::json(array('error_code' => 0, 'status' => 'success', 'message' => 'Data has been updated.'));
			}else {
			return Response::json(array('error_code' => 1, 'status' => 'fail', 'message' => 'invalid request.'));
           }
			
			
        }else {
			return Response::json(array('error_code' => 1, 'status' => 'fail', 'message' => 'invalid request.'));
           
        }
        
    }
	
	public function update_property_inspection(Request $request) {
       
		if ($request->_token) {
			
			$result_property = Property::whereRaw('md5(id) =?  ', array($request->proper_token))->get()->toArray();
			if(count($result_property)>0){
				
				$model = new Propertyinspection();
				$model->property_id = $result_property[0]['id'];
				$model->ins_date = $request->ins_date;
				$model->ins_start_time = $request->ins_start_hr.':'.$request->ins_start_min.' '.$request->ins_start_opt;
				$model->ins_end_time = $request->ins_end_hr.':'.$request->ins_end_min.' '.$request->ins_end_opt;
				$model->save();
				
				$rs_inspections = Propertyinspection::whereRaw(" property_id = ".$result_property[0]['id']." ")->orderByRaw('id DESC')->get()->toArray();

				$html = '';
				$html = View::make('accounts.property._inspections',array('rs_inspections'=>$rs_inspections))->render();
				return Response::json(array('error_code' => 0, 'status' => 'success', 'message' => 'Data has been updated.','html'=>$html));
			}else {
			return Response::json(array('error_code' => 1, 'status' => 'fail', 'message' => 'invalid request.'));
           }
			
			
        }else {
			return Response::json(array('error_code' => 1, 'status' => 'fail', 'message' => 'invalid request.'));
           
        }
        
    }
	
	
	
	public function delete_property_inspection(Request $request){
		 if ($request->_token) {
		 	Propertyinspection::whereRaw('(id) = ? ', array($request->id))->delete();
			return Response::json(array('error_code' => 0, 'status' => 'success', 'message' => 'Data has been removed.'));
		 }else {
			return Response::json(array('error_code' => 1, 'status' => 'fail', 'message' => 'invalid request.'));
         }
	}
	
	public function property_type_list(Request $request){
		 if ($request->_token) {
			 //$request->id
			 $rs_propertytypes = array();
			 if($request->id!=''){ 
		 		$rs_propertytypes = Propertytypes::whereRaw("status = 'Yes'  AND FIND_IN_SET('".$request->id."', property_options) ")->orderByRaw('name')->get()->toArray();
			 }
			$html = '<select id="property_type_id" name="property_type_id">
                    <option value="">Select</option>';
			foreach ($rs_propertytypes as $row){
				$html .= '<option value="'.$row['id'].'">'.$row['name'].'</option>';
			}
												 
            $html .= '</select>';
			return Response::json(array('error_code' => 0, 'status' => 'success', 'message' => '','html'=>$html));
		 }else {
			return Response::json(array('error_code' => 1, 'status' => 'fail', 'message' => 'invalid request.'));
         }
	}
	
	public function your_profile() {
		$data = Agents::whereRaw('id = ?  ', array(Session::get('user_id')))->first()->toArray();
		
		if(Session::get('user_role_id')==1){
			return view('accounts.agency.profile.index', ['data' => $data, 'title' => 'Your Profile']);
		}else {
			return Redirect::to('/dashboard');
		}
        
    } 
	//-------------------------sales---------------------------------------------------------
	public function salepersons_list() {
		$data = Agents::whereRaw('id = ?  ', array(Session::get('user_id')))->first()->toArray();
		if(Session::get('user_role_id')==1 || Session::get('user_role_id')==2){
			$user_id = Agents::get_user_id(Session::get('user_id'));
			$result = Agents::whereRaw("parent_agent_id IN (".$user_id.")  ")->get();
       	    return view('accounts.salepersons.index', ['result' => $result, 'title' => 'Sales Representatives']);
		}else {
			return Redirect::to('/dashboard');
		}
        
    }
	
	public function add_saleperson() {
		$data = Agents::whereRaw('id = ?  ', array(Session::get('user_id')))->first()->toArray();
		if(Session::get('user_role_id')==1 || Session::get('user_role_id')==2){
        return view('accounts.salepersons.add', ['title' => 'Add a Sales Representatives']);
		}else {
			return Redirect::to('/dashboard');
		}
        
    }
	
	public function save_saleperson(Request $request) {
        
		if ($request->_token) {
			
			if (filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
					
					$user_dp = Agents::whereRaw('email = ? ', array($request->email))->get()->toArray();
					if (count($user_dp)==0) {
			
						$image_name = '';
						$file = $request->image;
						if($file){
						$ext = $file->getClientOriginalExtension();
						$file = $request->image->getClientOriginalName();
						$image_name = rand(11111,99999).'_'.str_replace(' ','-',strtolower($file));
						$path_uploads = 'public/upload/agents/';
						$request->image->move($path_uploads, $image_name);
						//$resizeObj = new Resize($path_uploads.$image_name);
						//$resizeObj->resizeImage(200, 250, 'auto');
						//$resizeObj->saveImage($path_uploads.'thumbs/'.$image_name, 100);
						}
						
						if(Session::get('user_role_id')==1){
							$user_id = ($request->lead_agent!='')?$request->lead_agent:Session::get('user_id');
						}else {
							$user_id= Session::get('user_id');
						}
						
						
						$model = new Agents();
						$model->parent_agent_id = $user_id;
						$model->role_id = 3;
						
						$model->name = $request->name;
						$model->phone = $request->phone;
						$model->email = $request->email;
						$model->password = Hash::make($request->password);
						if($image_name!="") {
						$model->image = $image_name;
						}
						
						$model->status = 'Yes';
						$model->created_by = Session::get('user_id');
						$model->updated_at = date('Y-m-d H:i:s');
						$model->save();
						return Response::json(array('error_code' => 0, 'status' => 'success', 'message' => 'Account Information has been saved.'));
						
					}else {
						return Response::json(array('error_code' => 1, 'status' => 'fail', 'message' => 'Email already exist'));
					}
					
			}else {
				return Response::json(array('error_code' => 1, 'status' => 'fail', 'message' => 'Invalid Email address'));
			}
        }else {
			return Response::json(array('error_code' => 1, 'status' => 'fail', 'message' => 'Invalid Request'));
		}
        
    }
	
	public function edit_saleperson($id) {
		$result = Agents::whereRaw('md5(id) =? AND role_id=3 ', array($id))->get()->toArray();
		if(count($result)>0){
        	return view('accounts.salepersons.edit', ['result' => $result[0], 'title' => 'Edit Sales Representatives']);
		}else {
			 return Redirect::to('/dashboard');
		}
    }
	
	public function update_saleperson(Request $request) {
        
		if ($request->_token) {
			
			if (filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
					
					$user_dp = Agents::whereRaw('email = ? AND id !=? AND role_id=3 ', array($request->email,$request->id))->get()->toArray();
					if (count($user_dp)==0) {
			
						$image_name = '';
						$file = $request->image;
						if($file){
						$ext = $file->getClientOriginalExtension();
						$file = $request->image->getClientOriginalName();
						$image_name = rand(11111,99999).'_'.str_replace(' ','-',strtolower($file));
						$path_uploads = 'public/upload/agents/';
						$request->image->move($path_uploads, $image_name);
						//$resizeObj = new Resize($path_uploads.$image_name);
						//$resizeObj->resizeImage(200, 250, 'auto');
						//$resizeObj->saveImage($path_uploads.'thumbs/'.$image_name, 100);
						}
						
						if(Session::get('user_role_id')==1){
							$user_id = ($request->lead_agent!='')?$request->lead_agent:Session::get('user_id');
						}else {
							$user_id= Session::get('user_id');
						}
						
						
						$model = Agents::find($request->id);
						$model->parent_agent_id = $user_id;
						
						
						$model->name = $request->name;
						$model->phone = $request->phone;
						$model->email = $request->email;
						if($request->password!=''){
						$model->password = Hash::make($request->password);
						}
						
						
						if($image_name!="") {
						$model->image = $image_name;
						}
						
						$model->status = $request->status;
						$model->created_by = Session::get('user_id');
						$model->updated_at = date('Y-m-d H:i:s');
						$model->save();
						return Response::json(array('error_code' => 0, 'status' => 'success', 'message' => 'Account Information has been saved.'));
						
					}else {
						return Response::json(array('error_code' => 1, 'status' => 'fail', 'message' => 'Email already exist'));
					}
					
			}else {
				return Response::json(array('error_code' => 1, 'status' => 'fail', 'message' => 'Invalid Email address'));
			}
        }else {
			return Response::json(array('error_code' => 1, 'status' => 'fail', 'message' => 'Invalid Request'));
		}
        
    }
	
	public function delete_saleperson(Request $request){
		 if ($request->_token) {
		 	Agents::whereRaw('md5(id) = ? AND role_id=3 ', array($request->id))->delete();
			return Response::json(array('error_code' => 0, 'status' => 'success', 'message' => 'Data has been removed.'));
		 }else {
			return Response::json(array('error_code' => 1, 'status' => 'fail', 'message' => 'invalid request.'));
         }
	}
	
	//---------------------------------------------------------------------------------------
	
	public function agents_list() {
		$data = Agents::whereRaw('id = ?  ', array(Session::get('user_id')))->first()->toArray();
		if(Session::get('user_role_id')==1){
		$result = Agents::whereRaw('agency_id = ?  ', array(Session::get('user_id')))->get();
        return view('accounts.agency.agents.index', ['result' => $result, 'title' => 'Your Agents']);
		}else {
			return Redirect::to('/dashboard');
		}
        
    }
	
	public function add_agent() {
		$data = Agents::whereRaw('id = ?  ', array(Session::get('user_id')))->first()->toArray();
		if(Session::get('user_role_id')==1){
		
        return view('accounts.agency.agents.add', ['title' => 'New Profile']);
		}else {
			return Redirect::to('/dashboard');
		}
        
    }
	
	public function save_agent(Request $request) {
        
		if ($request->_token) {
			
			if (filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
					
					$user_dp = Agents::whereRaw('email = ? ', array($request->email))->get()->toArray();
					if (count($user_dp)==0) {
			
						$image_name = '';
						$file = $request->image;
						if($file){
						$ext = $file->getClientOriginalExtension();
						$file = $request->image->getClientOriginalName();
						$image_name = rand(11111,99999).'_'.str_replace(' ','-',strtolower($file));
						$path_uploads = 'public/upload/agents/';
						$request->image->move($path_uploads, $image_name);
						//$resizeObj = new Resize($path_uploads.$image_name);
						//$resizeObj->resizeImage(200, 250, 'auto');
						//$resizeObj->saveImage($path_uploads.'thumbs/'.$image_name, 100);
						}
						
						$logo_name = '';
						$file_logo = $request->logo;
						if($file_logo){
						$ext = $file_logo->getClientOriginalExtension();
						$file_logo = $request->logo->getClientOriginalName();
						$logo_name = rand(11111,99999).'_'.str_replace(' ','-',strtolower($file_logo));
						$path_uploads = 'public/upload/agents/';
						$request->logo->move($path_uploads, $logo_name);
						}
						
						
						$banner_name = '';
						$file_banner = $request->banner;
						if($file_banner){
						$ext = $file_banner->getClientOriginalExtension();
						$file_banner = $request->banner->getClientOriginalName();
						$banner_name = rand(11111,99999).'_'.str_replace(' ','-',strtolower($file_banner));
						$path_uploads = 'public/upload/agents/';
						$request->banner->move($path_uploads, $banner_name);
						}
						
						$model = new Agents();
						$model->agency_id = Session::get('user_id');
						$model->role_id = 2;
						$model->job_title = $request->job_title;
						$model->name = $request->name;
						$model->phone = $request->phone;
						$model->email = $request->email;
						$model->password = Hash::make($request->password);
						$model->business_phone = $request->business_phone;
						$model->weekly_update = ($request->weekly_update)?$request->weekly_update:0;
						$model->start_year_industry = $request->start_year_industry;
						
						
						$model->video_link = $request->video_link;
						$model->full_contents = $request->full_contents;
						$model->license_number = $request->license_number;
						
						$model->tagline = $request->tagline;
						$model->awards = $request->awards;
						$model->specialities = $request->specialities;
						$model->community_involvement = $request->community_involvement;
						
						$model->fb = $request->fb;
						$model->tw = $request->tw;
						$model->ln = $request->ln;
						$model->tiktok = $request->tiktok;
						$model->instagram = $request->instagram;
						$model->website = $request->website;
						
						
						
						if($image_name!="") {
						$model->image = $image_name;
						}
						if($logo_name!="") {
						$model->logo = $logo_name;
						}
						if($banner_name!="") {
						$model->banner = $banner_name;
						}
						$model->status = 'Yes';
						$model->created_by = Session::get('user_id');
						$model->updated_at = date('Y-m-d H:i:s');
						$model->save();
						return Response::json(array('error_code' => 0, 'status' => 'success', 'message' => 'Account Information has been saved.'));
						
					}else {
						return Response::json(array('error_code' => 1, 'status' => 'fail', 'message' => 'Email already exist'));
					}
					
			}else {
				return Response::json(array('error_code' => 1, 'status' => 'fail', 'message' => 'Invalid Email address'));
			}
        }else {
			return Response::json(array('error_code' => 1, 'status' => 'fail', 'message' => 'Invalid Request'));
		}
        
    }
	
	public function edit_agent($id) {
		$result = Agents::whereRaw('agency_id = ? AND md5(id) =?  ', array(Session::get('user_id'),$id))->get()->toArray();
		if(count($result)>0){
        return view('accounts.agency.agents.edit', ['result' => $result[0], 'title' => 'Edit Profile']);
		}else {
			 return Redirect::to('/dashboard');
		}
    }
	
	public function update_agent(Request $request) {
        
		if ($request->_token) {
			
			if (filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
					
					$user_dp = Agents::whereRaw('email = ? AND id !=? ', array($request->email,$request->id))->get()->toArray();
					if (count($user_dp)==0) {
			
						$image_name = '';
						$file = $request->image;
						if($file){
						$ext = $file->getClientOriginalExtension();
						$file = $request->image->getClientOriginalName();
						$image_name = rand(11111,99999).'_'.str_replace(' ','-',strtolower($file));
						$path_uploads = 'public/upload/agents/';
						$request->image->move($path_uploads, $image_name);
						//$resizeObj = new Resize($path_uploads.$image_name);
						//$resizeObj->resizeImage(200, 250, 'auto');
						//$resizeObj->saveImage($path_uploads.'thumbs/'.$image_name, 100);
						}
						
						$logo_name = '';
						$file_logo = $request->logo;
						if($file_logo){
						$ext = $file_logo->getClientOriginalExtension();
						$file_logo = $request->logo->getClientOriginalName();
						$logo_name = rand(11111,99999).'_'.str_replace(' ','-',strtolower($file_logo));
						$path_uploads = 'public/upload/agents/';
						$request->logo->move($path_uploads, $logo_name);
						}
						
						
						$banner_name = '';
						$file_banner = $request->banner;
						if($file_banner){
						$ext = $file_banner->getClientOriginalExtension();
						$file_banner = $request->banner->getClientOriginalName();
						$banner_name = rand(11111,99999).'_'.str_replace(' ','-',strtolower($file_banner));
						$path_uploads = 'public/upload/agents/';
						$request->banner->move($path_uploads, $banner_name);
						}
						
						
						$model = Agents::find($request->id);
						$model->agency_id = Session::get('user_id');
						
						$model->job_title = $request->job_title;
						$model->name = $request->name;
						$model->phone = $request->phone;
						$model->email = $request->email;
						if($request->password!=''){
						$model->password = Hash::make($request->password);
						}
						$model->business_phone = $request->business_phone;
						$model->weekly_update = ($request->weekly_update)?$request->weekly_update:0;
						$model->start_year_industry = $request->start_year_industry;
						
						
						$model->video_link = $request->video_link;
						$model->full_contents = $request->full_contents;
						$model->license_number = $request->license_number;
						
						$model->tagline = $request->tagline;
						$model->awards = $request->awards;
						$model->specialities = $request->specialities;
						$model->community_involvement = $request->community_involvement;
						
						$model->fb = $request->fb;
						$model->tw = $request->tw;
						$model->ln = $request->ln;
						$model->tiktok = $request->tiktok;
						$model->instagram = $request->instagram;
						$model->website = $request->website;
						
						
						if($image_name!="") {
						$model->image = $image_name;
						}
						if($logo_name!="") {
						$model->logo = $logo_name;
						}
						if($banner_name!="") {
						$model->banner = $banner_name;
						}
						$model->status = $request->status;
						$model->created_by = Session::get('user_id');
						$model->updated_at = date('Y-m-d H:i:s');
						$model->save();
						return Response::json(array('error_code' => 0, 'status' => 'success', 'message' => 'Account Information has been saved.'));
						
					}else {
						return Response::json(array('error_code' => 1, 'status' => 'fail', 'message' => 'Email already exist'));
					}
					
			}else {
				return Response::json(array('error_code' => 1, 'status' => 'fail', 'message' => 'Invalid Email address'));
			}
        }else {
			return Response::json(array('error_code' => 1, 'status' => 'fail', 'message' => 'Invalid Request'));
		}
        
    }
	
	public function delete_agent(Request $request){
		 if ($request->_token) {
		 	Agents::whereRaw('md5(id) = ? AND agency_id = ? ', array($request->id,Session::get('user_id')))->delete();
			return Response::json(array('error_code' => 0, 'status' => 'success', 'message' => 'Data has been removed.'));
		 }else {
			return Response::json(array('error_code' => 1, 'status' => 'fail', 'message' => 'invalid request.'));
         }
	}
	
	public function bookmar_property(Request $request){
		 if ($request->_token) {
		 	$check_res = BookmarkProperty::whereRaw('property_id = ? AND user_id = ? ', array($request->pid,Session::get('user_id')))->count();
			if($check_res==0){
				$model = new BookmarkProperty();
				$model->user_id = Session::get('user_id');
				$model->property_id = $request->pid;
				$model->property_name = $request->title;
				$model->save();
				return Response::json(array('error_code' => 0, 'status' => 'success', 'message' => 'Property has been saved.'));
			}else {
				return Response::json(array('error_code' => 0, 'status' => 'error', 'message' => 'Property already saved.'));
			}
			
			
		 }else {
			return Response::json(array('error_code' => 1, 'status' => 'fail', 'message' => 'invalid request.'));
         }
	}
	
	
	public function logout() {
		Session::put('inbox_hit', 0);
		
		$role_id = Session::get('user_role_id');
		
        Agents::logout();
		if($role_id==4){
        	return Redirect::intended('/login-customer');
		}else{
			return Redirect::intended('/login');
		}
    }
	
}
