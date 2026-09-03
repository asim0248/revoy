<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use View;
use Hash;
use App\Model\Valuationprovider;
use App\Model\Common;
use Session;
use Redirect;
use Response;
use URL;
class ValuationproviderController extends Controller {
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
		$result_dp = Valuationprovider::get()->toArray();
        return view('admin.valuationprovider.index', ['title' => 'Valuation Provider','result_dp'=>$result_dp]);
    }

    /*
      |--------------------------------------------------------------------------
      | Page Add
      |--------------------------------------------------------------------------
     */

    public function create() {
		
       return view('admin.valuationprovider.add', ['title' => 'Add Valuation Provider']);
    }

    /*
      |--------------------------------------------------------------------------
      | Admin Login Auth
      |--------------------------------------------------------------------------
     */

    public function create_save(Request $request) {
        if ($request->_token) {
			
			$image_name = '';
			$file = $request->image;
			if($file){
			$ext = $file->getClientOriginalExtension();
			$file = $request->image->getClientOriginalName();
			$image_name = rand(11111,99999).'_'.str_replace(' ','-',strtolower($file));// uniqid() . '.' . $ext;
			$path_uploads = 'public/upload/valuationprovider/';
			$request->image->move($path_uploads, $image_name);
			}
			
            $model = new Valuationprovider();
			
            $model->name = $request->name;
			$model->counter = $request->counter;
			$model->slug = $request->slug;
			$model->image = $image_name;
			$model->sort_order = $request->sort_order;
			$model->status = 'Yes';
			
			$model->save();
           // return Response::json(array('error_code' => 0, 'status' => 'success', 'message' => ''));
		   return Redirect::to('/admin/valuationprovider');
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

        Valuationprovider::whereRaw('md5(id) = ? ', array($id))->delete();
        return Redirect::to('/admin/valuationprovider');
    }

    /*
      |--------------------------------------------------------------------------
      | Edit Record
      |--------------------------------------------------------------------------
     */

    public function edit($id) {

        $data = Valuationprovider::whereRaw('md5(id) = ?  ', array($id))->get()->toArray();
        return view('admin.valuationprovider.edit', ['title' => 'Edit Valuation Provider','data' => $data[0]]);
    }

    /*
      |--------------------------------------------------------------------------
      | Edit Record
      |--------------------------------------------------------------------------
     */

   public function edit_save(Request $request) {

        if ($request->_token) {
			
			$image_name = '';
			$file = $request->image;
			if($file){
			$ext = $file->getClientOriginalExtension();
			$file = $request->image->getClientOriginalName();
			$image_name = rand(11111,99999).'_'.str_replace(' ','-',strtolower($file));// uniqid() . '.' . $ext;
			$path_uploads = 'public/upload/valuationprovider/';
			$request->image->move($path_uploads, $image_name);
			}
			
			
			
			$model = Valuationprovider::find($request->id);			
            
			$model->name = $request->name;
			
			$model->slug = $request->slug;
			$model->counter = $request->counter;
			if($image_name!=''){
			$model->image = $image_name;
			}
			$model->sort_order = $request->sort_order;
			
            $model->save();
			return Redirect::to('/admin/valuationprovider');
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
			 $model = Valuationprovider::find($request->id);
            if ($model->status == 'Yes') {
                $set_status = 'No';
                $html = '<a style="text-decoration:none;" href="javascript:void(0)" onclick="change_status(' . $request->id . ',\''.url('/').'/admin/valuationprovider/status\')" ><span  class="label label-default" data-title="Inctive"  ><i class="fa fa-ban"></i> Inctive</span></a>';
            } else {
                $set_status = 'Yes';
                $html = '<a style="text-decoration:none;" href="javascript:void(0)" onclick="change_status(' . $request->id . ',\''.url('/').'/admin/valuationprovider/status\')" ><span  class="label label-success " data-title="Active"  ><i class="fa fa-check"></i> Active</span></a>';
            }
            $model->status = $set_status;
            $model->save();
            return Response::json(array('error_code' => 0, 'status' => 'success', 'html' => $html));
        } else {
            return Response::json(array('error_code' => 1, 'status' => 'fail', 'message' => 'Invalid Access'));
        }
    }
	
	
	
	
	
   
	

}
