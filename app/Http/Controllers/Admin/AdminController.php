<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Model\Admins;
use Session;
use Hash;
use Redirect;
use Response;
class AdminController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Admin Controller
    |--------------------------------------------------------------------------
    
    */

   
    
    public function __construct()
    {
        //$this->middleware('guest')->except('logout');
		 $this->middleware('AdminAuth', ['except' => ['index','login', 'forgotpassword']]);
    }
	
	
	/*
      |--------------------------------------------------------------------------
      | Admin Auth.
      |--------------------------------------------------------------------------
     */
	
	public function index(){
		return view('admin.login',['title'=>'Login']);
	}
	
	/*
      |--------------------------------------------------------------------------
      | Admin Auth.
      |--------------------------------------------------------------------------
     */

    public function login(Request $request) {
		$admin = Admins::whereRaw('email = ? ', array($request->email))->get()->toArray();
		
		if (!empty($admin) && $admin[0]['status'] == 'Yes') {
            if (Hash::check($request->password, $admin[0]['password'])) {
                Session::put('admin_id', $admin[0]['id']);
                Session::put('admin_name', $admin[0]['name']);
				Session::put('admin_role_id', $admin[0]['role_id']);
				Session::put('role_id', $admin[0]['role_id']);
                session_start();
				$_SESSION['admin_check'] = '123';
                 return Response::json(array('error_code' => 0, 'status' => 'success', 'message' => ''));
            } else {
                 return Response::json(array('error_code' => 1, 'status' => 'fail', 'message' => 'Invalid login information'));
            }
        } else {
            return Response::json(array('error_code' => 1, 'status' => 'fail', 'message' => 'Invalid login information'));
        }
    }
	
	/*
      |--------------------------------------------------------------------------
      | Admin Dashboard.
      |--------------------------------------------------------------------------
     */

    public function dashboard() {
        return view('admin.home', ['title' => 'Dashboard']);
    }
	
	/*
      |--------------------------------------------------------------------------
      | Admin Profile.
      |--------------------------------------------------------------------------
     */

    public function profile() {
        $data = Admins::whereRaw('id = ?  ', array(Session::get('admin_id')))->first()->toArray();
        return view('admin.profile', ['data' => $data, 'title' => 'My Profile']);
    }
	
	
	/*
      |--------------------------------------------------------------------------
      | Admin Profile.
      |--------------------------------------------------------------------------
     */

    public function update_profile(Request $request) {
        $model = Admins::find(Session::get('admin_id'));
		if ($request->_token) {
			
            $model->name = $request->name;
            $model->email = $request->email;
			if($request->password!="") {
            	$model->password = Hash::make($request->password);
			}
            
            $model->save();
			return Response::json(array('error_code' => 0, 'status' => 'success', 'message' => 'Account Information has been updated.'));
        }
        
    }

    /*
      |--------------------------------------------------------------------------
      | Admin Logout.
      |--------------------------------------------------------------------------
     */

    public function logout() {
        Admins::logout();
        return Redirect::intended('/admin');
    }
    
     /*
      |--------------------------------------------------------------------------
      | Sum of Hours.
      |--------------------------------------------------------------------------
     */
	
	
}
