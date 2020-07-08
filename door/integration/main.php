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
switch($method){rchOrganizationBySecretKey($db,$secret_key);
    case 'saveOrganization':
        $organization = $json->organization;
        $secret_key   = $json->secret_key;
        saveOrganization($db,$organization,$secret_key);
    break;

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