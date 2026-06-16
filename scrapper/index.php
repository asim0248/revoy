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
		/*if ($html_detail_raw !== '') {
			if (preg_match("~window\\['__domain_group/APP_PROPS'\\]\\s*=\\s*(\\{[^;]+\\})\\s*;~s", $html_detail_raw)) {
				// placeholder to avoid accidental match
				//echo 'match '; exit;
			}else {
				//echo 'not match '; exit;
			}
			if (preg_match("~window\\['__domain_group/APP_PROPS'\\]\\s*=\\s*(\\{[^;]+\\})\\s*;~s", $html_detail_raw, $m)) {
				$json = $m[1];
				$appProps = json_decode($json, true);
				if (!is_array($appProps)) {
					$appProps = null;
				}
			}
		}*/
		
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
				if (isset($listing['description']) && is_string($listing['description']) && $listing['description'] !== '') {
					$detail_text = $listing['description'];
				} else {
					$fromJson = find_first_by_key($listing, 'description');
					if (is_string($fromJson) && $fromJson !== '') {
						$detail_text = $fromJson;
					}
				}
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
		// Fallback to HTML containers if JSON did not provide description
		if ($detail_text === '') {
			// Prefer the <section><div class="css-1josczm">...</div></section> block if present
			$detail_node = $html_detail->find('section div.css-1josczm', 0);
			if (!$detail_node) {
				// Fallback to older description container
				$detail_node = $html_detail->find('div[data-testid="description"].css-1j5tqht', 0);
			}
			$detail_text = $detail_node ? trim($detail_node->innertext) : '';
		}
		if ($detail_text !== '') {
			$detail_text = preg_replace('~<[^>]*>\s*View\s+less\s*</[^>]*>~i', '', $detail_text);
		}
		
		// Build accomodation array by pairing each icon title with its numeric value
		$accomodation = array();
		foreach ($html_detail->find('.css-hnq4o5 svg') as $icon) {
			$label_node = $icon->find('title', 0);
			if (!$label_node) {
				continue;
			}
			$label = trim($label_node->innertext);

			// Value is in the span with class css-1qkvt8e inside the same wrapper as the svg
			$wrapper = $icon->parent();
			$value_node = $wrapper ? $wrapper->find('span.css-1qkvt8e', 0) : null;
			$value = $value_node ? trim($value_node->plaintext) : '';

			$accomodation[] = array(
				'title' => $label,
				'value' => $value,
			);
		}

		// Build size array using label/value span pairs
		$size = array();
		foreach ($html_detail->find('span.css-q91zzj.e18sdcwj2') as $labelNode) {
			$label = trim($labelNode->plaintext);
			$wrapper = $labelNode->parent();
			$valueNode = $wrapper ? $wrapper->find('span.css-u0btei.e18sdcwj3', 0) : null;
			$valueRaw = $valueNode ? trim($valueNode->plaintext) : '';
			// remove m² from the value
			$value = str_replace('m²', '', $valueRaw);
			$value = trim($value);

			$size[] = array(
				'title' => $label,
				'value' => $value,
			);
		}
		$property_id = isset($appProps['body']['property']['listing']['id']) ? $appProps['body']['property']['listing']['id'] : '';
		
		// Get the last features object from the entire JSON structure
		$features = '';
		
		$features = find_last_features($appProps);
		
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
						//echo "Processing image: $filename<br>";
						
						// Try to create image from string
						$image_info = getimagesizefromstring($image_data);
						if ($image_info !== false) {
							//echo "Image format detected: " . $image_info['mime'] . "<br>";
							
							// Create image resource based on format
							$image = null;
							switch ($image_info[2]) {
								case IMAGETYPE_JPEG:
									$image = imagecreatefromstring($image_data);
									break;
								case IMAGETYPE_PNG:
									$image = imagecreatefromstring($image_data);
									break;
								case IMAGETYPE_GIF:
									$image = imagecreatefromstring($image_data);
									break;
							}
							
							if ($image !== false && $image !== null) {
								// Get image dimensions
								$width = imagesx($image);
								$height = imagesy($image);
								//echo "Image dimensions: {$width}x{$height}<br>";
								
								// Load the logo image
								$logo_path = __DIR__ . '/logo.png';
								$logo = imagecreatefrompng($logo_path);
								
								if ($logo !== false) {
								    // Get logo dimensions
								    $logo_width = imagesx($logo);
								    $logo_height = imagesy($logo);
								    
								    // Add padding around logo (increased from 15 to 30)
								    $padding = 30;
								    
								    // Create a temporary canvas for the watermark with padding
								    $watermark = imagecreatetruecolor($logo_width + $padding * 2, $logo_height + $padding * 2);
								    
								    // Set background color (dark teal: #044236)
								    $bg_color = imagecolorallocate($watermark, 4, 66, 54);
								    imagefill($watermark, 0, 0, $bg_color);
								    
								    // Copy logo onto the watermark with padding
								    imagecopy(
								        $watermark,  // destination
								        $logo,       // source
								        $padding,    // destination x (with padding)
								        $padding,    // destination y (with padding)
								        0,           // source x
								        0,           // source y
								        $logo_width, // source width
								        $logo_height // source height
								    );
								    
								    // Calculate position (bottom right with padding and additional margin)
								    $margin_right = 65;  // Additional margin from right
								    $margin_bottom = 70; // Additional margin from bottom
								    $x = max(0, $width - ($logo_width + $padding * 2 + $margin_right));
								    $y = max(0, $height - ($logo_height + $padding * 2 + $margin_bottom));
								    
								    // Merge watermark with original image (100% opaque)
								    imagecopy(
								        $image,           // destination image
								        $watermark,       // source image
								        $x,               // destination x
								        $y,               // destination y
								        0,                // source x
								        0,                // source y
								        imagesx($watermark), // source width
								        imagesy($watermark)  // source height
								    );
								    
								    // Free up memory
								    imagedestroy($logo);
								}
								
								// Clean up
								imagedestroy($watermark);
								
								//echo "Watermark applied successfully<br>";
								
								// Save the watermarked image
								if (imagejpeg($image, $filepath, 85)) {
									//echo "Watermarked image saved: $filename<br>";
									$saved_photos[] = array(
										'imageSrc' => $filename,
										'order' => isset($photo['order']) ? $photo['order'] : $index,
									);
								} else {
									//echo "Failed to save watermarked image<br>";
								}
								
								imagedestroy($image);
							} else {
								//echo "Failed to create image resource<br>";
								// Save original as fallback
								if (file_put_contents($filepath, $image_data)) {
									$saved_photos[] = array(
										'imageSrc' => $filename,
										'order' => isset($photo['order']) ? $photo['order'] : $index,
									);
								}
							}
						} else {
							//echo "Could not determine image format<br>";
							// Save original as fallback
							if (file_put_contents($filepath, $image_data)) {
								$saved_photos[] = array(
									'imageSrc' => $filename,
									'order' => isset($photo['order']) ? $photo['order'] : $index,
								);
							}
						}
					}
				}
			}
			
			// Update photos array with saved images only
			$photos = $saved_photos;
		}
		
		//-------------------------------------------
		
		$baseUrl = 'https://images.allhomes.com.au/property/photo/';

		foreach ($photos as &$photo) {
			if (isset($photo['imageSrc'])) {
				$photo['imageSrc'] = str_replace($baseUrl, '', $photo['imageSrc']);
			}
		}
		unset($photo); // break reference
		
		 $coordinates = getLatLong($title_text);
		 $Latitude = isset($coordinates['lat'])?$coordinates['lat']:'';
		 $Longitude = isset($coordinates['lng'])?$coordinates['lng']:'';
		
		$data_detail = array(
			'id' => $property_id ,
			'title' => $title_text,
			'price' => isset($appProps['body']['property']['listing']['price']) ? $appProps['body']['property']['listing']['price'] : '',
			'accomodation' => $accomodation,
			'size' => $size,
			'detail' => $detail_text,
			'photos' => $photos,
			'latitude' => $Latitude,
			'longitude' => $Longitude,
			'features' => $features,
			'propertyType' => isset($features['propertyType']) ? $features['propertyType'] : '',
			'type' => isset($appProps['body']['property']['listing']['type']) ? str_replace('_',' ',$appProps['body']['property']['listing']['type']) : '',
			
		);
		
		//----------------------table ---------------------
		

		// Generate slug from title
		$slug = !empty($data_detail['title']) ? strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $data_detail['title']))) : '';
		$slug = preg_replace('/-+/', '-', $slug); // Replace multiple hyphens with single
		$slug = trim($slug, '-'); // Remove hyphens from start and end

		// Get p_id from data_detail
		$p_id = $conn->real_escape_string($data_detail['id']);

		// Check if p_id exists and delete existing record
		if (!empty($p_id)) {
			$check_sql = "SELECT id FROM tbl_property_process_data WHERE p_id = '$p_id' LIMIT 1";
			$result = $conn->query($check_sql);
			
			if ($result && $result->num_rows > 0) {
				$delete_sql = "DELETE FROM tbl_property_process_data WHERE p_id = '$p_id'";
				if ($conn->query($delete_sql) === TRUE) {
					//echo "Existing record with p_id $p_id deleted.<br>";
				} else {
					//echo "Error deleting existing record: " . $conn->error . "<br>";
				}
			}
		}

		// Prepare data for database insertion
		$name = $conn->real_escape_string($data_detail['title']);
		$slug = $conn->real_escape_string($slug);
		$tag_line = $conn->real_escape_string($data_detail['type']);
		$property_type = $conn->real_escape_string($data_detail['propertyType']);
		$images = $conn->real_escape_string(json_encode($data_detail['photos']));
		$accomodation = $conn->real_escape_string(json_encode($data_detail['accomodation']));
		$price = $conn->real_escape_string($data_detail['price']);
		$size = $conn->real_escape_string(json_encode($data_detail['size']));
		$full_contents = $conn->real_escape_string($data_detail['detail']);
		$features = $conn->real_escape_string(json_encode($data_detail['features']));
		$latitude = $conn->real_escape_string($data_detail['latitude']);
		$longitude = $conn->real_escape_string($data_detail['longitude']);
		$meta_title = $conn->real_escape_string($data_detail['title']);
		$meta_keyword = $conn->real_escape_string($data_detail['title']);
		$meta_description = $conn->real_escape_string($data_detail['title']);

		// Insert into database
		$sql = "INSERT INTO tbl_property_process_data (
			p_id, name, slug, tag_line, property_type, images, accomodation, price, size, 
			full_contents, features, latitude, longitude, meta_title, meta_keyword, meta_description, 
			sort_order, status, is_processed, created_at, updated_at
		) VALUES (
			'$p_id', '$name', '$slug', '$tag_line', '$property_type', '$images', '$accomodation', '$price', '$size',
			'$full_contents', '$features', '$latitude', '$longitude', '$meta_title', '$meta_keyword', '$meta_description',
			1, 'Yes', 'No', NOW(), NOW()
		)";

		if ($conn->query($sql) === TRUE) {
			//echo "New record created successfully. ID: " . $conn->insert_id . "<br>";
			$processed_count++;
		} else {
			//echo "Error: " . $sql . "<br>" . $conn->error . "<br>";
		}

		//-------------------------------------------------
		
		//echo '<pre>'; print_r($data_detail);
		
		//
		
		//echo $html_detail;
		//if($processed_count >= 5){
		//exit; 
		//}
		
		echo '<br>=========================data process done==========================<br>';
		
	}
}
?>