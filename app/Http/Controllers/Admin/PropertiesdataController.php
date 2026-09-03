<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use View;
use Hash;
use App\Model\PropertyData;

use App\Model\Common;
use App\Model\Modules;

use App\Model\Setting;
use Session;
use Redirect;
use Response;
use URL;
class PropertiesdataController extends Controller {
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
		if(!Modules::permissions('propertiesdatadata')){
			Redirect::to('admin/dashboard')->send();
		}
		
        return view('admin.propertiesdata.index', ['title' => 'Properties']);
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
		
		
		
		$data_provider = PropertyData::whereRaw(" 1=1  ".$sWhere."  ")->skip($limit2)->take($limit1)->orderBy('id','DESC')->get();
		
	    $data_count = PropertyData::whereRaw(" 1=1  ".$sWhere." ")->count();
		
		
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
			
				if ($row->status == 'Yes') {
                                $status = '<a style="text-decoration:none;" href="javascript:void(0)" onclick="change_status(' . $row->id . ',\''.url('/').'/admin/propertiesdata/status\')" ><span  class="label label-success " data-title="Active"  ><i class="fa fa-check"></i> Active</span></a>';
                            } else {
                                $status = '<a style="text-decoration:none;" href="javascript:void(0)" onclick="change_status(' . $row->id . ',\''.url('/').'/admin/propertiesdata/status\')" ><span  class="label label-default" data-title="Inctive"  ><i class="fa fa-ban"></i> Inctive</span></a>';
                            }
							
				if ($row->is_processed == 'Yes') {
                                $status_featured = '<a style="text-decoration:none;" href="javascript:void(0)" onclick="change_status_header(' . $row->id . ',\''.url('/').'/admin/propertiesdata/statusfeatured\')" ><span  class="label label-success " data-title="Yes"  ><i class="fa fa-check"></i> Yes</span></a>';
                            } else {
                                $status_featured = '<a style="text-decoration:none;" href="javascript:void(0)" onclick="change_status_header(' . $row->id . ',\''.url('/').'/admin/propertiesdata/statusfeatured\')" ><span  class="label label-default" data-title="No"  ><i class="fa fa-ban"></i> No</span></a>';
                            }
							
					
					
				
				$actions = '';
				$actions .= '<a href="'.URL::to('/admin/propertiesdata/view/' . md5($row->id)).'"><button type="button" class="btn btn-info btn-xs" data-title="View"  ><i class="fa fa-eye"></i> </button></a> &nbsp; 
					
				
				';
				
				
                                   
				if(Session::get('admin_id')==1){
									
               $actions .= '&nbsp; <a onclick="delete_record(\''.md5($row->id).'\')"  href="javascript:void(0)" ><button type="button" class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" ><i class="fa fa-trash"></i> </button></a>';
				}
                                   
				$name = $row->name;
				if(strlen($row->name)>50){
					$name = '<span title="'.str_replace('"','',$row->name).'">'.substr($row->name,0,30).'...</span>';
				}
				
				$name = '<a href="'.url('/').'/view/'.$row->slug.'.html" target="_blank">'.$name.'</a>';
		
				$records["aaData"][] = array(
				'<input type="checkbox" name="id[]" value="'.$row->id.'">',
				  
				  $row->id,
				 
				  $name,
				  str_replace('_',' ',$row->tag_line),
				  $row->property_type,
				  
				  $status,
				  $status_featured,
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
		    $model = PropertyData::find($id);
			$model->status = $status;
            $model->save();
		   return true;
		}
		//----------------------------------------------------
		public function actionGroupDelete($id){
		   PropertyData::whereRaw('id = ? ', array($id))->delete();
		   return true;
		}
	

   
	
	/*
      |--------------------------------------------------------------------------
      | Delete Record
      |--------------------------------------------------------------------------
     */

    public function delete($id) {

        Properties::whereRaw('md5(id) = ? ', array($id))->delete();
        return Redirect::to('/admin/propertiesdata');
    }

    
	
	 /*
      |--------------------------------------------------------------------------
      | View Record
      |--------------------------------------------------------------------------
     */

    public function view($id) {

        $data = PropertyData::whereRaw('md5(id) = ?  ', array($id))->get();
        return view('admin.propertiesdata.view', ['title' => 'View Detail','row' => $data[0]]);
    }
	
	
	public function bulk_delete(Request $request){
		$arrsy_users = $request->ids;
			if(count($arrsy_users)>0){
			 foreach ($arrsy_users as $id){
				 PropertyData::whereRaw('id = ? ', array($id))->delete();
			 }
		}
		
		 return Redirect::to('/admin/propertiesdata');
	}
	
	/*
      |--------------------------------------------------------------------------
      | Change Record Status
      |--------------------------------------------------------------------------
     */

    public function status(Request $request) {

        if ($request->_token) {
			 $model = PropertyData::find($request->id);
            if ($model->status == 'Yes') {
                $set_status = 'No';
                $html = '<a style="text-decoration:none;" href="javascript:void(0)" onclick="change_status(' . $request->id . ',\''.url('/').'/admin/propertiesdata/status\')" ><span  class="label label-default" data-title="Inctive"  ><i class="fa fa-ban"></i> Inctive</span></a>';
            } else {
                $set_status = 'Yes';
                $html = '<a style="text-decoration:none;" href="javascript:void(0)" onclick="change_status(' . $request->id . ',\''.url('/').'/admin/propertiesdata/status\')" ><span  class="label label-success " data-title="Active"  ><i class="fa fa-check"></i> Active</span></a>';
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
			 $model = PropertyData::find($request->id);
            if ($model->is_processed == 'Yes') {
                $set_status = 'No';
                $html = '<a style="text-decoration:none;" href="javascript:void(0)" onclick="change_status_header(' . $request->id . ',\''.url('/').'/admin/propertiesdata/statusfeatured\')" ><span  class="label label-default" data-title="No"  ><i class="fa fa-ban"></i> No</span></a>';
            } else {
                $set_status = 'Yes';
                $html = '<a style="text-decoration:none;" href="javascript:void(0)" onclick="change_status_header(' . $request->id . ',\''.url('/').'/admin/propertiesdata/statusfeatured\')" ><span  class="label label-success " data-title="Yes"  ><i class="fa fa-check"></i> Yes</span></a>';
            }
            $model->is_processed = $set_status;
            $model->save();
            return Response::json(array('error_code' => 0, 'status' => 'success', 'html' => $html));
        } else {
            return Response::json(array('error_code' => 1, 'status' => 'fail', 'message' => 'Invalid Access'));
        }
    }
	
	
	
	
   
}
