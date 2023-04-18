<?php
// URL where submit the call
$url = "http://localhost:26659/submit_pfb";

// Getting the data from the js
$namespace_id = $_POST["namespace_id"];
$data = $_POST["data"];
$gas_limit = 80000;
$fee = 2000;


// Create data array for the PFB transaction
$data = array(
  "namespace_id" => $namespace_id,
  "data" => $data,
  "gas_limit" => $gas_limit,
  "fee" => $fee
);

// Init a new curl with options
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

// Execute the call
$response = curl_exec($ch);
// Close curl
curl_close($ch);

// Extract data returned
$json_response = json_decode($response, true);

// if response contains our wanted data
if (isset($json_response["height"]) && isset($json_response["txhash"])) {
    $height = $json_response["height"];
    $txhash = $json_response["txhash"];

    // Construct url for getting the namespaced share
    $url = "http://localhost:26659/namespaced_shares/" . $namespace_id . "/height/" . $height;
    // init a new curl
    $ch2 = curl_init();
    curl_setopt($ch2, CURLOPT_URL, $url);
    curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
    $response2 = curl_exec($ch2);
    curl_close($ch2);

    // Extract data returned
    $json_response2 = json_decode($response2, true);
    $namespaced_shares = $json_response2["shares"];

    // Construct a array for returning the data
    $data_to_return = array(
        "height" => $height,
        "txhash" => $txhash,
        "namespaced_shares" => $namespaced_shares
    );

    // We encode it on json format
    $json_data = json_encode($data_to_return);

    // We send the result
    $result = array('success' => true, 'json_data' => $json_data);

} else {
    // if we find an error
    $result = array('success' => false, 'message' => 'Error : cannot get the PFB data');
}

echo json_encode($result);
?>
