<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use View;
use Hash;
use App\Model\Widgets;
use App\Model\Common;
use Session;
use Redirect;
use Response;

class WidgetsController extends Controller {
    
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
		$result_dp = Widgets::get()->toArray();
		
        return view('admin.widgets.index', ['title' => 'Widgets','result_dp'=>$result_dp]);
    }

    /*
      |--------------------------------------------------------------------------
      |  Add
      |--------------------------------------------------------------------------
     */

    public function create() {
		
       return view('admin.widgets.add', ['title' => 'Add Widget']);
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
			$path_uploads = 'public/upload/widgets/';
			$request->image->move($path_uploads, $image_name);
			}
			
			
			
			$model = new widgets();
			$model->banner_type = $request->banner_type;
			$model->name = $request->name;
			$model->page_name = $request->page_name;
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
           return Redirect::to('/admin/widgets');
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

        Widgets::whereRaw('md5(id) = ? ', array($id))->delete();
        return Redirect::to('/admin/widgets');
    }

    /*
      |--------------------------------------------------------------------------
      | Edit Record
      |--------------------------------------------------------------------------
     */

    public function edit($id) {

        $data = Widgets::whereRaw('md5(id) = ?  ', array($id))->get()->toArray();
        return view('admin.widgets.edit', ['title' => 'Edit Widget','data' => $data[0]]);
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
			$path_uploads = 'public/upload/widgets/';
			$request->image->move($path_uploads, $image_name);
			}
			
			
			$model = Widgets::find($request->id);
			$model->banner_type = $request->banner_type;
			$model->tag_line = $request->tag_line;
			$model->name = $request->name;
			$model->page_name = $request->page_name;
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
			return Redirect::to('/admin/widgets');
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
			 $model = Widgets::find($request->id);
            if ($model->status == 'Yes') {
                $set_status = 'No';
                $html = '<a style="text-decoration:none;" href="javascript:void(0)" onclick="change_status(' . $request->id . ',\'widgets/status\')" ><span  class="label label-default" data-title="Inctive"  ><i class="fa fa-ban"></i> Inctive</span></a>';
            } else {
                $set_status = 'Yes';
                $html = '<a style="text-decoration:none;" href="javascript:void(0)" onclick="change_status(' . $request->id . ',\'widgets/status\')" ><span  class="label label-success " data-title="Active"  ><i class="fa fa-check"></i> Active</span></a>';
            }
            $model->status = $set_status;
            $model->save();
            return Response::json(array('error_code' => 0, 'status' => 'success', 'html' => $html));
        } else {
            return Response::json(array('error_code' => 1, 'status' => 'fail', 'message' => 'Invalid Access'));
        }
    }
	
	
	
	

}
