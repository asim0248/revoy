<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use View;
use Hash;
use App\Model\States;
use App\Model\Category;
use App\Model\Common;
use Session;
use Redirect;
use Response;

class StatesController extends Controller {
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
		$result_dp = States::get()->toArray();
        return view('admin.states.index', ['title' => 'States','result_dp'=>$result_dp]);
    }

    /*
      |--------------------------------------------------------------------------
      | Service Add
      |--------------------------------------------------------------------------
     */

    public function create() {
		
       return view('admin.states.add', ['title' => 'Add States']);
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
			$path_uploads = 'public/upload/states/';
			$request->image->move($path_uploads, $image_name);
			}
			
			$icon_2 = '';
			$file_icon_2 = $request->icon_2;
			if($file_icon_2){
			$ext = $file_icon_2->getClientOriginalExtension();
			$file_icon_2 = $request->icon_2->getClientOriginalName();
			$file_icon_2 = rand(11111,99999).'_'.str_replace(' ','-',strtolower($file_icon_2));// uniqid() . '.' . $ext;
			$path_uploads = 'public/upload/states/';
			$request->icon_2->move($path_uploads, $file_icon_2);
			}
			
			$image_banner = '';
			$file_banner = $request->banner;
			if($file_banner){
			$ext = $file_banner->getClientOriginalExtension();
			$file_banner = $request->banner->getClientOriginalName();
			$image_banner = rand(11111,99999).'_'.str_replace(' ','-',strtolower($file_banner)); //uniqid() . '.' . $ext;
			$path_uploads = 'public/upload/states/';
			$request->banner->move($path_uploads, $image_banner);
			}
			
			$model = new States();
			
            $model->name = $request->name;
			$model->slug = Common::slug($request->name);
			$model->heading = $request->heading;
			$model->image = $image_name;
			$model->image_2 =  $file_icon_2 ;
			$model->banner = $image_banner;
			$model->sort_order = $request->sort_order;
			$model->detail = $request->detail;
			$model->full_contents = $request->contents;
			$model->meta_title = $request->meta_title;
			$model->meta_keyword = $request->meta_keyword;
			$model->meta_description = $request->meta_description;
            $model->save();
			
			return Redirect::to('/admin/states');
			
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

        States::whereRaw('md5(id) = ? ', array($id))->delete();
        return Redirect::to('/admin/states');
    }

    /*
      |--------------------------------------------------------------------------
      | Edit Record
      |--------------------------------------------------------------------------
     */

    public function edit($id) {

        $data = States::whereRaw('md5(id) = ?  ', array($id))->get()->toArray();
		
        return view('admin.states.edit', ['title' => 'Edit States','data' => $data[0]]);
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
			$path_uploads = 'public/upload/states/';
			$request->image->move($path_uploads, $image_name);
			}
			
			$icon_2 = '';
			$file_icon_2 = $request->icon_2;
			if($file_icon_2){
			$ext = $file_icon_2->getClientOriginalExtension();
			$file_icon_2 = $request->icon_2->getClientOriginalName();
			$file_icon_2 = rand(11111,99999).'_'.str_replace(' ','-',strtolower($file_icon_2));// uniqid() . '.' . $ext;
			$path_uploads = 'public/upload/states/';
			$request->icon_2->move($path_uploads, $file_icon_2);
			}
			
			$image_banner = '';
			$file_banner = $request->banner;
			if($file_banner){
			$ext = $file_banner->getClientOriginalExtension();
			$file_banner = $request->banner->getClientOriginalName();
			$image_banner = rand(11111,99999).'_'.str_replace(' ','-',strtolower($file_banner)); //uniqid() . '.' . $ext;
			$path_uploads = 'public/upload/states/';
			$request->banner->move($path_uploads, $image_banner);
			}
			
			
            $model = States::find($request->id);
			
            $model->name = $request->name;
			$model->slug = Common::slug($request->name);
			if($image_name!=""){
			$model->image = $image_name;
			}
			
			if($image_banner!=""){
			$model->banner = $image_banner;
			}
			
			if($file_icon_2!=""){
			$model->image_2 =  $file_icon_2;
			}
			$model->heading = $request->heading;
			$model->sort_order = $request->sort_order;
			$model->detail = $request->detail;
			$model->full_contents = $request->contents;
			$model->meta_title = $request->meta_title;
			$model->meta_keyword = $request->meta_keyword;
			$model->meta_description = $request->meta_description;
            $model->save();
			return Redirect::to('/admin/states');
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
			 $model = States::find($request->id);
            if ($model->status == 'Yes') {
                $set_status = 'No';
                $html = '<a style="text-decoration:none;" href="javascript:void(0)" onclick="change_status(' . $request->id . ',\'states/status\')" ><span  class="label label-default" data-title="Inctive"  ><i class="fa fa-ban"></i> Inctive</span></a>';
            } else {
                $set_status = 'Yes';
                $html = '<a style="text-decoration:none;" href="javascript:void(0)" onclick="change_status(' . $request->id . ',\'states/status\')" ><span  class="label label-success " data-title="Active"  ><i class="fa fa-check"></i> Active</span></a>';
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
			 $model = States::find($request->id);
            if ($model->is_featured == 'Yes') {
                $set_status = 'No';
                $html = '<a style="text-decoration:none;" href="javascript:void(0)" onclick="change_status_header(' . $request->id . ',\'states/statusfeatured\')" ><span  class="label label-default" data-title="No"  ><i class="fa fa-ban"></i> No</span></a>';
            } else {
                $set_status = 'Yes';
                $html = '<a style="text-decoration:none;" href="javascript:void(0)" onclick="change_status_header(' . $request->id . ',\'states/statusfeatured\')" ><span  class="label label-success " data-title="Yes"  ><i class="fa fa-check"></i> Yes</span></a>';
            }
            $model->is_featured = $set_status;
            $model->save();
            return Response::json(array('error_code' => 0, 'status' => 'success', 'html' => $html));
        } else {
            return Response::json(array('error_code' => 1, 'status' => 'fail', 'message' => 'Invalid Access'));
        }
    }
	
	
	

}
