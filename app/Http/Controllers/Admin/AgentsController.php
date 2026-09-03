<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use View;
use Hash;
use App\Model\Agents;
use App\Model\UserPlans;
use App\Model\Plans;
use App\Model\Common;
use App\Model\Modules;
use App\Model\Resize;
use App\Model\Emailque;
use App\Model\Setting;
use Session;
use Redirect;
use Response;
use URL;
class AgentsController extends Controller {
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
		if(!Modules::permissions('agents')){
			Redirect::to('admin/dashboard')->send();
		}
		
		$result_dp = Agents::whereRaw('role_id=2 OR role_id=1' )->get()->toArray();
		
        return view('admin.agents.index', ['title' => 'Agents','result_dp'=>$result_dp]);
    }
	
	public function listing(Request $request){
		$aColumns = array( 1=>'id', 2=>'email', 3=>'name', 4=>'phone');
		$sLimit = "";
		$limit1 = false;
		$limit2 = 0;
		if ( isset( $request->iDisplayStart ) && $request->iDisplayLength != '-1' )
		{
			$sLimit = "LIMIT ".htmlentities($request->iDisplayStart, ENT_QUOTES, "UTF-8").", ".
				htmlentities($request->iDisplayLength, ENT_QUOTES, "UTF-8");
			
			$limit2 = htmlentities($request->iDisplayStart, ENT_QUOTES, "UTF-8");
			$limit1 = htmlentities($request->iDisplayLength, ENT_QUOTES, "UTF-8");
		}else {
			$request->iDisplayStart = $limit2 = 0;	
			$request->iDisplayLength = $limit1 =  50;
			$request->sEcho = 2;
			
		}
		
		if ( isset( $request->iSortCol_0 ) )
		{
			$sOrder = "";
			for ( $i=0 ; $i<intval( $request->iSortingCols ) ; $i++ )
			{
				if ( $_REQUEST[ 'bSortable_'.intval($_REQUEST['iSortCol_'.$i]) ] == "true" )
				{
					 $sOrder .= $aColumns[ intval( $_REQUEST['iSortCol_'.$i] ) ]."
						".htmlentities($_REQUEST['sSortDir_'.$i], ENT_QUOTES, "UTF-8") .", ";
				}
			}
			
			$sOrder = substr_replace( $sOrder, "", -2 );
			if ( $sOrder == "" )
			{
				$sOrder = false;
			}
			
		}
		
		$sWhere = "";
		if ( isset($request->sAction) &&  $request->sAction == "filter" )
		{
			$sWhere .= "  AND  (";
			for ( $i=1 ; $i<=count($aColumns) ; $i++ )
			{
				$sWhere .= " ".$aColumns[$i]."  LIKE '%".htmlentities($request->name, ENT_QUOTES, "UTF-8")."%' OR ";
			}
			$sWhere = substr_replace( $sWhere, "", -3 );
			$sWhere .= ')';
		}
		
		
		
		$data_provider = Agents::whereRaw(" 1=1 AND (role_id=2 OR role_id=1)  ".$sWhere." ")->skip($limit2)->take($limit1)->orderBy('id','DESC')->get()->toArray();
		
	    $data_count = Agents::whereRaw(" 1=1 AND (role_id=2 OR role_id=1) ".$sWhere." ")->count();
		
		
		$iTotalRecords = $data_count;
		$iDisplayLength = intval($request->iDisplayLength);
		$iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength; 
		$iDisplayStart = intval($request->iDisplayStart);
		$sEcho = intval($request->sEcho);
		$records = array();
  		$records["aaData"] = array(); 

  		$end = $iDisplayStart + $iDisplayLength;
  		$end = $end > $iTotalRecords ? $iTotalRecords : $end;
		
		if($data_provider){
		
		foreach ($data_provider as $row) {
			
				if ($row['status'] == 'Yes') {
                                $status = '<a style="text-decoration:none;" href="javascript:void(0)" onclick="change_status(' . $row['id'] . ',\''.url('/').'/admin/agents/status\')" ><span  class="label label-success " data-title="Active"  ><i class="fa fa-check"></i> Active</span></a>';
                            } else {
                                $status = '<a style="text-decoration:none;" href="javascript:void(0)" onclick="change_status(' . $row['id'] . ',\''.url('/').'/admin/agents/status\')" ><span  class="label label-default" data-title="Inctive"  ><i class="fa fa-ban"></i> Inctive</span></a>';
                            }
							
				if ($row['is_featured'] == 'Yes') {
                                $status_featured = '<a style="text-decoration:none;" href="javascript:void(0)" onclick="change_status_header(' . $row['id'] . ',\''.url('/').'/admin/agents/statusfeatured\')" ><span  class="label label-success " data-title="Yes"  ><i class="fa fa-check"></i> Yes</span></a>';
                            } else {
                                $status_featured = '<a style="text-decoration:none;" href="javascript:void(0)" onclick="change_status_header(' . $row['id'] . ',\''.url('/').'/admin/agents/statusfeatured\')" ><span  class="label label-default" data-title="No"  ><i class="fa fa-ban"></i> No</span></a>';
                            }			
							
				 if($row['image']!="") {
					 $image = '<img src="'.url('/') . '/public/upload/agents/' . $row['image'].'" height="50"  />';
					}else { 
					$image = '<img src="'.url('/') . '/public/upload/agents/default.jpg'.'" height="50"  />';
					} 
					
				if ($row['role_id'] == 1) {
					$role_id = 'Agency';
				} else {
					$role_id = 'Agent';
				}	
				
				$mantis_sync = '';
				if ($row['mantis_api_key'] != '') {
					$mantis_sync = '<br><span id="id_sync_loading" style="display:none;"><img  src="'.url('/').'/public/assets/images/loading_small.gif"></span><br><a id="id_sync_button" style="text-decoration:none;" href="javascript:void(0)" onclick="syn_property(' . $row['id'] . ')" ><span  class="label label-success "   > Sync Properties</span></a>';
				} 
					
				
				$actions = '';
				$actions .= '<a href="'.URL::to('/admin/agents/edit/' . md5($row['id'])).'"><button type="button" class="btn btn-primary btn-xs" data-title="Edit"  ><i class="fa fa-pencil"></i> </button></a> &nbsp; 
					<a href="'.URL::to('/admin/agents/packages/' . md5($row['id'])).'"><button type="button" class="btn btn-success btn-xs" data-title="Invoices"  ><i class="fa fa-money"></i> </button></a>
				
				';
				
				
                                   
									if(Session::get('admin_id')==1){
									
               $actions .= '&nbsp; <a onclick="delete_record(\''.md5($row['id']).'\')"  href="javascript:void(0)" ><button type="button" class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" ><i class="fa fa-trash"></i> </button></a>';
									}
                                   
				
		
				$records["aaData"][] = array(
				'<input type="checkbox" name="id[]" value="'.$row['id'].'">',
				  
				  $row['id'],
				  $image,
				  $row['name'],
				  $row['phone'],
				  $row['email'],
				  $status,
				  $status_featured,
				  $role_id.$mantis_sync,
				 $actions		
			   );
 		 }
		}
		
		if (isset($_REQUEST["sAction"]) && $_REQUEST["sAction"] == "group_action") {
			 		$ids_array = $_REQUEST["id"];
					if($_REQUEST['sGroupActionName']=='DELETE') {
					  	for($i=0;$i<count($ids_array);$i++) {
							$this->actionGroupDelete($ids_array[$i]);
						}
					}else {
					  	for($i=0;$i<count($ids_array);$i++) {
							$this->actionGroupStatus($ids_array[$i],$_REQUEST['sGroupActionName']);
						}
					}
			 	 $records["sStatus"] = "OK"; // pass custom message(useful for getting status of group actions)
   				 $records["sMessage"] = "Group action successfully has been completed"; // pass custom message(useful for getting status of group actions)
 		 }
		
		  $records["sEcho"] = $sEcho;
		  $records["iTotalRecords"] = $iTotalRecords;
		  $records["iTotalDisplayRecords"] = $iTotalRecords;
		  echo json_encode($records);
	}
	
	//----------------------------------------------------
		public function actionGroupStatus($id,$status){
		    $model = Agents::find($id);
			$model->status = $status;
            $model->save();
		   return true;
		}
		//----------------------------------------------------
		public function actionGroupDelete($id){
		   Agents::whereRaw('id = ? ', array($id))->delete();
		   return true;
		}
	
	public function export(){
		$fileName = "agents_data_" . date('Ymd') . ".xlsx"; 
		
		$fields = array('Name', 'Email','Phone'); 
		
		$excelData = implode("\t", array_values($fields)) . "\n"; 
		
		$result_dp = Agents::whereRaw('role_id=2')->get()->toArray();
		
		foreach ($result_dp as $row){
			$rowData = array($row['name'], $row['email'], str_replace('-','',$row['phone']));
			$excelData .= implode("\t", array_values($rowData)) . "\n";  
		}
		
		// Headers for download 
		header("Content-Disposition: attachment; filename=\"$fileName\""); 
		header("Content-Type: application/vnd.ms-excel"); 
		 
		// Render excel data 
		echo $excelData; 
		 
		exit;
 
	}

    /*
      |--------------------------------------------------------------------------
      | Page Add
      |--------------------------------------------------------------------------
     */

    public function create() {
       return view('admin.agents.add', ['title' => 'Add User']);
    }

    /*
      |--------------------------------------------------------------------------
      | Admin Login Auth
      |--------------------------------------------------------------------------
     */

    public function create_save(Request $request) {
        if ($request->_token) {
			
			$check_client = Agents::whereRaw('email = ?  ', array($request->email))->get()->toArray();
			
			if(count($check_client)==0) {
				
				
			$image_name = '';
			$file = $request->image;
			if($file){
			$ext = $file->getClientOriginalExtension();
			$file = $request->image->getClientOriginalName();
			$image_name = rand(11111,99999).'_'.str_replace(' ','-',strtolower($file));
			$path_uploads = 'public/upload/agents/';
			$request->image->move($path_uploads, $image_name);
			
			//$resizeObj = new Resize($path_uploads.$image_name);
			//$resizeObj->resizeImage(200, 250, 'auto');
			//$resizeObj->saveImage($path_uploads.'thumbs/'.$image_name, 100);
			
			}
			
			$logo_name = '';
			$file_logo = $request->logo;
			if($file_logo){
			$ext = $file_logo->getClientOriginalExtension();
			$file_logo = $request->logo->getClientOriginalName();
			$logo_name = rand(11111,99999).'_'.str_replace(' ','-',strtolower($file_logo));
			$path_uploads = 'public/upload/agents/';
			$request->logo->move($path_uploads, $logo_name);
			}
			
			
			$banner_name = '';
			$file_banner = $request->banner;
			if($file_banner){
			$ext = $file_banner->getClientOriginalExtension();
			$file_banner = $request->banner->getClientOriginalName();
			$banner_name = rand(11111,99999).'_'.str_replace(' ','-',strtolower($file_banner));
			$path_uploads = 'public/upload/agents/';
			$request->banner->move($path_uploads, $banner_name);
			}
			
			
            $model = new Agents();
			
			$model->role_id = $request->role_id;
			$model->name = $request->name;
			$model->phone = $request->phone;
			$model->location = $request->location;
			$model->address = $request->address;
			$model->designation = $request->designation;
			$model->experience = $request->experience;
			$model->post_code = $request->post_code;
			$model->map_link = $request->map_link;
			$model->video_link = $request->video_link;
			$model->full_contents = $request->full_contents;
			
			$model->license_number = $request->license_number;
			$model->business_phone = $request->business_phone;
			$model->tagline = $request->tagline;
			$model->awards = $request->awards;
			$model->specialities = $request->specialities;
			$model->community_involvement = $request->community_involvement;
			
			$model->fb = $request->fb;
			$model->tw = $request->tw;
			$model->ln = $request->ln;
			$model->tiktok = $request->tiktok;
			$model->instagram = $request->instagram;
			$model->website = $request->website;
			
			$model->mantis_api_key = $request->mantis_api_key;
			$model->mantis_agency_id = $request->mantis_agency_id;
			$model->mantis_allow = $request->mantis_allow;
			$model->mantis_property_types = (is_array($request->mantis_property_types) && count($request->mantis_property_types)>0)?implode(',',$request->mantis_property_types):'';
			
			$model->primary_colour = $request->primary_colour;
			$model->secondary_colour = $request->secondary_colour;
			$model->text_colour = $request->text_colour;
			$model->font_size = $request->font_size;
			
			$model->email = $request->email;
			$model->password = Hash::make($request->password);
			
			
			$model->image = $image_name;
			$model->logo = $logo_name;
			$model->banner = $banner_name;
			
			$model->status = 'Yes';
			$model->created_by = Session::get('admin_id');
			$model->save();
            return Response::json(array('error_code' => 0, 'status' => 'success', 'message' => ''));
			}else {
				return Response::json(array('error_code' => 1, 'status' => 'fail','message' => 'Buyer already exists with this email'));
			}
		  
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

        Agents::whereRaw('md5(id) = ? ', array($id))->delete();
        return Redirect::to('/admin/agents');
    }

    /*
      |--------------------------------------------------------------------------
      | Edit Record
      |--------------------------------------------------------------------------
     */

    public function edit($id) {

        $data = Agents::whereRaw('md5(id) = ?  ', array($id))->get()->toArray();
        return view('admin.agents.edit', ['title' => 'Edit Agents','data' => $data[0]]);
    }

    /*
      |--------------------------------------------------------------------------
      | Edit Record
      |--------------------------------------------------------------------------
     */

   public function edit_save(Request $request) {

        if ($request->_token) {
			
			$check_client = Agents::whereRaw('email = ?  AND id !='.$request->id.' ', array($request->email))->get()->toArray();
			
			if(count($check_client)==0) {
				
				
			
			$image_name = '';
			$file = $request->image;
			if($file){
			$ext = $file->getClientOriginalExtension();
			$file = $request->image->getClientOriginalName();
			$image_name = rand(11111,99999).'_'.str_replace(' ','-',strtolower($file));
			$path_uploads = 'public/upload/agents/';
			$request->image->move($path_uploads, $image_name);
			//$resizeObj = new Resize($path_uploads.$image_name);
			//$resizeObj->resizeImage(200, 250, 'auto');
			//$resizeObj->saveImage($path_uploads.'thumbs/'.$image_name, 100);
			}
			
			$logo_name = '';
			$file_logo = $request->logo;
			if($file_logo){
			$ext = $file_logo->getClientOriginalExtension();
			$file_logo = $request->logo->getClientOriginalName();
			$logo_name = rand(11111,99999).'_'.str_replace(' ','-',strtolower($file_logo));
			$path_uploads = 'public/upload/agents/';
			$request->logo->move($path_uploads, $logo_name);
			}
			
			
			$banner_name = '';
			$file_banner = $request->banner;
			if($file_banner){
			$ext = $file_banner->getClientOriginalExtension();
			$file_banner = $request->banner->getClientOriginalName();
			$banner_name = rand(11111,99999).'_'.str_replace(' ','-',strtolower($file_banner));
			$path_uploads = 'public/upload/agents/';
			$request->banner->move($path_uploads, $banner_name);
			}
			
			
			
			$model = Agents::find($request->id);
			$model->role_id = $request->role_id;
			$model->name = $request->name;
			$model->phone = $request->phone;
			$model->location = $request->location;
			$model->address = $request->address;
			$model->designation = $request->designation;
			$model->experience = $request->experience;
			$model->post_code = $request->post_code;
			$model->map_link = $request->map_link;
			$model->video_link = $request->video_link;
			$model->full_contents = $request->full_contents;
			
			$model->license_number = $request->license_number;
			$model->business_phone = $request->business_phone;
			$model->tagline = $request->tagline;
			$model->awards = $request->awards;
			$model->specialities = $request->specialities;
			$model->community_involvement = $request->community_involvement;
			
			$model->your_suburbs = $request->your_suburbs;
			$model->your_municipalities = $request->your_municipalities;
			
			$model->fb = $request->fb;
			$model->tw = $request->tw;
			$model->ln = $request->ln;
			$model->tiktok = $request->tiktok;
			$model->instagram = $request->instagram;
			$model->website = $request->website;
			
			$model->mantis_api_key = $request->mantis_api_key;
			$model->mantis_agency_id = $request->mantis_agency_id;
			$model->mantis_allow = $request->mantis_allow;
			$model->mantis_property_types = (is_array($request->mantis_property_types) && count($request->mantis_property_types)>0)?implode(',',$request->mantis_property_types):'';
			
			$model->primary_colour = $request->primary_colour;
			$model->secondary_colour = $request->secondary_colour;
			$model->text_colour = $request->text_colour;
			$model->font_size = $request->font_size;
			
			$model->email = $request->email;
			if($request->password!=""){
			$model->password = Hash::make($request->password);
			}
			if($image_name!="") {
			$model->image = $image_name;
			}
			if($logo_name!="") {
			$model->logo = $logo_name;
			}
			if($banner_name!="") {
			$model->banner = $banner_name;
			}
			
			$model->suburb1 = $request->suburb1;
			$model->suburb2 = $request->suburb2;
			$model->suburb3 = $request->suburb3;
			$model->suburb4 = $request->suburb4;
			$model->suburb5 = $request->suburb5;
			$model->suburb6 = $request->suburb6;
			$model->suburb7 = $request->suburb7;
			$model->suburb8 = $request->suburb8;
			$model->suburb9 = $request->suburb9;
			$model->suburb10 = $request->suburb10;
			
			$model->suburb_area = $request->suburb_area;
			$model->state_name = $request->state_name;
			$model->country_name = $request->country_name;
			$model->mailing_address = $request->mailing_address;
			$model->mailing_suburb_area = $request->mailing_suburb_area;
			$model->mailing_post_code = $request->mailing_post_code;
			$model->mailing_state_name = $request->mailing_state_name;
			$model->mailing_country_name = $request->mailing_country_name;
			$model->fax = $request->fax;
			$model->website = $request->website;
			$model->principal_name = $request->principal_name;
			$model->display_email = $request->display_email;
			
			
			
			$model->updated_by = Session::get('admin_id');
            $model->save();
			
            return Response::json(array('error_code' => 0, 'status' => 'success', 'message' => ''));
			
			}else {
				return Response::json(array('error_code' => 1, 'status' => 'fail','message' => 'Buyer already exists with this email'));
			}
			
        } else {
            return Response::json(array('error_code' => 1, 'status' => 'fail', 'message' => 'Invalid Access'));
        }
    }
	
	
	
	 /*
      |--------------------------------------------------------------------------
      | View Record
      |--------------------------------------------------------------------------
     */

    public function view($id) {

        $data = Agents::whereRaw('md5(id) = ?  ', array($id))->get()->toArray();
        return view('admin.agents.view', ['title' => 'View User','data' => $data[0]]);
    }
	
	
	public function bulk_delete(Request $request){
		$arrsy_users = $request->ids;
			if(count($arrsy_users)>0){
			 foreach ($arrsy_users as $id){
				 Agents::whereRaw('id = ? ', array($id))->delete();
			 }
		}
		
		 return Redirect::to('/admin/agents');
	}
	
	/*
      |--------------------------------------------------------------------------
      | Change Record Status
      |--------------------------------------------------------------------------
     */

    public function status(Request $request) {

        if ($request->_token) {
			 $model = Agents::find($request->id);
            if ($model->status == 'Yes') {
                $set_status = 'No';
                $html = '<a style="text-decoration:none;" href="javascript:void(0)" onclick="change_status(' . $request->id . ',\''.url('/').'/admin/agents/status\')" ><span  class="label label-default" data-title="Inctive"  ><i class="fa fa-ban"></i> Inctive</span></a>';
            } else {
                $set_status = 'Yes';
                $html = '<a style="text-decoration:none;" href="javascript:void(0)" onclick="change_status(' . $request->id . ',\''.url('/').'/admin/agents/status\')" ><span  class="label label-success " data-title="Active"  ><i class="fa fa-check"></i> Active</span></a>';
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
			 $model = Agents::find($request->id);
            if ($model->is_featured == 'Yes') {
                $set_status = 'No';
                $html = '<a style="text-decoration:none;" href="javascript:void(0)" onclick="change_status_header(' . $request->id . ',\''.url('/').'/admin/agents/statusfeatured\')" ><span  class="label label-default" data-title="No"  ><i class="fa fa-ban"></i> No</span></a>';
            } else {
                $set_status = 'Yes';
                $html = '<a style="text-decoration:none;" href="javascript:void(0)" onclick="change_status_header(' . $request->id . ',\''.url('/').'/admin/agents/statusfeatured\')" ><span  class="label label-success " data-title="Yes"  ><i class="fa fa-check"></i> Yes</span></a>';
            }
            $model->is_featured = $set_status;
            $model->save();
            return Response::json(array('error_code' => 0, 'status' => 'success', 'html' => $html));
        } else {
            return Response::json(array('error_code' => 1, 'status' => 'fail', 'message' => 'Invalid Access'));
        }
    }
	
	
   //--------------------------------------------------------
	
	public function packages($id) {
		$data = Agents::whereRaw('md5(id) = ?  ', array($id))->first()->toArray();
		$result_dp = UserPlans::whereRaw('user_id  = ?  ', array($data['id']))->get()->toArray();
		
        return view('admin.user_packages.index', ['title' => $data['name'].' Invoices','result_dp'=>$result_dp,'data'=>$data]);
    }
	
	/*
      |--------------------------------------------------------------------------
      | Image Add
      |--------------------------------------------------------------------------
     */

    public function createpackage($id) {
		$data = Agents::whereRaw('md5(id) = ?  ', array($id))->first()->toArray();
		$result_plans = Plans::whereRaw(" status='Yes' ")->get()->toArray();
        return view('admin.user_packages.add', ['title' => 'Add '.$data['name'].' Invoice','data'=>$data,'result_plans'=>$result_plans]);
    }
	
	/*
      |--------------------------------------------------------------------------
      | Edit Logo
      |--------------------------------------------------------------------------
     */

    public function createpackage_save(Request $request) {
			if ($request->_token) {
				
			$image_name = '';
			$file = $request->image;
			if($file){
			$ext = $file->getClientOriginalExtension();
			$file = $request->image->getClientOriginalName();
			$image_name = rand(11111,99999).'_'.str_replace(' ','-',strtolower($file));// uniqid() . '.' . $ext;
			$path_uploads = 'public/upload/invoice/';
			$request->image->move($path_uploads, $image_name);
			}
			
				
			
			$model = new UserPlans();
            $model->user_id 		= $request->user_id;
			$model->package_id 		= 0;
			$model->package_name 	= $request->package_name;
			$model->amount 			=  $request->amount;
			$model->start_date 		= $request->start_date;
			$model->end_date 		= $request->end_date;
			$model->image 		= $image_name;
			$model->status 			= 1;
            $model->save();
			
			return Redirect::intended('admin/agents/packages/'.md5($request->user_id).'');
		}
        	
			
         
    }
	
	public function editpackage($sid,$id) {
		$data = Agents::whereRaw('md5(id) = ?  ', array($sid))->first()->toArray();
		$data_package = UserPlans::whereRaw('md5(id) = ?  ', array($id))->get()->toArray();
		$result_plans = Plans::whereRaw(" status='Yes' ")->get()->toArray();
        return view('admin.user_packages.edit', ['title' => 'edit '.$data['name'].' Invoice','data'=>$data,'result_plans'=>$result_plans,'data_package'=>$data_package[0]]);
    }
	
	public function editpackage_save(Request $request) {
			if ($request->_token) {
			
			$image_name = '';
			$file = $request->image;
			if($file){
			$ext = $file->getClientOriginalExtension();
			$file = $request->image->getClientOriginalName();
			$image_name = rand(11111,99999).'_'.str_replace(' ','-',strtolower($file));// uniqid() . '.' . $ext;
			$path_uploads = 'public/upload/invoice/';
			$request->image->move($path_uploads, $image_name);
			}
			
			$model = UserPlans::find($request->id);
            $model->user_id 		= $request->user_id;
			$model->package_id 		= 0;
			$model->package_name 	= $request->package_name;
			$model->amount 			=  $request->amount;
			$model->start_date 		= $request->start_date;
			$model->end_date 		= $request->end_date;
			if($image_name!=''){
			$model->image 		= $image_name;
			}
            $model->save();
			
			return Redirect::intended('admin/agents/packages/'.md5($request->user_id).'');
		}
        	
			
         
    }
	
	public function packagedelete($id,$sid) {

        UserPlans::whereRaw('md5(id) = ? ', array($sid))->delete();
        return Redirect::to('/admin/agents/packages/'.$id);
    }
	
	
	public function packagestatus(Request $request) {

        if ($request->_token) {
			 $model = UserPlans::find($request->id);
            if ($model->status == 'Yes') {
                $set_status = 'No';
                $html = '<a style="text-decoration:none;" href="javascript:void(0)" onclick="change_status(' . $request->id . ',\''.url('/').'/admin/agents/packagestatus\')" ><span  class="label label-default" data-title="Inctive"  ><i class="fa fa-ban"></i> Inctive</span></a>';
            } else {
                $set_status = 'Yes';
                $html = '<a style="text-decoration:none;" href="javascript:void(0)" onclick="change_status(' . $request->id . ',\''.url('/').'/admin/agents/packagestatus\')" ><span  class="label label-success " data-title="Active"  ><i class="fa fa-check"></i> Active</span></a>';
            }
            $model->status = $set_status;
            $model->save();
			
			
			
            return Response::json(array('error_code' => 0, 'status' => 'success', 'html' => $html));
        } else {
            return Response::json(array('error_code' => 1, 'status' => 'fail', 'message' => 'Invalid Access'));
        }
    }

}
