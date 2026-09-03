<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use View;
use Hash;
use App\Model\Brokers;
use App\Model\Category;
use App\Model\Common;
use Session;
use Redirect;
use Response;

class BrokersController extends Controller {
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
		$result_dp = Brokers::get()->toArray();
        return view('admin.brokers.index', ['title' => 'Brokers','result_dp'=>$result_dp]);
    }

    /*
      |--------------------------------------------------------------------------
      | Service Add
      |--------------------------------------------------------------------------
     */

    public function create() {
		
       return view('admin.brokers.add', ['title' => 'Add Brokers']);
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
			$path_uploads = 'public/upload/brokers/';
			$request->image->move($path_uploads, $image_name);
			}
			
			$banner_name = '';
			$file_2 = $request->banner;
			if($file_2){
			$ext = $file_2->getClientOriginalExtension();
			$file_2 = $request->banner->getClientOriginalName();
			$banner_name = rand(11111,99999).'_'.str_replace(' ','-',strtolower($file_2));// uniqid() . '.' . $ext;
			$path_uploads = 'public/upload/brokers/';
			$request->banner->move($path_uploads, $banner_name);
			}
			
			$model = new Brokers();
			
			$model->name = $request->name;
			$model->slug = Common::slug($request->name);
			$model->phone = $request->phone;
			$model->email = $request->email;
			$model->location = $request->location;
			$model->designation = $request->designation;
			$model->experience = $request->experience;
			$model->address = $request->address;
			$model->post_code = $request->post_code;
			$model->rating = $request->rating;
			$model->map_link = $request->map_link;
			
			$model->fb = $request->fb;
			$model->tw = $request->tw;
			$model->ln = $request->ln;
			$model->web = $request->web;
			
			$model->sort_order = $request->sort_order;
			
			$model->short_contents = $request->short_contents;
			$model->full_contents = $request->full_contents;
			$model->image = $image_name;
			$model->banner = $banner_name;
			$model->is_featured = 'No';
			
			$model->loan_types = (is_array($request->loan_types)>0)?implode(',',$request->loan_types):'';
			$model->work_completed = $request->work_completed;
			$model->awesome_clients = $request->awesome_clients;
			$model->total_experience = $request->total_experience;
			
            $model->save();
			
			return Redirect::to('/admin/brokers');
			
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

        Brokers::whereRaw('md5(id) = ? ', array($id))->delete();
        return Redirect::to('/admin/brokers');
    }

    /*
      |--------------------------------------------------------------------------
      | Edit Record
      |--------------------------------------------------------------------------
     */

    public function edit($id) {

        $data = Brokers::whereRaw('md5(id) = ?  ', array($id))->get()->toArray();
		
        return view('admin.brokers.edit', ['title' => 'Edit Brokers','data' => $data[0]]);
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
			$image_name = rand(11111,99999).'_'.str_replace(' ','-',strtolower($file));//uniqid() . '.' . $ext;
			$path_uploads = 'public/upload/brokers/';
			$request->image->move($path_uploads, $image_name);
			}
			
			$banner_name = '';
			$file_2 = $request->banner;
			if($file_2){
			$ext = $file_2->getClientOriginalExtension();
			$file_2 = $request->banner->getClientOriginalName();
			$banner_name = rand(11111,99999).'_'.str_replace(' ','-',strtolower($file_2));// uniqid() . '.' . $ext;
			$path_uploads = 'public/upload/brokers/';
			$request->banner->move($path_uploads, $banner_name);
			}
			
            $model = Brokers::find($request->id);
			$model->name = $request->name;
			$model->slug = Common::slug($request->name);
			$model->email = $request->email;
			$model->phone = $request->phone;
			$model->location = $request->location;
			$model->designation = $request->designation;
			$model->experience = $request->experience;
			$model->address = $request->address;
			$model->post_code = $request->post_code;
			$model->rating = $request->rating;
			$model->map_link = $request->map_link;
			$model->fb = $request->fb;
			$model->tw = $request->tw;
			$model->ln = $request->ln;
			$model->web = $request->web;
			
			$model->sort_order = $request->sort_order;
			
			$model->short_contents = $request->short_contents;
			$model->full_contents = $request->full_contents;
			
			$model->loan_types = (is_array($request->loan_types)>0)?implode(',',$request->loan_types):'';
			$model->work_completed = $request->work_completed;
			$model->awesome_clients = $request->awesome_clients;
			$model->total_experience = $request->total_experience;
			
			if($image_name!=""){
			$model->image = $image_name;
			}
			if($banner_name!=""){
			$model->banner = $banner_name;
			}
            $model->save();
			return Redirect::to('/admin/brokers');
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
			 $model = Brokers::find($request->id);
            if ($model->status == 'Yes') {
                $set_status = 'No';
                $html = '<a style="text-decoration:none;" href="javascript:void(0)" onclick="change_status(' . $request->id . ',\'brokers/status\')" ><span  class="label label-default" data-title="Inctive"  ><i class="fa fa-ban"></i> Inctive</span></a>';
            } else {
                $set_status = 'Yes';
                $html = '<a style="text-decoration:none;" href="javascript:void(0)" onclick="change_status(' . $request->id . ',\'brokers/status\')" ><span  class="label label-success " data-title="Active"  ><i class="fa fa-check"></i> Active</span></a>';
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
			 $model = Brokers::find($request->id);
            if ($model->is_featured == 'Yes') {
                $set_status = 'No';
                $html = '<a style="text-decoration:none;" href="javascript:void(0)" onclick="change_status_header(' . $request->id . ',\'brokers/statusfeatured\')" ><span  class="label label-default" data-title="No"  ><i class="fa fa-ban"></i> No</span></a>';
            } else {
                $set_status = 'Yes';
                $html = '<a style="text-decoration:none;" href="javascript:void(0)" onclick="change_status_header(' . $request->id . ',\'brokers/statusfeatured\')" ><span  class="label label-success " data-title="Yes"  ><i class="fa fa-check"></i> Yes</span></a>';
            }
            $model->is_featured = $set_status;
            $model->save();
            return Response::json(array('error_code' => 0, 'status' => 'success', 'html' => $html));
        } else {
            return Response::json(array('error_code' => 1, 'status' => 'fail', 'message' => 'Invalid Access'));
        }
    }
	
	
	
	

}
