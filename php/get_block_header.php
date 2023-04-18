<?php
header('Content-Type: application/json; charset=utf-8');

// Function to get node's actual header
function get_remote_data($url, $params = array()) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url . '?' . http_build_query($params));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $response = curl_exec($ch);
    curl_close($ch);
    return json_decode($response, true);
}

header('Content-Type: application/json');

$url = "http://127.0.0.1:26659/header/1";

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

$response = curl_exec($ch);

curl_close($ch);

$data = json_decode($response, true);

if (isset($data['header']['last_commit_hash'])) {
    $commitHash = $data['header']['last_commit_hash'];
    $result = array('success' => true, 'commitHash' => $commitHash);
} else {
    $result = array('success' => false, 'message' => 'Impossible de récupérer le hash du commit');
}
echo json_encode($result);

?>
