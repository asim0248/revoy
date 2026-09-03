<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use View;
use Hash;
use App\Model\Contactus;
use Session;
use Redirect;
use Response;

class ContactController extends Controller {
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
		$result_dp = Contactus::get()->toArray();
        return view('admin.contact.index', ['title' => 'Contact Us','result_dp'=>$result_dp]);
    }

    
	
	/*
      |--------------------------------------------------------------------------
      | Delete Record
      |--------------------------------------------------------------------------
     */

    public function delete($id) {
		
		//Customercards::whereRaw('md5(user_id) = ? ', array($id))->delete();
        Contactus::whereRaw('md5(id) = ? ', array($id))->delete();
        return Redirect::to('/admin/contact');
    }
	
	public function multidelete(Request $request) {
		$array_ids = $request->ids;
		if(count($array_ids)>0){
			foreach ($array_ids as $id){
				Contactus::whereRaw('id = ? ', array($id))->delete();
			}
		}
        
        return Redirect::to('/admin/contact');
    }
	
	 public function status(Request $request) {

        if ($request->_token) {
			 $model = Contactus::find($request->id);
            if ($model->status == 'Yes') {
                $set_status = 'No';
                $html = '<a style="text-decoration:none;" href="javascript:void(0)" onclick="change_status(' . $request->id . ',\'contact/status\')" ><span  class="label label-default" data-title="No"  ><i class="fa fa-ban"></i> No</span></a>';
            } else {
                $set_status = 'Yes';
                $html = '<a style="text-decoration:none;" href="javascript:void(0)" onclick="change_status(' . $request->id . ',\'contact/status\')" ><span  class="label label-success " data-title="Yes"  ><i class="fa fa-check"></i> Yes</span></a>';
            }
            $model->status = $set_status;
            $model->save();
            return Response::json(array('error_code' => 0, 'status' => 'success', 'html' => $html));
        } else {
            return Response::json(array('error_code' => 1, 'status' => 'fail', 'message' => 'Invalid Access'));
        }
    }
	

    

}
