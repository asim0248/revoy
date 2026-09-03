<?php 

set_time_limit(0);
ini_set('memory_limit', '-1');

$apiKey = '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';


echo '<br>=========================data process start==========================<br>';

// Include database connection
require_once __DIR__ . '/config/db_connection.php';

$limit = isset($_GET['limit'])?$_GET['limit']:1;

// Select unprocessed records

//$sql = "SELECT * FROM tbl_property_process_data WHERE is_processed = 'No' ";
//$result = $conn->query($sql);
//echo '<br>Pending:'.$result->num_rows.'<br>';;

$sql = "SELECT * FROM tbl_property_process_data WHERE is_processed = 'No' LIMIT ".$limit;

$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<br>========================='.$row['id'].' :  '.$row['name'].'==========================<br>';
        
        $scrapedPropertyText = $row['name'].' '.$row['full_contents'];
        $recordId = $row['id'];
        
        
        $payload = [
            'model' => 'gpt-4.1-nano',
            'temperature' => 0.6,
            'messages' => [
                [
                    'role' => 'system',
                    'content' => 'You are a professional real estate content writer and SEO expert. Always respond in valid JSON only.'
                ],
                [
                    'role' => 'user',
                    'content' => "
Rewrite the following property description into a maximum of 2 concise paragraphs.
Then generate SEO meta title, meta keywords, and meta description based on it.
Then write one paragraph describing the suburb profile.

Property Details:
{$scrapedPropertyText}

Return the response strictly in this JSON format:

{
  \"property_description\": \"\",
  \"meta\": {
    \"title\": \"\",
    \"keywords\": \"\",
    \"description\": \"\"
  },
  \"suburb_profile\": \"\"
}
"
                ]
            ]
        ];

$ch = curl_init('https://api.openai.com/v1/chat/completions');

curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_HTTPHEADER => [
        'Content-Type: application/json',
        'Authorization: Bearer ' . $apiKey
    ],
    CURLOPT_POSTFIELDS => json_encode($payload)
]);

$apiResponse = curl_exec($ch);

if (curl_errno($ch)) {
    die('Curl error: ' . curl_error($ch));
}

curl_close($ch);

$apiResult = json_decode($apiResponse, true);

// Check for API errors (rate limits, credit exceeded, etc.)
if (isset($apiResult['error'])) {
    $errorCode = $apiResult['error']['code'] ?? 'unknown';
    $errorMessage = $apiResult['error']['message'] ?? 'Unknown API error';
    
    // Handle specific error types
    if ($errorCode === 'insufficient_quota' || strpos($errorMessage, 'credit') !== false) {
        die("❌ API Credit Exceeded: " . $errorMessage . " - Please check your OpenAI account credits.");
    } elseif ($errorCode === 'rate_limit_exceeded' || strpos($errorMessage, 'rate limit') !== false) {
        echo "⏱️ API Rate Limit Exceeded: " . $errorMessage . " - Auto-refreshing in 10 seconds...";
        echo '<meta http-equiv="refresh" content="10;url=' . $_SERVER['REQUEST_URI'] . '">';
        exit();
    } else {
        echo "❌ API Error (" . $errorCode . "): " . $errorMessage . " - Auto-refreshing in 15 seconds...";
        echo '<meta http-equiv="refresh" content="15;url=' . $_SERVER['REQUEST_URI'] . '">';
        exit();
    }
}

// Extract JSON content from AI
$aiContent = json_decode(
    $apiResult['choices'][0]['message']['content'],
    true
);

if (!$aiContent) {
	echo '<meta http-equiv="refresh" content="15;url=' . $_SERVER['REQUEST_URI'] . '">';
       
    die('Invalid AI response');
}

$dbData = [
    'property_description' => $aiContent['property_description'],
    'meta_title'           => $aiContent['meta']['title'],
    'meta_keywords'        => $aiContent['meta']['keywords'],
    'meta_description'     => $aiContent['meta']['description'],
    'suburb_profile'       => $aiContent['suburb_profile'],
    'updated_at'           => date('Y-m-d H:i:s')
];

	echo '<pre>'; print_r($dbData);
	
	$meta_title_updated       = $dbData['meta_title'];
	$meta_keywords_updated    = $dbData['meta_keywords'];
	$meta_description_updated = $dbData['meta_description'];
	$suburb_profile 		  = $dbData['suburb_profile'];
	$property_description 	  = $dbData['property_description'];
	
    
    // Update status to 'Yes' and all AI-generated content
    $updateSql = "UPDATE tbl_property_process_data SET 
        is_processed = 'Yes',
        meta_title_updated = '" . $conn->real_escape_string($meta_title_updated) . "',
        meta_keywords_updated = '" . $conn->real_escape_string($meta_keywords_updated) . "',
        meta_description_updated = '" . $conn->real_escape_string($meta_description_updated) . "',
        suburb_profile = '" . $conn->real_escape_string($suburb_profile) . "',
        property_description = '" . $conn->real_escape_string($property_description) . "'
        WHERE id = " . $recordId;
    
    if ($conn->query($updateSql)) {
        echo "Record processed successfully. ID: " . $recordId . "<br>";
    } else {
        echo "Error updating record: " . $conn->error . "<br>";
    }
    
    // Sleep for 1 second after every API call (prevents rate limiting)
    sleep(1);
    }
} else {
    echo "No unprocessed records found.<br>";
    $scrapedPropertyText = "";
}

// Auto-refresh when all records are processed to check for more
echo '<meta http-equiv="refresh" content="5;url=' . $_SERVER['REQUEST_URI'] . '">';

?>