<?php
header('Content-Type: text/html; charset=utf-8');

// Function to get node's balance
function get_remote_data($url, $params = array()) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url . '?' . http_build_query($params));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $response = curl_exec($ch);
    curl_close($ch);
    return json_decode($response, true);
}


    $url = "http://127.0.0.1:26659/balance";

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    $response = curl_exec($ch);

    curl_close($ch);

    $data = json_decode($response, true);

        if (isset($data["amount"])) {
                $amount = $data["amount"];
                $result = array('success' => true, 'amount' => $amount);
        } else {
                $result = array('success' => false, 'message' => 'An error occured :(');
        }
        echo json_encode($result);

?>
