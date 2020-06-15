<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
require "../../key/Connection.php";   
$Connection  = new Connection();               
$db          = $Connection->getConnection(); 

$method = $_REQUEST['method'];
switch($method){
    case 'insert_user':
        insert_user();
    break;

}

function insert_user(){
     // ?name=some name?email=some@some.com?pass=some pass
    $name    = $_REQUEST['name'];
    $email   = $_REQUEST['email'];
    $p       = en($_REQUEST['pass']);
    $pass    = $p['pass'];
    $mask    = $p['mask'];
    $depict  = $p['type'];
    $role    = 3;  // test is role 2 , dlira is role 3
    $extra   = 0;
    $sql = "INSERT INTO `gr_users`
    (`name`,
    `email`,
    `pass`,
    `mask`,
    `depict`,
    `role`,
    `created`,
    `altered`,
    `extra`)
    VALUES
    (:name,
    :email,
    :pass,
    :mask,
    :depict,
    :role,
     NOW(),
     NOW(),
    :extra)";
    try {
        $response = array();
        $stmt = $db->prepare($sql); 
        $stmt->bindValue("name",  $name);
        $stmt->bindValue("email", $email);
        $stmt->bindValue("pass",  $pass);
        $stmt->bindValue("mask",  $mask);
        $stmt->bindValue("depict",$depict);
        $stmt->bindValue("role",  $role);
        $stmt->bindValue("extra", $extra);
        $stmt->execute();
        $id = $db->lastInsertId();
        $lastInsertId = $id > 0 ? $id : 0;
        $db = null;     
        $response['data'] = $lastInsertId;
        $response['error'] = false; 
        $response['message'] = "User '".$name."' created successfully.";             
    } catch(PDOException $e) {
        $response['data'] = null;
        $response['error'] = true; 
        $response['message'] = "An error occurred, try again.".$e->getMessage();    
    }
    return $response;
}


?>