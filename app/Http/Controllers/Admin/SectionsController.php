<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use View;
use Hash;
use App\Model\Sections;
use App\Model\Category;
use App\Model\Common;
use Session;
use Redirect;
use Response;

class SectionsController extends Controller {
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
		$result_dp = Sections::get()->toArray();
        return view('admin.sections.index', ['title' => 'Sections','result_dp'=>$result_dp]);
    }

    /*
      |--------------------------------------------------------------------------
      | Service Add
      |--------------------------------------------------------------------------
     */

    public function create() {
		
       return view('admin.sections.add', ['title' => 'Add Sections']);
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
			$path_uploads = 'public/upload/sections/';
			$request->image->move($path_uploads, $image_name);
			}
			
			$image_name_2 = '';
			$file_2 = $request->image_2;
			if($file_2){
			$ext = $file_2->getClientOriginalExtension();
			$file_2 = $request->image_2->getClientOriginalName();
			$image_name_2 = rand(11111,99999).'_'.str_replace(' ','-',strtolower($file_2));// uniqid() . '.' . $ext;
			$path_uploads = 'public/upload/sections/';
			$request->image_2->move($path_uploads, $image_name_2);
			}
			
			$model = new Sections();
			
			$model->name = $request->name;
			$model->heading = $request->heading;
			$model->image = $image_name;
			$model->image_2 = $image_name_2;
			$model->slug = Common::slug($request->name);
			$model->listing_ids = (is_array($request->product_ids) && count($request->product_ids)>0)?implode(',',$request->product_ids):'';
			$model->sort_order = $request->sort_order;
			$model->detail = $request->detail;
            $model->save();
			
			return Redirect::to('/admin/sections');
			
            return Response::json(array('error_code' => 0, 'status' => 'success', 'message' => ''));
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

        Sections::whereRaw('md5(id) = ? ', array($id))->delete();
        return Redirect::to('/admin/sections');
    }

    /*
      |--------------------------------------------------------------------------
      | Edit Record
      |--------------------------------------------------------------------------
     */

    public function edit($id) {

        $data = Sections::whereRaw('md5(id) = ?  ', array($id))->get()->toArray();
		
        return view('admin.sections.edit', ['title' => 'Edit Sections','data' => $data[0]]);
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
			$path_uploads = 'public/upload/sections/';
			$request->image->move($path_uploads, $image_name);
			}
			
			$image_name_2 = '';
			$file_2 = $request->image_2;
			if($file_2){
			$ext = $file_2->getClientOriginalExtension();
			$file_2 = $request->image_2->getClientOriginalName();
			$image_name_2 = rand(11111,99999).'_'.str_replace(' ','-',strtolower($file_2));// uniqid() . '.' . $ext;
			$path_uploads = 'public/upload/sections/';
			$request->image_2->move($path_uploads, $image_name_2);
			}
			
            $model = Sections::find($request->id);
			$model->name =$request->name;
			$model->heading = $request->heading;
			if($image_name!=""){
			$model->image = $image_name;
			}
			
			if($image_name_2!=""){
			$model->image_2 = $image_name_2;
			}
			
			$model->slug = Common::slug($request->name);
			$model->listing_ids = (is_array($request->product_ids) && count($request->product_ids)>0)?implode(',',$request->product_ids):'';
			
			
			$model->sort_order = $request->sort_order;
			$model->detail = $request->detail;
            $model->save();
			return Redirect::to('/admin/sections');
            return Response::json(array('error_code' => 0, 'status' => 'success', 'message' => ''));
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
			 $model = Sections::find($request->id);
            if ($model->status == 'Yes') {
                $set_status = 'No';
                $html = '<a style="text-decoration:none;" href="javascript:void(0)" onclick="change_status(' . $request->id . ',\'sections/status\')" ><span  class="label label-default" data-title="Inctive"  ><i class="fa fa-ban"></i> Inctive</span></a>';
            } else {
                $set_status = 'Yes';
                $html = '<a style="text-decoration:none;" href="javascript:void(0)" onclick="change_status(' . $request->id . ',\'sections/status\')" ><span  class="label label-success " data-title="Active"  ><i class="fa fa-check"></i> Active</span></a>';
            }
            $model->status = $set_status;
            $model->save();
            return Response::json(array('error_code' => 0, 'status' => 'success', 'html' => $html));
        } else {
            return Response::json(array('error_code' => 1, 'status' => 'fail', 'message' => 'Invalid Access'));
        }
    }
	
	
	public function statusfeatured(Request $request) {

        if ($request->_token) {
			 $model = Sections::find($request->id);
            if ($model->is_featured == 'Yes') {
                $set_status = 'No';
                $html = '<a style="text-decoration:none;" href="javascript:void(0)" onclick="change_status_header(' . $request->id . ',\'sections/statusfeatured\')" ><span  class="label label-default" data-title="No"  ><i class="fa fa-ban"></i> No</span></a>';
            } else {
                $set_status = 'Yes';
                $html = '<a style="text-decoration:none;" href="javascript:void(0)" onclick="change_status_header(' . $request->id . ',\'sections/statusfeatured\')" ><span  class="label label-success " data-title="Yes"  ><i class="fa fa-check"></i> Yes</span></a>';
            }
            $model->is_featured = $set_status;
            $model->save();
            return Response::json(array('error_code' => 0, 'status' => 'success', 'html' => $html));
        } else {
            return Response::json(array('error_code' => 1, 'status' => 'fail', 'message' => 'Invalid Access'));
        }
    }
	
	
	

}
