<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
// ini_set('display_errors', '1');
// ini_set('display_startup_errors', '1');
// error_reporting(E_ALL);
//require "../door/guard/load.php";   
require "../../key/Connection.php";   
          
$db          = Connection(); 
$json = json_decode(file_get_contents("php://input"));
$method = $json->method;
switch($method){
    case 'createUser':
        createUser($db,$json);
    break;
    case 'existUser':
        $email = $json->email;
        $phone = $json->phone;
        existUser($db,$email,$phone);
    break;
    case 'existGroup':
        $group = $json->group;
        existGroup($db,$group);
    break;    
    case 'createGroup':
        $group      = $json->group;
        $password   = $json->password;
        createGroup($db,$group,$password);
    break;    
}

function createGroup($db,$group,$password){
    $sql = "INSERT INTO `gr_options`
    (type,
    v1,
    v2,
    v3,
    v4,
    v5,
    tms
    )
    VALUES
    ('group',
    :group,
    :password,
    0,
    0,
    0,
    NOW())";
    try {
        $p = en($json->password);
        $response = array();
        $stmt = $db->prepare($sql); 
        $stmt->bindValue("group",    $group);
        $stmt->bindValue("password", $password);
        $stmt->execute();
        $id = $db->lastInsertId();
        $lastInsertId = $id > 0 ? $id : 0;
        $db = null;     
        $response['data'] = $lastInsertId;
        $response['error'] = false; 
        $response['message'] = "Group '". $group ."' created successfully.";             
    } catch(PDOException $e) {
        $response['data'] = null;
        $response['error'] = true; 
        $response['message'] = "An error occurred, try again.".$e->getMessage();    
    }
    echo json_encode($response);
 }


function existGroup($db,$group){
      $sql = "SELECT * FROM gr_options WHERE type = 'group' and v1 = '$group'";
      try {
          $response = array();
          $stmt = $db->query($sql); 
          $rs   =  $stmt->fetchAll();
          if(count($rs)>0){
              $response['exist'] = true; 
              $response['data'] = $rs[0];
              $response['message'] = "The group '$email' exist.";             
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
  

function createUser($db,$json){
   $sql = "INSERT INTO `gr_users`
   (name,
   email,
   pass,
   mask,
   depict,
   role,
   created,
   altered,
   extra,
   phone,
   id_organization,
   status
   )
   VALUES
   (:name,
   :email,
   :pass,
   :mask,
   :depict,
   :role,
   NOW(),
   NOW(),
   :extra,
   :phone,
   :id_organization,
   0)";
   try {
       $p = en($json->password);
       $response = array();
       $stmt = $db->prepare($sql); 
       $stmt->bindValue("name",             $json->name.' '.$json->lastname);
       $stmt->bindValue("email",            $json->email);
       $stmt->bindValue("pass",             $p['pass']);
       $stmt->bindValue("mask",             $p['mask']);
       $stmt->bindValue("depict",           $p['type']);
       $stmt->bindValue("role",             $json->role);
       $stmt->bindValue("extra",            0);
       $stmt->bindValue("phone",            $json->phone);
       $stmt->bindValue("id_organization",  $json->id_organization);
       $stmt->execute();
       $id = $db->lastInsertId();
       $lastInsertId = $id > 0 ? $id : 0;
       $db = null;     
       $response['data'] = $lastInsertId;
       $response['error'] = false; 
       $response['message'] = "User '". $json->email ."' created successfully.";             
   } catch(PDOException $e) {
       $response['data'] = null;
       $response['error'] = true; 
       $response['message'] = "An error occurred, try again.".$e->getMessage();    
   }
   echo json_encode($response);
}


function en($v, $t = 0, $m = 0) {
    if ($t == '0') {
        $t = rand(1, 10);
    }
    function depict($t, $v, $m) {
        $r["type"] = $t;
        $r["mask"] = $m;
        if ($r["mask"] == '0') {
            $r["mask"] = rn(rand(8, 15));
        }
        if ($r["type"] == '1') {
            $r["pass"] = md5(md5(sha1(sha1(md5($r["mask"] . $v)))));
        } else if ($r["type"] == '2') {
            $r["pass"] = hash('ripemd128', (md5(md5($r["mask"] . $v))));
        } else if ($r["type"] == '3') {
            $r["pass"] = hash('sha256', (crc32($r["mask"] . $v)));
        } else if ($r["type"] == '4') {
            $r["pass"] = hash('ripemd128', (crc32(crc32($r["mask"] . $v))));
        } else if ($r["type"] == '5') {
            $r["pass"] = hash('md4', (md5($r["mask"] . $v)));
        } else if ($r["type"] == '6') {
            $r["pass"] = md5(hash('sha256', (md5($r["mask"] . $v))));
        } else if ($r["type"] == '7') {
            $r["pass"] = hash('ripemd128', (sha1($r["mask"] . $v)));
        } else if ($r["type"] == '8') {
            $r["pass"] = hash('md2', (md5(sha1($r["mask"] . $v))));
        } else if ($r["type"] == '9') {
            $r["pass"] = sha1(crc32(sha1(crc32(md5($r["mask"] . $v)))));
        } else if ($r["type"] == '10') {
            $r["pass"] = md5(md5(sha1(sha1(crc32($r["mask"] . $v)))));
        }
        return $r;
    }
    return depict($t, $v, $m);
}

function rn() {
    $arg = func_get_args();
    if (!isset($arg[0])) {
        $length = rand(8, 20);
    } else {
        $length = $arg[0];
    }
    if (empty($length)) {
        $length = rand(8, 20);
    }
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $size = strlen($chars);
    $str = "";
    for ($i = 0; $i < $length; $i++) {
        $str .= $chars[rand(0, $size - 1)]; $str .= $chars[rand(0, $size - 1)];
    } $str = substr($str, 0, $length);
    if (isset($arg[2])) {
        $sym = $arg[2];
        if (!isset($arg[3])) {
            $str = $str.$sym;
            $str = str_shuffle($str);
        } else if ($arg[3] == 'left') {
            $str = $sym.$str;
        } else if ($arg[3] == 'right') {
            $str = $str.$sym;
        } else if ($arg[3] == 'mid') {
            $m = strlen($str)/2;
            $f = substr($str, 0, $m);
            $l = substr($str, $m);
            $str = $f.$sym.$l;
        }
        $str = vc($str);
    }
    return $str;
}

?>