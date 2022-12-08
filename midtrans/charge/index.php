<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "truelysell";
$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$sql =  "SELECT *  FROM `system_settings`  WHERE  (`key` = 'midtrans_option')";
$result = mysqli_query($conn, $sql);
$midtrans_type = mysqli_fetch_assoc($result);

if($midtrans_type['value'] == 1) {
    $sql1 =  "SELECT *  FROM `system_settings`  WHERE  (`key` = 'midtrans_secret_apikey')";
    $result1 = mysqli_query($conn, $sql1);
    $server_apikey = mysqli_fetch_assoc($result1);
} else {
    $sql2 =  "SELECT *  FROM `system_settings`  WHERE  (`key` = 'live_midtrans_secret_apikey')";
    $result2 = mysqli_query($conn, $sql2);
    $server_apikey = mysqli_fetch_assoc($result2);
}

mysqli_close($conn);
// Set your server key (Note: Server key for sandbox and production mode are different)
$server_key = $server_apikey['value'];

// Set true for production, set false for sandbox
$is_production = ($midtrans_type['value'] == 1) ? false : true;

$api_url = $is_production ? 
  'https://app.midtrans.com/snap/v1/transactions' : 
  'https://app.sandbox.midtrans.com/snap/v1/transactions';

// Check if request doesn't contains `/charge` in the url/path, display 404
if( !strpos($_SERVER['REQUEST_URI'], '/charge') ) {
  http_response_code(404); 
  echo "wrong path, make sure it's `/charge`"; exit();
}
// Check if method is not HTTP POST, display 404
if( $_SERVER['REQUEST_METHOD'] !== 'POST'){
  http_response_code(404);
  echo "Page not found or wrong HTTP request method is used"; exit();
}

// get the HTTP POST body of the request
$request_body = file_get_contents('php://input');
// set response's content type as JSON
header('Content-Type: application/json');
// call charge API using request body passed by mobile SDK
$charge_result = chargeAPI($api_url, $server_key, $request_body);
// set the response http status code
http_response_code($charge_result['http_code']);
// then print out the response body
echo $charge_result['body'];

/**
 * call charge API using Curl
 * @param string  $api_url
 * @param string  $server_key
 * @param string  $request_body
 */
function chargeAPI($api_url, $server_key, $request_body){
  $ch = curl_init();
  $curl_options = array(
    CURLOPT_URL => $api_url,
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_POST => 1,
    CURLOPT_HEADER => 0,
    // Add header to the request, including Authorization generated from server key
    CURLOPT_HTTPHEADER => array(
      'Content-Type: application/json',
      'Accept: application/json',
      'Authorization: Basic ' . base64_encode($server_key . ':')
    ),
    CURLOPT_POSTFIELDS => $request_body
  );
  curl_setopt_array($ch, $curl_options);
  $result = array(
    'body' => curl_exec($ch),
    'http_code' => curl_getinfo($ch, CURLINFO_HTTP_CODE),
  );
  return $result;
}
