<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
// ini_set('display_errors', '1');
// ini_set('display_startup_errors', '1');
// error_reporting(E_ALL);
require "../../key/Connection.php";

$db          = Connection();
$json = json_decode(file_get_contents("php://input"));



try {
    $sql = "SELECT * FROM `gr_users` where deleted = '0'" ;
    $stmt     = $db->query($sql);
    $rs       =  $stmt->fetchAll();
    if (count($rs) > 0) {
    }
    // $data_array =  array(
    //     "sms"   => "",
    //     "type"  => "signuplink",
    //     "phone" => "+525567733943"
    // );
    // $make_call = callAPI('POST', 'https://c4ymficygk.execute-api.us-east-1.amazonaws.com/dev/sendsms', json_encode($data_array));
    // $response  = json_decode($make_call, true);
    // $data    = $response['body']['MessageId'];
    // $statusCode = $response['statusCode'];
    // $data = "message test";
    $response = array();
    $response['data'] = $rs;
    $response['error'] = false;
    $response['message'] = "Get users for admin.";
} catch (PDOException $e) {
    $response['data'] = null;
    $response['error'] = true;
    $response['message'] = "An error occurred, try again.";
}
echo json_encode($response);
