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
    case 'existGroup':
        $group = $json->group;
        existGroup($db,$group);
    break;    
    case 'createGroup':
        $id_user    = $json->id_user;
        $id_organization    = $json->id_organization;
        $group      = $json->group;
        $password   = $json->password;
        $role       = $json->role;
        createGroup($db,$group,$password,$id_user,$role,$id_organization);
    break;    
    case 'updateStatusUser':
        $uid    = $json->uid;
        $status = $json->status;
        updateStatusUser($db,$uid,$status);
    break;    
}





function getDataUserById($db,$id){
    $sql = "SELECT * FROM gr_users WHERE id = $id";
    try {
        $response = array();
        $stmt     = $db->query($sql); 
        $rs       =  $stmt->fetchAll();
        $response['data']  = $rs[0];
        $response['error'] = false; 
    } catch(PDOException $e) {
        $response['data']  = null;
        $response['error'] = true; 
    }
    return $response;
}

function updateStatusUser($db,$uid,$status){
    $getData         = getDataUserById($db,$uid);
    $role            = $getData['data']['role'];
    $id_organization = $getData['data']['id_organization'];
    if($role==2 || $role==5){
        $countRole = countRole($db,$role,$id_organization);
        if($status=='0'){
            if($countRole['count']==2){
              $response = array();
              $response['data']    = 0;
              $response['error']   = true; 
              $response['message'] = ($role==2)?"You can’t remove less than 2 org admin" : "You can’t remove less than 2 approver";    
              echo json_encode($response);
              exit;
            }
        }else{
            if($countRole['count']>=4){
                $response = array();
                $response['data']    = 0;
                $response['error']   = true; 
                $response['message'] = ($role==2)?"You can’t create more than 4 org admin" : "You can’t create more than 4 approver";    
                echo json_encode($response);
                exit;
            }
        }
     }


    $sql = "UPDATE gr_users SET STATUS = $status WHERE id = '$uid'";
    try {
        $response = array();
        $stmt = $db->prepare($sql); 
        $stmt->execute();
        $rs = $stmt->rowCount() ? 1 : 0;
        $db = null;     
        $response['data']    = $rs;
        $response['error']   = false; 
        $response['message'] = "";             
    } catch(PDOException $e) {
        $response['data']    = null;
        $response['error']   = true; 
        $response['message'] = "An error occurred, try again.".$e->getMessage();    
    }
    echo json_encode($response);
 }


function createGroup($db,$group,$password,$id_user,$role,$id_organization){
    $sql = "INSERT INTO `gr_options`(type,v1,v2,v3,v4,v5,tms,id_organization) VALUES('group',:group,:password,0,0,0,NOW(),:id_organization);";
    try {
       // $p = en($password);
        $response = array();
        $stmt = $db->prepare($sql); 
        $stmt->bindValue("id_organization",    $id_organization);
        $stmt->bindValue("group",    $group);
        $stmt->bindValue("password", md5($password));
        $stmt->execute();
        $id_group     = $db->lastInsertId();
        $lastInsertId = $id_group > 0 ? $id_group : 0;
        if($lastInsertId!=0){
            $sql = "INSERT INTO gr_options(type,v1,v2,v3,v4,v5,tms) VALUES('gruser','$id_group','$id_user','$role',0,0,NOW());";
            $stmt = $db->prepare($sql); 
            $stmt->execute();
            $sql = "SELECT * FROM `gr_options` where type = 'lview' ORDER BY `v3` DESC;";
            $stmt = $db->query($sql); 
            $rs   =  $stmt->fetchAll();
            $v3   = $rs[0]['v3'];
            $sql = "INSERT INTO gr_options(type,v1,v2,v3,v4,v5,tms) VALUES('lview','$id_group','$id_user','v3',0,0,NOW());";
            $stmt = $db->prepare($sql); 
            $stmt->execute();
            $response['data'] = $lastInsertId;
            $response['error'] = false; 
            $response['message'] = "Group '". $group ."' created successfully.";             
        }else{
            $response['data'] = 0;
            $response['error'] = false; 
            $response['message'] = "Error.";             

        }

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
  


function countRole($db,$role,$id_organization){
    $sql = "SELECT COUNT(*) as count FROM gr_users WHERE role = $role and id_organization = $id_organization and status = 1";
    try {
        $response = array();
        $stmt = $db->query($sql); 
        $rs   =  $stmt->fetchAll();
        if(count($rs)>0){
            $response['count'] = (int) $rs[0]['count'];
        }else{
            $response['count'] = (int) $rs[0]['count'];
        }
        $response['error'] = false; 
    } catch(PDOException $e) {
        $response['exist'] = false; 
        $response['count'] = 0;

    }
    return $response;
}


function createUser($db,$json){
    
   if($json->role==2 || $json->role==5){
      $countRole = countRole($db,$json->role,$json->id_organization);
      if($countRole['count']>=4){
        $response = array();
        $response['data']    = 0;
        $response['error']   = true; 
        $response['message'] = ($json->role==2)?"You can’t create more than 4 org admin" : "You can’t create more than 4 approver";    
        echo json_encode($response);
        exit;
      }
   }
   
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
   status,
   address,
   zipcode
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
   0,
   :address,
   :zipcode
   )";
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
       $stmt->bindValue("address",          $json->address);
       $stmt->bindValue("zipcode",          $json->zipcode);
       $stmt->execute();
       $id = $db->lastInsertId();
       $lastInsertId = $id > 0 ? $id : 0;
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


function saveGrSession($db,$json){
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
    status,
    address,
    zipcode
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
    0,
    :address,
    :zipcode
    )";
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
        $stmt->bindValue("address",          $json->address);
        $stmt->bindValue("zipcode",          $json->zipcode);
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