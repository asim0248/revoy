<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use View;
use Hash;
use App\Model\Services;
use App\Model\Category;
use App\Model\Common;
use App\Model\Projectimages;
use Session;
use Redirect;
use Response;

class ServicesController extends Controller {
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
		$result_dp = Services::get()->toArray();
        return view('admin.services.index', ['title' => 'Services','result_dp'=>$result_dp]);
    }

    /*
      |--------------------------------------------------------------------------
      | Service Add
      |--------------------------------------------------------------------------
     */

    public function create() {
		
       return view('admin.services.add', ['title' => 'Add Services']);
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
			$path_uploads = 'public/upload/services/';
			$request->image->move($path_uploads, $image_name);
			}
			
			$icon = '';
			$file_icon = $request->icon;
			if($file_icon){
			$ext = $file_icon->getClientOriginalExtension();
			$file_icon = $request->icon->getClientOriginalName();
			$file_icon = rand(11111,99999).'_'.str_replace(' ','-',strtolower($file_icon));// uniqid() . '.' . $ext;
			$path_uploads = 'public/upload/services/';
			$request->icon->move($path_uploads, $file_icon);
			}
			
			$icon_2 = '';
			$file_icon_2 = $request->icon_2;
			if($file_icon_2){
			$ext = $file_icon_2->getClientOriginalExtension();
			$file_icon_2 = $request->icon_2->getClientOriginalName();
			$file_icon_2 = rand(11111,99999).'_'.str_replace(' ','-',strtolower($file_icon_2));// uniqid() . '.' . $ext;
			$path_uploads = 'public/upload/services/';
			$request->icon_2->move($path_uploads, $file_icon_2);
			}
			
			$image_banner = '';
			$file_banner = $request->banner;
			if($file_banner){
			$ext = $file_banner->getClientOriginalExtension();
			$file_banner = $request->banner->getClientOriginalName();
			$image_banner = rand(11111,99999).'_'.str_replace(' ','-',strtolower($file_banner)); //uniqid() . '.' . $ext;
			$path_uploads = 'public/upload/services/';
			$request->banner->move($path_uploads, $image_banner);
			}
			
			
			$model = new Services();
			$model->name = $request->name;
			$model->heading = $request->heading;
			$model->service_group = $request->service_group;
			$model->location_name = $request->location_name;
			$model->tag_line = $request->tag_line;
			$model->slug =Common::slug($request->name);
			$model->icon_class =  $file_icon ; // $request->icon_class; //
			$model->icon_class_2 =  $file_icon_2 ; //$request->icon_class;
			$model->detail = $request->detail;
			$model->sort_order = $request->sort_order;
			$model->image = $image_name;
			$model->banner = $image_banner;
			$model->FullContents = $request->contents;
			$model->extra_detail = $request->extra_detail;
            $model->save();
			
			return Redirect::to('/admin/services');
			
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

        Services::whereRaw('md5(id) = ? ', array($id))->delete();
        return Redirect::to('/admin/services');
    }

    /*
      |--------------------------------------------------------------------------
      | Edit Record
      |--------------------------------------------------------------------------
     */

    public function edit($id) {

        $data = Services::whereRaw('md5(id) = ?  ', array($id))->get()->toArray();
		
        return view('admin.services.edit', ['title' => 'Edit Services','data' => $data[0]]);
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
			$path_uploads = 'public/upload/services/';
			$request->image->move($path_uploads, $image_name);
			}
			
			$icon = '';
			$file_icon = $request->icon;
			if($file_icon){
			$ext = $file_icon->getClientOriginalExtension();
			$file_icon = $request->icon->getClientOriginalName();
			$file_icon = rand(11111,99999).'_'.str_replace(' ','-',strtolower($file_icon));// uniqid() . '.' . $ext;
			$path_uploads = 'public/upload/services/';
			$request->icon->move($path_uploads, $file_icon);
			}
			
			$icon_2 = '';
			$file_icon_2 = $request->icon_2;
			if($file_icon_2){
			$ext = $file_icon_2->getClientOriginalExtension();
			$file_icon_2 = $request->icon_2->getClientOriginalName();
			$file_icon_2 = rand(11111,99999).'_'.str_replace(' ','-',strtolower($file_icon_2));// uniqid() . '.' . $ext;
			$path_uploads = 'public/upload/services/';
			$request->icon_2->move($path_uploads, $file_icon_2);
			}
			
			$image_banner = '';
			$file_banner = $request->banner;
			if($file_banner){
			$ext = $file_banner->getClientOriginalExtension();
			$file_banner = $request->banner->getClientOriginalName();
			$image_banner = rand(11111,99999).'_'.str_replace(' ','-',strtolower($file_banner)); //uniqid() . '.' . $ext;
			$path_uploads = 'public/upload/services/';
			$request->banner->move($path_uploads, $image_banner);
			}
			
			
			
            $model = Services::find($request->id);
			
			$model->name = $request->name;
			$model->heading = $request->heading;
			$model->service_group = $request->service_group;
			$model->location_name = $request->location_name;
			$model->tag_line = $request->tag_line;
			$model->slug =Common::slug($request->name);
			$model->detail = $request->detail;
			$model->sort_order = $request->sort_order;
			$model->FullContents = $request->contents;
			$model->extra_detail = $request->extra_detail;
			//$model->icon_class = $request->icon_class;
			
			if($image_name!=""){
			$model->image = $image_name;
			}
			
			if($image_banner!=""){
			$model->banner = $image_banner;
			}
			
			if($file_icon!=""){
			$model->icon_class =  $file_icon;
			}
			
			if($file_icon_2!=""){
			$model->icon_class_2 =  $file_icon_2;
			}
			
			
			
            $model->save();
			return Redirect::to('/admin/services');
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
			 $model = Services::find($request->id);
            if ($model->status == 'Yes') {
                $set_status = 'No';
                $html = '<a style="text-decoration:none;" href="javascript:void(0)" onclick="change_status(' . $request->id . ',\'services/status\')" ><span  class="label label-default" data-title="Inctive"  ><i class="fa fa-ban"></i> Inctive</span></a>';
            } else {
                $set_status = 'Yes';
                $html = '<a style="text-decoration:none;" href="javascript:void(0)" onclick="change_status(' . $request->id . ',\'services/status\')" ><span  class="label label-success " data-title="Active"  ><i class="fa fa-check"></i> Active</span></a>';
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
			 $model = Services::find($request->id);
            if ($model->is_featured == 'Yes') {
                $set_status = 'No';
                $html = '<a style="text-decoration:none;" href="javascript:void(0)" onclick="change_status_header(' . $request->id . ',\'services/statusfeatured\')" ><span  class="label label-default" data-title="No"  ><i class="fa fa-ban"></i> No</span></a>';
            } else {
                $set_status = 'Yes';
                $html = '<a style="text-decoration:none;" href="javascript:void(0)" onclick="change_status_header(' . $request->id . ',\'services/statusfeatured\')" ><span  class="label label-success " data-title="Yes"  ><i class="fa fa-check"></i> Yes</span></a>';
            }
            $model->is_featured = $set_status;
            $model->save();
            return Response::json(array('error_code' => 0, 'status' => 'success', 'html' => $html));
        } else {
            return Response::json(array('error_code' => 1, 'status' => 'fail', 'message' => 'Invalid Access'));
        }
    }
	
	
	public function statusfooter(Request $request) {

        if ($request->_token) {
			 $model = Services::find($request->id);
            if ($model->is_footer == 'Yes') {
                $set_status = 'No';
                $html = '<a style="text-decoration:none;" href="javascript:void(0)" onclick="change_status_footer(' . $request->id . ',\'services/statusfooter\')" ><span  class="label label-default" data-title="No"  ><i class="fa fa-ban"></i> No</span></a>';
            } else {
                $set_status = 'Yes';
                $html = '<a style="text-decoration:none;" href="javascript:void(0)" onclick="change_status_footer(' . $request->id . ',\'services/statusfooter\')" ><span  class="label label-success " data-title="Yes"  ><i class="fa fa-check"></i> Yes</span></a>';
            }
            $model->is_footer = $set_status;
            $model->save();
            return Response::json(array('error_code' => 0, 'status' => 'success', 'html' => $html));
        } else {
            return Response::json(array('error_code' => 1, 'status' => 'fail', 'message' => 'Invalid Access'));
        }
    }
	
	//--------------------------------------------------------
	
	public function images($id) {
		$data = Services::whereRaw('md5(id) = ?  ', array($id))->first()->toArray();
		$result_dp = Projectimages::whereRaw('project_id  = ?  ', array($data['id']))->get()->toArray();
		
        return view('admin.productimages.index', ['title' => $data['name'].' Images','result_dp'=>$result_dp,'data'=>$data]);
    }
	
	/*
      |--------------------------------------------------------------------------
      | Image Add
      |--------------------------------------------------------------------------
     */

    public function createimage($id) {
		$data = Services::whereRaw('md5(id) = ?  ', array($id))->first()->toArray();
		
        return view('admin.productimages.add', ['title' => 'Add '.$data['name'].' Image','data'=>$data]);
    }
	
	/*
      |--------------------------------------------------------------------------
      | Edit Logo
      |--------------------------------------------------------------------------
     */

    public function createimage_save(Request $request) {
			if ($request->_token) {
			
			$image_name = '';
			$file = $request->image;
			if($file){
			$ext = $file->getClientOriginalExtension();
			$file = $request->image->getClientOriginalName();
			$image_name = rand(11111,99999).'_'.str_replace(' ','-',strtolower($file));// uniqid() . '.' . $ext;
			$path_uploads = 'public/upload/services/';
			$request->image->move($path_uploads, $image_name);
			}
			
			
			$model = new Projectimages();
            $model->image = $image_name;
			$model->project_id = $request->project_id;
			$model->featured = 'No';
			$model->sort_order = 1;
            $model->save();
			
			return Redirect::intended('admin/services/images/'.md5($request->project_id).'');
		}
        	
			
         
    }
	
	public function imagedelete($id,$sid) {

        Projectimages::whereRaw('md5(id) = ? ', array($sid))->delete();
        return Redirect::to('/admin/services/images/'.$id);
    }
	

}
