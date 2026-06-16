<?php namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Model\Common;
use App\Model\Cms;
use App\Model\Setting;
use App\Model\States;
use App\Model\Plans;
use App\Model\Agents;
use App\Model\Property;
use App\Model\Propertyimages;
use App\Model\Propertyinspection;
use App\Model\Propertytypes;
use App\Model\Propertyauthority;
use App\Model\Propertyoptions;
use App\Model\Emailque;
use Session;
use Response;
use Mail;
use URL;
class CronjobController extends Controller {
	/*
	|--------------------------------------------------------------------------
	| Welcome Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders the "marketing page" for the application and
	| is configured to only allow guests. Like most of the other sample
	| controllers, you are free to modify or remove it as you desire.
	|
	*/
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('guest');
	}
	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		
	}
	
	
	/*
      |--------------------------------------------------------------------------
      | Load ajax 
      |--------------------------------------------------------------------------
     */
	 
	  public function pkg_reset_property(){
		  set_time_limit(0);
		ini_set('memory_limit', '-1');
		  echo '<br>Process start<br>';
		  $result_propery = 	Property::whereRaw(" package_id !=1 AND status = 'Yes' AND admin_status='Yes' AND display_start_date !='' AND display_end_date !='' ")->select('id','name','display_start_date','display_end_date')->get()->toArray();
		  
		  if(count($result_propery)>0){
			  $current_date = date('Y-m-d');
			  foreach ($result_propery as $row){
				  $display_end_date = $row['display_end_date'];
				  
				    if ($current_date > $display_end_date) {
						$model = Property::find($row['id']);
						$model->package_id = 1;
						$model->save();
					}
				  
			  }
		  }
		  
		  echo 'Rows Process '.count($result_propery);
		  
		  echo '<br>Process end<br>';
		  
	  }
	  
	  public function send_email_alert() {
		 set_time_limit(0);
		ini_set('memory_limit', '-1');
		$result_dp = Emailque::whereRaw( "email_type != '' ")->take(5)->get()->toArray(); 
		//print_r($result_dp); exit;
		if(count($result_dp)>0){
			Common::overrideMailerConfig();
			foreach ($result_dp as $row){
				
				
			$subject = $row['subject'];
			$msg = $row['message'];
			$to_name = $row['to_name'];
			$to_email = $row['to_email'];
			$from_name = $row['from_name'];
			$from_email = $row['from_email'];
			
            //Common::overrideMailerConfig();
           
            $data_email = array('name' => $to_name, 'msg' => $msg);
            $user_data = array('to' => $to_email, 'name' => $to_name, 'subject' => $subject, 'siteName' => $from_name, 'businessEmail' => $from_email);
			// echo $html_email = view('emails.alerts',$data_email)->render(); exit;
            Mail::send('emails.alerts', $data_email, function($message) use ($user_data) {
                $message->from($user_data['businessEmail'], $user_data['siteName']);
                $message->to($user_data['to'], $user_data['name'])->subject($user_data['subject']);
            });
				
				Emailque::whereRaw("id = ".$row['id']." ")->delete();
				
				sleep(1);
			}
		}
		   
     }
	  
	 
	  public function sync_user_property(Request $request){
		  set_time_limit(0);
		ini_set('memory_limit', '-1');
		$result_dp = Agents::whereRaw( "mantis_api_key!='' AND mantis_agency_id!='' AND mantis_property_types!='' AND id=".$request->id." ")->get()->toArray();
			
			if(count($result_dp)>0){
				$mantis_property_types = array();
			
				foreach ($result_dp as $row_user) { 
					
					$mantis_property_types = explode(',',$row_user['mantis_property_types']);
					//echo '<pre>'; print_r($mantis_property_types); exit;
					if(count($mantis_property_types)>0) {
						
						foreach ($mantis_property_types as $pp_type) {
					
							 $curl = curl_init();
				
							 curl_setopt_array($curl, array(
							  CURLOPT_URL => 'http://api.mantisproperty.com.au/listings?apikey='.$row_user['mantis_api_key'].'&agencyID='.$row_user['mantis_agency_id'].'&listingType='.$pp_type.'&output=json',
							  CURLOPT_RETURNTRANSFER => true,
							  CURLOPT_ENCODING => '',
							  CURLOPT_MAXREDIRS => 10,
							  CURLOPT_TIMEOUT => 0,
							  CURLOPT_FOLLOWLOCATION => true,
							  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
							  CURLOPT_CUSTOMREQUEST => 'GET',
							));
							
							$response = curl_exec($curl);
							curl_close($curl);
							$result_api = json_decode($response,TRUE);
							$listingListArr = array(); 
							//echo '<pre>'; print_r($result_api); exit;
							$listingListArr = $result_api['listingList'];
							if(count($listingListArr)>0){
								$this->process_data($listingListArr,$row_user,$pp_type);
							}
						
						}
					
					}
					
					
				}
				return Response::json(array('error_code' => 0, 'status' => 'success', 'message' => 'Data has been updated successfully.'));
			}else {
				return Response::json(array('error_code' => 0, 'status' => 'error', 'message' => 'Please check settings'));
			}
			
			
		
	  }
	 
	  public function sync_my_property(Request $request){
		  set_time_limit(0);
		ini_set('memory_limit', '-1');
		$result_dp = Agents::whereRaw( "mantis_api_key!='' AND mantis_agency_id!='' AND mantis_property_types!='' AND id=".Session::get('user_id')." ")->get()->toArray();
			
			if(count($result_dp)>0){
				$mantis_property_types = array();
			
				foreach ($result_dp as $row_user) { 
					
					$mantis_property_types = explode(',',$row_user['mantis_property_types']);
					//echo '<pre>'; print_r($mantis_property_types); exit;
					if(count($mantis_property_types)>0) {
						
						foreach ($mantis_property_types as $pp_type) {
					
							 $curl = curl_init();
				
							 curl_setopt_array($curl, array(
							  CURLOPT_URL => 'http://api.mantisproperty.com.au/listings?apikey='.$row_user['mantis_api_key'].'&agencyID='.$row_user['mantis_agency_id'].'&listingType='.$pp_type.'&output=json',
							  CURLOPT_RETURNTRANSFER => true,
							  CURLOPT_ENCODING => '',
							  CURLOPT_MAXREDIRS => 10,
							  CURLOPT_TIMEOUT => 0,
							  CURLOPT_FOLLOWLOCATION => true,
							  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
							  CURLOPT_CUSTOMREQUEST => 'GET',
							));
							
							$response = curl_exec($curl);
							curl_close($curl);
							$result_api = json_decode($response,TRUE);
							$listingListArr = array(); 
							//echo '<pre>'; print_r($result_api); exit;
							$listingListArr = $result_api['listingList'];
							if(count($listingListArr)>0){
								$this->process_data($listingListArr,$row_user,$pp_type);
							}
						
						}
					
					}
					
					
				}
			
				return Response::json(array('error_code' => 0, 'status' => 'success', 'message' => 'Data has been updated successfully.'));
			}else {
				return Response::json(array('error_code' => 0, 'status' => 'error', 'message' => 'Please update profile settings'));
			}
		
	  }
	  
	  
	 
	  public function sync_property(){
		  set_time_limit(0);
		ini_set('memory_limit', '-1');
		$result_dp = Agents::whereRaw( "mantis_api_key!='' AND mantis_agency_id!='' AND mantis_property_types!='' ")->get()->toArray();
			//echo '<pre>'; print_r($result_dp); exit;
			if(count($result_dp)>0){
				$mantis_property_types = array();
			
				foreach ($result_dp as $row_user) { 
					
					$mantis_property_types = explode(',',$row_user['mantis_property_types']);
					//echo '<pre>'; print_r($mantis_property_types); exit;
					if(count($mantis_property_types)>0) {
						
						foreach ($mantis_property_types as $pp_type) {
					
							 $curl = curl_init();
							// echo 'http://api.mantisproperty.com.au/listings?apikey='.$row_user['mantis_api_key'].'&agencyID='.$row_user['mantis_agency_id'].'&listingType='.$pp_type.'&output=json'; exit;
				
							 curl_setopt_array($curl, array(
							  CURLOPT_URL => 'http://api.mantisproperty.com.au/listings?apikey='.$row_user['mantis_api_key'].'&agencyID='.$row_user['mantis_agency_id'].'&listingType='.$pp_type.'&output=json&includeSold=true',
							  CURLOPT_RETURNTRANSFER => true,
							  CURLOPT_ENCODING => '',
							  CURLOPT_MAXREDIRS => 10,
							  CURLOPT_TIMEOUT => 0,
							  CURLOPT_FOLLOWLOCATION => true,
							  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
							  CURLOPT_CUSTOMREQUEST => 'GET',
							));
							
							$response = curl_exec($curl);
							curl_close($curl);
							$result_api = json_decode($response,TRUE);
							$listingListArr = array(); 
							//echo '<pre>'; print_r($result_api); 
							$listingListArr = $result_api['listingList'];
							if(count($listingListArr)>0){
								$this->process_data($listingListArr,$row_user,$pp_type);
							}
						
						}
					
					}
					
					
				}
			}
		
	  }
	  
	  
	  public function process_data($listingListArr,$row_user,$pp_type){
		  set_time_limit(0);
		ini_set('memory_limit', '-1');
		 // echo '<pre>'; print_r($listingListArr);
		 foreach ($listingListArr as $row_api_pro) {
		   // $result_propery = 	Property::whereRaw('property_id = ? AND user_id = ? ', array($row_api_pro['propertyID'],$row_user['id']))->get()->toArray();
		  	$result_propery = 	Property::whereRaw('property_id = ? ', array($row_api_pro['propertyID']))->get()->toArray();
			$category_property = 1;
			if($pp_type=='rent'){
				$category_property = 2;
			}else if($pp_type=='residential'){
				$category_property = 1; //3
			}else if($pp_type=='land'){
				$category_property = 1; //3
			}
			else if($pp_type=='holiday'){
				$category_property = 2;
			}
			else if($pp_type=='commercial'){
				$category_property = 2;
			}
			else if($pp_type=='business'){
				$category_property = 2;
			}else if($pp_type=='rural'){
				$category_property = 2;
			}
			
		  	if(count($result_propery)==0){
				$this->add_data($row_api_pro,$row_user['id'],$category_property);
			}else {
				$this->edit_data($row_api_pro,$row_user['id'],$result_propery[0]['id'],$category_property);
			}
		 
		 }
		 
	  }
	  
	  public function add_data($res_property,$user_id,$category_property){
		  	
		    $model  = new Property();
			$package_name = '';
			$package_id = 1;
			$property_type_id = 0;
			$category_id = $category_property;
			$property_status_type = '';
			$property_authority_id = 0;
			$state_id = 0;
			$sale_user_id = 0;
			
			$package_name = Plans::whereRaw('id = ?  ', array($package_id))->first()->toArray();
			$property_types = Propertytypes::whereRaw("LOWER(name) = '".strtolower($res_property['category1'])."'  ")->get()->toArray();
			if(count($property_types)>0){
				$property_type_id = $property_types[0]['id'];
			}else {
				$model_pt = new Propertytypes();
				$model_pt->name = $res_property['category1'];
				$model_pt->slug = Common::slug($res_property['category1']);
				$model_pt->sort_order = 1;
				$model_pt->status = 'Yes';
				$model_pt->property_options = '1,2,3';
				$model_pt->save();
				$property_type_id = $model_pt->id; 
			}
			if(isset($res_property['authority']) && $res_property['authority']!=''){
				$property_authority = Propertyauthority::whereRaw("LOWER(name) = '".strtolower($res_property['authority'])."'  ")->get()->toArray();
				if(count($property_authority)>0){
					$property_authority_id = $property_authority[0]['id'];
				}else {
					$model_pa = new Propertyauthority();
					$model_pa->name = $res_property['authority'];
					$model_pa->slug = Common::slug($res_property['authority']);
					$model_pa->sort_order = 1;
					$model_pa->status = 'Yes';
					$model_pa->save();
					$property_authority_id =  $model_pa->id; 
				}
			}
			
			$res_states = States::whereRaw("LOWER(name) = '".strtolower($res_property['state'])."'  ")->get()->toArray();
			if(count($res_states)>0){
				$state_id = $res_states[0]['id'];
			}
			
			if(isset($res_property['salesPeople'][0]['email'])){
				$res_agents = Agents::whereRaw("LOWER(email) = '".strtolower($res_property['salesPeople'][0]['email'])."'  ")->get()->toArray();
				if(count($res_agents)>0){
					$sale_user_id = $res_agents[0]['id'];
				}
			}
			
			//  echo '<pre>'; print_r($res_states); exit;
			
			$model->user_id = $sale_user_id;
			$model->agency_id = $user_id;
			$model->property_id = $res_property['propertyID'];
            $model->package_id = $package_id;
            $model->package_name = $package_name['name'];
			$model->category_id = $category_id;
			$model->property_type_id = $property_type_id;
			$model->property_status_type = $property_status_type;
			$model->property_authority = $property_authority_id;
			if(isset($res_property['searchPrice']) && $res_property['searchPrice']!=''){
				//$model->price = isset($res_property['displayPrice'])?(float)str_replace(',','',$res_property['displayPrice']):0;
				$model->price = isset($res_property['searchPrice'])?(float)str_replace(',','',$res_property['searchPrice']):0;
			}else if(isset($res_property['rent']) && $res_property['rent']!=''){
				//$model->price = isset($res_property['rent'])?(float)str_replace(',','',$res_property['rent']):0;
				$model->price = isset($res_property['rent'])?(float)str_replace(',','',$res_property['rent']):0;
			}
			
			$model->show_price = isset($res_property['showPrice'])?$res_property['showPrice']:0;
			//$model->min_price = isset($res_property['searchPrice'])?str_replace(',','',$res_property['searchPrice']):0;
			$model->min_price = isset($res_property['displayPrice'])?$res_property['displayPrice']:'';
			$model->hide_price_show_contact_agent = 0;
			$model->bond = isset($res_property['bond'])?$res_property['bond']:'';
			//--------------------------------------------
			if(isset($res_property['displayPrice']) && trim(strtolower($res_property['displayPrice']))=='sold'){
				$model->category_id = 3;
				$model->sold_date = ($res_property['soldDate']!='')?date('Y-m-d',strtotime($res_property['soldDate'])):NULL;
			}else if(isset($res_property['displayPrice']) && trim(strtolower($res_property['displayPrice']))=='leased'){
				$model->category_id = 4;
				$model->leased_date = ($res_property['soldDate']!='')?date('Y-m-d',strtotime($res_property['soldDate'])):NULL;
			}
			//--------------------------------------------
			//$model->leased_date = '';
			
			$model->vendor_name = '';
			$model->vendor_email = '';
			$model->vendor_phone = '';
			$model->send_public_mail_to_vender = 0;
			$model->send_weekly_mail_to_vender = 0;
			
			$model->address_unit = '';
			$model->street_address = isset($res_property['streetAddress'])?$res_property['streetAddress']:'';
			$model->hide_street_address = ($res_property['showAddress']=='yes')?1:0;
			$model->hide_street_view = ($res_property['showAddress']=='yes')?1:0;
			$model->suburb = isset($res_property['suburb'])?$res_property['suburb']:'';
			$model->state_id = $state_id;
			$model->municipality = isset($res_property['municipality'])?$res_property['municipality']:'';
			$model->auction_result = 'To be determined';
			$model->latitude = isset($res_property['latitude'])?$res_property['latitude']:'';
			$model->longitude = isset($res_property['longitude'])?$res_property['longitude']:'';
			$model->maximum_bid = 0;
			if($res_property['showAddress']=='no'){
				$short_address = '';
				
				if($res_property['suburb']!=''){
					$short_address .= $res_property['suburb'].', ';
				}
				if($res_property['state']!=''){
					$short_address .= $res_property['state'].', ';
				}
				if($res_property['postcode']!=''){
					$short_address .= $res_property['postcode'];
				}
				
				if($res_property['country']!=''){
					//$short_address .= $res_property['country'];
				}
				$model->street_address = $short_address;
			}
			$model->postcode = $res_property['postcode'];
			if($res_property['latitude']=='' && $res_property['longitude']==''){
				$map_key = Setting::findByKey('MAP_KEY');
				
				if($map_key!='' && $model->street_address!=''){
					 $coordinates =  Common::getLatLong($model->street_address.' '.$res_property['suburb'].' '.$res_property['state'].' '.$res_property['postcode'].' Austrila',$map_key);
					 if ($coordinates) {
						 $Latitude = $coordinates['lat'];
						 $Longitude = $coordinates['lng'];
						 $model->latitude = $Latitude;
						 $model->longitude = $Longitude;
						 
					 }
				}
			
			}
			$model->underContract = isset($res_property['underContract'])?$res_property['underContract']:0;
			$model->bedrooms = isset($res_property['bedrooms'])?$res_property['bedrooms']:0;
			$model->bathrooms = isset($res_property['bathrooms'])?$res_property['bathrooms']:0;
			$model->ensuites = 0;
			$model->toilets = 0;
			$model->garage_spaces = isset($res_property['carSpaces'])?$res_property['carSpaces']:0;
			$model->carport_spaces = 0; //isset($res_property['carSpaces'])?$res_property['carSpaces']:'';
			$model->popen_spaces = 0;
			$model->living_areas = '';
			$model->house_size = isset($res_property['houseSize']['value'])?$res_property['houseSize']['value']:'';
			$model->house_size_unit = isset($res_property['houseSize']['unit'])?$res_property['houseSize']['unit']:'';
			
			$model->land_size = isset($res_property['landDetails']['area']['value'])?$res_property['landDetails']['area']['value']:'';
			$model->land_size_unit = $res_property['landDetails']['area']['unit'];
			$model->energy_efficiency_rating = isset($res_property['energyRating'])?$res_property['energyRating']:0;
			if(isset($res_property['featureList'])){
				$featureList = is_array($res_property['featureList'])?$res_property['featureList']:array();
			}else {
				$featureList = array();
			}
			$arr_features = array();
			if(count($featureList)>0){
				foreach ($featureList as $rf){
					$arr_features[] = $rf['name'];
				}
			}
			
			$model->outdoor_features = is_array($arr_features)?implode(',',$arr_features):'';
			$model->indoor_features = '';
			$model->heating_cooling = '';
			$model->eco_friendly_features = '';
			$model->other_features = '';
		
			
			$model->name = str_replace('"','',$res_property['heading']);
			$model->video_url = $res_property['videoLink'];
			$model->map_link_url = '';
			$model->slug =Common::slug($res_property['heading']);
			$model->full_contents = $res_property['description'];
			if(isset($res_property['auctionDateTime']) && $res_property['auctionDateTime']!=''){
				$array_auc = explode(' ',$res_property['auctionDateTime']);
				$date_auc = explode('/',$array_auc[0]);
				$model->auction_date = $date_auc[2].'-'.$date_auc[1].'-'.$date_auc[0];
				$model->auction_time = $array_auc[1].':00';
				$model->auction_location = $res_property['auctionLocation'];
			}
			
			$listingStartDate = str_replace('/','-',$res_property['listingStartDate']);
			
			$model->sort_order = 1;
			$model->published_date = date('Y-m-d H:i:s',strtotime($listingStartDate));
            $model->save();
			$property_id = $model->id;
			//---------------------------------------------------
				$inspection = array();
				if(is_array($res_property['inspections']) && count($res_property['inspections'])>0){
					$inspection = $res_property['inspections'];
				}
				$find = array('AM','PM');
				$rep = array(' AM',' PM');
				
				if(count($inspection)>0){
					foreach ($inspection as $row_ins) { 
						$model_ins = new Propertyinspection();
						$model_ins->property_id = $property_id;
						$model_ins->ins_date = date('Y-m-d',strtotime(str_replace('/','-',$row_ins['day'])));
						$model_ins->ins_start_time = str_replace($find,$rep,$row_ins['startTime']);
						$model_ins->ins_end_time = str_replace($find,$rep,$row_ins['endTime']);
						$model_ins->save();
					}
				}
			//---------------------------------------------------
				$photos_array = array();
				
				$path_uploads = 'public/upload/property/'.$property_id;
				if (!file_exists($path_uploads)) {
					mkdir($path_uploads, 0755, true); // Create the folder with permissions
				}
				
				if(is_array($res_property['photos']) && count($res_property['photos'])>0){
					$photos_array = $res_property['photos'];
				}
				if(count($photos_array)>0){
					foreach ($photos_array as $k=>$row_img) {
					
						$imageUrl = $row_img['fullSize'];
						$originalName = '';
						$temp_name_array = explode('/',$row_img['fullSize']); 
						$originalName = end($temp_name_array);
						//$image_name = rand(11111, 99999) . '_' . str_replace(' ', '-', strtolower($originalName));
						$image_name = $originalName;
						$localPath = 'public/upload/property/'.$property_id.'/'.$image_name;
						if($this->save_img($imageUrl,$localPath)){
							$model_img = new Propertyimages();
							$model_img->image = $image_name;
							$model_img->img_type = 'images';
							$model_img->property_id = $property_id;
							$model_img->save();
							
							if($k==0){
								$model_main  = Property::find($property_id);
								$model_main->image = $image_name;
								$model_main->save();
							}
							
						}
						
					
					}
					
				}
				
				//--------------------------------------------------------------------------
				$photos_array = array();
				if(is_array($res_property['floorPlans']) && count($res_property['floorPlans'])>0){
					$photos_array = $res_property['floorPlans'];
				}
				if(count($photos_array)>0){
					foreach ($photos_array as $row_img) {
					
						$imageUrl = $row_img['fullSize'];
						$originalName = '';
						$temp_name_array = explode('/',$row_img['fullSize']); 
						$originalName = end($temp_name_array);
						$image_name = rand(11111, 99999) . '_' . str_replace(' ', '-', strtolower($originalName));
						$localPath = 'public/upload/property/'.$property_id.'/'.$image_name;
						if($this->save_img($imageUrl,$localPath)){
							$model_img = new Propertyimages();
							$model_img->image = $image_name;
							$model_img->img_type = 'floorplans';
							$model_img->property_id = $property_id;
							$model_img->save();
						}
						
					
					}
					
				}
			
	  }
	  
	  public function edit_data($res_property,$user_id,$property_id,$category_property){
		    $model  = Property::find($property_id);
			$old_status = $model->category_id;
			$package_name = '';
			$package_id = 1;
			$property_type_id = 0;
			$category_id = $category_property;
			$property_status_type = '';
			$property_authority_id = 0;
			$state_id = 0;
			$sale_user_id = 0;
			$property_types = Propertytypes::whereRaw("LOWER(name) = '".strtolower($res_property['category1'])."'  ")->get()->toArray();
			if(count($property_types)>0){
				$property_type_id = $property_types[0]['id'];
			}else {
				$model_pt = new Propertytypes();
				$model_pt->name = $res_property['category1'];
				$model_pt->slug = Common::slug($res_property['category1']);
				$model_pt->sort_order = 1;
				$model_pt->status = 'Yes';
				$model_pt->property_options = '1,2,3';
				$model_pt->save();
				$property_type_id = $model_pt->id; 
			}
			if(isset($res_property['authority']) && $res_property['authority']!=''){
				$property_authority = Propertyauthority::whereRaw("LOWER(name) = '".strtolower($res_property['authority'])."'  ")->get()->toArray();
				if(count($property_authority)>0){
					$property_authority_id = $property_authority[0]['id'];
				}else {
					$model_pa = new Propertyauthority();
					$model_pa->name = $res_property['authority'];
					$model_pa->slug = Common::slug($res_property['authority']);
					$model_pa->sort_order = 1;
					$model_pa->status = 'Yes';
					$model_pa->save();
					$property_authority_id =  $model_pa->id; 
				}
			}
			
			$res_states = States::whereRaw("LOWER(name) = '".strtolower($res_property['state'])."'  ")->get()->toArray();
			if(count($res_states)>0){
				$state_id = $res_states[0]['id'];
			}
			
			//  echo '<pre>'; print_r($res_states); exit;
			
			if(isset($res_property['salesPeople'][0]['email'])){
				$res_agents = Agents::whereRaw("LOWER(email) = '".strtolower($res_property['salesPeople'][0]['email'])."'  ")->get()->toArray();
				if(count($res_agents)>0){
					$sale_user_id = $res_agents[0]['id'];
				}
			}
			
			//  echo '<pre>'; print_r($res_states); exit;
			$model->user_id = $sale_user_id;
			$model->agency_id = $user_id;
			
			$model->property_id = $res_property['propertyID'];
            
			$model->property_type_id = $property_type_id;
			$model->property_status_type = $property_status_type;
			$model->property_authority = $property_authority_id;
			/*if($res_property['displayPrice']!=''){
				$model->price = isset($res_property['displayPrice'])?(float)str_replace(',','',$res_property['displayPrice']):0;
			}else if($res_property['rent']!=''){
				$model->price = isset($res_property['rent'])?(float)str_replace(',','',$res_property['rent']):0;
			}
			$model->show_price = isset($res_property['showPrice'])?$res_property['showPrice']:0;
			$model->min_price = isset($res_property['searchPrice'])?str_replace(',','',$res_property['searchPrice']):0;*/
			
			if(isset($res_property['searchPrice']) && $res_property['searchPrice']!=''){
				//$model->price = isset($res_property['displayPrice'])?(float)str_replace(',','',$res_property['displayPrice']):0;
				$model->price = isset($res_property['searchPrice'])?(float)str_replace(',','',$res_property['searchPrice']):0;
			}else if(isset($res_property['rent']) && $res_property['rent']!=''){
				//$model->price = isset($res_property['rent'])?(float)str_replace(',','',$res_property['rent']):0;
				$model->price = isset($res_property['rent'])?(float)str_replace(',','',$res_property['rent']):0;
			}
			
			$model->show_price = isset($res_property['showPrice'])?$res_property['showPrice']:0;
			//$model->min_price = isset($res_property['searchPrice'])?str_replace(',','',$res_property['searchPrice']):0;
			$model->min_price = isset($res_property['displayPrice'])?$res_property['displayPrice']:'';
			$model->bond = isset($res_property['bond'])?$res_property['bond']:'';
			//--------------------------------------------
			if(isset($res_property['displayPrice']) && trim(strtolower($res_property['displayPrice']))=='sold'){
				$model->category_id = 3;
				$model->sold_date = ($res_property['soldDate']!='')?date('Y-m-d',strtotime($res_property['soldDate'])):NULL;
			}else if(isset($res_property['displayPrice']) && trim(strtolower($res_property['displayPrice']))=='leased'){
				$model->category_id = 4;
				$model->leased_date = ($res_property['soldDate']!='')?date('Y-m-d',strtotime($res_property['soldDate'])):NULL;
			}
			//--------------------------------------------
			
			$model->street_address = isset($res_property['streetAddress'])?$res_property['streetAddress']:'';
			$model->hide_street_address = ($res_property['showAddress']=='yes')?1:0;
			$model->hide_street_view = ($res_property['showAddress']=='yes')?1:0;
			$model->suburb = isset($res_property['suburb'])?$res_property['suburb']:'';
			$model->state_id = $state_id;
			$model->municipality = isset($res_property['municipality'])?$res_property['municipality']:'';
			$model->latitude = isset($res_property['latitude'])?$res_property['latitude']:'';
			$model->longitude = isset($res_property['longitude'])?$res_property['longitude']:'';
			
			if($res_property['showAddress']=='no'){
				$short_address = '';
				if($res_property['suburb']!=''){
					$short_address .= $res_property['suburb'].', ';
				}
				if($res_property['state']!=''){
					$short_address .= $res_property['state'].', ';
				}
				if($res_property['postcode']!=''){
					$short_address .= $res_property['postcode'];
				}
				
				if($res_property['country']!=''){
					//$short_address .= $res_property['country'];
				}
				$model->street_address = $short_address;
			}
			$model->postcode = $res_property['postcode'];
			
			if($res_property['latitude']=='' && $res_property['longitude']==''){
				$map_key = Setting::findByKey('MAP_KEY');
				
				if($map_key!='' && $model->street_address!=''){
					 $coordinates =  Common::getLatLong($model->street_address.' '.$res_property['suburb'].' '.$res_property['state'].' '.$res_property['postcode'].' Austrila',$map_key);
					 if ($coordinates) {
						 $Latitude = $coordinates['lat'];
						 $Longitude = $coordinates['lng'];
						 $model->latitude = $Latitude;
						 $model->longitude = $Longitude;
						 
					 }
				}
			
			}
			
			$model->underContract = isset($res_property['underContract'])?$res_property['underContract']:0;
			$model->bedrooms = isset($res_property['bedrooms'])?$res_property['bedrooms']:0;
			$model->bathrooms = isset($res_property['bathrooms'])?$res_property['bathrooms']:0;
			
			$model->garage_spaces = isset($res_property['carSpaces'])?$res_property['carSpaces']:0;
			$model->carport_spaces = 0; //isset($res_property['carSpaces'])?$res_property['carSpaces']:'';
			
			$model->house_size = isset($res_property['houseSize']['value'])?$res_property['houseSize']['value']:'';
			$model->house_size_unit = isset($res_property['houseSize']['unit'])?$res_property['houseSize']['unit']:'';
			
			$model->land_size = isset($res_property['landDetails']['area']['value'])?$res_property['landDetails']['area']['value']:'';
			$model->land_size_unit = $res_property['landDetails']['area']['unit'];
			$model->energy_efficiency_rating = isset($res_property['energyRating'])?$res_property['energyRating']:0;
			if(isset($res_property['featureList'])){
				$featureList = is_array($res_property['featureList'])?$res_property['featureList']:array();
			}else {
				$featureList = array();
			}
			$arr_features = array();
			if(count($featureList)>0){
				foreach ($featureList as $rf){
					$arr_features[] = $rf['name'];
				}
			}
			
			$model->outdoor_features = is_array($arr_features)?implode(',',$arr_features):'';
			//$model->indoor_features = '';
			//$model->heating_cooling = '';
			//$model->eco_friendly_features = '';
			//$model->other_features = '';
		
			
			$model->name = str_replace('"','',$res_property['heading']);
			$model->video_url = $res_property['videoLink'];
			//$model->map_link_url = '';
			$model->slug =Common::slug($res_property['heading']);
			$model->full_contents = $res_property['description'];
			
			if(isset($res_property['auctionDateTime']) && $res_property['auctionDateTime']!=''){
				$array_auc = explode(' ',$res_property['auctionDateTime']);
				$date_auc = explode('/',$array_auc[0]);
				$model->auction_date = $date_auc[2].'-'.$date_auc[1].'-'.$date_auc[0];
				$model->auction_time = $array_auc[1].':00';
				$model->auction_location = $res_property['auctionLocation'];
			}
			
			
            $model->save();
			
			//---------------------------------------------------
			Propertyinspection::whereRaw('property_id = ? ', array($property_id))->delete();
				$inspection = array();
				if(is_array($res_property['inspections']) && count($res_property['inspections'])>0){
					$inspection = $res_property['inspections'];
				}
				$find = array('AM','PM');
				$rep = array(' AM',' PM');
				
				if(count($inspection)>0){
					foreach ($inspection as $row_ins) { 
						$model_ins = new Propertyinspection();
						$model_ins->property_id = $property_id;
						$model_ins->ins_date = date('Y-m-d',strtotime(str_replace('/','-',$row_ins['day'])));
						$model_ins->ins_start_time = str_replace($find,$rep,$row_ins['startTime']);
						$model_ins->ins_end_time = str_replace($find,$rep,$row_ins['endTime']);
						$model_ins->save();
					}
				}
			//---------------------------------------------------
				Propertyimages::whereRaw('property_id = ? ', array($property_id))->delete();
				$photos_array = array();
				
				$path_uploads = 'public/upload/property/'.$property_id;
				if (!file_exists($path_uploads)) {
					mkdir($path_uploads, 0755, true); // Create the folder with permissions
				}
				
				if(is_array($res_property['photos']) && count($res_property['photos'])>0){
					$photos_array = $res_property['photos'];
				}
				if(count($photos_array)>0){
					foreach ($photos_array as $k=>$row_img) {
					
						$imageUrl = $row_img['fullSize'];
						$originalName = '';
						$temp_name_array = explode('/',$row_img['fullSize']); 
						$originalName = end($temp_name_array);
						//$image_name = rand(11111, 99999) . '_' . str_replace(' ', '-', strtolower($originalName));
						$image_name = $originalName;
						$localPath = 'public/upload/property/'.$property_id.'/'.$image_name;
						if($this->save_img($imageUrl,$localPath)){
							$model_img = new Propertyimages();
							$model_img->image = $image_name;
							$model_img->img_type = 'images';
							$model_img->property_id = $property_id;
							$model_img->save();
							
							if($k==0){
								$model_main  = Property::find($property_id);
								$model_main->image = $image_name;
								$model_main->save();
							}
							
						}
						
					
					}
					
				}
				
				//--------------------------------------------------------------------------
				$photos_array = array();
				if(is_array($res_property['floorPlans']) && count($res_property['floorPlans'])>0){
					$photos_array = $res_property['floorPlans'];
				}
				if(count($photos_array)>0){
					foreach ($photos_array as $row_img) {
					
						$imageUrl = $row_img['fullSize'];
						$originalName = '';
						$temp_name_array = explode('/',$row_img['fullSize']); 
						$originalName = end($temp_name_array);
						$image_name = rand(11111, 99999) . '_' . str_replace(' ', '-', strtolower($originalName));
						$localPath = 'public/upload/property/'.$property_id.'/'.$image_name;
						if($this->save_img($imageUrl,$localPath)){
							$model_img = new Propertyimages();
							$model_img->image = $image_name;
							$model_img->img_type = 'floorplans';
							$model_img->property_id = $property_id;
							$model_img->save();
						}
						
					
					}
					
				}
				
				if($old_status!=$category_id){
					$this->send_vendor_email($property_id,$category_id);
				}
			
	  }
	 
	 
	  public function save_img($imageUrl,$localPath){
		  // Initialize cURL
		$ch = curl_init($imageUrl);
		
		// Set cURL options
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		
		// Execute cURL request
		$imageData = curl_exec($ch);
		
		// Check for errors
		if (curl_errno($ch)) {
			//echo "cURL Error: " . curl_error($ch);
			curl_close($ch);
			return false;
		}
		
		// Close cURL session
		curl_close($ch);
		
		// Save the image to the local folder
		if (file_put_contents($localPath, $imageData)) {
			//echo "Image saved successfully to $localPath";
			return true;
		} else {
			//echo "Failed to save the image.";
			return false;
		}
	  }
	  
	  public function send_vendor_email($id,$status_id){
					
					$row_p = Property::where('id',$id)->first();
					$propery_sharing_address = $row_p->suburb.','.$row_p->postcode.','.$row_p->property_state->name;
					
					if($row_p->send_weekly_mail_to_vender==1 && $row_p->vendor_email!='') {
					
					$rs_property_options = Propertyoptions::whereRaw("id = ".$status_id." ")->orderByRaw('name')->get()->toArray();	
					$status_name = '';
					if(count($rs_property_options)>0){
						$status_name = '('.$rs_property_options[0]['name'].')';
					}
		
					$subject = Setting::findByKey('SITE_NAME').' Property Status Updated '.$status_name;
					$subject_header = 'Your Property Status Update '.$status_name;
					
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
                            '.$propery_sharing_address.'
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
	 
	 
	
}
