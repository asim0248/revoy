<?php namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Model\Cms;
use App\Model\Setting;
use App\Model\Common;
use App\Model\Comments;
use App\Model\Subscribe;
use App\Model\Brokers;
use App\Model\Agents;
use App\Model\Property;
use App\Model\Propertytypes;
use App\Model\Videos;
use App\Model\AgentReviews;
use App\Model\BrokerReviews;
use App\Model\Leads;
use App\Model\States;
use App\Model\PropertyData;
use App\Model\Contactus;
use Session;
use Response;
use Mail;
use URL;
use DB;
class CommonController extends Controller {
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
	 
	 
	 
	  public function reviewsubmit(Request $request){
		 if ($request->_token) {
			$model = new AgentReviews();
            $model->user_id = $request->agent_id;
			$model->star_rating = $request->agent_rating;
			$model->message = $request->agent_comment;
			$model->property_type = $request->transactionType;
			$model->address = $request->agent_search_address;
			
			$model->first_name = $request->agent_comment_first_name;
			$model->last_name = $request->agent_comment_last_name;
			$model->phone = $request->agent_comment_phone;
			$model->email = $request->agent_comment_email;
			
			$model->created_at = date('Y-m-d H:i:s');
			$model->status = 'No';
			$model->save();
		 
		 	return Response::json(array('error_code' => '',  'status' => 'success', 'message' => 'Your message has been sent successfully.'));
		 }
	 }
	 
	 public function reviewsubmitbroker(Request $request){
		 if ($request->_token) {
			$model = new BrokerReviews();
            $model->user_id = $request->agent_id;
			$model->star_rating = $request->agent_rating;
			$model->message = $request->agent_comment;
			$model->property_type = '';//$request->transactionType;
			$model->address = '';//$request->agent_search_address;
			
			$model->first_name = $request->agent_comment_first_name;
			$model->last_name = $request->agent_comment_last_name;
			$model->phone = $request->agent_comment_phone;
			$model->email = $request->agent_comment_email;
			
			$model->created_at = date('Y-m-d H:i:s');
			$model->status = 'No';
			$model->save();
		 
		 	return Response::json(array('error_code' => '',  'status' => 'success', 'message' => 'Your message has been sent successfully.'));
		 }
	 }
	 
	 
	 
	  public function commentsubmit(Request $request){
		 if ($request->_token) {
			$model = new Comments();
            $model->name = $request->comment_name;
			$model->email = $request->comment_email;
			$model->comment = $request->comment_post;
			$model->post_id = $request->post_id;
			$model->post_date = date('Y-m-d H:i:s');
			$model->status = 'No';
			$model->save();
		 
		 	return Response::json(array('error_code' => '',  'status' => 'success', 'message' => 'Your comment has been sent successfully.'));
		 }
	 }
	 
	 public function career_process(Request $request) {
		$data = array();
		
		
			$resume = '';
			
			$image_name = '';
			$file = $request->resume;
			if($file){
			$ext = $file->getClientOriginalExtension();
			$file = $request->resume->getClientOriginalName();
			$image_name = uniqid().'_'.str_replace(' ','-',strtolower($file));//uniqid() . '.' . $ext;
			$path_uploads = 'public/upload/resume/';
			$request->resume->move($path_uploads, $image_name);
			}
			
			$resume_link = url('/').'/public/upload/resume/'.$image_name;
			$resume = '<a href="'.$resume_link.'" download >Download</a>';
		  
		
		    $subject = Setting::findByKey('SITE_NAME').' Career';
			$subject_header = 'Career';
            $msg = '';
            $msg	="<table width='100%' border='0' cellpadding='0' cellspacing='10' bgcolor='#FFFFFF' align='center' style='background-color: #e5e5e5; padding: 20px 0;'>
					
                  	
                  	<tr>
                   	  	<td valign='top' style='color:#044235;'><span style='font-weight:bold;'> Name : </span> ".$request->contact_full_name." </td>
                   	</tr>
					
					
					<tr>
                   	  	<td valign='top' style='color:#044235;'><span style='font-weight:bold;'> Email Address : </span> ".$request->contact_email."</td>
                   	</tr>
					
					<tr>
                   	  	<td valign='top' style='color:#044235;'><span style='font-weight:bold;'> Phone : </span> ".$request->contact_phone."</td>
                   	</tr>
					
					<tr>
                   	  	<td valign='top' style='color:#044235;'><span style='font-weight:bold;'> Contact Role : </span> ".$request->contact_role."</td>
                   	</tr>
					<tr>
                   	  	<td valign='top' style='color:#044235;'><span style='font-weight:bold;'> Resume : </span> ".$resume."</td>
                   	</tr>
					<tr>
                   	  	<td valign='top' style='color:#044235;'><span style='font-weight:bold;'>Message : </span> ".$request->contact_message."</td>
                   	</tr>
                    
			  </table>";
			
            Common::overrideMailerConfig();
           
             $data_email = array('name' => '', 'msg' => $msg, 'subject' => $subject_header);
            $user_data = array('to' => Setting::findByKey('CONTACT_CAREER'), 'name' => Setting::findByKey('SITE_NAME'), 'subject' => $subject, 'siteName' => $request->contact_full_name, 'businessEmail' => $request->contact_email);
			
            Mail::send('emails.template', $data_email, function($message) use ($user_data) {
                $message->from($user_data['businessEmail'], $user_data['siteName']);
                $message->to($user_data['to'], $user_data['name'])->subject($user_data['subject']);
            });
		
		
		return Response::json(array('error_code' => '',  'status' => 'success', 'message' => 'Your message has been sent successfully.'));
			
     }
	 
	 
	 public function contact_process(Request $request) {
		$data = array();
		
		  
		
		    $subject = Setting::findByKey('SITE_NAME').' Contact Us';
			$subject_header = 'Contact Us';
            $msg = '';
            $msg	="<table width='100%' border='0' cellpadding='0' cellspacing='10' bgcolor='#FFFFFF' align='center' style='background-color: #e5e5e5; padding: 20px 0;' >
					
                  	
                  	<tr>
                   	  	<td valign='top' style='color:#044235;'><span style='font-weight:bold;'> Name : </span> ".$request->contact_full_name." </td>
                   	</tr>
					
					
					<tr>
                   	  	<td valign='top' style='color:#044235;'><span style='font-weight:bold;'> Email Address : </span> ".$request->contact_email."</td>
                   	</tr>
					
					<tr>
                   	  	<td valign='top' style='color:#044235;'><span style='font-weight:bold;'> Phone : </span> ".$request->contact_phone."</td>
                   	</tr>
					
					<tr>
                   	  	<td valign='top' style='color:#044235;'><span style='font-weight:bold;'> Property Type : </span> ".$request->contact_service."</td>
                   	</tr>
					<tr>
                   	  	<td valign='top' style='color:#044235;'><span style='font-weight:bold;'> Subject : </span> ".$request->contact_subject."</td>
                   	</tr>
					<tr>
                   	  	<td valign='top' style='color:#044235;'><span style='font-weight:bold;'>Message : </span> ".$request->contact_message."</td>
                   	</tr>
                    
			  </table>";
			
            Common::overrideMailerConfig();
           
            $data_email = array('name' => '', 'msg' => $msg, 'subject' => $subject_header);
			// echo $html_email = view('emails.template',$data_email)->render();
			// exit;
            $user_data = array('to' => Setting::findByKey('CONTACT_EMAIL'), 'name' => Setting::findByKey('SITE_NAME'), 'subject' => $subject, 'siteName' => $request->contact_full_name, 'businessEmail' => $request->contact_email);
			
            Mail::send('emails.template', $data_email, function($message) use ($user_data) {
                $message->from($user_data['businessEmail'], $user_data['siteName']);
                $message->to($user_data['to'], $user_data['name'])->subject($user_data['subject']);
            });
		
		
		return Response::json(array('error_code' => '',  'status' => 'success', 'message' => 'Your message has been sent successfully.'));
			
     }
	 
	  public function contact_data_process(Request $request) {
		$data = array();
		
		
			$model = new Contactus();
            $model->name = $request->data_process_first_name." ".$request->data_process_last_name;
			$model->email = $request->data_process_email;
			$model->phone = $request->data_process_phone_detail;
			$model->services_name = $request->data_process_for;
			$model->message = $request->data_process_message;
			$model->from_page = $request->data_process_from_page;
			$model->ip_address = $_SERVER['REMOTE_ADDR'];
			$model->status = 'No';
			$model->save();
		
		  
		
		    $subject = Setting::findByKey('SITE_NAME').' '.$request->data_process_for;
			$subject_header = $request->data_process_for;
            $msg = '';
            $msg	="<table width='100%' border='0' cellpadding='0' cellspacing='10' bgcolor='#FFFFFF' align='center' style='background-color: #e5e5e5; padding: 20px 0;' >
					
                  	
                  	<tr>
                   	  	<td valign='top' style='color:#044235;'><span style='font-weight:bold;'> Name : </span> ".$request->data_process_first_name." ".$request->data_process_last_name." </td>
                   	</tr>
					
					
					<tr>
                   	  	<td valign='top' style='color:#044235;'><span style='font-weight:bold;'> Email Address : </span> ".$request->data_process_email."</td>
                   	</tr>
					
					<tr>
                   	  	<td valign='top' style='color:#044235;'><span style='font-weight:bold;'> Phone : </span> ".$request->data_process_phone_detail."</td>
                   	</tr>
					
					<tr>
                   	  	<td valign='top' style='color:#044235;'><span style='font-weight:bold;'> From Page : </span> ".$request->data_process_from_page."</td>
                   	</tr>
					<tr>
                   	  	<td valign='top' style='color:#044235;'><span style='font-weight:bold;'> Address : </span> ".$request->data_process_address."</td>
                   	</tr>
					<tr>
                   	  	<td valign='top' style='color:#044235;'><span style='font-weight:bold;'>Message : </span> ".$request->data_process_message."</td>
                   	</tr>
                    
			  </table>";
			
            Common::overrideMailerConfig();
           
            $data_email = array('name' => '', 'msg' => $msg, 'subject' => $subject_header);
			// echo $html_email = view('emails.template',$data_email)->render();
			// exit;
            $user_data = array('to' => Setting::findByKey('CONTACT_EMAIL'), 'name' => Setting::findByKey('SITE_NAME'), 'subject' => $subject, 'siteName' => $request->data_process_first_name, 'businessEmail' => $request->data_process_email);
			
            Mail::send('emails.template', $data_email, function($message) use ($user_data) {
                $message->from($user_data['businessEmail'], $user_data['siteName']);
                $message->to($user_data['to'], $user_data['name'])->subject($user_data['subject']);
            });
		
		
		return Response::json(array('error_code' => '',  'status' => 'success', 'message' => 'Your message has been sent successfully.'));
			
     }
	 
	 public function contact_process_help(Request $request) {
		$data = array();
		
		  
		
		    $subject = Setting::findByKey('SITE_NAME').' Contact Us ('.$request->subject_page.')';
			
			$subject_header = ' Contact Us ('.$request->subject_page.')';
			
            $msg = '';
            $msg	="<table width='100%' border='0' cellpadding='0' cellspacing='10' bgcolor='#FFFFFF' align='center' style='background-color: #e5e5e5; padding: 20px 0;'>
					
					<tr>
                   	  	<td valign='top' style='color:#044235;'><span style='font-weight:bold;'> What can we help you with today : </span> ".$request->contact_help." </td>
                   	</tr>
					<tr>
                   	  	<td valign='top' style='color:#044235;'><span style='font-weight:bold;'> I am a.. : </span> ".$request->contact_i_am."</td>
                   	</tr>
                  	
                  	<tr>
                   	  	<td valign='top' style='color:#044235;'><span style='font-weight:bold;'> Name : </span> ".$request->contact_full_name." </td>
                   	</tr>
					
					
					<tr>
                   	  	<td valign='top' style='color:#044235;'><span style='font-weight:bold;'> Email Address : </span> ".$request->contact_email."</td>
                   	</tr>
					
					
					
					<tr>
                   	  	<td valign='top' style='color:#044235;'><span style='font-weight:bold;'> State : </span> ".$request->contact_state."</td>
                   	</tr>
					<tr>
                   	  	<td valign='top' style='color:#044235;'><span style='font-weight:bold;'> Subject : </span> ".$request->contact_subject."</td>
                   	</tr>
					
					<tr>
                   	  	<td valign='top' style='color:#044235;'><span style='font-weight:bold;'>Description : </span> ".$request->contact_message."</td>
                   	</tr>
                    
			  </table>";
			
            Common::overrideMailerConfig();
           
            $data_email = array('name' => '', 'msg' => $msg, 'subject' => $subject_header);
            $user_data = array('to' => Setting::findByKey('CONTACT_EMAIL'), 'name' => Setting::findByKey('SITE_NAME'), 'subject' => $subject, 'siteName' => $request->contact_full_name, 'businessEmail' => $request->contact_email);
			
            Mail::send('emails.template', $data_email, function($message) use ($user_data) {
                $message->from($user_data['businessEmail'], $user_data['siteName']);
                $message->to($user_data['to'], $user_data['name'])->subject($user_data['subject']);
            });
		
		
		return Response::json(array('error_code' => '',  'status' => 'success', 'message' => 'Your message has been sent successfully.'));
			
     }
	 
	  public function contact_process_common(Request $request) {
		$data = array();
		
		  
		
		    $subject = Setting::findByKey('SITE_NAME').' Contact Us ('.$request->subject_page.')';
			$subject_header = ' Contact Us ('.$request->subject_page.')';
            $msg = '';
            $msg	="<table width='100%' border='0' cellpadding='0' cellspacing='10' bgcolor='#FFFFFF' align='center' style='background-color: #e5e5e5; padding: 20px 0;'>
					
                  	
                  	<tr>
                   	  	<td valign='top' style='color:#044235;'><span style='font-weight:bold;'> Name : </span> ".$request->contact_full_name." </td>
                   	</tr>
					
					
					<tr>
                   	  	<td valign='top' style='color:#044235;'><span style='font-weight:bold;'> Email Address : </span> ".$request->contact_email."</td>
                   	</tr>
					
					<tr>
                   	  	<td valign='top' style='color:#044235;'><span style='font-weight:bold;'> Phone : </span> ".$request->contact_phone."</td>
                   	</tr>
					
					<tr>
                   	  	<td valign='top' style='color:#044235;'><span style='font-weight:bold;'> Address : </span> ".$request->contact_address."</td>
                   	</tr>
					<tr>
                   	  	<td valign='top' style='color:#044235;'><span style='font-weight:bold;'> Subrub : </span> ".$request->contact_subrub."</td>
                   	</tr>
					<tr>
                   	  	<td valign='top' style='color:#044235;'><span style='font-weight:bold;'> Postcode : </span> ".$request->contact_postcode."</td>
                   	</tr>
					<tr>
                   	  	<td valign='top' style='color:#044235;'><span style='font-weight:bold;'>Message : </span> ".$request->contact_message."</td>
                   	</tr>
                    
			  </table>";
			
            Common::overrideMailerConfig();
           
             $data_email = array('name' => '', 'msg' => $msg, 'subject' => $subject_header);
            $user_data = array('to' => Setting::findByKey('CONTACT_EMAIL'), 'name' => Setting::findByKey('SITE_NAME'), 'subject' => $subject, 'siteName' => $request->contact_full_name, 'businessEmail' => $request->contact_email);
			
            Mail::send('emails.template', $data_email, function($message) use ($user_data) {
                $message->from($user_data['businessEmail'], $user_data['siteName']);
                $message->to($user_data['to'], $user_data['name'])->subject($user_data['subject']);
            });
		
		
		return Response::json(array('error_code' => '',  'status' => 'success', 'message' => 'Your message has been sent successfully.'));
			
     }
	 
	 public function contact_process_commercial(Request $request) {
		$data = array();
		
		  
		
		    $subject = Setting::findByKey('SITE_NAME').' Contact Us (Commercial)';
			$subject_header = 'Contact Us (Commercial)';
            $msg = '';
            $msg	="<table width='100%' border='0' cellpadding='0' cellspacing='10' bgcolor='#FFFFFF' align='center' style='background-color: #e5e5e5; padding: 20px 0;'>
					
                  	
                  	<tr>
                   	  	<td valign='top' style='color:#044235;'><span style='font-weight:bold;'> Name : </span> ".$request->contact_full_name." </td>
                   	</tr>
					
					
					<tr>
                   	  	<td valign='top' style='color:#044235;'><span style='font-weight:bold;'> Email Address : </span> ".$request->contact_email."</td>
                   	</tr>
					
					<tr>
                   	  	<td valign='top' style='color:#044235;'><span style='font-weight:bold;'> Phone : </span> ".$request->contact_phone."</td>
                   	</tr>
					
					<tr>
                   	  	<td valign='top' style='color:#044235;'><span style='font-weight:bold;'> Property Type : </span> ".$request->contact_service."</td>
                   	</tr>
					<tr>
                   	  	<td valign='top' style='color:#044235;'><span style='font-weight:bold;'> Subject : </span> ".$request->contact_subject."</td>
                   	</tr>
					<tr>
                   	  	<td valign='top' style='color:#044235;'><span style='font-weight:bold;'>Message : </span> ".$request->contact_message."</td>
                   	</tr>
                    
			  </table>";
			
            Common::overrideMailerConfig();
           
            $data_email = array('name' => '', 'msg' => $msg, 'subject' => $subject_header);
            $user_data = array('to' => Setting::findByKey('CONTACT_EMAIL'), 'name' => Setting::findByKey('SITE_NAME'), 'subject' => $subject, 'siteName' => $request->contact_full_name, 'businessEmail' => $request->contact_email);
			
            Mail::send('emails.template', $data_email, function($message) use ($user_data) {
                $message->from($user_data['businessEmail'], $user_data['siteName']);
                $message->to($user_data['to'], $user_data['name'])->subject($user_data['subject']);
            });
		
		
		return Response::json(array('error_code' => '',  'status' => 'success', 'message' => 'Your message has been sent successfully.'));
			
     }
	 
	 public function contact_process_team(Request $request) {
		$data = array();
		
		  $row_add = '';
		  if($request->contact_team_check && $request->contact_team_check==1){
		  $row_add = "<tr>
                   	  	<td valign='top' style='color:#044235;'>I'm in Western Australia. Check the local time before you call.</td>
                   	</tr>";
					
		  }
		  
		  
		
		    $subject = Setting::findByKey('SITE_NAME').' Contact Us - Team';
			$subject_header = 'Contact Us - Team';
            $msg = '';
            $msg	="<table width='100%' border='0' cellpadding='0' cellspacing='10' bgcolor='#FFFFFF' align='center' style='background-color: #e5e5e5; padding: 20px 0;'>
					
                  	
                  	<tr>
                   	  	<td valign='top' style='color:#044235;'><span style='font-weight:bold;'> Name : </span> ".$request->contact_team_full_name." </td>
                   	</tr>
					
					
					
					
					<tr>
                   	  	<td valign='top' style='color:#044235;'><span style='font-weight:bold;'> Phone : </span> ".$request->contact_team_phone."</td>
                   	</tr>
					
					
					".$row_add."
                    
			  </table>";
			
            Common::overrideMailerConfig();
           
             $data_email = array('name' => '', 'msg' => $msg, 'subject' => $subject_header);
            $user_data = array('to' => Setting::findByKey('CONTACT_EMAIL'), 'name' => Setting::findByKey('SITE_NAME'), 'subject' => $subject, 'siteName' => $request->contact_team_full_name, 'businessEmail' => Setting::findByKey('FROM_EMAIL'));
			
            Mail::send('emails.template', $data_email, function($message) use ($user_data) {
                $message->from($user_data['businessEmail'], $user_data['siteName']);
                $message->to($user_data['to'], $user_data['name'])->subject($user_data['subject']);
            });
		
		
		return Response::json(array('error_code' => '',  'status' => 'success', 'message' => 'Your message has been sent successfully.'));
			
     }
	 
	 public function contact_process_loan(Request $request) {
		$data = array();
		
		  $row_add = '';
		  if($request->contact_loan_check && $request->contact_loan_check==1){
		  $row_add = "<tr>
                   	  	<td valign='top' style='color:#044235;'>I'm in Western Australia. Check the local time before you call.</td>
                   	</tr>";
					
		  }
		  
		  
		
		    $subject = Setting::findByKey('SITE_NAME').' Contact Us - Loan';
			$subject_header = 'Contact Us - Loan';
            $msg = '';
            $msg	="<table width='100%' border='0' cellpadding='0' cellspacing='10' bgcolor='#FFFFFF' align='center' style='background-color: #e5e5e5; padding: 20px 0;'>
					
                  	
                  	<tr>
                   	  	<td valign='top' style='color:#044235;'><span style='font-weight:bold;'> Name : </span> ".$request->contact_loan_full_name." </td>
                   	</tr>
					
					
					
					
					<tr>
                   	  	<td valign='top' style='color:#044235;'><span style='font-weight:bold;'> Phone : </span> ".$request->contact_loan_phone."</td>
                   	</tr>
					
					
					".$row_add."
                    
			  </table>";
			
            Common::overrideMailerConfig();
           
            $data_email = array('name' => '', 'msg' => $msg, 'subject' => $subject_header);
            $user_data = array('to' => Setting::findByKey('CONTACT_EMAIL'), 'name' => Setting::findByKey('SITE_NAME'), 'subject' => $subject, 'siteName' => $request->contact_loan_full_name, 'businessEmail' => Setting::findByKey('FROM_EMAIL'));
			
            Mail::send('emails.template', $data_email, function($message) use ($user_data) {
                $message->from($user_data['businessEmail'], $user_data['siteName']);
                $message->to($user_data['to'], $user_data['name'])->subject($user_data['subject']);
            });
		
		
		return Response::json(array('error_code' => '',  'status' => 'success', 'message' => 'Your message has been sent successfully.'));
			
     }
	 
	  public function contact_process_investment_request(Request $request) {
		$data = array();
		  
		
		    $subject = Setting::findByKey('SITE_NAME').' Contact Us - Advertise Us';
			$subject_header = 'Contact Us - Advertise Us';
            $msg = '';
            $msg	="<table width='100%' border='0' cellpadding='0' cellspacing='10' bgcolor='#FFFFFF' align='center' style='background-color: #e5e5e5; padding: 20px 0;'>
					
                  	
                  	<tr>
                   	  	<td valign='top' style='color:#044235;'><span style='font-weight:bold;'> First Name : </span> ".$request->contact_investment_first_name." </td>
                   	</tr>
					
					<tr>
                   	  	<td valign='top' style='color:#044235;'><span style='font-weight:bold;'> Last Name : </span> ".$request->contact_investment_last_name." </td>
                   	</tr>
					
					<tr>
                   	  	<td valign='top' style='color:#044235;'><span style='font-weight:bold;'> Email : </span> ".$request->contact_investment_email." </td>
                   	</tr>
					
					
					<tr>
                   	  	<td valign='top' style='color:#044235;'><span style='font-weight:bold;'> Phone : </span> ".$request->contact_investment_phone."</td>
                   	</tr>
					
					
					<tr>
                   	  	<td valign='top' style='color:#044235;'><span style='font-weight:bold;'> Investment Property Street : </span> ".$request->contact_investment_property_street." </td>
                   	</tr>
					<tr>
                   	  	<td valign='top' style='color:#044235;'><span style='font-weight:bold;'> Investment Property City : </span> ".$request->contact_investment_property_city." </td>
                   	</tr>
					<tr>
                   	  	<td valign='top' style='color:#044235;'><span style='font-weight:bold;'> Investment Property State : </span> ".$request->contact_investment_property_state." </td>
                   	</tr>
					
					
					
					
					<tr>
                   	  	<td valign='top' style='color:#044235;'><span style='font-weight:bold;'> Postcode : </span> ".$request->contact_investment_property_postcode."</td>
                   	</tr>
					
					
					<tr>
                   	  	<td valign='top' style='color:#044235;'><span style='font-weight:bold;'> How did you hear about us : </span> ".$request->contact_investment_hear." </td>
                   	</tr>
					
					
					<tr>
                   	  	<td valign='top' style='color:#044235;'><span style='font-weight:bold;'> Enquiry : </span> ".$request->contact_investment_message." </td>
                   	</tr>
                    
			  </table>";
			
            Common::overrideMailerConfig();
           
            $data_email = array('name' => '', 'msg' => $msg, 'subject' => $subject_header);
            $user_data = array('to' => Setting::findByKey('CONTACT_EMAIL'), 'name' => Setting::findByKey('SITE_NAME'), 'subject' => $subject, 'siteName' => $request->contact_investment_first_name, 'businessEmail' => $request->contact_investment_email);
			
            Mail::send('emails.template', $data_email, function($message) use ($user_data) {
                $message->from($user_data['businessEmail'], $user_data['siteName']);
                $message->to($user_data['to'], $user_data['name'])->subject($user_data['subject']);
            });
		
		
		return Response::json(array('error_code' => '',  'status' => 'success', 'message' => 'Your message has been sent successfully.'));
			
     }
	 
	  public function contact_process_estimate_request(Request $request) {
		$data = array();
		
		  
		  	$tr = '';
			if(isset($request->contact_address)){
			$tr = "<tr>
                   	  	<td valign='top' style='color:#044235;'><span style='font-weight:bold;'> Full Address : </span> ".$request->contact_address." </td>
                   	</tr>";
			}
			
		  	if(isset($request->contact_address_new)){
			$tr = "<tr>
                   	  	<td valign='top' style='color:#044235;'><span style='font-weight:bold;'> Full Address : </span> ".$request->contact_address_new." </td>
                   	</tr>";
			}
		
		    $subject = Setting::findByKey('SITE_NAME').' Property Appraisal Request';
			$subject_header = ' Property Appraisal Request';
            $msg = '';
            $msg	="<table width='100%' border='0' cellpadding='0' cellspacing='10' bgcolor='#FFFFFF' align='center' style='background-color: #e5e5e5; padding: 20px 0;'>
					
                  	
                  	<tr>
                   	  	<td valign='top' style='color:#044235;'><span style='font-weight:bold;'> First Name : </span> ".$request->contact_investment_first_name." </td>
                   	</tr>
					
					<tr>
                   	  	<td valign='top' style='color:#044235;'><span style='font-weight:bold;'> Last Name : </span> ".$request->contact_investment_last_name." </td>
                   	</tr>
					
					<tr>
                   	  	<td valign='top' style='color:#044235;'><span style='font-weight:bold;'> Email : </span> ".$request->contact_investment_email." </td>
                   	</tr>
					
					
					<tr>
                   	  	<td valign='top' style='color:#044235;'><span style='font-weight:bold;'> Phone : </span> ".$request->contact_investment_phone."</td>
                   	</tr>
					
					
					".$tr."
					
					
					
					<tr>
                   	  	<td valign='top' style='color:#044235;'><span style='font-weight:bold;'> How did you hear about us : </span> ".$request->contact_investment_hear." </td>
                   	</tr>
					
					
					<tr>
                   	  	<td valign='top' style='color:#044235;'><span style='font-weight:bold;'> Enquiry : </span> ".$request->contact_investment_message." </td>
                   	</tr>
                    
			  </table>";
			
            Common::overrideMailerConfig();
           	
            $data_email = array('name' => '', 'msg' => $msg, 'subject' => $subject_header);
            $user_data = array('to' => Setting::findByKey('CONTACT_EMAIL'), 'name' => Setting::findByKey('SITE_NAME'), 'subject' => $subject, 'siteName' => $request->contact_investment_first_name, 'businessEmail' => $request->contact_investment_email);
			
            Mail::send('emails.template', $data_email, function($message) use ($user_data) {
                $message->from($user_data['businessEmail'], $user_data['siteName']);
                $message->to($user_data['to'], $user_data['name'])->subject($user_data['subject']);
            });
		
		
		return Response::json(array('error_code' => '',  'status' => 'success', 'message' => 'Your message has been send successfully.'));
			
     }
	 
	  public function contact_process_media_sales(Request $request) {
		$data = array();
		
		  
		  
		  
		
		    $subject = Setting::findByKey('SITE_NAME').' Contact Us - Media Sales';
			$subject_header = ' Contact Us - Media Sales';
            $msg = '';
            $msg	="<table width='100%' border='0' cellpadding='0' cellspacing='10' bgcolor='#FFFFFF' align='center' style='background-color: #e5e5e5; padding: 20px 0;'>
					
                  	
                  	<tr>
                   	  	<td valign='top' style='color:#044235;'><span style='font-weight:bold;'> First Name : </span> ".$request->contact_investment_first_name." </td>
                   	</tr>
					
					<tr>
                   	  	<td valign='top' style='color:#044235;'><span style='font-weight:bold;'> Last Name : </span> ".$request->contact_investment_last_name." </td>
                   	</tr>
					
					<tr>
                   	  	<td valign='top' style='color:#044235;'><span style='font-weight:bold;'> Email : </span> ".$request->contact_investment_email." </td>
                   	</tr>
					
					
					<tr>
                   	  	<td valign='top' style='color:#044235;'><span style='font-weight:bold;'> Phone : </span> ".$request->contact_investment_phone."</td>
                   	</tr>
					
					
					
					
					
					<tr>
                   	  	<td valign='top' style='color:#044235;'><span style='font-weight:bold;'> How did you hear about us : </span> ".$request->contact_investment_hear." </td>
                   	</tr>
					
					
					<tr>
                   	  	<td valign='top' style='color:#044235;'><span style='font-weight:bold;'> Enquiry : </span> ".$request->contact_investment_message." </td>
                   	</tr>
                    
			  </table>";
			
            Common::overrideMailerConfig();
           
            $data_email = array('name' => '', 'msg' => $msg, 'subject' => $subject_header);
            $user_data = array('to' => Setting::findByKey('CONTACT_EMAIL'), 'name' => Setting::findByKey('SITE_NAME'), 'subject' => $subject, 'siteName' => $request->contact_investment_first_name, 'businessEmail' => $request->contact_investment_email);
			
            Mail::send('emails.template', $data_email, function($message) use ($user_data) {
                $message->from($user_data['businessEmail'], $user_data['siteName']);
                $message->to($user_data['to'], $user_data['name'])->subject($user_data['subject']);
            });
		
		
		return Response::json(array('error_code' => '',  'status' => 'success', 'message' => 'Your message has been sent successfully.'));
			
     }
	 
	 public function contact_process_loan_request(Request $request) {
		$data = array();
		
		    $subject = Setting::findByKey('SITE_NAME').' Contact Us - Loan Request';
			 $subject_header = 'Contact Us - Loan Request';
            $msg = '';
            $msg	="<table width='100%' border='0' cellpadding='0' cellspacing='10' bgcolor='#FFFFFF' align='center' style='background-color: #e5e5e5; padding: 20px 0;'>
					
                  	
                  	<tr>
                   	  	<td valign='top' style='color:#044235;'><span style='font-weight:bold;'> First Name : </span> ".$request->contact_loan_first_name." </td>
                   	</tr>
					
					<tr>
                   	  	<td valign='top' style='color:#044235;'><span style='font-weight:bold;'> Last Name : </span> ".$request->contact_loan_last_name." </td>
                   	</tr>
					
					<tr>
                   	  	<td valign='top' style='color:#044235;'><span style='font-weight:bold;'> Email : </span> ".$request->contact_loan_email." </td>
                   	</tr>
					
					
					<tr>
                   	  	<td valign='top' style='color:#044235;'><span style='font-weight:bold;'> Phone : </span> ".$request->contact_loan_phone."</td>
                   	</tr>
					
					
					<tr>
                   	  	<td valign='top' style='color:#044235;'><span style='font-weight:bold;'> Address : </span> ".$request->contact_loan_address." </td>
                   	</tr>
					
					
					<tr>
                   	  	<td valign='top' style='color:#044235;'><span style='font-weight:bold;'> Loan Type : </span> ".$request->contact_loan_type." </td>
                   	</tr>
					
					<tr>
                   	  	<td valign='top' style='color:#044235;'><span style='font-weight:bold;'> Postcode : </span> ".$request->contact_loan_postcode."</td>
                   	</tr>
					
					
					<tr>
                   	  	<td valign='top' style='color:#044235;'><span style='font-weight:bold;'> How did you hear about us : </span> ".$request->contact_loan_hear." </td>
                   	</tr>
					
					
					<tr>
                   	  	<td valign='top' style='color:#044235;'><span style='font-weight:bold;'> Enquiry : </span> ".$request->contact_loan_message." </td>
                   	</tr>
                    
			  </table>";
			
            Common::overrideMailerConfig();
           
             $data_email = array('name' => '', 'msg' => $msg, 'subject' => $subject_header);
            $user_data = array('to' => Setting::findByKey('CONTACT_EMAIL'), 'name' => Setting::findByKey('SITE_NAME'), 'subject' => $subject, 'siteName' => $request->contact_loan_first_name, 'businessEmail' => $request->contact_loan_email);
			
            Mail::send('emails.template', $data_email, function($message) use ($user_data) {
                $message->from($user_data['businessEmail'], $user_data['siteName']);
                $message->to($user_data['to'], $user_data['name'])->subject($user_data['subject']);
            });
		
		
		return Response::json(array('error_code' => '',  'status' => 'success', 'message' => 'Your message has been sent successfully.'));
			
     }
	 
	 public function contact_broker(Request $request) {
		$data = array();
		
		    $rs_brokers = Broker::whereRaw(" id =".$request->broker_id." ")->first()->toArray();
		
		    $subject = Setting::findByKey('SITE_NAME').' Contact Us';
			$subject_header = 'Contact Us ';
            $msg = '';
            $msg	="<table width='100%' border='0' cellpadding='0' cellspacing='10' bgcolor='#FFFFFF' align='center' style='background-color: #e5e5e5; padding: 20px 0;'>
					
                  	
                  	<tr>
                   	  	<td valign='top' style='color:#044235;'><span style='font-weight:bold;'> First Name : </span> ".$request->contact_broker_first_name." </td>
                   	</tr>
					
					<tr>
                   	  	<td valign='top' style='color:#044235;'><span style='font-weight:bold;'> Last Name : </span> ".$request->contact_broker_last_name." </td>
                   	</tr>
					<tr>
                   	  	<td valign='top' style='color:#044235;'><span style='font-weight:bold;'> Email Address : </span> ".$request->contact_broker_phone."</td>
                   	</tr>
					
					<tr>
                   	  	<td valign='top' style='color:#044235;'><span style='font-weight:bold;'> Phone : </span> ".$request->contact_broker_email."</td>
                   	</tr>
					
					
					
					<tr>
                   	  	<td valign='top' style='color:#044235;'><span style='font-weight:bold;'>Message : </span> ".$request->contact_broker_message."</td>
                   	</tr>
                    
			  </table>";
			
            Common::overrideMailerConfig();
           
            $data_email = array('name' => '', 'msg' => $msg, 'subject' => $subject_header);
            $user_data = array('to' => $rs_brokers['email'], 'name' => $rs_brokers['name'], 'subject' => $subject, 'siteName' => $request->contact_broker_first_name, 'businessEmail' => $request->contact_broker_email);
			
            Mail::send('emails.template', $data_email, function($message) use ($user_data) {
                $message->from($user_data['businessEmail'], $user_data['siteName']);
                $message->to($user_data['to'], $user_data['name'])->subject($user_data['subject']);
            });
		
		
		return Response::json(array('error_code' => '',  'status' => 'success', 'message' => 'Your message has been sent successfully.'));
			
     }
	 
	 public function contact_agent(Request $request) {
		$data = array();
		
		    $rs_agents = Agents::whereRaw(" id =".$request->agent_id." ")->first()->toArray();
		
		    $subject = Setting::findByKey('SITE_NAME').' Contact Us';
			 $subject_header = 'Contact Us';
            $msg = '';
            $msg	="<table width='100%' border='0' cellpadding='0' cellspacing='10' bgcolor='#FFFFFF' align='center' style='background-color: #e5e5e5; padding: 20px 0;'>
					
                  	
                  	<tr>
                   	  	<td valign='top' style='color:#044235;'><span style='font-weight:bold;'> First Name : </span> ".$request->contact_agent_first_name." </td>
                   	</tr>
					
					<tr>
                   	  	<td valign='top' style='color:#044235;'><span style='font-weight:bold;'> Last Name : </span> ".$request->contact_agent_last_name." </td>
                   	</tr>
					<tr>
                   	  	<td valign='top' style='color:#044235;'><span style='font-weight:bold;'> Email Address : </span> ".$request->contact_agent_phone."</td>
                   	</tr>
					
					<tr>
                   	  	<td valign='top' style='color:#044235;'><span style='font-weight:bold;'> Phone : </span> ".$request->contact_agent_email."</td>
                   	</tr>
					
					
					
					<tr>
                   	  	<td valign='top' style='color:#044235;'><span style='font-weight:bold;'>Message : </span> ".$request->contact_agent_message."</td>
                   	</tr>
                    
			  </table>";
			
            Common::overrideMailerConfig();
           
             $data_email = array('name' => '', 'msg' => $msg, 'subject' => $subject_header);
            $user_data = array('to' => $rs_agents['email'], 'name' => $rs_agents['name'], 'subject' => $subject, 'siteName' => $request->contact_agent_first_name, 'businessEmail' => $request->contact_agent_email);
			
            Mail::send('emails.template', $data_email, function($message) use ($user_data) {
                $message->from($user_data['businessEmail'], $user_data['siteName']);
                $message->to($user_data['to'], $user_data['name'])->subject($user_data['subject']);
            });
		
		
		return Response::json(array('error_code' => '',  'status' => 'success', 'message' => 'Your message has been sent successfully.'));
			
     }
	 
	 public function save_lead($data){
		 
		 	$model = new Leads();
			
			$model->listing_id = $data['id'];
			$model->firstName = $data['firstName'];
			$model->lastName = $data['lastName'];
			$model->emailAddress =$data['emailAddress'];
			$model->phone = $data['phone'];
			$model->listingType = $data['listingType'];
			$model->notes =$data['notes'];
			$model->mentis_id = $data['listingID'];
			$model->save();
	 }
	 
	 public function send_lead($data){
		 		//echo '<pre>'; print_r($data); exit;
		   
		        $apiKey = "506f3110";
				$agencyID = "1338";
				
				$url = "https://api.mantisproperty.com.au/leads?apikey=$apiKey&agencyID=$agencyID";
				
				 $xmlData = "<?xml version='1.0' encoding='UTF-8'?>
							<lead>
							<contact>
							<firstName>".$data['firstName']."</firstName>
							<lastName>".$data['lastName']."</lastName>
							<primaryEmail>
							<emailAddress>".$data['emailAddress']."</emailAddress>
							</primaryEmail>
							<mobile>
							<phone>".$data['phone']."</phone>
							<doNotContact>true</doNotContact>
							</mobile>
							
							<groups>
							<group>Leads</group>
							</groups>
							<source>Revoy</source>
							</contact>
							<listingID>".$data['listingID']."</listingID>
							<listingType>".$data['listingType']."</listingType>
							<notes>".$data['notes']."</notes>
							
							<notifyAgent>true</notifyAgent>
							</lead>";
				
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_POST, true);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $xmlData);
				curl_setopt($ch, CURLOPT_HTTPHEADER, [
					"Content-Type: application/xml",
					"Content-Length: " . strlen($xmlData)
				]);
				
				$response = curl_exec($ch);
				$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
				curl_close($ch);
				//return true;
				/*if ($httpCode == 200 || $httpCode == 201) {
					echo "Success: " . $response;
				} else {
					echo "Error ($httpCode): " . $response;
				}*/
		   
	   }
	 
	 public function contact_agent_prop(Request $request) {
		$data = array();
			$cc = '';
		    $rs_agents = Agents::whereRaw(" id =".$request->agent_id_prop." ")->first()->toArray();
			$propery_sharing_address = '';
			$detail_page_link = '';
			//------------------------------------------------------
			if($request->property_property_id_prop>0){
				$listingType = 'residential';
				$property_id = 0;
				$rs_asset_agent = array();
				$cc = '';
				$db_property_rs = Property::whereRaw(" id='".$request->property_property_id_prop."'  ")->get()->toArray();
				$rs_state = States::whereRaw(" id =".$db_property_rs[0]['state_id']." ")->first()->toArray();
				 $state_name = '';
				$propery_sharing_address = $db_property_rs[0]['suburb'].','.$db_property_rs[0]['postcode'].','.$rs_state['name'];
				$detail_page_link = url('/').'/detail/'.$db_property_rs[0]['slug'].'-'.$db_property_rs[0]['id'].'.html';
				if(count($db_property_rs)>0){
					$property_id = $db_property_rs[0]['property_id'];
					/*if($db_property_rs[0]['category_id']==1){
						$listingType = 'residential';
					}else if($db_property_rs[0]['category_id']==2){
						$listingType = 'rent';
					}else if($db_property_rs[0]['category_id']==3){
						$listingType = 'rent';
					}else if($db_property_rs[0]['category_id']==4){
						$listingType = 'rent';
					}*/
					if($db_property_rs[0]['assestant_user_id']!=0){
						$rs_asset_agent = Agents::whereRaw(" id =".$db_property_rs[0]['assestant_user_id']." ")->first()->toArray();
						$cc = $rs_asset_agent['email'];
					}
				}
				$syn_data = array(
									'firstName'=>$request->contact_agent_first_name_prop,
									'lastName'=>$request->contact_agent_last_name_prop,
									'emailAddress'=>$request->contact_agent_email_prop,
									'phone'=>$request->contact_agent_phone_prop,
									'listingID'=>$property_id,
									'id'=>$request->property_property_id_prop,
									'listingType'=>$listingType,
									'notes'=>$request->contact_agent_message_prop
									);
									
				$this->save_lead($syn_data);					
				$this->send_lead($syn_data);
			}
			//------------------------------------------------------
			/*
			<tr>
                   	  	<td valign='top' style='color:#044235;'><span style='font-weight:bold;'> Last Name : </span> ".$request->contact_agent_last_name_prop." </td>
                   	</tr>
			*/
		
		    $subject = Setting::findByKey('SITE_NAME').' Contact Us';
			 $subject_header = 'Contact Us';
            $msg = '';
            $msg	="<table width='100%' border='0' cellpadding='0' cellspacing='10' bgcolor='#FFFFFF' align='center' style='background-color: #e5e5e5; padding: 20px 0;'>
					
                  	
                  	<tr>
                   	  	<td valign='top' style='color:#044235;'><span style='font-weight:bold;'>  Name : </span> ".$request->contact_agent_first_name_prop." </td>
                   	</tr>
					
					
					<tr>
                   	  	<td valign='top' style='color:#044235;'><span style='font-weight:bold;'> Email Address : </span> ".$request->contact_agent_email_prop."</td>
                   	</tr>
					
					<tr>
                   	  	<td valign='top' style='color:#044235;'><span style='font-weight:bold;'> Phone : </span> ".$request->contact_agent_phone_prop."</td>
                   	</tr>
					
					
					
					<tr>
                   	  	<td valign='top' style='color:#044235;'><span style='font-weight:bold;'>Message : </span> ".$request->contact_agent_message_prop."</td>
                   	</tr>
					
					<tr>
                   	  	<td valign='top' style='color:#044235;'><span style='font-weight:bold;'>Detail : </span> ".$request->property_title_prop." (".$request->property_option_prop.")</td>
                   	</tr>
                    
			  </table>";
			
            Common::overrideMailerConfig();
           
             $data_email = array('name' => '', 'msg' => $msg, 'subject' => $subject_header);
            $user_data = array('to' => $rs_agents['email'],'cc' => $cc, 'name' => $rs_agents['name'], 'subject' => $subject, 'siteName' => Setting::findByKey('SITE_NAME'), 'businessEmail' => Setting::findByKey('FROM_EMAIL'));
			//echo '<pre>'; print_r($user_data); exit;
            Mail::send('emails.template', $data_email, function($message) use ($user_data) {
                $message->from($user_data['businessEmail'], $user_data['siteName']);
                $message->to($user_data['to'], $user_data['name'])->subject($user_data['subject']);
				/*if (isset($user_data['cc']) && !empty($user_data['cc'])) {
					$message->cc($user_data['cc']);
				}*/
            });
			
			if (isset($user_data['cc']) && $user_data['cc'] !='') {
				
				Mail::send('emails.template', $data_email, function($message) use ($user_data) {
                $message->from($user_data['businessEmail'], $user_data['siteName']);
                $message->to($user_data['cc'], $user_data['name'])->subject($user_data['subject']);
				
           		 });
				// echo 'in cc';
			}
			
			//----------------------------auto reply------------------------------------------
			$subject = Setting::findByKey('SITE_NAME').' Thanks';
			$subject_header = $request->property_title_prop;
			//$listing_link = url('/').'/agents/'.Common::slug($rs_agents['name']).'-'.$rs_agents['id'].'.html';
			if($detail_page_link==''){
				$listing_link = url('/').'/detail/'.Common::slug($rs_agents['name']).'-'.$rs_agents['id'].'.html';
			}else {
				$listing_link = $detail_page_link;
			}
            $msg = '';
			
			$msg = '<table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="width: 100%; margin: 0px auto; background-color: #f3f5fb; border-collapse: collapse; border-bottom: 1px solid #ddd;">
        <tbody><tr>
            <td style="padding: 20px; text-align: center;">
                <!-- Heading -->
                <h1 style="font-size: 28px; color: #044235; margin: 0;">Contact Our Expert</h1>
            </td>
        </tr>
        <tr>
            <td style="padding: 0px 20px 20px 20px;">
                
                <table class="responsive-table" align="center" border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse;">
                    <tbody><tr>
                        
                        <td style="padding: 10px; text-align: center; width: 100px;">
                            <img src="'.url('/') . '/public/upload/agents/' . $rs_agents['image'].'" alt="" style="width: 100px; height: 100px; border-radius: 50%;">
                        </td>
                        
                        <td style="padding: 10px; text-align: left;">
                           
                            <strong style="font-size: 20px; color: #044235;">'.$rs_agents['name'].'</strong><br>
                            
                            <span style="font-size: 14px; color: #000; margin-botom: 5px;">'.$rs_agents['designation'].'</span><br>
                            
                            <span style="font-size: 14px; color: #000;">'.$rs_agents['address'].'</span><br>
                            
                            <span style="font-size: 14px; color: #666; font-weight: bold;">'.$rs_agents['phone'].'</span><br>
                            <a href="'.url('/').'/contact-us.html" style="display: inline-block; padding: 10px 20px; background-color: #044235; color: #ffc50b; text-decoration: none; font-size: 18px; border-radius: 5px; margin-top: 10px;">Contact Us</a>
                        </td>
                    </tr>
                </tbody></table>
            </td>
        </tr>
    </tbody></table>';
			
			
			//$request->property_address_prop
			$data_email = array('name' => '', 'msg' => $msg,'listing_link'=>$listing_link, 'subject' => $subject_header , 'property_option' => $request->property_option_prop, 'property_address' => $propery_sharing_address);
            $user_data = array('to' => $request->contact_agent_email_prop, 'name' => $request->contact_agent_first_name_prop, 'subject' => $subject, 'siteName' => Setting::findByKey('SITE_NAME'), 'businessEmail' => Setting::findByKey('FROM_EMAIL'));
			 //echo $html_email = view('emails.template_auto_reply',$data_email)->render(); exit;
			 
			Mail::send('emails.template_auto_reply', $data_email, function($message) use ($user_data) {
                $message->from($user_data['businessEmail'], $user_data['siteName']);
                $message->to($user_data['to'], $user_data['name'])->subject($user_data['subject']);
            });
			//-------------------------------------------------------------------------------
		
		
		return Response::json(array('error_code' => '',  'status' => 'success', 'message' => 'Your message has been sent successfully.'));
			
     }
	 
	 public function contact_agent_detail(Request $request) {
		$data = array();
			$cc = '';
			
			if(isset($request->property_id_detail) && $request->property_id_detail!=""){
			$db_property_rs = Property::whereRaw(" id='".$request->property_id_detail."'  ")->get()->toArray();
				if(count($db_property_rs)>0){
					$property_id = $db_property_rs[0]['property_id'];
					if($db_property_rs[0]['assestant_user_id']!=0){
					$rs_asset_agent = Agents::whereRaw(" id =".$db_property_rs[0]['assestant_user_id']." ")->first()->toArray();
					$cc = $rs_asset_agent['email'];
					}
					
				}
			}
			
		    $rs_agents = Agents::whereRaw(" id =".$request->agent_id_detail." ")->first()->toArray();
			
			if($request->contact_method=='call'){
			
			$tr = "<tr>
                   	  	<td valign='top' style='color:#044235;'><span style='font-weight:bold;'> Phone : </span> ".$request->contact_agent_phone_detail."</td>
                   	</tr>";
			
			}else {
				
				$tr = "<tr>
                   	  	<td valign='top' style='color:#044235;'><span style='font-weight:bold;'> Email Address : </span> ".$request->contact_agent_email_detail."</td>
                   	</tr>
					";
			}
			
			if($request->enquiry_detail!=''){
				$tr = "<tr>
                   	  	<td valign='top' style='color:#044235;'><span style='font-weight:bold;'> Enquiry About : </span> ".$request->enquiry_detail."</td>
                   	</tr>
					";
			}
			
		
		    $subject = Setting::findByKey('SITE_NAME').' Property Appraisal Request';
			$subject_header = 'Property Appraisal Request';
            $msg = '';
            $msg	="<table width='100%' border='0' cellpadding='0' cellspacing='10' bgcolor='#FFFFFF' align='center' style='background-color: #e5e5e5; padding: 20px 0;'>
					
                  	
                  	<tr>
                   	  	<td valign='top' style='color:#044235;'><span style='font-weight:bold;'> Name : </span> ".$request->contact_agent_first_name_detail." </td>
                   	</tr>
					
					
					
					".$tr."
					
					
					
					<tr>
                   	  	<td valign='top' style='color:#044235;'><span style='font-weight:bold;'>Message : </span> ".$request->contact_agent_message_detail."</td>
                   	</tr>
					
					<tr>
                   	  	<td valign='top' style='color:#044235;'><span style='font-weight:bold;'>Address : </span> ".$request->contact_address."</td>
                   	</tr>
                    
			  </table>";
			
            Common::overrideMailerConfig();
          
            $data_email = array('name' => '', 'msg' => $msg, 'subject' => $subject_header);
            $user_data = array('to' => $rs_agents['email'],'cc' => $cc, 'name' => $rs_agents['name'], 'subject' => $subject, 'siteName' => $request->contact_agent_first_name, 'businessEmail' => Setting::findByKey('FROM_EMAIL'));
			
            Mail::send('emails.template', $data_email, function($message) use ($user_data) {
                $message->from($user_data['businessEmail'], $user_data['siteName']);
                $message->to($user_data['to'], $user_data['name'])->subject($user_data['subject']);
				/*if (isset($user_data['cc']) && !empty($user_data['cc'])) {
					$message->cc($user_data['cc']);
				}*/
            });
			
			if (isset($user_data['cc']) && $user_data['cc'] !='') {
				Mail::send('emails.template', $data_email, function($message) use ($user_data) {
					$message->from($user_data['businessEmail'], $user_data['siteName']);
					$message->to($user_data['cc'], $user_data['name'])->subject($user_data['subject']);
					
				});
			}
			
			
			$data_email = array('name' => '', 'msg' => $msg, 'subject' => $subject_header);
            $user_data = array('to' => Setting::findByKey('CONTACT_EMAIL'), 'name' => Setting::findByKey('SITE_NAME'), 'subject' => $subject, 'siteName' => $request->contact_agent_first_name, 'businessEmail' => Setting::findByKey('FROM_EMAIL'));
			
            Mail::send('emails.template', $data_email, function($message) use ($user_data) {
                $message->from($user_data['businessEmail'], $user_data['siteName']);
                $message->to($user_data['to'], $user_data['name'])->subject($user_data['subject']);
            });
		
		
		return Response::json(array('error_code' => '',  'status' => 'success', 'message' => 'Your message has been send successfully.'));
			
     }
	 
	 public function contact_free_estimate_detail(Request $request) {
		$data = array();
		
		   
			
			if($request->contact_method=='call'){
			
			$tr = "<tr>
                   	  	<td valign='top' style='color:#044235;'><span style='font-weight:bold;'> Phone : </span> ".$request->contact_agent_phone_detail."</td>
                   	</tr>";
			
			}else {
				
				$tr = "<tr>
                   	  	<td valign='top' style='color:#044235;'><span style='font-weight:bold;'> Email Address : </span> ".$request->contact_agent_email_detail."</td>
                   	</tr>
					";
			}
			
			if($request->enquiry_detail!=''){
				$tr = "<tr>
                   	  	<td valign='top' style='color:#044235;'><span style='font-weight:bold;'> Enquiry About : </span> ".$request->enquiry_detail."</td>
                   	</tr>
					";
			}
			
		
		    $subject = Setting::findByKey('SITE_NAME').' Contact Us';
			$subject_header = 'Contact Us';
            $msg = '';
            $msg	="<table width='100%' border='0' cellpadding='0' cellspacing='10' bgcolor='#FFFFFF' align='center' style='background-color: #e5e5e5; padding: 20px 0;'>
					
                  	
                  	<tr>
                   	  	<td valign='top' style='color:#044235;'><span style='font-weight:bold;'> Name : </span> ".$request->contact_agent_first_name." </td>
                   	</tr>
					
					
					
					".$tr."
					
					
					
					<tr>
                   	  	<td valign='top' style='color:#044235;'><span style='font-weight:bold;'>Message : </span> ".$request->contact_agent_message."</td>
                   	</tr>
					
					<tr>
                   	  	<td valign='top' style='color:#044235;'><span style='font-weight:bold;'>Address : </span> ".$request->contact_address."</td>
                   	</tr>
                    
			  </table>";
			
            Common::overrideMailerConfig();
           
            
			
			
			$data_email = array('name' => '', 'msg' => $msg, 'subject' => $subject_header);
            $user_data = array('to' => Setting::findByKey('CONTACT_EMAIL'), 'name' => Setting::findByKey('SITE_NAME'), 'subject' => $subject, 'siteName' => $request->contact_agent_first_name, 'businessEmail' => Setting::findByKey('FROM_EMAIL'));
			
            Mail::send('emails.template', $data_email, function($message) use ($user_data) {
                $message->from($user_data['businessEmail'], $user_data['siteName']);
                $message->to($user_data['to'], $user_data['name'])->subject($user_data['subject']);
            });
		
		
		return Response::json(array('error_code' => '',  'status' => 'success', 'message' => 'Your message has been send successfully.'));
			
     }
	 
	 public function contact_process_service(Request $request) {
		$data = array();
		
		  
		
		    $subject = Setting::findByKey('SITE_NAME').' Contact Us';
			$subject_header = 'Contact Us';
            $msg = '';
            $msg	="<table width='100%' border='0' cellpadding='0' cellspacing='10' bgcolor='#FFFFFF' align='center' style='background-color: #e5e5e5; padding: 20px 0;'>
					
                  	
                  	<tr>
                   	  	<td valign='top' style='color:#044235;'><span style='font-weight:bold;'> First Name : </span>".$request->contact_you." ".$request->contact_first_name." </td>
                   	</tr>
					
					<tr>
                   	  	<td valign='top' style='color:#044235;'><span style='font-weight:bold;'> Last Name : </span> ".$request->contact_last_name." </td>
                   	</tr>
					<tr>
                   	  	<td valign='top' style='color:#044235;'><span style='font-weight:bold;'> Email Address : </span> ".$request->contact_email."</td>
                   	</tr>
					
					<tr>
                   	  	<td valign='top' style='color:#044235;'><span style='font-weight:bold;'> Phone : </span> ".$request->contact_phone."</td>
                   	</tr>
					
					<tr>
                   	  	<td valign='top' style='color:#044235;'><span style='font-weight:bold;'> Town / City : </span> ".$request->contact_city."</td>
                   	</tr>
					
					<tr>
                   	  	<td valign='top' style='color:#044235;'><span style='font-weight:bold;'> Post Code : </span> ".$request->contact_post_code."</td>
                   	</tr>
					
					<tr>
                   	  	<td valign='top' style='color:#044235;'><span style='font-weight:bold;'> Enquiry For : </span> ".$request->contact_enquiry_for."</td>
                   	</tr>
					
					<tr>
                   	  	<td valign='top' style='color:#044235;'><span style='font-weight:bold;'> Prefrence Respond : </span> ".$request->contact_prefrence_respond."</td>
                   	</tr>
					
					<tr>
                   	  	<td valign='top' style='color:#044235;'><span style='font-weight:bold;'>Message : </span> ".$request->contact_message."</td>
                   	</tr>
                    
			  </table>";
			
            Common::overrideMailerConfig();
           
            $data_email = array('name' => '', 'msg' => $msg, 'subject' => $subject_header);
            $user_data = array('to' => Setting::findByKey('CONTACT_EMAIL'), 'name' => Setting::findByKey('SITE_NAME'), 'subject' => $subject, 'siteName' => $request->contact_first_name, 'businessEmail' => $request->contact_email);
			
            Mail::send('emails.template', $data_email, function($message) use ($user_data) {
                $message->from($user_data['businessEmail'], $user_data['siteName']);
                $message->to($user_data['to'], $user_data['name'])->subject($user_data['subject']);
            });
		
		
		return Response::json(array('error_code' => '',  'status' => 'success', 'message' => 'Your message has been sent successfully.'));
			
     }
	 
	 
	 public function register_process(Request $request) {
		    $data = array();
		   $result = Subscribe::findByEmail($request->contact_email);
		   if(count($result)==0){
			    $model = new Subscribe();
				$model->name = '';
				$model->email = $request->sub_email;
				
				$model->created_at = date('Y-m-d H:i:s');
				$model->status = 'Yes';
				$model->save();
				
				
			   
		   return Response::json(array('error_code' => '',  'status' => 'success', 'message' => 'You have successfully registerd.'));
		   }else {
			   return Response::json(array('error_code' => '',  'status' => 'error', 'message' => 'You have already registerd.'));
		   }
			
     }
	  public function load_more_review(Request $request){
		  //last_id
		  $result_reviews = AgentReviews::whereRaw("status = 'Yes' AND admin_status = 'Yes' AND user_id  = ".$request->id." AND id < ".$request->last_id." ")->orderByRaw('id DESC')->take(3)->get()->toArray();
			
			 $html = view('common._reviews',['result_reviews'=>$result_reviews])->render();
			 
			 $last_id = 0;
			 if(count($result_reviews)>0){
				 foreach ($result_reviews as $row_coment) {
				 }
				 $last_id = $row_coment['id'];
			 }
			 
			 $count_rows = count($result_reviews);
		     
			 return Response::json(array('error_code' => '',  'status' => 'success', 'html' => $html,'last_id'=>$last_id,'count_rows'=>$count_rows));
	  } 
	  
	   public function load_more_property(Request $request){
		  //last_id
		  
		  $user_id = Agents::get_user_id($request->id);
		  
		  $db_property = Property::whereRaw("status = 'Yes' AND admin_status = 'Yes' AND user_id IN (".$user_id.") AND id < ".$request->last_id." ")->orderByRaw('id DESC')->take(3)->get();
			
			 $html = view('common._user_property',['db_property'=>$db_property])->render();
			 
			 $last_id = 0;
			 if(count($db_property)>0){
				 foreach ($db_property as $row_coment) {
				 }
				 $last_id = $row_coment['id'];
			 }
			 
			 $count_rows = count($db_property);
		     
			 return Response::json(array('error_code' => '',  'status' => 'success', 'html' => $html,'last_id'=>$last_id,'count_rows'=>$count_rows));
	  } 
	 
	  public function load_property_data(Request $request){
		  $where = '';
		  if($request->state_id!=""){
			  $where .= " AND state_id = '".$request->state_id."' AND category_id = 1 ";  
		  }
		  $result  =  Property::whereRaw("status = 'Yes'  AND admin_status = 'Yes' ".$where." ")->select('latitude','longitude','street_address')->get()->toArray();
		  echo json_encode($result);
	  }
	  
	  
	  
	  public function agent_load_property_data(Request $request){
		  $where = '';
		  if($request->user_id!=""){
			  $where .= " AND user_id = '".$request->user_id."' ";  
		  }
		  
		  if($request->p_type!=0){
			  $where .= " AND category_id = '".$request->p_type."' ";  
		  }
		  
		  $result  =  Property::whereRaw("status = 'Yes'  AND admin_status = 'Yes' ".$where." ")->select('latitude','longitude',DB::raw("CONCAT(street_address, ' Austrila') AS street_address"))->get()->toArray();
		  echo json_encode($result);
	  }
	  
	  public function agent_load_property_data_list(Request $request){
		  $where = '';
		  $limit = 3;
		  if($request->user_id!=""){
			  $user_id = Agents::get_user_id($request->user_id);
			  $where .= " AND user_id IN (".$user_id.") ";  
		  }
		  
		  if($request->p_type!=0){
			  $where .= " AND category_id = '".$request->p_type."' ";  
		  }
		  
		  $db_property = Property::whereRaw("status = 'Yes' AND admin_status = 'Yes' ".$where."  ")->orderByRaw('id DESC')->take($limit)->get();
		  $db_property_total = Property::whereRaw("status = 'Yes' AND admin_status = 'Yes' ".$where."  ")->count();
			
			$html = view('common._load_agent_filter_result',['limit'=>$limit,'db_property'=>$db_property,'db_property_total'=>$db_property_total,'user_id'=>$request->user_id])->render();
			
			return Response::json(array('error_code' => '',  'status' => 'success', 'html' => $html));
		  
	  }
	 
	 public function load_property(Request $request) {
	 
	     $per_page =  Setting::findByKey('PAGES');
		 $html = '';
		 $html_2 = '';
		 $link = '';
		 $status = 'success';
		 
		 $cur_page = $page = $request->page;
		 
		 $page = ($cur_page==1)?0:$cur_page;
		 $per_page = $per_page;
		 $page = $page-1;
		 $page = ($page<0)?0:$page;
		 $start = $page * $per_page;
		 $limit = ' LIMIT '.$start.','.$per_page;
			
		
		 if($request->from_page=='state'){
			 $sid = $request->sid;
			 
			  $count   = Property::whereRaw("status = 'Yes'  AND admin_status = 'Yes' AND state_id= ".$sid."  ")->count();
			  
			  $result  =  Property::whereRaw("status = 'Yes'  AND admin_status = 'Yes' AND state_id= ".$sid."  ")->orderByRaw('package_id DESC, id DESC')->skip($start)->take($per_page)->get();
			
			  if($count>$per_page) {
				$link = Common::getLinks($count,$cur_page,$per_page);
			  }
			 
			 if($result->count()>0){
				 $html = view('common.listing.view',['result'=>$result])->render();
				
			 }
			 
		 }else if($request->from_page=='search'){
			  $where = '';
			  $keywords = $request->keywords;
			  $where .= " AND category_id = ".$request->category_id." ";
			  if($request->property_type_id!=''){
				    if (strpos($request->property_type_id, 'all') === false) {
						$where .= " AND property_type_id IN(".$request->property_type_id.") ";
					}
			  }
			  
			   if($request->min_price!='' && $request->max_price!=''){
				   $where .= " AND price BETWEEN  ".str_replace('$','',$request->min_price)." AND ".str_replace('$','',$request->max_price)." ";
			   }
				
				if($request->min_bedrooms!='' && $request->max_bedrooms!=''){
				   $where .= " AND bedrooms BETWEEN  ".$request->min_bedrooms." AND ".$request->max_bedrooms." ";
			   }   
				
			 if($request->bathrooms!=''){
				   $where .= " AND bathrooms = ".$request->bathrooms." ";
			   } 
			   
			    if($request->car_spaces!=''){
				   $where .= " AND garage_spaces = ".$request->car_spaces." ";
			   } 
			   
			   if($request->min_land_sizes!='' && $request->max_land_sizes!=''){
				   $where .= " AND land_size BETWEEN  ".$request->min_land_sizes." AND ".$request->max_land_sizes." ";
			   }  
			   
			   if($request->esatblish!='' ){
				   $where .= " AND LOWER(property_status_type) ='".strtolower($request->esatblish)."' ";
			   }
			   
			   if($request->outdoor_features!='' ){
				   $where .= " AND outdoor_features IN(".$request->outdoor_features.") ";
			   } 
			   
			   if($request->indoor_features!='' ){
				   $where .= " AND indoor_features IN(".$request->indoor_features.") ";
			   } 
			   
			   if($request->climatecontrol!='' ){
				   $where .= " AND heating_cooling IN(".$request->climatecontrol.") ";
			   } 
			   
			   if($request->ecofriendly!='' ){
				   $where .= " AND eco_friendly_features IN(".$request->ecofriendly.") ";
			   } 
			   
			    	   
			 
			  $count   = Property::whereRaw("status = 'Yes'  AND admin_status = 'Yes' ".$where." ")
			  			->when(!empty($keywords), function ($query) use ($keywords) {
							$query->where(function ($subQuery) use ($keywords) {
								$subQuery->where('suburb', 'LIKE', '%' . $keywords . '%')
										 ->orWhere('street_address', 'LIKE', '%' . $keywords . '%')
										  ->orWhere('name', 'LIKE', '%' . $keywords . '%')
										   ->orWhere('full_contents', 'LIKE', '%' . $keywords . '%')
										   ->orWhere('street_address', 'LIKE', '%' . $keywords . '%')
										 ->orWhere('address_unit', 'LIKE', '%' . $keywords . '%');
							});
						})->count();
			  
			  $result  =  Property::whereRaw("status = 'Yes'  AND admin_status = 'Yes' ".$where." ")
			  				->when(!empty($keywords), function ($query) use ($keywords) {
							$query->where(function ($subQuery) use ($keywords) {
								$subQuery->where('suburb', 'LIKE', '%' . $keywords . '%')
										 ->orWhere('street_address', 'LIKE', '%' . $keywords . '%')
										  ->orWhere('name', 'LIKE', '%' . $keywords . '%')
										   ->orWhere('full_contents', 'LIKE', '%' . $keywords . '%')
										   ->orWhere('street_address', 'LIKE', '%' . $keywords . '%')
										 ->orWhere('address_unit', 'LIKE', '%' . $keywords . '%');
							});
						})->orderByRaw('package_id DESC, id DESC')->skip($start)->take($per_page)->get();
			
			  if($count>$per_page) {
				$link = Common::getLinks($count,$cur_page,$per_page);
			  }
			 
			 if($result->count()>0){
				 $html = view('common.listing.view',['result'=>$result])->render();
				
			 }
			 
		 }
		 
		 return Response::json(array('error_code' => '',  'status' => $status, 'html' => $html,'total_ads'=>$count, 'page' => $page, 'link' => $link));
		 
	 }
	 
	 
	 public function load_video(Request $request) {
	 
	     $per_page =  Setting::findByKey('PAGES');
		 $html = '';
		 $html_2 = '';
		 $link = '';
		 $status = 'success';
		 
		 $cur_page = $page = $request->page;
		 
		 $page = ($cur_page==1)?0:$cur_page;
		 $per_page = $per_page;
		 $page = $page-1;
		 $page = ($page<0)?0:$page;
		 $start = $page * $per_page;
		 $limit = ' LIMIT '.$start.','.$per_page;
			
		  $where = '';
		 if($request->from_page=='video'){
			 
			  if($request->filter_type!=''){
				   if($request->filter_type=='category'){
				  	  $where .= " AND category_id = ".$request->filter_ids." ";
				   }else {
					   $where .= " AND sub_category_id = ".$request->filter_ids." ";
				   }
			   } 
			      
			 
			  $count   = Videos::whereRaw("status = 'Yes'   ".$where." ")->count();
			  
			  $result  =  Videos::whereRaw("status = 'Yes'   ".$where." ")->orderByRaw('id DESC, id DESC')->skip($start)->take($per_page)->get();
			  
			  if($count>$per_page) {
				$link = Common::getLinks($count,$cur_page,$per_page);
			  }
			 
			 if($result->count()>0){
				 $html = view('common._video',['result_video'=>$result])->render();
				
			 }
			 
		 }else if($request->from_page=='search'){
			 
			  
			  
				
			  if($request->bathrooms!=''){
				   $where .= " AND bathrooms ".$request->bathrooms." ";
			   } 
			      
			 
			  $count   = Videos::whereRaw("status = 'Yes'   ".$where." ")->count();
			  
			  $result  =  Videos::whereRaw("status = 'Yes'   ".$where." ")->orderByRaw('id DESC, id DESC')->skip($start)->take($per_page)->get();
			
			  if($count>$per_page) {
				$link = Common::getLinks($count,$cur_page,$per_page);
			  }
			 
			 if($result->count()>0){
				 $html = view('common._video',['result_video'=>$result])->render();
				
			 }
			 
		 }
		 
		 return Response::json(array('error_code' => '',  'status' => $status, 'html' => $html,'total_ads'=>$count, 'page' => $page, 'link' => $link));
		 
	 }
	 
	  public function load_property_type_filter(Request $request) {
		  
		  $selected_ids = array();
		  if($request->filter_property_types!=''){
			   $selected_ids = explode(',', $request->filter_property_types);
		  }
		  
		   $result   = Propertytypes::whereRaw(" status = 'Yes' AND FIND_IN_SET('".$request->id."', property_options) ")->get()->toArray();
		   
		   			$checked_set = '';
				   if(in_array('all',$selected_ids)){
					   $checked_set = 'checked';
				   }
		   
		   $html = '<ul class="interior__amenities--check"><li class="interior__amenities--check__list">
                                                    <label class="interior__amenities--check__label"
                                                        for="All">All</label>
                                                    <input class="interior__amenities--check__input" id="All"
                                                        type="checkbox" value="all"  name="property_type[]" '.$checked_set.'>
                                                    <span class="interior__amenities--checkmark"></span>
                                                </li>';
		   if(count($result)>0){
			   foreach ($result as $row){
				   
				   $checked_set = '';
				   if(in_array($row['id'],$selected_ids)){
					   $checked_set = 'checked';
				   }
				   
				   $html .= '<li class="interior__amenities--check__list">
                                                    <label class="interior__amenities--check__label"
                                                        for="check'.$row['name'].'">'.$row['name'].'</label>
                                                    <input class="interior__amenities--check__input" id="check'.$row['id'].'"
                                                        type="checkbox" value="'.$row['id'].'" name="property_type[]" '.$checked_set.' >
                                                    <span class="interior__amenities--checkmark"></span>
                                                </li>';
			   }
		   }
		   
		   $html .='</ul>';
		   $status = 'success';
		   return Response::json(array('error_code' => '',  'status' => $status, 'html' => $html));
	  }
	  
	   public function load_near_by(Request $request) {
		   
		   	$result = array();
		    $apiKey = Setting::findByKey('MAP_KEY');
			$lat = $request->latitude;
			$lng = $request->longitude;
			$type = "primary_school";
			
			$array_schools = array();
			
			$places = Common::getNearbyPlaces($lat, $lng, $type, $apiKey);
			
			if ($places['status'] == 'OK') {
    			foreach ($places['results'] as $place) {
					$placeLat = $place['geometry']['location']['lat'];
					$placeLng = $place['geometry']['location']['lng'];
					$distance = Common::getDistance($lat, $lng, $placeLat, $placeLng, $apiKey);
					 //echo '<br>=============================================<br>';
					 //echo "Name: " . $place['name'] . "<br>";
					// echo "Address: " . $place['vicinity'] . "<br>";
					// echo "Distance: " . $distance . "<br>";
					// echo '<br>=============================================<br>';
					$array_schools[] = array('name'=>$place['name'],'address'=>$place['vicinity'],'distance'=>$distance);
					
				}
			}
			
			$type = "secondary_school";
			$array_secondary_school = array();
			$places = Common::getNearbyPlaces($lat, $lng, $type, $apiKey);
			if ($places['status'] == 'OK') {
    			foreach ($places['results'] as $place) {
					$placeLat = $place['geometry']['location']['lat'];
					$placeLng = $place['geometry']['location']['lng'];
					$distance = Common::getDistance($lat, $lng, $placeLat, $placeLng, $apiKey);
					$array_secondary_school[] = array('name'=>$place['name'],'address'=>$place['vicinity'],'distance'=>$distance);
					
				}
			}
			
			$type = "establishment";
			$array_establishment = array();
			$places = Common::getNearbyPlaces($lat, $lng, $type, $apiKey);
			if ($places['status'] == 'OK') {
    			foreach ($places['results'] as $place) {
					$placeLat = $place['geometry']['location']['lat'];
					$placeLng = $place['geometry']['location']['lng'];
					$distance = Common::getDistance($lat, $lng, $placeLat, $placeLng, $apiKey);
					$array_establishment[] = array('name'=>$place['name'],'address'=>$place['vicinity'],'distance'=>$distance);
					
				}
			}
			
			
		    $html = view('common._propery_near_by',['array_schools'=>$array_schools,'array_secondary_school'=>$array_secondary_school,'array_establishment'=>$array_establishment])->render();
			$status = 'success';
			 return Response::json(array('error_code' => '',  'status' => $status, 'html' => $html));
		   
	   }
	   
	   	 public function load_address_detail(Request $request) {
			 
			  DB::statement("SET sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''));");	
			  $html = '';
			  
			    $where = '';
				$keywords = $request->keywords;
				
				$result_data = PropertyData::whereRaw("status = 'Yes' AND is_processed = 'Yes' ")
					->where('name', 'LIKE', '%' . $request->keywords . '%')
					->take(10)
					->get();
					
				if($result_data->count()>0){
					foreach ($result_data as $k=>$row){	
						$html .= '<li class="property-suggestion-item" data-keyword="">
										<a class="property-suggestion-link" target="_blank" href="'.url('/').'/view/'.$row->slug.'.html">
										  '.$row->name.'
										</a>
								</li>';
					}
					
				}else {
					$html .= '<div class="recent-search-item">
								No Result Found
							 </div>';
				}
				
				return Response::json(array('error_code' => '',  'status' => 'success', 'html' => $html));
			 
		 }
	   
	    public function load_address(Request $request) {
			 DB::statement("SET sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''));");	
		$html = '';
	   	if($request->filter!='agent' && $request->filter!='address' ){ 
		$html = '<ul class="suggestions " id="id_suggestion_'.$request->filter.'" >';
		}
		$where = '';
		$keywords = $request->keywords;
		
		$result_state = States::whereRaw("status = 'Yes'")
			->where('name', 'LIKE', '%' . $request->keywords . '%')
			->take(10)
			->get();
		
		if($result_state->count()>0){
			
			if($result_state->count()>0){
					foreach ($result_state as $k=>$row){	
				$address = $row->name;
				
						if($request->filter!='agent' && $request->filter!='address'){ 		
						$html .= '<li ><div class="recentsearch-div">
										<i class="fa-solid fa-magnifying-glass"></i>
										<p>
											'.$address.'
										</p>
									</div>
								  </li>';		
						}else {
							
							$html .= '<div class="recent-search-item" >
							<a href="javascript:void(0)" onclick="search_goto_agents(\''.$request->filter.'\',\''.$address.'\')">
								<i class="fa-solid fa-search"></i>
								<span id="id_res_'.$k.'_'.$request->filter.'">'.$address.'</span>
							</a>
						</div>';
							
						}
				}
				}else {
					$html .= '<div class="recent-search-item">
								No Result Found
							 </div>';
				}
			
		}else {
		
		
		$keywordArray = explode(' ', trim($keywords)); // Split keywords into an array
		
		$where = '';
		if($request->filter=='buy'){
			$where = " AND category_id = 1 ";
		}else if($request->filter=='rent'){
			$where = " AND category_id = 2 ";
		}else if($request->filter=='sold'){
			$where = " AND  category_id = 3 ";
		}
		
		if($request->filter=='address'){
			$where .= " AND is_new='Yes' ";
		}else {
			$where .= " AND  is_new='No' ";
		}
		
		$result = Property::whereRaw("status = 'Yes'  AND admin_status = 'Yes'  ".$where." ")
			->when(!empty($keywordArray), function ($query) use ($keywordArray) {
				$query->where(function ($subQuery) use ($keywordArray) {
					foreach ($keywordArray as $keyword) {
						$subQuery->orWhere('suburb', 'LIKE', '%' . $keyword . '%')
								 //->orWhere('street_address', 'LIKE', '%' . $keyword . '%')
								 ->orWhere('postcode', 'LIKE', '%' . $keyword . '%');
								 //->orWhere('address_unit', 'LIKE', '%' . $keyword . '%');
					}
				});
			})
			->groupBy('suburb', 'postcode')
			->orderByRaw('package_id DESC, id DESC')
			->take(10)
			->get();

			   if($result->count()>0){
					foreach ($result as $k=>$row){	
				$address = $row->suburb.','.$row->property_state->name.','.$row->postcode;
				
						if($request->filter!='agent' && $request->filter!='address'){ 		
						$html .= '<li ><div class="recentsearch-div">
										<i class="fa-solid fa-magnifying-glass"></i>
										<p>
											'.$address.'
										</p>
									</div>
								  </li>';		
						}else {
							
							$html .= '<div class="recent-search-item" >
							<a href="javascript:void(0)" onclick="search_goto_agents(\''.$request->filter.'\',\''.$address.'\')">
								<i class="fa-solid fa-search"></i>
								<span id="id_res_'.$k.'_'.$request->filter.'">'.$address.'</span>
							</a>
						</div>';
							
						}
				}
				}else {
					$html .= '<div class="recent-search-item">
								No Result Found
							 </div>';
				}
		}
		
		
		
		if($request->filter!='agent' && $request->filter!='address'){ 
		$html .= '</ul>';
		}
		
		
		
	   	return Response::json(array('error_code' => '',  'status' => 'success', 'html' => $html));
		   
	   }
	   
	   
	   public function test_email(Request $request){
		   exit;
		  				// echo $request->email;
		   				Common::overrideMailerConfig();
		   				$SITE_NAME = Setting::findByKey('SITE_NAME');
						$FROM_EMAIL = Setting::findByKey('FROM_EMAIL');	
							
						$subject = ' Welcome to '.$SITE_NAME;
						$msg = '';
						//$msg .= '<h3>' . $subject . '</h3>';
						//$msg .= '<hr>';
						$msg .= '<p style="line-height:25px;">Your account has been registered successfully.Please click on following button to activate account.</p>';
						 
						$msg .= '<p style="line-height:25px;"> <a target="_blank" href="#" style="color: #044235; cursor: pointer; background: #ffc50b; padding: 10px 40px; border-radius: 5px; display: inline; text-decoration: none;"><b>Activate Your Account</b></a> 
			
			</p>';
			
						$data_email = array('name' => '', 'msg' => $msg , 'subject' => $subject);
						
						$user_data = array('to' => $request->email, 'name' => 'Dev Test', 'subject' => $subject, 'siteName' => $SITE_NAME, 'businessEmail' => $FROM_EMAIL);
		   				echo '<pre>'; print_r($user_data);
						
						echo $msg;
						
						 Mail::send('emails.template', $data_email, function($message) use ($user_data) {
							$message->from($user_data['businessEmail'], $user_data['siteName']);
							$message->to($user_data['to'], $user_data['name'])->subject($user_data['subject']);
						});
						
						echo '<br><br>email send ';
		   
	   }
	
}
