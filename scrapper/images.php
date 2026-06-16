<?php 
set_time_limit(0);
ini_set('memory_limit', '-1');

echo '<br>=========================data process start==========================<br>';

// Include database connection
require_once __DIR__ . '/config/db_connection.php';

include("simple_html_dom.php"); 

function find_first_by_key($array, $key) {
	if (!is_array($array)) {
		return null;
	}
	foreach ($array as $k => $v) {
		if ($k === $key) {
			return $v;
		}
		if (is_array($v)) {
			$result = find_first_by_key($v, $key);
			if ($result !== null) {
				return $result;
			}
		}
	}
	return null;
}

function getLatLong($address) {
		$apiKey = 'AIzaSyBsSF8K1AASOzvT_wKBhkHysFc5HOXYtH8';
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

function find_last_features($array) {
			$last_features = '';
			foreach ($array as $key => $value) {
				if ($key === 'features') {
					$last_features = $value;
				}
				if (is_array($value)) {
					$nested_features = find_last_features($value);
					if ($nested_features !== '') {
						$last_features = $nested_features;
					}
				}
			}
			return $last_features;
		}

function find_first_photo_array($array) {
	if (!is_array($array)) {
		return null;
	}
	// If this is a list-like array with imageSrc, treat it as photos
	$hasNumericKeys = false;
	foreach (array_keys($array) as $k) {
		if (is_int($k)) {
			$hasNumericKeys = true;
			break;
		}
	}
	if ($hasNumericKeys && isset($array[0]) && is_array($array[0]) && isset($array[0]['imageSrc'])) {
		return $array;
	}
	// Otherwise recurse
	foreach ($array as $v) {
		if (is_array($v)) {
			$result = find_first_photo_array($v);
			if ($result !== null) {
				return $result;
			}
		}
	}
	return null;
}

//$html = file_get_html("https://www.freecodecamp.org/news"); 

$hit_link = $_GET['link'];//https://www.allhomes.com.au/sale/search
//echo $hit_link; exit;
$html = file_get_html($hit_link); 

// Find all elements with the given CSS class
$titles = $html->find(".css-1que1r7"); 

// Build an array of links (href attributes), excluding agency links
$data = array_map(function ($element) { 
	$link = isset($element->href) ? trim($element->href) : "";
	// Skip links that contain /agency/
	if (strpos($link, '/agency/') !== false) {
		return null;
	}
	return array( 
		"link" => $link
	); 
}, $titles);

// Remove null entries from the array
$data = array_filter($data, function($item) {
	return $item !== null;
}); 
 
//echo '<pre>'; print_r($data); exit;

if(count($data)>0){
	$processed_count = 0;
	foreach ($data as $key=>$value){
		echo ($key+1).'=>'.$value['link'];
		echo '<br>';
		$html_detail = file_get_html($value['link']);
		$html_detail_raw = $html_detail ? $html_detail->outertext : '';
		
		$needle = "window['__domain_group/APP_PROPS']";
		
		/*if (strpos($html_detail_raw, $needle) !== false) {
			echo "String found";
		} else {
			echo "String not found";
		}
				exit;*/
		// Get main title text
		$title_nodes = $html_detail->find(".css-hed0vw"); 
		$title_text = count($title_nodes) > 0 ? trim($title_nodes[0]->plaintext) : "";
		
		// Skip if title is empty
		if (empty($title_text)) {
			echo "Skipping record with empty title.<br>";
			continue;
		}
		
		// Get description detail from detail page (keep <p> tags)
		// Prefer JSON from window['__domain_group/APP_PROPS'] if available
		$detail_text = '';
		$photos = array();
		$appProps = null;
		
		
					if (preg_match(
				"~window\\['__domain_group/APP_PROPS'\\]\\s*=\\s*(\\{.*?\\})\\s*;~s",
				$html_detail_raw,
				$m
			)) {
				$json = $m[1];
			
				$appProps = json_decode($json, true);
			
				if (json_last_error() !== JSON_ERROR_NONE) {
					echo 'JSON ERROR: ' . json_last_error_msg();
					exit;
				}
			}
		
		//echo '<pre>'; print_r($appProps); exit;
		if (is_array($appProps)) {
			
			// Focus on the body.property.listing branch as per sample.php
			$listing = null;
			if (isset($appProps['body']['property']['listing']) && is_array($appProps['body']['property']['listing'])) {
				$listing = $appProps['body']['property']['listing'];
			}
			if ($listing !== null) {
				// Prefer explicit listing description
				
				// Restrict photo search to listing branch
				$photoArray = find_first_photo_array($listing);
				if (is_array($photoArray)) {
					foreach ($photoArray as $photo) {
						if (!is_array($photo) || !isset($photo['imageSrc'])) {
							continue;
						}
						$photos[] = array(
							'imageSrc' => $photo['imageSrc'],
							'order' => isset($photo['order']) ? $photo['order'] : 0,
						);
					}
				}
			}
		}
		
		
		
		$property_id = isset($appProps['body']['property']['listing']['id']) ? $appProps['body']['property']['listing']['id'] : '';
		
		
		//--------------------save images-----------------------
		
		if (!empty($property_id) && !empty($photos)) {
			// Create main directory if it doesn't exist
			$main_dir = '../public/upload/property_images';
			if (!file_exists($main_dir)) {
				mkdir($main_dir, 0777, true);
			}
			
			// Create property-specific subfolder
			$property_dir = $main_dir . '/' . $property_id;
			if (!file_exists($property_dir)) {
				mkdir($property_dir, 0777, true);
			}
			
			// Limit to first 5 images
			$limited_photos = array_slice($photos, 0, 5);
			$saved_photos = array();
			
			// Loop through limited photos and download each image
			foreach ($limited_photos as $index => $photo) {
				if (isset($photo['imageSrc']) && !empty($photo['imageSrc'])) {
					$image_url = $photo['imageSrc'];
					
					// Extract filename from URL
					$filename = basename(parse_url($image_url, PHP_URL_PATH));
					if (empty($filename)) {
						$filename = 'image_' . ($index + 1) . '.jpg';
					}
					
					$filepath = $property_dir . '/' . $filename;
					
					// Download image using curl
					$ch = curl_init();
					curl_setopt($ch, CURLOPT_URL, $image_url);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
					curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
					curl_setopt($ch, CURLOPT_TIMEOUT, 30);
					
					$image_data = curl_exec($ch);
					$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
					curl_close($ch);
					
					// Save image if download was successful
					if ($image_data !== false && $http_code == 200) {
						// Save original image directly without watermark
						if (file_put_contents($filepath, $image_data)) {
							$saved_photos[] = array(
								'imageSrc' => $filename,
								'order' => isset($photo['order']) ? $photo['order'] : $index,
							);
						}
					}
				}
			}
			
			// Update photos array with saved images only
			$photos = $saved_photos;
		}
		
		
		
		echo '<br>=========================data process done==========================<br>';
		
	}
}
?>