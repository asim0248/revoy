<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use View;
use Hash;
use App\Model\Blogcategory;
use App\Model\Common;
use Session;
use Redirect;
use Response;
use URL;
class BlogcategoryController extends Controller {
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
		$result_dp = Blogcategory::get()->toArray();
		
        return view('admin.blogcategory.index', ['title' => 'Category','result_dp'=>$result_dp]);
    }

    /*
      |--------------------------------------------------------------------------
      | Page Add
      |--------------------------------------------------------------------------
     */

    public function create() {
		
       return view('admin.blogcategory.add', ['title' => 'Add Category']);
    }

    /*
      |--------------------------------------------------------------------------
      | Admin Login Auth
      |--------------------------------------------------------------------------
     */

    public function create_save(Request $request) {
        if ($request->_token) {
			
			$icon_name = '';
			$file_icon = $request->icon;
			if($file_icon){
			$ext = $file_icon->getClientOriginalExtension();
			$file_icon = $request->icon->getClientOriginalName();
			$icon_name = uniqid() . '.' . $ext; //str_replace(' ','-',strtolower($file));//
			$path_uploads = 'public/upload/blogcategory/';
			$request->icon->move($path_uploads, $icon_name);
			}
			
			
			$image_name = '';
			$file = $request->image;
			if($file){
			$ext = $file->getClientOriginalExtension();
			$file = $request->image->getClientOriginalName();
			$image_name = uniqid() . '.' . $ext; //str_replace(' ','-',strtolower($file));//
			$path_uploads = 'public/upload/blogcategory/';
			$request->image->move($path_uploads, $image_name);
			}
			
			
            $model = new Blogcategory();
			$model->parent_ids = (is_array($request->c_id)>0)?implode(',',$request->c_id):''; 
            $model->title = $request->name;
			$model->slug = Common::slug($request->name);
			$model->link = $request->link;
			$model->Meta_Title = $request->meta_title;
			$model->Keywords = $request->meta_keyword;
			$model->Description = $request->meta_description;
			$model->sort_order = $request->sort_order;
			$model->heading = $request->heading;
			$model->short_description = $request->short_description;
			$model->banner = $image_name;
			$model->icon = $icon_name;
			$model->status = 'Yes';
			$model->save();
           // return Response::json(array('error_code' => 0, 'status' => 'success', 'message' => ''));
		   return Redirect::to('/admin/blogcategory');
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

        Blogcategory::whereRaw('md5(id) = ? ', array($id))->delete();
        return Redirect::to('/admin/blogcategory');
    }

    /*
      |--------------------------------------------------------------------------
      | Edit Record
      |--------------------------------------------------------------------------
     */

    public function edit($id) {

        $data = Blogcategory::whereRaw('md5(id) = ?  ', array($id))->get()->toArray();
        return view('admin.blogcategory.edit', ['title' => 'Edit Category','data' => $data[0]]);
    }

    /*
      |--------------------------------------------------------------------------
      | Edit Record
      |--------------------------------------------------------------------------
     */

    public function edit_save(Request $request) {

        if ($request->_token) {
			
			$icon_name = '';
			$file_icon = $request->icon;
			if($file_icon){
			$ext = $file_icon->getClientOriginalExtension();
			$file_icon = $request->icon->getClientOriginalName();
			$icon_name = uniqid() . '.' . $ext; //str_replace(' ','-',strtolower($file));//
			$path_uploads = 'public/upload/blogcategory/';
			$request->icon->move($path_uploads, $icon_name);
			}
			
			$image_name = '';
			$file = $request->image;
			if($file){
			$ext = $file->getClientOriginalExtension();
			$file = $request->image->getClientOriginalName();
			$image_name = uniqid() . '.' . $ext; //str_replace(' ','-',strtolower($file));//
			$path_uploads = 'public/upload/blogcategory/';
			$request->image->move($path_uploads, $image_name);
			}
			
			$model = Blogcategory::find($request->id);
			
			
            $model->parent_ids = (is_array($request->c_id)>0)?implode(',',$request->c_id):''; 
			$model->title = $request->name;
			$model->slug = Common::slug($request->name);
			$model->link = $request->link;
			$model->Meta_Title = $request->meta_title;
			$model->Keywords = $request->meta_keyword;
			$model->Description = $request->meta_description;
			$model->sort_order = $request->sort_order;
			
			$model->heading = $request->heading;
			$model->short_description = $request->short_description;
			
			if($icon_name!=''){
			$model->icon = $icon_name;
			}
			
			if($image_name!=''){
			$model->banner = $image_name;
			}
            $model->save();
			return Redirect::to('/admin/blogcategory');
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
			 $model = Blogcategory::find($request->id);
            if ($model->status == 'Yes') {
                $set_status = 'No';
                $html = '<a style="text-decoration:none;" href="javascript:void(0)" 
				onclick="change_status(' . $request->id . ',\''.url('/').'/admin/blogcategory/status\')" ><span  class="label label-default" data-title="Inctive"  ><i class="fa fa-ban"></i> Inctive</span></a>';
            } else {
                $set_status = 'Yes';
                $html = '<a style="text-decoration:none;" href="javascript:void(0)" 
				onclick="change_status(' . $request->id . ',\''.url('/').'/admin/blogcategory/status\')" ><span  class="label label-success " data-title="Active"  ><i class="fa fa-check"></i> Active</span></a>';
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
			 $model = Blogcategory::find($request->id);
            if ($model->is_featured == 'Yes') {
                $set_status = 'No';
                $html = '<a style="text-decoration:none;" href="javascript:void(0)" onclick="change_status_header(' . $request->id . ',\''.url('/').'/admin/blogcategory/statusfeatured\')" ><span  class="label label-default" data-title="No"  ><i class="fa fa-ban"></i> No</span></a>';
            } else {
                $set_status = 'Yes';
                $html = '<a style="text-decoration:none;" href="javascript:void(0)" onclick="change_status_header(' . $request->id . ',\''.url('/').'/admin/blogcategory/statusfeatured\')" ><span  class="label label-success " data-title="Yes"  ><i class="fa fa-check"></i> Yes</span></a>';
            }
            $model->is_featured = $set_status;
            $model->save();
            return Response::json(array('error_code' => 0, 'status' => 'success', 'html' => $html));
        } else {
            return Response::json(array('error_code' => 1, 'status' => 'fail', 'message' => 'Invalid Access'));
        }
    }
	
	

}
