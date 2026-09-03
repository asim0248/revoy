<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use View;
use Hash;
use App\Model\Plans;
use App\Model\Category;
use App\Model\Common;
use Session;
use Redirect;
use Response;

class PlansController extends Controller {
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
		$result_dp = Plans::get()->toArray();
        return view('admin.plans.index', ['title' => 'Packages','result_dp'=>$result_dp]);
    }

    /*
      |--------------------------------------------------------------------------
      | Service Add
      |--------------------------------------------------------------------------
     */

    public function create() {
		
       return view('admin.plans.add', ['title' => 'Add Package']);
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
			$path_uploads = 'public/upload/plans/';
			$request->image->move($path_uploads, $image_name);
			}
			
			
			$model = new Plans();
			$model->category_id = 0;
			$model->name = $request->name;
			
			$model->plan_price = $request->plan_price;
			$model->price_per = $request->price_per;
			$model->sort_order = $request->sort_order;
			$model->features = $request->features;
			$model->tag_line = $request->tag_line;
			$model->color_code = $request->color_code;
			$model->layout_type = $request->layout_type;
			$model->short_contents = $request->short_contents;
			$model->image = $image_name;
			
            $model->save();
			
			return Redirect::to('/admin/plans');
			
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

        Plans::whereRaw('md5(id) = ? ', array($id))->delete();
        return Redirect::to('/admin/plans');
    }

    /*
      |--------------------------------------------------------------------------
      | Edit Record
      |--------------------------------------------------------------------------
     */

    public function edit($id) {

        $data = Plans::whereRaw('md5(id) = ?  ', array($id))->get()->toArray();
		
        return view('admin.plans.edit', ['title' => 'Edit Package','data' => $data[0]]);
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
			$path_uploads = 'public/upload/plans/';
			$request->image->move($path_uploads, $image_name);
			}
			
			
            $model = Plans::find($request->id);
			$model->category_id = 0;
			$model->name = $request->name;
			
			$model->plan_price = $request->plan_price;
			$model->price_per = $request->price_per;
			$model->sort_order = $request->sort_order;
			$model->features = $request->features;
			$model->tag_line = $request->tag_line;
			$model->color_code = $request->color_code;
			$model->layout_type = $request->layout_type;
			$model->short_contents = $request->short_contents;
			if($image_name!=""){
			$model->image = $image_name;
			}
			
            $model->save();
			return Redirect::to('/admin/plans');
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
			 $model = Plans::find($request->id);
            if ($model->status == 'Yes') {
                $set_status = 'No';
                $html = '<a style="text-decoration:none;" href="javascript:void(0)" onclick="change_status(' . $request->id . ',\'plans/status\')" ><span  class="label label-default" data-title="Inctive"  ><i class="fa fa-ban"></i> Inctive</span></a>';
            } else {
                $set_status = 'Yes';
                $html = '<a style="text-decoration:none;" href="javascript:void(0)" onclick="change_status(' . $request->id . ',\'plans/status\')" ><span  class="label label-success " data-title="Active"  ><i class="fa fa-check"></i> Active</span></a>';
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
			 $model = Plans::find($request->id);
            if ($model->is_featured == 'Yes') {
                $set_status = 'No';
                $html = '<a style="text-decoration:none;" href="javascript:void(0)" onclick="change_status_header(' . $request->id . ',\'plans/statusfeatured\')" ><span  class="label label-default" data-title="No"  ><i class="fa fa-ban"></i> No</span></a>';
            } else {
                $set_status = 'Yes';
                $html = '<a style="text-decoration:none;" href="javascript:void(0)" onclick="change_status_header(' . $request->id . ',\'plans/statusfeatured\')" ><span  class="label label-success " data-title="Yes"  ><i class="fa fa-check"></i> Yes</span></a>';
            }
            $model->is_featured = $set_status;
            $model->save();
            return Response::json(array('error_code' => 0, 'status' => 'success', 'html' => $html));
        } else {
            return Response::json(array('error_code' => 1, 'status' => 'fail', 'message' => 'Invalid Access'));
        }
    }
	
	
	

}
