<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use View;
use Hash;
use App\Model\Leads;
use App\Model\UserPlans;
use App\Model\Plans;
use App\Model\Common;
use App\Model\Modules;
use App\Model\Resize;
use App\Model\Emailque;
use App\Model\Setting;
use App\Model\Property;
use Session;
use Redirect;
use Response;
use URL;
class LeadsController extends Controller {
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
		if(!Modules::permissions('leads')){
			Redirect::to('admin/dashboard')->send();
		}
		
		$result_dp = array(); //Leads::whereRaw('role_id=4' )->get()->toArray();
		
        return view('admin.leads.index', ['title' => 'Leads','result_dp'=>$result_dp]);
    }
	
	public function listing(Request $request){
		$aColumns = array( 1=>'id', 2=>'emailAddress', 3=>'firstName', 4=>'phone');
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
		
		
		
		$data_provider = Leads::whereRaw(" 1=1   ".$sWhere." ")->skip($limit2)->take($limit1)->orderBy('id','DESC')->get()->toArray();
		
	    $data_count = Leads::whereRaw(" 1=1   ".$sWhere." ")->count();
		
		
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
                                $status = '<a style="text-decoration:none;" href="javascript:void(0)" onclick="change_status(' . $row['id'] . ',\''.url('/').'/admin/leads/status\')" ><span  class="label label-success " data-title="Yes"  ><i class="fa fa-check"></i> Yes</span></a>';
                            } else {
                                $status = '<a style="text-decoration:none;" href="javascript:void(0)" onclick="change_status(' . $row['id'] . ',\''.url('/').'/admin/leads/status\')" ><span  class="label label-default" data-title="No"  ><i class="fa fa-ban"></i> No</span></a>';
                            }
							
					
				 
					
				
				$actions = '';
				$list_name = '';
				
				$data_property = Property::whereRaw(" id = ".$row['listing_id']." ")->get()->toArray();
				if(count($data_property)>0){
					$list_name = '<a target="_blank" href="'.url('/').'/detail/'.$data_property[0]['slug'].'-'.$data_property[0]['id'].'" >'.$data_property[0]['name'].'</a> ';
				}
				
				
				
                                   
				if(Session::get('admin_id')==1){
				
$actions .= '&nbsp; <a onclick="delete_record(\''.md5($row['id']).'\')"  href="javascript:void(0)" ><button type="button" class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" ><i class="fa fa-trash"></i> </button></a>';
				}
                                   
				
		
				$records["aaData"][] = array(
				'<input type="checkbox" name="id[]" value="'.$row['id'].'">',
				  
				  $row['id'],
				 
				  $row['firstName'].' '.$row['lastName'],
				  $row['phone'],
				  $row['emailAddress'],
				  $list_name ,
				  $row['notes'],
				  $status,
				  
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
		    $model = Leads::find($id);
			$model->status = $status;
            $model->save();
		   return true;
		}
		//----------------------------------------------------
		public function actionGroupDelete($id){
		   Leads::whereRaw('id = ? ', array($id))->delete();
		   return true;
		}
	
	

    

    public function delete($id) {

        Leads::whereRaw('md5(id) = ? ', array($id))->delete();
        return Redirect::to('/admin/leads');
    }

    
	
	public function bulk_delete(Request $request){
		$arrsy_users = $request->ids;
			if(count($arrsy_users)>0){
			 foreach ($arrsy_users as $id){
				 Leads::whereRaw('id = ? ', array($id))->delete();
			 }
		}
		
		 return Redirect::to('/admin/leads');
	}
	
	/*
      |--------------------------------------------------------------------------
      | Change Record Status
      |--------------------------------------------------------------------------
     */

    public function status(Request $request) {

        if ($request->_token) {
			 $model = Leads::find($request->id);
            if ($model->status == 'Yes') {
                $set_status = 'No';
                $html = '<a style="text-decoration:none;" href="javascript:void(0)" onclick="change_status(' . $request->id . ',\''.url('/').'/admin/leads/status\')" ><span  class="label label-default" data-title="No"  ><i class="fa fa-ban"></i> No</span></a>';
            } else {
                $set_status = 'Yes';
                $html = '<a style="text-decoration:none;" href="javascript:void(0)" onclick="change_status(' . $request->id . ',\''.url('/').'/admin/leads/status\')" ><span  class="label label-success " data-title="Yes"  ><i class="fa fa-check"></i> Yes</span></a>';
            }
            $model->status = $set_status;
            $model->save();
			
			
			
			
			
            return Response::json(array('error_code' => 0, 'status' => 'success', 'html' => $html));
        } else {
            return Response::json(array('error_code' => 1, 'status' => 'fail', 'message' => 'Invalid Access'));
        }
    }
	
	public function export()
{
    $fileName = "leads_data_" . date('Ymd') . ".xls"; // Use .xls instead of .xlsx

    // Set headers for download
    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=\"$fileName\"");
    header("Pragma: no-cache");
    header("Expires: 0");

    // Open output buffer
    $output = fopen("php://output", "w");

    // Column names
    $fields = ['Name', 'Email', 'Phone'];
    fputcsv($output, $fields, "\t");

    // Fetch data
    $result_dp = Leads::all(); // Instead of whereRaw('1=1'), just use all()

    foreach ($result_dp as $row) {
        fputcsv($output, [
            $row->firstName . ' ' . $row->lastName,
            $row->emailAddress,
            str_replace('-', '', $row->phone),
        ], "\t");
    }

    fclose($output);
    exit;
}

}
