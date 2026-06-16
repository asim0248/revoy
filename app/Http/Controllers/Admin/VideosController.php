<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use View;
use Hash;
use App\Model\Videos;
use App\Model\Common;
use Session;
use Redirect;
use Response;

class VideosController extends Controller {
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
		$result_dp = Videos::get()->toArray();
        return view('admin.videos.index', ['title' => 'Videos','result_dp'=>$result_dp]);
    }

    /*
      |--------------------------------------------------------------------------
      | Service Add
      |--------------------------------------------------------------------------
     */

    public function create() {
		
       return view('admin.videos.add', ['title' => 'Add videos']);
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
			$image_name = uniqid() . '.' . $ext; //str_replace(' ','-',strtolower($file));//
			$path_uploads = 'public/upload/videos/';
			$request->image->move($path_uploads, $image_name);
			}
			
			$model = new Videos();
			$model->category_id = $request->category_id;
			$model->sub_category_id = $request->sub_category_id;
			$model->name = $request->name;
			$model->slug = Common::slug($request->name);
			$model->sort_order = $request->sort_order;
			$model->video_link = $request->video_link;
			$model->page_link = $request->page_link;
			$model->heading = $request->heading;
			$model->full_contents = $request->contents;
			$model->tag_line = $request->tag_line;
			$model->banner = $image_name;
            $model->save();
			
			
			return Redirect::to('/admin/videos');
			
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

        Videos::whereRaw('md5(id) = ? ', array($id))->delete();
        return Redirect::to('/admin/videos');
    }

    /*
      |--------------------------------------------------------------------------
      | Edit Record
      |--------------------------------------------------------------------------
     */

    public function edit($id) {

        $data = Videos::whereRaw('md5(id) = ?  ', array($id))->get()->toArray();
		
        return view('admin.videos.edit', ['title' => 'Edit Videos','data' => $data[0]]);
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
			$image_name = uniqid() . '.' . $ext; //str_replace(' ','-',strtolower($file));//
			$path_uploads = 'public/upload/videos/';
			$request->image->move($path_uploads, $image_name);
			}
			
            $model = Videos::find($request->id);
			$model->category_id = $request->category_id;
			$model->sub_category_id = $request->sub_category_id;
			$model->name = $request->name;
			$model->slug = Common::slug($request->name);
			$model->sort_order = $request->sort_order;
			$model->video_link = $request->video_link;
			$model->page_link = $request->page_link;
			$model->heading = $request->heading;
			$model->tag_line = $request->tag_line;
			$model->full_contents = $request->contents;
			
			if($image_name!=''){
			$model->banner = $image_name;
			}
			
            $model->save();
			
			return Redirect::to('/admin/videos');
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
			 $model = Videos::find($request->id);
            if ($model->status == 'Yes') {
                $set_status = 'No';
                $html = '<a style="text-decoration:none;" href="javascript:void(0)" onclick="change_status(' . $request->id . ',\''.url('/').'/admin/videos/status\')" ><span  class="label label-default" data-title="Inctive"  ><i class="fa fa-ban"></i> Inctive</span></a>';
            } else {
                $set_status = 'Yes';
                $html = '<a style="text-decoration:none;" href="javascript:void(0)" onclick="change_status(' . $request->id . ',\''.url('/').'/admin/videos/status\')" ><span  class="label label-success " data-title="Active"  ><i class="fa fa-check"></i> Active</span></a>';
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
			 $model = Videos::find($request->id);
            if ($model->is_featured == 'Yes') {
                $set_status = 'No';
                $html = '<a style="text-decoration:none;" href="javascript:void(0)" onclick="change_status_header(' . $request->id . ',\''.url('/').'/admin/videos/statusfeatured\')" ><span  class="label label-default" data-title="No"  ><i class="fa fa-ban"></i> No</span></a>';
            } else {
                $set_status = 'Yes';
                $html = '<a style="text-decoration:none;" href="javascript:void(0)" onclick="change_status_header(' . $request->id . ',\''.url('/').'/admin/videos/statusfeatured\')" ><span  class="label label-success " data-title="Yes"  ><i class="fa fa-check"></i> Yes</span></a>';
            }
            $model->is_featured = $set_status;
            $model->save();
            return Response::json(array('error_code' => 0, 'status' => 'success', 'html' => $html));
        } else {
            return Response::json(array('error_code' => 1, 'status' => 'fail', 'message' => 'Invalid Access'));
        }
    }
	
	public function statuspopular(Request $request) {

        if ($request->_token) {
			 $model = Videos::find($request->id);
            if ($model->is_popular == 'Yes') {
                $set_status = 'No';
                $html = '<a style="text-decoration:none;" href="javascript:void(0)" onclick="change_status_footer(' . $request->id . ',\''.url('/').'/admin/videos/statuspopular\')" ><span  class="label label-default" data-title="No"  ><i class="fa fa-ban"></i> No</span></a>';
            } else {
                $set_status = 'Yes';
                $html = '<a style="text-decoration:none;" href="javascript:void(0)" onclick="change_status_footer(' . $request->id . ',\''.url('/').'/admin/videos/statuspopular\')" ><span  class="label label-success " data-title="Yes"  ><i class="fa fa-check"></i> Yes</span></a>';
            }
            $model->is_popular = $set_status;
            $model->save();
            return Response::json(array('error_code' => 0, 'status' => 'success', 'html' => $html));
        } else {
            return Response::json(array('error_code' => 1, 'status' => 'fail', 'message' => 'Invalid Access'));
        }
    }

}
