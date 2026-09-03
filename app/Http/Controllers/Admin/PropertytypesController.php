<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use View;
use Hash;
use App\Model\Propertytypes;
use App\Model\Common;
use Session;
use Redirect;
use Response;
use URL;
class PropertytypesController extends Controller {
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
		$result_dp = Propertytypes::get()->toArray();
        return view('admin.propertytypes.index', ['title' => 'Property Types','result_dp'=>$result_dp]);
    }

    /*
      |--------------------------------------------------------------------------
      | Page Add
      |--------------------------------------------------------------------------
     */

    public function create() {
		
       return view('admin.propertytypes.add', ['title' => 'Add Property Types']);
    }

    /*
      |--------------------------------------------------------------------------
      | Admin Login Auth
      |--------------------------------------------------------------------------
     */

    public function create_save(Request $request) {
        if ($request->_token) {
			
			
			
            $model = new Propertytypes();
			
            $model->name = $request->name;
			$model->slug = Common::slug($request->name);
			$model->sort_order = $request->sort_order;
			$model->status = 'Yes';
			$model->property_options = (is_array($request->property_options) && count($request->property_options)>0)?implode(',',$request->property_options):'';
			$model->save();
           // return Response::json(array('error_code' => 0, 'status' => 'success', 'message' => ''));
		   return Redirect::to('/admin/propertytypes');
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

        Propertytypes::whereRaw('md5(id) = ? ', array($id))->delete();
        return Redirect::to('/admin/propertytypes');
    }

    /*
      |--------------------------------------------------------------------------
      | Edit Record
      |--------------------------------------------------------------------------
     */

    public function edit($id) {

        $data = Propertytypes::whereRaw('md5(id) = ?  ', array($id))->get()->toArray();
        return view('admin.propertytypes.edit', ['title' => 'Edit Property Types','data' => $data[0]]);
    }

    /*
      |--------------------------------------------------------------------------
      | Edit Record
      |--------------------------------------------------------------------------
     */

   public function edit_save(Request $request) {

        if ($request->_token) {
			
			
			
			
			$model = Propertytypes::find($request->id);			
            
			$model->name = $request->name;
			$model->slug = Common::slug($request->name);
			$model->sort_order = $request->sort_order;
			$model->property_options = (is_array($request->property_options) && count($request->property_options)>0)?implode(',',$request->property_options):'';
            $model->save();
			return Redirect::to('/admin/propertytypes');
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
			 $model = Propertytypes::find($request->id);
            if ($model->status == 'Yes') {
                $set_status = 'No';
                $html = '<a style="text-decoration:none;" href="javascript:void(0)" onclick="change_status(' . $request->id . ',\''.url('/').'/admin/propertytypes/status\')" ><span  class="label label-default" data-title="Inctive"  ><i class="fa fa-ban"></i> Inctive</span></a>';
            } else {
                $set_status = 'Yes';
                $html = '<a style="text-decoration:none;" href="javascript:void(0)" onclick="change_status(' . $request->id . ',\''.url('/').'/admin/propertytypes/status\')" ><span  class="label label-success " data-title="Active"  ><i class="fa fa-check"></i> Active</span></a>';
            }
            $model->status = $set_status;
            $model->save();
            return Response::json(array('error_code' => 0, 'status' => 'success', 'html' => $html));
        } else {
            return Response::json(array('error_code' => 1, 'status' => 'fail', 'message' => 'Invalid Access'));
        }
    }
	
	
	
   
	

}
