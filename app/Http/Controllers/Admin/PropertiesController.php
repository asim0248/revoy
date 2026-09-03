<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use View;
use Hash;
use App\Model\Property;
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
class PropertiesController extends Controller {
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
		if(!Modules::permissions('properties')){
			Redirect::to('admin/dashboard')->send();
		}
		
        return view('admin.properties.index', ['title' => 'Properties']);
    }
	
	public function listing(Request $request){
		$aColumns = array( 1=>'id', 2=>'name');
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
		
		
		
		$data_provider = Property::whereRaw(" 1=1  ".$sWhere."  ")->skip($limit2)->take($limit1)->orderBy('id','DESC')->get();
		//$data_provider = Property::whereRaw(" 1=1  ".$sWhere." AND id !=51 ")->take(2)->orderBy('id','DESC')->get();
		//echo '<pre>'; print_r($data_provider); exit;
	    $data_count = Property::whereRaw(" 1=1  ".$sWhere." ")->count();
		
		
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
			
				if ($row->admin_status == 'Yes') {
                                $status = '<a style="text-decoration:none;" href="javascript:void(0)" onclick="change_status(' . $row->id . ',\''.url('/').'/admin/properties/status\')" ><span  class="label label-success " data-title="Active"  ><i class="fa fa-check"></i> Active</span></a>';
                            } else {
                                $status = '<a style="text-decoration:none;" href="javascript:void(0)" onclick="change_status(' . $row->id . ',\''.url('/').'/admin/properties/status\')" ><span  class="label label-default" data-title="Inctive"  ><i class="fa fa-ban"></i> Inctive</span></a>';
                            }
							
				if ($row->is_featured == 'Yes') {
                                $status_featured = '<a style="text-decoration:none;" href="javascript:void(0)" onclick="change_status_header(' . $row->id . ',\''.url('/').'/admin/properties/statusfeatured\')" ><span  class="label label-success " data-title="Yes"  ><i class="fa fa-check"></i> Yes</span></a>';
                            } else {
                                $status_featured = '<a style="text-decoration:none;" href="javascript:void(0)" onclick="change_status_header(' . $row->id . ',\''.url('/').'/admin/properties/statusfeatured\')" ><span  class="label label-default" data-title="No"  ><i class="fa fa-ban"></i> No</span></a>';
                            }
							
					if ($row->is_new == 'Yes') {
                                $status_new = '<a style="text-decoration:none;" href="javascript:void(0)" onclick="change_status_footer(' . $row->id . ',\''.url('/').'/admin/properties/statusnew\')" ><span  class="label label-success " data-title="Yes"  ><i class="fa fa-check"></i> Yes</span></a>';
                            } else {
                                $status_new = '<a style="text-decoration:none;" href="javascript:void(0)" onclick="change_status_footer(' . $row->id . ',\''.url('/').'/admin/properties/statusnew\')" ><span  class="label label-default" data-title="No"  ><i class="fa fa-ban"></i> No</span></a>';
                            }					
							
				   if($row->image!="") {
					 $image = '<img src="'.url('/') . '/public//upload/property/'.$row->id.'/' . $row->image.'" height="50"  />';
					}else { 
					$image = '';
					} 
					
				$property_type = isset($row->property_type->name)?$row->property_type->name:'';
				$property_option = isset($row->property_option->name)?'<br>('.$row->property_option->name.')':'';
				$by = isset($row->agent->name)?$row->agent->name:'';
					
				
				$actions = '';
				$actions .= '<a href="'.URL::to('/admin/properties/view/' . md5($row->id)).'"><button type="button" class="btn btn-info btn-xs" data-title="View"  ><i class="fa fa-eye"></i> </button></a> &nbsp; 
					
				
				';
				
				
                                   
				if(Session::get('admin_id')==1){
									
               $actions .= '&nbsp; <a onclick="delete_record(\''.md5($row->id).'\')"  href="javascript:void(0)" ><button type="button" class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" ><i class="fa fa-trash"></i> </button></a>';
				}
                                   
				$name = $row->name;
				if(strlen($row->name)>35){
					$name = '<span title="'.str_replace('"','',$row->name).'">'.substr($row->name,0,20).'...</span>';
				}
		
				$records["aaData"][] = array(
				'<input type="checkbox" name="id[]" value="'.$row->id.'">',
				  
				  $row->id,
				  $image,
				  $name,
				  $property_type.$property_option,
				  $row->package_name,
				  $by,
				  $status,
				  $status_featured,
				  $status_new,
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
		    $model = Property::find($id);
			$model->admin_status = $status;
            $model->save();
		   return true;
		}
		//----------------------------------------------------
		public function actionGroupDelete($id){
		   Property::whereRaw('id = ? ', array($id))->delete();
		   return true;
		}
	

   
	
	/*
      |--------------------------------------------------------------------------
      | Delete Record
      |--------------------------------------------------------------------------
     */

    public function delete($id) {

        Properties::whereRaw('md5(id) = ? ', array($id))->delete();
        return Redirect::to('/admin/properties');
    }

    /*
      |--------------------------------------------------------------------------
      | Edit Record
      |--------------------------------------------------------------------------
     */

    public function edit($id) {

        $data = Properties::whereRaw('md5(id) = ?  ', array($id))->get()->toArray();
        return view('admin.properties.edit', ['title' => 'Edit Properties','data' => $data[0]]);
    }

    /*
      |--------------------------------------------------------------------------
      | Edit Record
      |--------------------------------------------------------------------------
     */

   public function edit_save(Request $request) {

        if ($request->_token) {
			
			
			
			
			
			
        } else {
            return Response::json(array('error_code' => 1, 'status' => 'fail', 'message' => 'Invalid Access'));
        }
    }
	
	
	 public function edit_settings(Request $request) {

        if ($request->_token) {
			
			
			
			$model = Property::find($request->id);
			$model->package_id = $request->package_id;
			$model->display_start_date = $request->display_start_date;
			$model->display_end_date = $request->display_end_date;
			//$model->updated_by = Session::get('admin_id');
            $model->save();
			
            return Response::json(array('error_code' => 0, 'status' => 'success', 'message' => 'Data has been updated successfully'));
			
			
			
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

        $data = Property::whereRaw('md5(id) = ?  ', array($id))->get();
        return view('admin.properties.view', ['title' => 'View Detail','row' => $data[0]]);
    }
	
	
	public function bulk_delete(Request $request){
		$arrsy_users = $request->ids;
			if(count($arrsy_users)>0){
			 foreach ($arrsy_users as $id){
				 Property::whereRaw('id = ? ', array($id))->delete();
			 }
		}
		
		 return Redirect::to('/admin/properties');
	}
	
	/*
      |--------------------------------------------------------------------------
      | Change Record Status
      |--------------------------------------------------------------------------
     */

    public function status(Request $request) {

        if ($request->_token) {
			 $model = Property::find($request->id);
            if ($model->admin_status == 'Yes') {
                $set_status = 'No';
                $html = '<a style="text-decoration:none;" href="javascript:void(0)" onclick="change_status(' . $request->id . ',\''.url('/').'/admin/properties/status\')" ><span  class="label label-default" data-title="Inctive"  ><i class="fa fa-ban"></i> Inctive</span></a>';
            } else {
                $set_status = 'Yes';
                $html = '<a style="text-decoration:none;" href="javascript:void(0)" onclick="change_status(' . $request->id . ',\''.url('/').'/admin/properties/status\')" ><span  class="label label-success " data-title="Active"  ><i class="fa fa-check"></i> Active</span></a>';
            }
            $model->admin_status = $set_status;
            $model->save();
			
			if($set_status=='Yes' && $model->vendor_email!=''){
				$this->send_vendor_email($request->id);
			}
			
			
			
            return Response::json(array('error_code' => 0, 'status' => 'success', 'html' => $html));
        } else {
            return Response::json(array('error_code' => 1, 'status' => 'fail', 'message' => 'Invalid Access'));
        }
    }
	
	public function send_vendor_email($id){
					
					$row_p = Property::where('id',$id)->first();
					
					if($row_p->send_public_mail_to_vender==1 && $row_p->vendor_email!='') {
		
					$subject = Setting::findByKey('SITE_NAME').' Property Listing Live';
					$subject_header = 'Congratulations Your Property Listing is now live on Our Portal';
					
					$msg = '';
					
					$listing_link = url('/').'/detail/'.$row_p->slug.'-'.$row_p->id.'.html';
					
					$msg = '<div class="mail-cont-ul" style="background-color: #e5e5e5; padding: 40px 0; text-align: center;">
            <p style="font-size: 18px; color: #044235; margin: 0 0 25px 0; padding: 0 10px;">
                Please have a look, and if you have any questions, Please let your agent know.
                Here is the Link Below for your Property.
            </p>
            <a href="'.$listing_link.'" target="_blank" style="text-decoration: none; background-color: #044235; color: #ffc50b; font-size: 16px; font-weight: 600; border-radius: 5px; padding: 10px 20px;">View Your Property</a>
            <div style="margin: 35px auto 0 auto; width: 280px; background-color: #044235; padding: 10px; border-radius: 5px;">
                <img src="'.url('/') . '/public/upload/property/'.$row_p->id.'/'.$row_p->image.'" alt="" width="280px" style="border-radius: 5px;">
                <table style="width: 100%; max-width: 300px; border-collapse: collapse;">
                    <tbody><tr>
                        
                    </tr>
                    <tr style="width: 100%;">
                        <td colspan="4" style=" padding: 10px 0px 0px 10px; text-align: left; font-weight: bold; font-size: 18px; color: #fff;">
                            Contact Agent
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 10px; text-align: left; width: 25%; vertical-align: middle;">
                            <table align="center" style="border-collapse: collapse;">
                                <tbody><tr>
                                    <td style="vertical-align: middle;">
                                        <img src="'.url('/').'/public/assets/main/img/bed-icon.png"
                                        width="25" height="25" alt>  
                                    </td>
                                    <td style="vertical-align: middle; padding-left: 5px;">
                                        <!-- Number -->
                                        <span style="font-size: 18px; font-weight: bold; color: #fff;">'.$row_p->bedrooms.'</span>
                                    </td>
                                </tr>
                            </tbody></table>
                        </td>
            
                        <!-- Second Column: Bathrooms -->
                        <td style="padding: 10px; text-align: center; vertical-align: middle;">
                            <table align="center" style="border-collapse: collapse;">
                                <tbody><tr>
                                    <td style="vertical-align: middle;">
                                        <img src="'.url('/').'/public/assets/main/img/bath-icon.png"
                                        width="25" height="25" alt> 
                                    </td><td style="vertical-align: middle; padding-left: 5px;">
                                        <!-- Number -->
                                        <span style="font-size: 18px; font-weight: bold; color: #fff;">'.$row_p->bathrooms.'</span>
                                    </td>
                                </tr>
                            </tbody></table>
                        </td>
                        <!-- Second Column: Bathrooms -->
                        <td style="padding: 10px; text-align: center; vertical-align: middle;">
                            <table align="center" style="border-collapse: collapse;">
                                <tbody><tr>
                                    <td style="vertical-align: middle;">
                                        <img src="'.url('/').'/public/assets/main/img/car-icon.png"
                                        width="25" height="25" alt> 
                                    </td><td style="vertical-align: middle; padding-left: 5px;">
                                        <!-- Number -->
                                        <span style="font-size: 18px; font-weight: bold; color: #fff;">'.$row_p->garage_spaces.'</span>
                                    </td>
                                </tr>
                            </tbody></table>
                        </td>
                    </tr>
                    <tr style="width: 100%;">
                        <td colspan="4" style=" padding: 0px 10px 10px 10px; text-align: left; color: #fff; font-size: 18px;">
                            '.$row_p->street_address.'
                        </td>
                    </tr>
                </tbody></table>
            
            </div>
        </div>';
	
					$data_email = array('name' => '', 'msg' => $msg,'listing_link'=>$listing_link, 'subject' => $subject_header );
	
					$html_email = view('emails.template',$data_email)->render(); 
					//echo $html_email; exit;
					
					$to_name = Setting::findByKey('SITE_NAME');
					$model_n = new Emailque();
					$model_n->email_type = 'PROPERY_PUBLIC';
					$model_n->to_name =  $row_p->vendor_name;
					$model_n->to_email = $row_p->vendor_email;
					$model_n->from_name = Setting::findByKey('SITE_NAME');
					$model_n->from_email = Setting::findByKey('CONTACT_EMAIL');
					$model_n->subject = $subject;
					$model_n->message = $html_email;
					$model_n->save();
					
					}
		
	}
	
	public function statusfeatured(Request $request) {

        if ($request->_token) {
			 $model = Property::find($request->id);
            if ($model->is_featured == 'Yes') {
                $set_status = 'No';
                $html = '<a style="text-decoration:none;" href="javascript:void(0)" onclick="change_status_header(' . $request->id . ',\''.url('/').'/admin/properties/statusfeatured\')" ><span  class="label label-default" data-title="No"  ><i class="fa fa-ban"></i> No</span></a>';
            } else {
                $set_status = 'Yes';
                $html = '<a style="text-decoration:none;" href="javascript:void(0)" onclick="change_status_header(' . $request->id . ',\''.url('/').'/admin/properties/statusfeatured\')" ><span  class="label label-success " data-title="Yes"  ><i class="fa fa-check"></i> Yes</span></a>';
            }
            $model->is_featured = $set_status;
            $model->save();
            return Response::json(array('error_code' => 0, 'status' => 'success', 'html' => $html));
        } else {
            return Response::json(array('error_code' => 1, 'status' => 'fail', 'message' => 'Invalid Access'));
        }
    }
	
	
	public function statusnew(Request $request) {

        if ($request->_token) {
			 $model = Property::find($request->id);
            if ($model->is_new == 'Yes') {
                $set_status = 'No';
                $html = '<a style="text-decoration:none;" href="javascript:void(0)" onclick="change_status_footer(' . $request->id . ',\''.url('/').'/admin/properties/statusnew\')" ><span  class="label label-default" data-title="No"  ><i class="fa fa-ban"></i> No</span></a>';
            } else {
                $set_status = 'Yes';
                $html = '<a style="text-decoration:none;" href="javascript:void(0)" onclick="change_status_footer(' . $request->id . ',\''.url('/').'/admin/properties/statusnew\')" ><span  class="label label-success " data-title="Yes"  ><i class="fa fa-check"></i> Yes</span></a>';
            }
            $model->is_new = $set_status;
            $model->save();
            return Response::json(array('error_code' => 0, 'status' => 'success', 'html' => $html));
        } else {
            return Response::json(array('error_code' => 1, 'status' => 'fail', 'message' => 'Invalid Access'));
        }
    }
	
   
}
