<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use View;
use Hash;
use App\Model\Locations;
use App\Model\Common;
use Session;
use Redirect;
use Response;
use URL;
class LocationsController extends Controller {
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
		$result_dp = Locations::get()->toArray();
        return view('admin.locations.index', ['title' => 'Location','result_dp'=>$result_dp]);
    }

    /*
      |--------------------------------------------------------------------------
      | Page Add
      |--------------------------------------------------------------------------
     */

    public function create() {
		
       return view('admin.locations.add', ['title' => 'Add Location']);
    }

    /*
      |--------------------------------------------------------------------------
      | Admin Login Auth
      |--------------------------------------------------------------------------
     */

    public function create_save(Request $request) {
        if ($request->_token) {
			
			
			
            $model = new Locations();
			
            $model->name = $request->name;
			$model->slug = Common::slug($request->name);
			$model->sort_order = $request->sort_order;
			$model->address = $request->address;
			$model->phone = $request->phone;
			$model->email = $request->email;
			
			$model->status = 'Yes';
			
			$model->save();
           // return Response::json(array('error_code' => 0, 'status' => 'success', 'message' => ''));
		   return Redirect::to('/admin/locations');
        } else {
            return Response::json(array('error_code' => 1, 'status' => 'fail', 'message' => 'Invalid Access'));
        }
    }
	
	/*
      |--------------------------------------------------------------------------
      | Delete Record
      |--------------------------------------------------------------------------
     */

    public function delete($id) {

        Locations::whereRaw('md5(id) = ? ', array($id))->delete();
        return Redirect::to('/admin/locations');
    }

    /*
      |--------------------------------------------------------------------------
      | Edit Record
      |--------------------------------------------------------------------------
     */

    public function edit($id) {

        $data = Locations::whereRaw('md5(id) = ?  ', array($id))->get()->toArray();
        return view('admin.locations.edit', ['title' => 'Edit Location','data' => $data[0]]);
    }

    /*
      |--------------------------------------------------------------------------
      | Edit Record
      |--------------------------------------------------------------------------
     */

   public function edit_save(Request $request) {

        if ($request->_token) {
			
			
			
			
			$model = Locations::find($request->id);			
            
			$model->name = $request->name;
			$model->slug = Common::slug($request->name);
			$model->sort_order = $request->sort_order;
			$model->address = $request->address;
			$model->phone = $request->phone;
			$model->email = $request->email;
            $model->save();
			return Redirect::to('/admin/locations');
           // return Response::json(array('error_code' => 0, 'status' => 'success', 'message' => ''));
        } else {
            return Response::json(array('error_code' => 1, 'status' => 'fail', 'message' => 'Invalid Access'));
        }
    }
	
	/*
      |--------------------------------------------------------------------------
      | Change Record Status
      |--------------------------------------------------------------------------
     */

    public function status(Request $request) {

        if ($request->_token) {
			 $model = Locations::find($request->id);
            if ($model->status == 'Yes') {
                $set_status = 'No';
                $html = '<a style="text-decoration:none;" href="javascript:void(0)" onclick="change_status(' . $request->id . ',\''.url('/').'/admin/locations/status\')" ><span  class="label label-default" data-title="Inctive"  ><i class="fa fa-ban"></i> Inctive</span></a>';
            } else {
                $set_status = 'Yes';
                $html = '<a style="text-decoration:none;" href="javascript:void(0)" onclick="change_status(' . $request->id . ',\''.url('/').'/admin/locations/status\')" ><span  class="label label-success " data-title="Active"  ><i class="fa fa-check"></i> Active</span></a>';
            }
            $model->status = $set_status;
            $model->save();
            return Response::json(array('error_code' => 0, 'status' => 'success', 'html' => $html));
        } else {
            return Response::json(array('error_code' => 1, 'status' => 'fail', 'message' => 'Invalid Access'));
        }
    }
	
	
	
   
	

}
