<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use View;
use Hash;
use App\Model\Banners;
use App\Model\Common;
use Session;
use Redirect;
use Response;

class BannersController extends Controller {
    
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
      | View All.
      |--------------------------------------------------------------------------
     */

    public function index() {
		$result_dp = Banners::get()->toArray();
		
        return view('admin.banners.index', ['title' => 'Banners','result_dp'=>$result_dp]);
    }

    /*
      |--------------------------------------------------------------------------
      |  Add
      |--------------------------------------------------------------------------
     */

    public function create() {
		
       return view('admin.banners.add', ['title' => 'Add Banner']);
    }

    /*
      |--------------------------------------------------------------------------
      | POST Add
      |--------------------------------------------------------------------------
     */

    public function create_save(Request $request) {
		
         if ($request->_token) {
			
			$image_name = '';
			$file = $request->image;
			if($file){
			$ext = $file->getClientOriginalExtension();
			$file = $request->image->getClientOriginalName();
			$image_name = uniqid() . '.' . $ext; //str_replace(' ','-',strtolower($file));//
			$path_uploads = 'public/upload/banners/';
			$request->image->move($path_uploads, $image_name);
			}
			
			
			
			$model = new banners();
			$model->banner_type = $request->banner_type;
			$model->name = $request->name;
			$model->tag_line = $request->tag_line;
			$model->sub_title = $request->sub_title;
      		$model->detail = $request->detail;
			$model->button_text = $request->button_text;
			$model->link = $request->link;
			$model->button_text_2 = $request->button_text_2;
			$model->link_2 = $request->link_2;
			$model->image = $image_name;
			$model->sort_order = $request->sort_order;
			$model->status = 'Yes';
			$model->save();
           return Redirect::to('/admin/banners');
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

        Banners::whereRaw('md5(id) = ? ', array($id))->delete();
        return Redirect::to('/admin/banners');
    }

    /*
      |--------------------------------------------------------------------------
      | Edit Record
      |--------------------------------------------------------------------------
     */

    public function edit($id) {

        $data = Banners::whereRaw('md5(id) = ?  ', array($id))->get()->toArray();
        return view('admin.banners.edit', ['title' => 'Edit Banner','data' => $data[0]]);
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
			$image_name = uniqid() . '.' . $ext; // str_replace(' ','-',strtolower($file)); //
			$path_uploads = 'public/upload/banners/';
			$request->image->move($path_uploads, $image_name);
			}
			
			
			$model = Banners::find($request->id);
			$model->banner_type = $request->banner_type;
			$model->tag_line = $request->tag_line;
			$model->name = $request->name;
			$model->sub_title = $request->sub_title;
      		$model->detail = $request->detail;
			$model->button_text = $request->button_text;
			$model->link = $request->link;
			$model->button_text_2 = $request->button_text_2;
			$model->link_2 = $request->link_2;
			
			if($image_name!=""){
			$model->image = $image_name;
			}
			
			$model->sort_order = $request->sort_order;
			$model->save();
			return Redirect::to('/admin/banners');
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
			 $model = Banners::find($request->id);
            if ($model->status == 'Yes') {
                $set_status = 'No';
                $html = '<a style="text-decoration:none;" href="javascript:void(0)" onclick="change_status(' . $request->id . ',\'banners/status\')" ><span  class="label label-default" data-title="Inctive"  ><i class="fa fa-ban"></i> Inctive</span></a>';
            } else {
                $set_status = 'Yes';
                $html = '<a style="text-decoration:none;" href="javascript:void(0)" onclick="change_status(' . $request->id . ',\'banners/status\')" ><span  class="label label-success " data-title="Active"  ><i class="fa fa-check"></i> Active</span></a>';
            }
            $model->status = $set_status;
            $model->save();
            return Response::json(array('error_code' => 0, 'status' => 'success', 'html' => $html));
        } else {
            return Response::json(array('error_code' => 1, 'status' => 'fail', 'message' => 'Invalid Access'));
        }
    }
	
	
	
	

}
