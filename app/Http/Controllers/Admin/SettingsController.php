<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use View;
use Hash;
use App\Model\Setting;
use App\Model\EmailSetting;
use Session;
use Redirect;
use Response;
class SettingsController extends Controller {
    /*
      |--------------------------------------------------------------------------
      | Site Settings Controller
      |--------------------------------------------------------------------------

     */

    /*
      |--------------------------------------------------------------------------
      | Create a new controller instance.
      |--------------------------------------------------------------------------
      @return void
     */

    public function __construct() {
        $this->middleware('AdminAuth');
        
    }

    /*
      |--------------------------------------------------------------------------
      | View Site Settings.
      |--------------------------------------------------------------------------
     */

    public function index() {
        return view('admin.settings.index', ['title' => 'Settings']);
    }

    /*
      |--------------------------------------------------------------------------
      | Post Site Settings.
      |--------------------------------------------------------------------------
     */

    public function update_setting(Request $request) {
        if ($request->_token) {
			$array_settings = $request->setting;
			foreach ($array_settings as $key => $val) {
				$model = Setting::firstOrNew(array('key_name' => $key));
				$model->key_value = $val;
				$model->save();
			}
			
			return Response::json(array('error_code' => 0, 'status' => 'success', 'message' => 'Data has been updated.'));
  
        }
    }
	
	public function email($id) {
		
		$data = EmailSetting::whereRaw('md5(id) = ?  ', array($id))->get()->toArray();
        return view('admin.settings.email', ['title' => 'Edit Email','data' => $data[0]]);
        
    }
	
	public function emaillist() {
		$result_dp = EmailSetting::get()->toArray();
        return view('admin.settings.email_list', ['title' => 'Email','result_dp'=>$result_dp]);
    }
	
	public function update_setting_email(Request $request) {
        if ($request->_token) {
				
				$model = EmailSetting::find($request->id);	
				
				$model->key_value = $request->contents;
				$model->save();
			return Redirect::to('/admin/emailsettings/emaillist');
			
			return Response::json(array('error_code' => 0, 'status' => 'success', 'message' => 'Data has been updated..'));
  
        }
    }

}
