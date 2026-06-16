<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use View;
use Hash;
use App\Model\Posts;
use App\Model\Common;
use App\Model\Blogcategory;
use App\Model\Tags;
use Session;
use Redirect;
use Response;
use App\Model\Resize;
use Validator;
class PostsController extends Controller {
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
		
		$result_dp = Posts::get()->toArray();
        	return view('admin.posts.index', ['title' => 'Posts','result_dp'=>$result_dp]);
		
    }

    /*
      |--------------------------------------------------------------------------
      | Project Add
      |--------------------------------------------------------------------------
     */

    public function create() {
		
		$dp_category = Blogcategory::whereRaw('Status = ?  ', array('Yes'))->orderBy('title')->get()->toArray();
		$dp_tags = Tags::whereRaw('Status = ?  ', array('Yes'))->orderBy('name')->get()->toArray();
       return view('admin.posts.add', ['title' => 'Add Post','dp_category'=>$dp_category,'dp_tags'=>$dp_tags]);
    }

    /*
      |--------------------------------------------------------------------------
      | Admin Login Auth
      |--------------------------------------------------------------------------
     */

    public function create_save(Request $request) {
        if ($request->_token) {
			
			/*$image_name = '';
			$file = $request->image;
			$image_name = '';
			$file = $request->image;
			if($file){
			$ext = $file->getClientOriginalExtension();
			$file = $request->image->getClientOriginalName();
			$image_name = rand(11111,99999).'_'.str_replace(' ','-',strtolower($file));//uniqid() . '.' . $ext;
			$path_uploads = 'public/upload/post/';
			$request->image->move($path_uploads, $image_name);
			
			$resizeObj = new Resize($path_uploads.$image_name);
			$resizeObj->resizeImage(770, 309, 'exact');
			$resizeObj->saveImage($path_uploads.'thumbs/'.$image_name, 100);
			
			$resizeObj->resizeImage(370, 220, 'exact');
			$resizeObj->saveImage($path_uploads.'small/'.$image_name, 100);
			
			$resizeObj->resizeImage(80, 80, 'exact');
			$resizeObj->saveImage($path_uploads.'mini/'.$image_name, 100);
			
			}*/
			
			$image_name = '';
			$file = $request->image;
			if($file){
			$ext = $file->getClientOriginalExtension();
			$file = $request->image->getClientOriginalName();
			$image_name = rand(11111,99999).'_'.str_replace(' ','-',strtolower($file));//uniqid() . '.' . $ext;
			$path_uploads = 'public/upload/post/';
			$request->image->move($path_uploads, $image_name);
			}
			
			$image_2 = '';
			$file_2 = $request->image_2;
			if($file_2){
			$ext = $file_2->getClientOriginalExtension();
			$file_2 = $request->image_2->getClientOriginalName();
			$image_2 = rand(11111,99999).'_'.str_replace(' ','-',strtolower($file_2));//uniqid() . '.' . $ext;
			$path_uploads = 'public/upload/post/';
			$request->image_2->move($path_uploads, $image_2);
			}
			
			$image_name_2 = '';
			$file_2 = $request->banner;
			if($file_2){
			$ext = $file_2->getClientOriginalExtension();
			$file_2 = $request->banner->getClientOriginalName();
			$image_name_2 = rand(11111,99999).'_'.str_replace(' ','-',strtolower($file_2)); //uniqid() . '.' . $ext;
			$path_uploads = 'public/upload/post/';
			$request->banner->move($path_uploads, $image_name_2);
			}
			
			$model = new Posts();
			$model->category = (is_array($request->c_id)>0)?implode(',',$request->c_id):''; 
			$model->tags = (is_array($request->t_id)>0)?implode(',',$request->t_id):'';
            $model->heading = $request->name;
			$model->sub_heading = $request->sub_heading;
			$model->banner_heading = $request->banner_heading;
			$model->post_by = $request->post_by;
			$model->slug = Common::slug($request->name);
			$model->image = $image_name;
			$model->image_2 = $image_2;
			$model->banner = $image_name_2;
			$model->Contents = $request->short_contents;
			$model->FullContents = $request->contents;
			$model->Title = $request->meta_title;
			$model->Keywords = $request->meta_keyword;
			$model->Description = $request->meta_description;
			
			$model->status = 'Yes';
			$model->post_date = date('Y-m-d H:i:s');
			$model->save();
			
			return Redirect::to('/admin/posts');
			
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

        Posts::whereRaw('md5(id) = ? ', array($id))->delete();
        return Redirect::to('/admin/posts');
    }

    /*
      |--------------------------------------------------------------------------
      | Edit Record
      |--------------------------------------------------------------------------
     */

    public function edit($id) {
		 $data = Posts::whereRaw('md5(id) = ?  ', array($id))->get()->toArray();
		$dp_category = Blogcategory::whereRaw('Status = ?  ', array('Yes'))->orderBy('title')->get()->toArray();
		$dp_tags = Tags::whereRaw('Status = ?  ', array('Yes'))->orderBy('name')->get()->toArray();
        return view('admin.posts.edit', ['title' => 'Edit Post','dp_category'=>$dp_category,'dp_tags'=>$dp_tags,'data' => $data[0]]);
    }

    /*
      |--------------------------------------------------------------------------
      | Edit Record
      |--------------------------------------------------------------------------
     */

    public function edit_save(Request $request) {

        if ($request->_token) {
			
			$image_name = '';
			
			
			/*$image_name = '';
			$file = $request->image;
			if($file){
			$ext = $file->getClientOriginalExtension();
			$file = $request->image->getClientOriginalName();
			$image_name = rand(11111,99999).'_'.str_replace(' ','-',strtolower($file));//uniqid() . '.' . $ext;
			$path_uploads = 'public/upload/post/';
			$request->image->move($path_uploads, $image_name);
			
			$resizeObj = new Resize($path_uploads.$image_name);
			$resizeObj->resizeImage(770, 309, 'exact');
			$resizeObj->saveImage($path_uploads.'thumbs/'.$image_name, 100);
			
			$resizeObj->resizeImage(370, 220, 'exact');
			$resizeObj->saveImage($path_uploads.'small/'.$image_name, 100);
			
			$resizeObj->resizeImage(80, 80, 'exact');
			$resizeObj->saveImage($path_uploads.'mini/'.$image_name, 100);
			
			}*/
			
			$image_name = '';
			$file = $request->image;
			if($file){
			$ext = $file->getClientOriginalExtension();
			$file = $request->image->getClientOriginalName();
			$image_name = rand(11111,99999).'_'.str_replace(' ','-',strtolower($file));// uniqid() . '.' . $ext;
			$path_uploads = 'public/upload/post/';
			$request->image->move($path_uploads, $image_name);
			}
			
			$image_2 = '';
			$file_2 = $request->image_2;
			if($file_2){
			$ext = $file_2->getClientOriginalExtension();
			$file_2 = $request->image_2->getClientOriginalName();
			$image_2 = rand(11111,99999).'_'.str_replace(' ','-',strtolower($file_2));//uniqid() . '.' . $ext;
			$path_uploads = 'public/upload/post/';
			$request->image_2->move($path_uploads, $image_2);
			}
			
			$image_name_2 = '';
			$file_2 = $request->banner;
			if($file_2){
			$ext = $file_2->getClientOriginalExtension();
			$file_2 = $request->banner->getClientOriginalName();
			$image_name_2 = rand(11111,99999).'_'.str_replace(' ','-',strtolower($file_2)); //uniqid() . '.' . $ext;
			$path_uploads = 'public/upload/post/';
			$request->banner->move($path_uploads, $image_name_2);
			}
			
            $model = Posts::find($request->id);
			$model->category = (is_array($request->c_id)>0)?implode(',',$request->c_id):'';
			$model->tags = (is_array($request->t_id)>0)?implode(',',$request->t_id):'';
            $model->heading = $request->name;
			$model->banner_heading = $request->banner_heading;
			$model->sub_heading = $request->sub_heading;
			$model->post_by = $request->post_by;
			$model->slug = Common::slug($request->name);
			
			$model->Contents = $request->short_contents;
			$model->FullContents = $request->contents;
			$model->Title = $request->meta_title;
			$model->Keywords = $request->meta_keyword;
			$model->Description = $request->meta_description;
			if($image_name!=""){
			$model->image = $image_name;
			}
			if($image_2!=""){
			$model->image_2 = $image_2;
			}
			if($image_name_2!=""){
			$model->banner = $image_name_2;
			}
			
            $model->save();
			return Redirect::to('/admin/posts');
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
			 $model = Posts::find($request->id);
            if ($model->status == 'Yes') {
                $set_status = 'No';
                $html = '<a style="text-decoration:none;" href="javascript:void(0)" 
				onclick="change_status(' . $request->id . ',\''.url('/').'/admin/posts/status\')" ><span  class="label label-default" data-title="Inctive"  ><i class="fa fa-ban"></i> Inctive</span></a>';
            } else {
                $set_status = 'Yes';
                $html = '<a style="text-decoration:none;" href="javascript:void(0)" onclick="change_status(' . $request->id . ',\''.url('/').'/admin/posts/status\')" ><span  class="label label-success " data-title="Active"  ><i class="fa fa-check"></i> Active</span></a>';
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
			 $model = Posts::find($request->id);
            if ($model->is_popular == 'Yes') {
                $set_status = 'No';
                $html = '<a style="text-decoration:none;" href="javascript:void(0)" onclick="change_status_header(' . $request->id . ',\''.url('/').'/admin/posts/statusfeatured\')" ><span  class="label label-default" data-title="No"  ><i class="fa fa-ban"></i> No</span></a>';
            } else {
                $set_status = 'Yes';
                $html = '<a style="text-decoration:none;" href="javascript:void(0)" onclick="change_status_header(' . $request->id . ',\''.url('/').'/admin/posts/statusfeatured\')" ><span  class="label label-success " data-title="Yes"  ><i class="fa fa-check"></i> Yes</span></a>';
            }
            $model->is_popular = $set_status;
            $model->save();
            return Response::json(array('error_code' => 0, 'status' => 'success', 'html' => $html));
        } else {
            return Response::json(array('error_code' => 1, 'status' => 'fail', 'message' => 'Invalid Access'));
        }
    }
	
	public function statusrecent(Request $request) {

        if ($request->_token) {
			 $model = Posts::find($request->id);
            if ($model->is_recent == 'Yes') {
                $set_status = 'No';
                $html = '<a style="text-decoration:none;" href="javascript:void(0)" onclick="change_status_footer(' . $request->id . ',\''.url('/').'/admin/posts/statusrecent\')" ><span  class="label label-default" data-title="No"  ><i class="fa fa-ban"></i> No</span></a>';
            } else {
                $set_status = 'Yes';
                $html = '<a style="text-decoration:none;" href="javascript:void(0)" onclick="change_status_footer(' . $request->id . ',\''.url('/').'/admin/posts/statusrecent\')" ><span  class="label label-success " data-title="Yes"  ><i class="fa fa-check"></i> Yes</span></a>';
            }
            $model->is_recent = $set_status;
            $model->save();
            return Response::json(array('error_code' => 0, 'status' => 'success', 'html' => $html));
        } else {
            return Response::json(array('error_code' => 1, 'status' => 'fail', 'message' => 'Invalid Access'));
        }
    }
	
	public function statuslisting(Request $request) {

        if ($request->_token) {
			 $model = Posts::find($request->id);
            if ($model->is_listing == 'Yes') {
                $set_status = 'No';
                $html = '<a style="text-decoration:none;" href="javascript:void(0)" onclick="change_status_quick(' . $request->id . ',\''.url('/').'/admin/posts/statuslisting\')" ><span  class="label label-default" data-title="No"  ><i class="fa fa-ban"></i> No</span></a>';
            } else {
                $set_status = 'Yes';
                $html = '<a style="text-decoration:none;" href="javascript:void(0)" onclick="change_status_quick(' . $request->id . ',\''.url('/').'/admin/posts/statuslisting\')" ><span  class="label label-success " data-title="Yes"  ><i class="fa fa-check"></i> Yes</span></a>';
            }
            $model->is_listing = $set_status;
            $model->save();
            return Response::json(array('error_code' => 0, 'status' => 'success', 'html' => $html));
        } else {
            return Response::json(array('error_code' => 1, 'status' => 'fail', 'message' => 'Invalid Access'));
        }
    }

}
