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
    case 'getDataUserByPhone':
        $phone = $json->phone;
        getDataUserByPhone($db,$phone);
    break;
    case 'searchOrganization':
        $organization = $json->organization;
        $secret_key   = $json->secret_key;
        searchOrganization($db,$organization,$secret_key);
    break;
    case 'searchOrganizationBySecretKey':
        $secret_key   = $json->secret_key;
        searchOrganizationBySecretKey($db,$secret_key);
    break;
    case 'saveOrganization':
        $organization = $json->organization;
        $secret_key   = $json->secret_key;
        saveOrganization($db,$organization,$secret_key);
    break;
    case 'existUser':
        $email = $json->email;
        $phone = $json->phone;
        existUser($db,$email,$phone);
    break;
    case 'updateStatusUser':
        $phone = $json->phone;
        updateStatusUser($db,$phone);
    break;

}

function updateStatusUser($db,$phone,$status){
    $sql = "UPDATE gr_users SET STATUS = $status WHERE phone = '$phone'";
    try {
        $response = array();
        $stmt = $db->prepare($sql); 
        $stmt->execute();
        $db = null;     
        $response['data'] = null;
        $response['error'] = false; 
        $response['message'] = "";             
    } catch(PDOException $e) {
        $response['data'] = null;
        $response['error'] = true; 
        $response['message'] = "An error occurred, try again.".$e->getMessage();    
    }
    echo json_encode($response);
 }


function existUser($db,$email,$phone){
  //  $sql = "SELECT * FROM `gr_users` WHERE  email = '$email' OR phone = '$phone'";
    $sql = "SELECT * FROM `gr_users` WHERE  phone = '$phone'";
    try {
        $response = array();
        $stmt = $db->query($sql); 
        $rs   =  $stmt->fetchAll();
        if(count($rs)>0){
            $response['exist'] = true; 
            $response['data'] = $rs[0];
            $response['message'] = "The user with phone '$phone' exist.";             
        }else{
            $response['exist'] = false; 
            $response['data'] = [];
            $response['message'] = "";             
        }
        $response['error'] = false; 
    } catch(PDOException $e) {
        $response['exist'] = false; 
        $response['data'] = null;
        $response['error'] = true; 
        $response['message'] = "An error occurred, try again.".$e->getMessage();    
    }
    echo json_encode($response);
}



function searchOrganizationBySecretKey($db,$secret_key){
    $sql = "SELECT * FROM `gr_organizations` WHERE  secret_key = '$secret_key'";
    try {
        $response = array();
        $stmt = $db->query($sql); 
        $rs   =  $stmt->fetchAll();
        if(count($rs)>0){
            $response['exist'] = true; 
            $response['data'] = $rs[0];
        }else{
            $response['exist'] = false; 
            $response['data'] = [];
        }
        $response['error'] = false; 
        $response['message'] = "";             
    } catch(PDOException $e) {
        $response['exist'] = false; 
        $response['data'] = null;
        $response['error'] = true; 
        $response['message'] = "An error occurred, try again.".$e->getMessage();    
    }
    echo json_encode($response);
}

function searchOrganization($db,$organization,$secret_key){
    $sql = "SELECT * FROM `gr_organizations` WHERE organization = '$organization' or secret_key = '$secret_key' ";
    try {
        $response = array();
        $stmt = $db->query($sql); 
        $rs   =  $stmt->fetchAll();
        if(count($rs)>0){
            $response['exist'] = true; 
            $response['data'] = $rs[0];
        }else{
            $response['exist'] = false; 
            $response['data'] = [];
        }
        $response['error'] = false; 
        $response['message'] = "";             
    } catch(PDOException $e) {
        $response['exist'] = false; 
        $response['data'] = null;
        $response['error'] = true; 
        $response['message'] = "An error occurred, try again.".$e->getMessage();    
    }
    echo json_encode($response);
}



function getDataUserByPhone($db,$phone ){
    $sql = "SELECT * FROM gr_users WHERE phone = '$phone'";
    try {
        $response = array();
        $stmt = $db->query($sql); 
        $rs   =  $stmt->fetchAll();
        if(count($rs)>0){
            $response['exist'] = true; 
            $response['data'] = $rs[0];
        }else{
            $response['exist'] = false; 
            $response['data'] = [];
        }
        $response['error'] = false; 
        $response['message'] = "";             
    } catch(PDOException $e) {
        $response['exist'] = false; 
        $response['data'] = null;
        $response['error'] = true; 
        $response['message'] = "An error occurred, try again.".$e->getMessage();    
    }
    echo json_encode($response);
}

function saveOrganization($db,$organization,$secret_key){
   $sql = "INSERT INTO `gr_organizations`
   (organization,
   secret_key
   )
   VALUES
   (:organization,
   :secret_key)";
   try {
       $response = array();
       $stmt = $db->prepare($sql); 
       $stmt->bindValue("organization",  $organization);
       $stmt->bindValue("secret_key", $secret_key);
       $stmt->execute();
       $id = $db->lastInsertId();
       $lastInsertId = $id > 0 ? $id : 0;
       $db = null;     
       $response['data'] = $lastInsertId;
       $response['error'] = false; 
       $response['message'] = "Organization '".$organization."' created successfully.";             
   } catch(PDOException $e) {
       $response['data'] = null;
       $response['error'] = true; 
       $response['message'] = "An error occurred, try again.".$e->getMessage();    
   }
   echo json_encode($response);
}



?>