<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use View;
use Hash;
use App\Model\Testimonials;
use App\Model\Common;
use Session;
use Redirect;
use Response;
use URL;
class TestimonialsController extends Controller {
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
		$result_dp = Testimonials::get()->toArray();
        return view('admin.testimonials.index', ['title' => 'Testimonials','result_dp'=>$result_dp]);
    }

    /*
      |--------------------------------------------------------------------------
      | Page Add
      |--------------------------------------------------------------------------
     */

    public function create() {
		
       return view('admin.testimonials.add', ['title' => 'Add Testimonials']);
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
			$path_uploads = 'public/upload/testimonials/';
			$request->image->move($path_uploads, $image_name);
			}
			
			
            $model = new Testimonials();
            $model->name = $request->name;
			$model->designation = $request->designation;
			$model->rating = $request->rating;
			$model->sort_order = $request->sort_order;
			$model->image = $image_name;
			$model->heading_contents = $request->heading_contents;
			$model->short_contents = $request->short_contents;
			$model->save();
           // return Response::json(array('error_code' => 0, 'status' => 'success', 'message' => ''));
		   return Redirect::to('/admin/testimonials');
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

        Testimonials::whereRaw('md5(id) = ? ', array($id))->delete();
        return Redirect::to('/admin/testimonials');
    }

    /*
      |--------------------------------------------------------------------------
      | Edit Record
      |--------------------------------------------------------------------------
     */

    public function edit($id) {

        $data = Testimonials::whereRaw('md5(id) = ?  ', array($id))->get()->toArray();
        return view('admin.testimonials.edit', ['title' => 'Edit Testimonials','data' => $data[0]]);
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
			$path_uploads = 'public/upload/testimonials/';
			$request->image->move($path_uploads, $image_name);
			}
			
			
			
			
			$model = Testimonials::find($request->id);			
            $model->name = $request->name;
			$model->designation = $request->designation;
			$model->sort_order = $request->sort_order;
			$model->rating = $request->rating;
			$model->heading_contents = $request->heading_contents;
			$model->short_contents = $request->short_contents;
			if($image_name!=""){
			$model->image = $image_name;
			}
			
            $model->save();
			return Redirect::to('/admin/testimonials');
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
			 $model = Testimonials::find($request->id);
            if ($model->status == 'Yes') {
                $set_status = 'No';
                $html = '<a style="text-decoration:none;" href="javascript:void(0)" onclick="change_status(' . $request->id . ',\''.url('/').'/admin/testimonials/status\')" ><span  class="label label-default" data-title="Inctive"  ><i class="fa fa-ban"></i> Inctive</span></a>';
            } else {
                $set_status = 'Yes';
                $html = '<a style="text-decoration:none;" href="javascript:void(0)" onclick="change_status(' . $request->id . ',\''.url('/').'/admin/testimonials/status\')" ><span  class="label label-success " data-title="Active"  ><i class="fa fa-check"></i> Active</span></a>';
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
			 $model = Testimonials::find($request->id);
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
