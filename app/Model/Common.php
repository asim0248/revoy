<?php namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Session;
use DB;
use PDO;
use Illuminate\Support\Str;
use Datetime;
use Config;
class Common extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    
    
   public static  function formatCreatedAt($createdAt) {
    // Convert the created_at date to a timestamp
    $createdTimestamp = strtotime($createdAt);
    $currentTimestamp = time();

    // Calculate the difference in seconds
    $differenceInSeconds = $currentTimestamp - $createdTimestamp;

    // Calculate the number of days
    $days = floor($differenceInSeconds / (60 * 60 * 24));

    // Check if the difference is within 5 days
    if ($days <= 5) {
        return $days === 0 ? 'Today' : "$days days ago";
    } else {
        // Format the date (customize as needed)
        return date('Y-m-d', $createdTimestamp);
    }
}
	
	public static function timeAgo($datetime, $full = false)
		{
			$now = new DateTime;
			$ago = new DateTime($datetime);
			$diff = $now->diff($ago);
			$diff->w = floor($diff->d / 7);
			$diff->d -= $diff->w * 7;
		
			$string = array(
				'y' => 'Year',
				'm' => 'Month',
				'w' => 'Week',
				'd' => 'Day',
				'h' => 'Hour',
				'i' => 'Minute',
				's' => 'Second',
			);
		
			foreach ($string as $k => &$v) 
			{
				if ($diff->$k) 
				{
					$v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? ' ' : '');
				} 
				else 
				{
					unset($string[$k]);
				}
			}
		
			if ( ! $full)
			{
				$string = array_slice($string, 0, 1);   
			} 
		
			return $string ? implode(', ', $string) . '' : 'just now';
		
		}
	
	/*
      |--------------------------------------------------------------------------
      | function to find city 
      |--------------------------------------------------------------------------
     */
    public static function slug($string) {
		$string = str_replace(" & ", " and ", strtolower($string));
		$string = str_replace(" ", "-", $string);
   		$string = preg_replace('/[^A-Za-z0-9\-]/', '', $string);
		$string = strtolower(trim($string, '-'));
		$string = rtrim($string, '-');
        $string = ltrim($string, '-');
		return preg_replace('/-+/', '-', $string);
	}
	/*
      |--------------------------------------------------------------------------
      | function to find lat long 
      |--------------------------------------------------------------------------
     */
    public static function address_to_latlong($address) {
		$prepAddr = str_replace(' ','+',$address);
        $geocode=file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.$prepAddr.'&sensor=false');
        $output= json_decode($geocode);
        $latitude = $output->results[0]->geometry->location->lat;
        $longitude = $output->results[0]->geometry->location->lng;
		return array('lat'=>$latitude,'lng'=>$longitude);
	}
	
	/*
      |--------------------------------------------------------------------------
      | function to phoneformat 
      |--------------------------------------------------------------------------
     */
    public static function phoneformat($phone) {
		$phone = str_replace("(", "", $phone);
		$phone = str_replace(")", "", $phone);
   		$phone = str_replace(" ", "", $phone);
		return '+92'.$phone;
	}
	
	/*
      |--------------------------------------------------------------------------
      | function to priceFormat 
      |--------------------------------------------------------------------------
     */
    public static function priceFormat($price) {
		
		return '$'.number_format($price);
	}
	
	/*
      |--------------------------------------------------------------------------
      | function to priceFormat 
      |--------------------------------------------------------------------------
     */
    public static function formatPrice($price) {
		
		return number_format($price);
	}
	/*
      |--------------------------------------------------------------------------
      | function to set date formate 
      |--------------------------------------------------------------------------
     */
    public static function addDate($date) {
		 $date = str_replace(' - ',' ',$date);
		return date('Y-m-d H:i:s',strtotime($date));
	}
	
	public static function dateFormat($date) {
		 $date = str_replace(' - ',' ',$date);
		return date('d M,Y',strtotime($date));
	}
	
	
	/*
      |--------------------------------------------------------------------------
      | pagination
      |--------------------------------------------------------------------------
     */
	
	public static function getLinks_Old($count,$cur_page,$per_page)
	{
		$previous_btn = true;
		$next_btn = true;
		$first_btn = true;
		$last_btn = true;
		$no_of_paginations = ceil($count / $per_page);
		
		/* ---------------Calculating the starting and endign values for the loop----------------------------------- */
	if ($cur_page >= 7) {
		$start_loop = $cur_page - 3;
		if ($no_of_paginations > $cur_page + 3)
			$end_loop = $cur_page + 3;
		else if ($cur_page <= $no_of_paginations && $cur_page > $no_of_paginations - 6) {
			$start_loop = $no_of_paginations - 6;
			$end_loop = $no_of_paginations;
		} else {
			$end_loop = $no_of_paginations;
		}
	} else {
		$start_loop = 1;
		if ($no_of_paginations > 7)
			$end_loop = 7;
		else
			$end_loop = $no_of_paginations;
	}
	$links = '';
	/* ----------------------------------------------------------------------------------------------------------- */
	$links .= '<nav class="text-center">
			<ul class="pagination ">';
	
	// FOR ENABLING THE PREVIOUS BUTTON
	if ($previous_btn && $cur_page > 1) {
		$pre = $cur_page - 1;
		$links .= "<li p='$pre' class='active'><a onclick='loadData(".$pre.")' href='javascript:void(0)'>Previous</a></li>";
	} else if ($previous_btn) {
		$links .= "<li class='inactive'><a href='javascript:void(0)'>Previous</a></li>";
	}
	for ($i = $start_loop; $i <= $end_loop; $i++) {
	
		if ($cur_page == $i)
			$links .= "<li p='$i' style='' class='active'><a href='javascript:void(0)'>{$i}</a></li>";
		else
			$links .= "<li p='$i' class=''><a onclick='loadData(".$i.")' href='javascript:void(0)'>{$i}</a></li>";
	}
	
	// TO ENABLE THE NEXT BUTTON
	if ($next_btn && $cur_page < $no_of_paginations) {
		$nex = $cur_page + 1;
		$links .= "<li p='$nex' class='active'><a onclick='loadData(".$nex.")' href='javascript:void(0)'>Next</a></li>";
	} else if ($next_btn) {
		$links .= "<li class='inactive'><a href='javascript:void(0)'>Next</a></li>";
	}
	
	
	$links .= "</ul></nav>";
	return  $links;
		
		
	}
	
	
	public static function getLinks($count,$cur_page,$per_page)
	{
		$previous_btn = true;
		$next_btn = true;
		$first_btn = true;
		$last_btn = true;
		$no_of_paginations = ceil($count / $per_page);
		
		/* ---------------Calculating the starting and endign values for the loop----------------------------------- */
	if ($cur_page >= 7) {
		$start_loop = $cur_page - 3;
		if ($no_of_paginations > $cur_page + 3)
			$end_loop = $cur_page + 3;
		else if ($cur_page <= $no_of_paginations && $cur_page > $no_of_paginations - 6) {
			$start_loop = $no_of_paginations - 6;
			$end_loop = $no_of_paginations;
		} else {
			$end_loop = $no_of_paginations;
		}
	} else {
		$start_loop = 1;
		if ($no_of_paginations > 7)
			$end_loop = 7;
		else
			$end_loop = $no_of_paginations;
	}
	$links = '';
	
	$pr = '<svg width="12" height="11" viewbox="0 0 12 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M6 5.12695C5.73633 5.39062 5.73633 5.83008 6 6.12305L9.98438 10.1074C10.2773 10.3711 10.7168 10.3711 10.9805 10.1074L11.6543 9.43359C11.918 9.14062 11.918 8.70117 11.6543 8.4375L8.8125 5.5957L11.6543 2.7832C11.918 2.51953 11.918 2.08008 11.6543 1.78711L10.9805 1.14258C10.7168 0.849609 10.2773 0.849609 9.98437 1.14258L6 5.12695ZM0.375 6.12305L4.35938 10.1074C4.65234 10.3711 5.0918 10.3711 5.35547 10.1074L6.0293 9.43359C6.29297 9.16992 6.29297 8.70117 6.0293 8.4375L3.1875 5.625L6.0293 2.7832C6.29297 2.51953 6.29297 2.08008 6.0293 1.78711L5.35547 1.14258C5.0918 0.849609 4.62305 0.849609 4.35937 1.14258L0.375 5.12695C0.111328 5.39063 0.111328 5.83008 0.375 6.12305Z" fill="currentColor"></path>
                                                    </svg>';
													
	
	$nxt = '<svg width="12" height="11" viewbox="0 0 12 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M6 5.87305C6.26367 5.60938 6.26367 5.16992 6 4.87695L2.01562 0.892578C1.72266 0.628906 1.2832 0.628906 1.01953 0.892578L0.345703 1.56641C0.0820312 1.85938 0.0820312 2.29883 0.345703 2.5625L3.1875 5.4043L0.345703 8.2168C0.0820312 8.48047 0.0820312 8.91992 0.345703 9.21289L1.01953 9.85742C1.2832 10.1504 1.72266 10.1504 2.01562 9.85742L6 5.87305ZM11.625 4.87695L7.64062 0.892578C7.34766 0.628906 6.9082 0.628906 6.64453 0.892578L5.9707 1.56641C5.70703 1.83008 5.70703 2.29883 5.9707 2.5625L8.8125 5.375L5.9707 8.2168C5.70703 8.48047 5.70703 8.91992 5.9707 9.21289L6.64453 9.85742C6.9082 10.1504 7.37695 10.1504 7.64062 9.85742L11.625 5.87305C11.8887 5.60938 11.8887 5.16992 11.625 4.87695Z" fill="currentColor"></path>
                                                    </svg>';												
	
	/* ----------------------------------------------------------------------------------------------------------- */
	$links .= '<ul class="page__pagination--wrapper d-flex justify-content-center">';
	
	// FOR ENABLING THE PREVIOUS BUTTON
	if ($previous_btn && $cur_page > 1) {
		$pre = $cur_page - 1;
		$links .= "<li p='$pre' class='page__pagination--list '><a class='page__pagination--link active' onclick='loadData(".$pre.")' href='javascript:void(0)'>".$pr."</a></li>";
	} else if ($previous_btn) {
		$links .= "<li class='page__pagination--list'><a class='page__pagination--link ' href='javascript:void(0)'>".$pr."</a></li>";
	}
	for ($i = $start_loop; $i <= $end_loop; $i++) {
	
		if ($cur_page == $i)
			$links .= "<li p='$i' style='' class='page__pagination--list '><a class='page__pagination--link active' href='javascript:void(0)'>{$i}</a></li>";
		else
			$links .= "<li p='$i' class='page__pagination--list'><a class='page__pagination--link ' onclick='loadData(".$i.")' href='javascript:void(0)'>{$i}</a></li>";
	}
	
	// TO ENABLE THE NEXT BUTTON
	if ($next_btn && $cur_page < $no_of_paginations) {
		$nex = $cur_page + 1;
		$links .= "<li p='$nex' class='page__pagination--list active'><a class='page__pagination--link active ' onclick='loadData(".$nex.")' href='javascript:void(0)'>".$nxt."</a></li>";
	} else if ($next_btn) {
		$links .= "<li class='page__pagination--list'><a class='page__pagination--link ' href='javascript:void(0)'>".$nxt."</a></li>";
	}
	
	
	$links .= "</ul>";
	return  $links;
		
		
	}
	
	
	
	public static function getYoutubeIdFromUrl($url) {
			$parts = parse_url($url);
			if(isset($parts['query'])){
				parse_str($parts['query'], $qs);
				if(isset($qs['v'])){
					return $qs['v'];
				}else if(isset($qs['vi'])){
					return $qs['vi'];
				}
			}
			if(isset($parts['path'])){
				$path = explode('/', trim($parts['path'], '/'));
				return $path[count($path)-1];
			}
			return '';
	}
	
	
	
	/*
      |--------------------------------------------------------------------------
      | function to override Mailer Config 
      |--------------------------------------------------------------------------
     */
    public static function overrideMailerConfig() {
		
	   Config::set('mail.driver',Setting::findByKey('SMTP_DRIVER'));
       Config::set('mail.host',Setting::findByKey('SMTP_HOST'));
       Config::set('mail.port',Setting::findByKey('SMTP_PORT'));
       Config::set('mail.username',Setting::findByKey('SMTP_USERNAME'));
       Config::set('mail.password',Setting::findByKey('SMTP_PASSWORD'));
       Config::set('mail.sendmail','/usr/sbin/sendmail -bs');
	   
	}
	
	public static function image_validation_rule(){

		$rules = array(

		  'image' => 'mimes:jpeg,jpg,png,gif'

		);

		

		return $rules;

	}
	
	
	

	public static  function getLatLong($address, $apiKey) {
		// Base URL for the Geocoding API
		$url = "https://maps.googleapis.com/maps/api/geocode/json";
		
		// Encode the address to make it URL-safe
		$address = urlencode($address);
		
		// Full URL with parameters
		$fullUrl = "{$url}?address={$address}&key={$apiKey}";
		
		// Initialize cURL
		$ch = curl_init();
		
		// Set cURL options
		curl_setopt($ch, CURLOPT_URL, $fullUrl);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		
		// Execute the cURL request
		$response = curl_exec($ch);
		
		// Check for cURL errors
		if (curl_errno($ch)) {
			echo "cURL Error: " . curl_error($ch);
			return null;
		}
		
		// Close cURL
		curl_close($ch);
		
		// Decode the JSON response
		$data = json_decode($response, true);
		
		// Check if the response is OK
		if ($data['status'] == 'OK') {
			// Extract latitude and longitude
			$location = $data['results'][0]['geometry']['location'];
			return [
				'lat' => $location['lat'],
				'lng' => $location['lng']
			];
		} else {
			//echo "API Error: " . $data['status'];
			return [
				'lat' => '',
				'lng' => ''
			];
		}
	}


	public static  function getNearbyPlaces($lat, $lng, $type, $apiKey) {
		
		
		if($type=='establishment'){
			$url = "https://maps.googleapis.com/maps/api/place/nearbysearch/json?location=$lat,$lng&rankby=distance&type=&type=school&keyword=montessori&key=$apiKey";
		
		}else {
			$url = "https://maps.googleapis.com/maps/api/place/nearbysearch/json?location=$lat,$lng&rankby=distance&type=$type&key=$apiKey";
		
		}
		//$url = "https://maps.googleapis.com/maps/api/place/nearbysearch/json?location=$lat,$lng&rankby=distance&type=$type&key=$apiKey";
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$response = curl_exec($ch);
		curl_close($ch);
	
		return json_decode($response, true);
	}

		public static  function getDistance($originLat, $originLng, $destinationLat, $destinationLng, $apiKey) {
			$origin = "$originLat,$originLng";
			$destination = "$destinationLat,$destinationLng";
		
			$url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=$origin&destinations=$destination&key=$apiKey";
		
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			$response = curl_exec($ch);
			curl_close($ch);
		
			$data = json_decode($response, true);
		
			if ($data['status'] == 'OK' && isset($data['rows'][0]['elements'][0]['distance'])) {
				return $data['rows'][0]['elements'][0]['distance']['text'];
			} else {
				return "Distance not available";
			}
		}
		
		public static function generatePdf($body, $filename = 'doc', $output = 'D', $tcpdf = '') {
			require_once "./public/vendor_pdf/autoload.php";
		
			$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'orientation' => 'L']);
			$mpdf->autoLangToFont = true;
			$mpdf->autoScriptToLang = true;
		
			$mpdf->WriteHTML($body);
		
			// Ensure filename ends with .pdf
			$filename = preg_replace('/[^a-zA-Z0-9_-]/', '', $filename); // Remove special characters
			$filename .= '.pdf';
		
			// Set headers manually before output
			header("Content-Type: application/pdf");
			header("Content-Disposition: attachment; filename=\"$filename\"");
			header("Content-Transfer-Encoding: binary");
			header("Cache-Control: private, max-age=0, must-revalidate");
			header("Pragma: public");
		
			$mpdf->Output($filename, 'D'); // Force download
			exit;
		}
		
		public static function get_google_client() {
			require_once "./public/library_google_login/vendor/autoload.php";
		
			$clientID = Setting::findByKey('GOOGLE_clientID');
			$clientSecret = Setting::findByKey('GOOGLE_clientSecret');
			$redirectUri = url('/').'/google_login';
			
			// create Client Request to access Google API
			$client = new \Google_Client();
			$client->setClientId($clientID);
			$client->setClientSecret($clientSecret);
			$client->setRedirectUri($redirectUri);
			$client->addScope("email");
			$client->addScope("profile");
			return $client;
		}

}
