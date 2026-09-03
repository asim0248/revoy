<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use View;
use Hash;
use App\Model\Projects;
use App\Model\Category;
use App\Model\Common;
use Session;
use Redirect;
use Response;

class ProjectsController extends Controller {
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
		$result_dp = Projects::get()->toArray();
        return view('admin.projects.index', ['title' => 'Projects','result_dp'=>$result_dp]);
    }

    /*
      |--------------------------------------------------------------------------
      | Service Add
      |--------------------------------------------------------------------------
     */

    public function create() {
		
       return view('admin.projects.add', ['title' => 'Add Projects']);
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
			$path_uploads = 'public/upload/projects/';
			$request->image->move($path_uploads, $image_name);
			}
			
			$image_name_2 = '';
			$file_2 = $request->banner;
			if($file_2){
			$ext = $file_2->getClientOriginalExtension();
			$file_2 = $request->banner->getClientOriginalName();
			$image_name_2 = rand(11111,99999).'_'.str_replace(' ','-',strtolower($file_2)); //uniqid() . '.' . $ext;
			$path_uploads = 'public/upload/projects/';
			$request->banner->move($path_uploads, $image_name_2);
			}
			
			$model = new Projects();
			
			$model->name = $request->name;
			$model->project_date = $request->project_date;
			$model->category_id = $request->category_id;
			$model->slug = $request->slug;
			//$model->slug =Common::slug($request->name);
			$model->sort_order = $request->sort_order;
			$model->image = $image_name;
			$model->banner = $image_name_2;
			$model->FullContents = $request->contents;
			$model->short_contents = $request->short_contents;
			
			
			
            $model->save();
			
			return Redirect::to('/admin/projects');
			
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

        Projects::whereRaw('md5(id) = ? ', array($id))->delete();
        return Redirect::to('/admin/projects');
    }

    /*
      |--------------------------------------------------------------------------
      | Edit Record
      |--------------------------------------------------------------------------
     */

    public function edit($id) {

        $data = Projects::whereRaw('md5(id) = ?  ', array($id))->get()->toArray();
		
        return view('admin.projects.edit', ['title' => 'Edit Projects','data' => $data[0]]);
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
			$path_uploads = 'public/upload/projects/';
			$request->image->move($path_uploads, $image_name);
			}
			
			$image_name_2 = '';
			$file_2 = $request->banner;
			if($file_2){
			$ext = $file_2->getClientOriginalExtension();
			$file_2 = $request->banner->getClientOriginalName();
			$image_name_2 = rand(11111,99999).'_'.str_replace(' ','-',strtolower($file_2)); //uniqid() . '.' . $ext;
			$path_uploads = 'public/upload/projects/';
			$request->banner->move($path_uploads, $image_name_2);
			}
			
			
            $model = Projects::find($request->id);
			
			$model->name = $request->name;
			$model->project_date = $request->project_date;
			$model->category_id = $request->category_id;
			//$model->slug =Common::slug($request->name);
			$model->slug = $request->slug;
			$model->sort_order = $request->sort_order;
			$model->short_contents = $request->short_contents;
			$model->FullContents = $request->contents;
			
			if($image_name!=""){
			$model->image = $image_name;
			}
			
			if($image_name_2!=""){
			$model->banner = $image_name_2;
			}
			
			
            $model->save();
			return Redirect::to('/admin/projects');
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
			 $model = Projects::find($request->id);
            if ($model->status == 'Yes') {
                $set_status = 'No';
                $html = '<a style="text-decoration:none;" href="javascript:void(0)" onclick="change_status(' . $request->id . ',\'projects/status\')" ><span  class="label label-default" data-title="Inctive"  ><i class="fa fa-ban"></i> Inctive</span></a>';
            } else {
                $set_status = 'Yes';
                $html = '<a style="text-decoration:none;" href="javascript:void(0)" onclick="change_status(' . $request->id . ',\'projects/status\')" ><span  class="label label-success " data-title="Active"  ><i class="fa fa-check"></i> Active</span></a>';
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
			 $model = Projects::find($request->id);
            if ($model->is_featured == 'Yes') {
                $set_status = 'No';
                $html = '<a style="text-decoration:none;" href="javascript:void(0)" onclick="change_status_header(' . $request->id . ',\'projects/statusfeatured\')" ><span  class="label label-default" data-title="No"  ><i class="fa fa-ban"></i> No</span></a>';
            } else {
                $set_status = 'Yes';
                $html = '<a style="text-decoration:none;" href="javascript:void(0)" onclick="change_status_header(' . $request->id . ',\'projects/statusfeatured\')" ><span  class="label label-success " data-title="Yes"  ><i class="fa fa-check"></i> Yes</span></a>';
            }
            $model->is_featured = $set_status;
            $model->save();
            return Response::json(array('error_code' => 0, 'status' => 'success', 'html' => $html));
        } else {
            return Response::json(array('error_code' => 1, 'status' => 'fail', 'message' => 'Invalid Access'));
        }
    }
	
	
	
	

}
