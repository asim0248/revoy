<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use View;
use Hash;
use App\Model\Videocategory;
use App\Model\Common;
use Session;
use Redirect;
use Response;
use URL;
class VideocategoryController extends Controller {
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
		$result_dp = Videocategory::get()->toArray();
        return view('admin.videocategory.index', ['title' => 'Video Category','result_dp'=>$result_dp]);
    }

    /*
      |--------------------------------------------------------------------------
      | Page Add
      |--------------------------------------------------------------------------
     */

    public function create() {
		
       return view('admin.videocategory.add', ['title' => 'Add Video Category']);
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
			$path_uploads = 'public/upload/videocategory/';
			$request->image->move($path_uploads, $image_name);
			}
			
			$image_name_2 = '';
			$file_2 = $request->banner;
			if($file_2){
			$ext = $file_2->getClientOriginalExtension();
			$file_2 = $request->banner->getClientOriginalName();
			$image_name_2 = rand(11111,99999).'_'.str_replace(' ','-',strtolower($file_2)); //uniqid() . '.' . $ext;
			$path_uploads = 'public/upload/videocategory/';
			$request->banner->move($path_uploads, $image_name_2);
			}
			
            $model = new Videocategory();
			$model->pid = $request->pid;
            $model->name = $request->name;
			$model->heading = $request->heading;
			$model->icon = $request->icon;
			$model->slug = Common::slug($request->name);
			$model->sort_order = $request->sort_order;
			$model->status = 'Yes';
			$model->image = $image_name;
			$model->banner = $image_name_2;
			$model->detail = $request->detail;
			$model->FullContents = $request->contents;
			$model->save();
           // return Response::json(array('error_code' => 0, 'status' => 'success', 'message' => ''));
		   return Redirect::to('/admin/videocategory');
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

        Videocategory::whereRaw('md5(id) = ? ', array($id))->delete();
        return Redirect::to('/admin/videocategory');
    }

    /*
      |--------------------------------------------------------------------------
      | Edit Record
      |--------------------------------------------------------------------------
     */

    public function edit($id) {

        $data = Videocategory::whereRaw('md5(id) = ?  ', array($id))->get()->toArray();
        return view('admin.videocategory.edit', ['title' => 'Edit Video Category','data' => $data[0]]);
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
			$path_uploads = 'public/upload/videocategory/';
			$request->image->move($path_uploads, $image_name);
			}
			
			$image_name_2 = '';
			$file_2 = $request->banner;
			if($file_2){
			$ext = $file_2->getClientOriginalExtension();
			$file_2 = $request->banner->getClientOriginalName();
			$image_name_2 = rand(11111,99999).'_'.str_replace(' ','-',strtolower($file_2)); //uniqid() . '.' . $ext;
			$path_uploads = 'public/upload/videocategory/';
			$request->banner->move($path_uploads, $image_name_2);
			}
			
			
			$model = Videocategory::find($request->id);			
            $model->pid = $request->pid;
			$model->name = $request->name;
			$model->heading = $request->heading;
			$model->icon = $request->icon;
			$model->slug = Common::slug($request->name);
			$model->sort_order = $request->sort_order;
			$model->detail = $request->detail;
			$model->FullContents = $request->contents;
			if($image_name!=""){
			$model->image = $image_name;
			}
			if($image_name_2!=""){
			$model->banner = $image_name_2;
			}
            $model->save();
			return Redirect::to('/admin/videocategory');
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
			 $model = Videocategory::find($request->id);
            if ($model->status == 'Yes') {
                $set_status = 'No';
                $html = '<a style="text-decoration:none;" href="javascript:void(0)" onclick="change_status(' . $request->id . ',\''.url('/').'/admin/videocategory/status\')" ><span  class="label label-default" data-title="Inctive"  ><i class="fa fa-ban"></i> Inctive</span></a>';
            } else {
                $set_status = 'Yes';
                $html = '<a style="text-decoration:none;" href="javascript:void(0)" onclick="change_status(' . $request->id . ',\''.url('/').'/admin/videocategory/status\')" ><span  class="label label-success " data-title="Active"  ><i class="fa fa-check"></i> Active</span></a>';
            }
            $model->status = $set_status;
            $model->save();
            return Response::json(array('error_code' => 0, 'status' => 'success', 'html' => $html));
        } else {
            return Response::json(array('error_code' => 1, 'status' => 'fail', 'message' => 'Invalid Access'));
        }
    }
	
	
	/*
      |--------------------------------------------------------------------------
      | Change Record Status
      |--------------------------------------------------------------------------
     */

   public function subcategory(Request $request) {
			
			$dp_category = Videocategory::whereRaw('status = ?  AND pid=? ', array('Yes',$request->pid))->orderBy('name')->get()->toArray();
        	$html = '';
			$html = '<select class="form-control"   name="sub_category_id" id="sub_category_id" >';
			$html .= '<option value="0" >Select</option>';
			if($request->pid!=0){
            foreach ($dp_category as $sub){
				$html .= '<option value="'.$sub['id'].'" >'.$sub['name'].'</option>';
			}
			}
            $html .= '</select>';
            return Response::json(array('error_code' => 0, 'status' => 'success', 'html' => $html));
        
    }
	
	
	
   
	

}
