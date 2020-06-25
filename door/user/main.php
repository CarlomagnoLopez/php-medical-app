<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
// ini_set('display_errors', '1');
// ini_set('display_startup_errors', '1');
// error_reporting(E_ALL);
require "../../key/Connection.php";   
          
$db          = Connection(); 
$json = json_decode(file_get_contents("php://input"));
$method = $json->method;
switch($method){
    case 'getDataUserByEmail':
        $email = $json->email;
        getDataUserByEmail($email,$db );
    break;

}

function getDataUserByEmail($email,$db ){
    $sql = "SELECT * FROM gr_users WHERE email = '$email'";
    try {
        $response = array();
        $stmt = $db->query($sql); 
        $rs   =  $stmt->fetchAll();
        if(count($rs)>0){
            $response['data'] = $rs[0];
        }else{
            $response['data'] = [];
        }
        $response['error'] = false; 
        $response['message'] = "no user found.";             
    } catch(PDOException $e) {
        $response['data'] = null;
        $response['error'] = true; 
        $response['message'] = "An error occurred, try again.".$e->getMessage();    
    }
    echo json_encode($response);
}


?>