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
switch ($method) {
    case 'getDataUserByPhone':
        $phone = $json->phone;
        getDataUserByPhone($db, $phone);
        break;
    case 'getDataUserByUsername':
        $username = $json->username;
        getDataUserByUsername($db, $username);
        break;
    case 'searchOTP':
        $otp = $json->otp;
        searchOTP($db, $otp);
        break;
    case 'searchOrganization':
        $organization = $json->organization;
        $secret_key   = $json->secret_key;
        searchOrganization($db, $organization, $secret_key);
        break;
    case 'searchOrganizationBySecretKey':
        $secret_key   = $json->secret_key;
        searchOrganizationBySecretKey($db, $secret_key);
        break;
    case 'saveOrganization':
        $organization = $json->organization;
        $secret_key   = $json->secret_key;
        saveOrganization($db, $organization, $secret_key);
        break;
    case 'existUser':
        $phone    = $json->phone;
        $email = $json->email;
        existUser($db, $phone, $email);
        break;
    case 'existUserSign':
        $phone    = $json->phone;
        $username = $json->username;
        $email    = $json->email;
        existUserSign($db, $phone, $username, $email);
        break;
    case 'existUserForgotPassword':
        $phone    = $json->phone;
        existUserForgotPassword($db, $phone);
        break;        
    case 'updateStatusUser':
        $phone  = $json->phone;
        $status = $json->status;
        updateStatusUser($db, $phone, $status);
        break;
    case 'updatePasswordUser':
        $phone    = $json->phone;
        $password = $json->password;
        updatePasswordUser($db, $password, $phone);
        break;   
    case 'deleteUserOrganization':
        $id_user          = $json->id_user;
        $role             = $json->role;
        $id_organization  = $json->id_organization;
        deleteUserOrganization($db, $id_user, $role, $id_organization);
        break;
    case 'deleteOrganization':
        // $id_user          = $json->id_user;
        // $role             = $json->role;
        $id_organization  = $json->id_organization;
        deleteOrganization($db, $id_organization);
        break;
    case 'fastLogin':
        $id_username    = $json->id_username;
        $psw_encrypt    = $json->psw_encrypt;
        $phone          = $json->phone;
        $status_user    = $json->status_user;
        $id_chat        = $json->id_chat;
        $codeInvitation = $json->codeInvitation;
        fast_login($db, $id_username,$psw_encrypt, $phone, $status_user, $id_chat, $codeInvitation);
        break;
}

function deleteOrganization($db, $id_organization)
{
    $response = array();
    $response['data'] = 0;
    $countRoleOrg = countRole($db, 3, $id_organization);
    $countRoleApp = countRole($db, 5, $id_organization);
    $countRoleUser = countRole($db, 6, $id_organization);

    try {

        if ($countRoleOrg['count'] == "2" &&  $countRoleApp['count'] == "2" &&  $countRoleUser['count'] == "0") {
            $sql = "UPDATE gr_organizations SET deleted = 1 WHERE 	id_organization=:id_organization";
            $stmt = $db->prepare($sql);
            $stmt->bindValue("id_organization",    $id_organization);
            $stmt->execute();
            $rs = $stmt->rowCount() ? 1 : 0;
            $deleteRoleOrg = deleteByRole($db, 3, $id_organization);
            $deleteRoleApp = deleteByRole($db, 5, $id_organization);
            $response['data'] = true;
            $response['message'] = "Available to delete this organization. Deleting...";
        } else {
            $response['data'] = false;

            $response['message'] = "You are not available to delete this organization";
        }
        $db = null;
        $response['error'] = false;
        // $response['message'] = "Success";
    } catch (PDOException $e) {
        $db = null;
        $response['data'] = null;
        $response['error'] = true;
        $response['message'] = "An error occurred, try again." . $e->getMessage();
    }
    echo json_encode($response);
    return;
    //return $response;
}

function deleteByRole($db, $role, $id_organization)
{
    $sql = "SELECT * FROM gr_users WHERE role = $role and id_organization = $id_organization AND deleted = 0";
    try {
        $response = array();
        $stmt = $db->query($sql);
        $rs   =  $stmt->fetchAll();

        $rsSelect = array();
        for ($i = 0; $i < count($rs); $i++) {
            $idToDelete = $rs[$i]['id'];
            $sqlDeleteUSer = "UPDATE gr_users SET deleted = 1 WHERE id=$idToDelete";
            $stmtDeleteUSer = $db->query($sqlDeleteUSer);
            // $rsDeleteUSer   =  $stmtDeleteUSer->fetchAll();
            
            $rsDeleteUSer["id_".$i] = "deleted".$idToDelete;
        }
        // if (count($rs) > 0) {
        // $response['count'] = $rs[0];
        return $rsSelect;
        // } else {
        //     $response['count'] = (int) $rs[0]['count'];
        // }
        // $response['error'] = false;
    } catch (PDOException $e) {
        // $response['exist'] = false;
        // $response['count'] = 0;
    }
    return $response;
}


function countRole($db, $role, $id_organization)
{
    // $sql = "SELECT COUNT(*) as count FROM gr_users WHERE role = $role and id_organization = $id_organization and status = 1 AND deleted=0";
    $sql = "SELECT COUNT(*) as count FROM gr_users WHERE role = $role and id_organization = $id_organization AND deleted = 0";
    try {
        $response = array();
        $stmt = $db->query($sql);
        $rs   =  $stmt->fetchAll();
        if (count($rs) > 0) {
            $response['count'] = (int) $rs[0]['count'];
        } else {
            $response['count'] = (int) $rs[0]['count'];
        }
        $response['error'] = false;
    } catch (PDOException $e) {
        $response['exist'] = false;
        $response['count'] = 0;
    }
    return $response;
}

function deleteUserOrganization($db, $id_user, $role, $id_organization)
{
    // 3 org admin / 5 approver
    $response = array();
    $response['data'] = 0;
    //   echo  $countRole['count'];
    $countRole = countRole($db, $role, $id_organization);

    if ($role == 3 && $countRole['count'] == 2) {
        $response['error']   = true;
        $response['message'] = "You can’t delete more org admins, The limit per org its 2";
        //return $response;
        echo json_encode($response);
        return;
    } else if ($role == 5 && $countRole['count'] == 2) {
        $response['error']   = true;
        $response['message'] = "You can’t delete more approvers, The limit per org its 2";
        //return $response;
        echo json_encode($response);
        return;
    }

    $sql = "UPDATE gr_users SET deleted = 1 WHERE id=:id";
    try {
        $stmt = $db->prepare($sql);
        $stmt->bindValue("id",    $id_user);
        $stmt->execute();
        $rs = $stmt->rowCount() ? 1 : 0;
        $response['data'] = $rs;
        $response['error'] = false;
        $response['message'] = "Success";
    } catch (PDOException $e) {
        $response['data'] = null;
        $response['error'] = true;
        $response['message'] = "An error occurred, try again." . $e->getMessage();
    }
    echo json_encode($response);
    return;
    //return $response;
}

function updateSession($db, $uid)
{
    $sql = "UPDATE `gr_session` SET try=:try,device=:device WHERE uid=:uid";
    try {
        $response = array();
        $stmt = $db->prepare($sql);
        $stmt->bindValue("uid",    $uid);
        $stmt->bindValue("device", 'bs.' . ip() . ip('dev'));
        $stmt->bindValue("try",    0);
        $stmt->execute();
        $rs = $stmt->rowCount() ? 1 : 0;
        $response['data'] = $rs;
        $response['error'] = false;
        $response['message'] = "";
    } catch (PDOException $e) {
        $response['data'] = null;
        $response['error'] = true;
        $response['message'] = "An error occurred, try again." . $e->getMessage();
    }

    return $response;
}


function existSession($db, $uid)
{
    $sql = "SELECT * FROM `gr_session` WHERE  uid = '$uid'";
    try {
        $response = array();
        $stmt = $db->query($sql);
        $rs   =  $stmt->fetchAll();
        if (count($rs) > 0) {
            $response['exist'] = true;
            $response['data'] = $rs[0];
            $response['message'] = "The user with phone '$phone' exist.";
        } else {
            $response['exist'] = false;
            $response['data'] = [];
            $response['message'] = "";
        }
        $response['error'] = false;
    } catch (PDOException $e) {
        $response['exist'] = false;
        $response['data'] = null;
        $response['error'] = true;
        $response['message'] = "An error occurred, try again." . $e->getMessage();
    }
    return $response;
}


function updateStatusUser($db, $phone, $status)
{
    $sql = "UPDATE gr_users SET STATUS = $status WHERE phone = '$phone'";
    try {
        $response = array();
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $rs = $stmt->rowCount() ? 1 : 0;
        $db = null;
        $response['data']    = $rs;
        $response['error']   = false;
        $response['message'] = "";
    } catch (PDOException $e) {
        $response['data']    = null;
        $response['error']   = true;
        $response['message'] = "An error occurred, try again." . $e->getMessage();
    }
    echo json_encode($response);
}


function updatePasswordUser($db, $password ,$phone){
    $p = en($password);
    $pass = $p['pass'];
    $mask = $p['mask'];
    $type = $p['type'];
    $sql = "UPDATE gr_users SET pass = '$pass', mask='$mask', depict='$type' WHERE phone = '$phone'";
    try {
        $response = array();
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $rs = $stmt->rowCount() ? 1 : 0;
        $db = null;
        $response['data']    = $rs;
        $response['error']   = false;
        $response['message'] = "";
    } catch (PDOException $e) {
        $response['data']    = null;
        $response['error']   = true;
        $response['message'] = "An error occurred, try again." . $e->getMessage();
    }
    echo json_encode($response);
}

function existUser($db, $phone, $email)
{
    $sql = "SELECT * FROM `gr_users` WHERE  phone = '$phone' OR email = '$email'";
    try {
        $response = array();
        $stmt = $db->query($sql);
        $rs   =  $stmt->fetchAll();
        if (count($rs) > 0) {
            $response['exist'] = true;
            $response['data'] = $rs[0];
            if($rs[0]['phone']==$phone){
                $response['message'] = "Phone: '$phone' already exists";
            }else if($rs[0]['email']==$email){
                $response['message'] = "Email: '$email' already exists";
            }
        } else {
            $response['exist'] = false;
            $response['data'] = [];
            $response['message'] = "";
        }
        $response['error'] = false;
    } catch (PDOException $e) {
        $response['exist'] = false;
        $response['data'] = null;
        $response['error'] = true;
        $response['message'] = "An error occurred, try again." . $e->getMessage();
    }
    echo json_encode($response);
}


function existUserSign($db, $phone, $username, $email)
{
    $sql = "SELECT * FROM `gr_users` WHERE  phone = '$phone' OR username = '$username' OR email = '$email'";
    try {
        $response = array();
        $stmt = $db->query($sql);
        $rs   =  $stmt->fetchAll();
        if (count($rs) > 0) {
            $response['exist'] = true;
            $response['data'] = $rs[0];
            if ($rs[0]['phone'] == $phone) {
                $response['message'] = "Phone: '$phone' already exists";
            } else if ($rs[0]['username'] == $username) {
                $response['message'] = "User: '$username' already exists";
            } else if ($rs[0]['email'] == $email) {
                $response['message'] = "Email: '$email' already exists";
            }
        } else {
            $response['exist'] = false;
            $response['data'] = [];
            $response['message'] = "";
        }
        $response['error'] = false;
    } catch (PDOException $e) {
        $response['exist'] = false;
        $response['data'] = null;
        $response['error'] = true;
        $response['message'] = "An error occurred, try again." . $e->getMessage();
    }
    echo json_encode($response);
}

function existUserForgotPassword($db, $phone)
{
    $sql = "SELECT * FROM `gr_users` WHERE phone = '$phone'";
    try {
        $response = array();
        $stmt = $db->query($sql);
        $rs   =  $stmt->fetchAll();
        if (count($rs) > 0) {
            $response['exist'] = true;
            $response['data'] = $rs[0];
        } else {
            $response['exist'] = false;
            $response['data'] = [];
            $response['message'] = "";
        }
        $response['error'] = false;
    } catch (PDOException $e) {
        $response['exist'] = false;
        $response['data'] = null;
        $response['error'] = true;
        $response['message'] = "An error occurred, try again." . $e->getMessage();
    }
    echo json_encode($response);
}




function saveSession($db, $uid)
{
    $sql = "INSERT INTO `gr_session`(uid,device,code,tms,try) VALUES(:uid,:device,:code,NOW(),:try)";
    try {
        $response = array();
        $stmt = $db->prepare($sql);
        $stmt->bindValue("uid",    $uid);
        $stmt->bindValue("device", 'bs.' . ip() . ip('dev'));
        $stmt->bindValue("try",    0);
        $stmt->bindValue("code",   rn(20));
        $stmt->execute();
        $id = $db->lastInsertId();
        $lastInsertId = $id > 0 ? $id : 0;
        $response['data'] = $lastInsertId;
        $response['error'] = false;
        $response['message'] = "";
    } catch (PDOException $e) {
        $response['data'] = null;
        $response['error'] = true;
        $response['message'] = "An error occurred, try again." . $e->getMessage();
    }

    return $response;
}

function searchOrganizationBySecretKey($db, $secret_key)
{
    $sql = "SELECT * FROM `gr_organizations` WHERE  secret_key = '$secret_key'";
    try {
        $response = array();
        $stmt = $db->query($sql);
        $rs   =  $stmt->fetchAll();
        if (count($rs) > 0) {
            $response['exist'] = true;
            $response['data'] = $rs[0];
        } else {
            $response['exist'] = false;
            $response['data'] = [];
        }
        $response['error'] = false;
        $response['message'] = "";
    } catch (PDOException $e) {
        $response['exist'] = false;
        $response['data'] = null;
        $response['error'] = true;
        $response['message'] = "An error occurred, try again." . $e->getMessage();
    }
    echo json_encode($response);
}

function searchOrganization($db, $organization, $secret_key)
{
    $sql = "SELECT * FROM `gr_organizations` WHERE organization = '$organization' or secret_key = '$secret_key' ";
    try {
        $response = array();
        $stmt = $db->query($sql);
        $rs   =  $stmt->fetchAll();
        if (count($rs) > 0) {
            $response['exist'] = true;
            $response['data'] = $rs[0];
        } else {
            $response['exist'] = false;
            $response['data'] = [];
        }
        $response['error'] = false;
        $response['message'] = "";
    } catch (PDOException $e) {
        $response['exist'] = false;
        $response['data'] = null;
        $response['error'] = true;
        $response['message'] = "An error occurred, try again." . $e->getMessage();
    }
    echo json_encode($response);
}



function getDataUserByPhone($db, $phone)
{
    $sql = "SELECT * FROM gr_users WHERE phone = '$phone'";
    try {
        $response = array();
        $stmt = $db->query($sql);
        $rs   =  $stmt->fetchAll();
        if (count($rs) > 0) {
            $response['exist'] = true;
            $response['data'] = $rs[0];
        } else {
            $response['exist'] = false;
            $response['data'] = [];
        }
        $response['error'] = false;
        $response['message'] = "";
    } catch (PDOException $e) {
        $response['exist'] = false;
        $response['data'] = null;
        $response['error'] = true;
        $response['message'] = "An error occurred, try again." . $e->getMessage();
    }
    echo json_encode($response);
}

function getDataUserById($db, $id){
    $sql = "SELECT * FROM gr_users WHERE id = '$id'";
    try {
        $response = array();
        $stmt = $db->query($sql);
        $rs   =  $stmt->fetchAll();
        if (count($rs) > 0) {
            $response['exist'] = true;
            $response['data'] = $rs[0];
        } else {
            $response['exist'] = false;
            $response['data'] = [];
        }
        $response['error'] = false;
        $response['message'] = "";
    } catch (PDOException $e) {
        $response['exist'] = false;
        $response['data'] = null;
        $response['error'] = true;
        $response['message'] = "An error occurred, try again." . $e->getMessage();
    }
    return $response;
}
function getDataUserByUsername($db, $username)
{
    $sql = "SELECT * FROM gr_users WHERE username = '$username'";
    try {
        $response = array();
        $stmt = $db->query($sql);
        $rs   =  $stmt->fetchAll();
        if (count($rs) > 0) {
            $response['exist'] = true;
            $response['data'] = $rs[0];
        } else {
            $response['exist'] = false;
            $response['data'] = [];
        }
        $response['error'] = false;
        $response['message'] = "";
    } catch (PDOException $e) {
        $response['exist'] = false;
        $response['data'] = null;
        $response['error'] = true;
        $response['message'] = "An error occurred, try again." . $e->getMessage();
    }
    echo json_encode($response);
}


function searchOTP($db, $otp)
{
    $sql = "SELECT * FROM gr_options WHERE type='invite' and  v2 = '$otp'";
    try {
        $response = array();
        $stmt = $db->query($sql);
        $rs   =  $stmt->fetchAll();
        if (count($rs) > 0) {
            $dataUser = getDataUserById($db,$rs[0]['v3']);
            $response['exist'] = true;
            $response['data']  = $rs[0];
            $response['user']  = $dataUser['data'];

        } else {
            $response['exist'] = false;
            $response['data'] = [];
            $response['user'] = [];
        }
        $response['error'] = false;
        $response['message'] = "";
    } catch (PDOException $e) {
        $response['exist'] = false;
        $response['data'] = null;
        $response['user'] = null;
        $response['error'] = true;
        $response['message'] = "An error occurred, try again." . $e->getMessage();
    }
    echo json_encode($response);
}


function saveOrganization($db, $organization, $secret_key)
{
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
        $response['message'] = "Organization '" . $organization . "' created successfully.";
    } catch (PDOException $e) {
        $response['data'] = null;
        $response['error'] = true;
        $response['message'] = "An error occurred, try again." . $e->getMessage();
    }
    echo json_encode($response);
}


/********************* */
function ip($t = 0)
{
    if ($t === 'dev') {
        $dev = $_SERVER['HTTP_USER_AGENT'];
        $dev = preg_replace("/[^A-Za-z0-9.]/", "", $dev);
        $dev = strtolower($dev);
        return $dev;
    } else {
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR') ?:
            getenv('HTTP_X_FORWARDED') ?:
            getenv('HTTP_FORWARDED_FOR') ?:
            getenv('HTTP_FORWARDED');
        if (empty($ipaddress)) {
            return getenv('REMOTE_ADDR');
        } else {
            return $ipaddress;
        }
    }
}

function fast_login($db, $id_username, $psw_encrypt, $phone, $status_user, $id_chat, $codeInvitation){
    $response = array();
    $u = $phone;
    $f = 'phone';
    $r[0] = false;
    $r[1] = 'invalid';
    $d = 'Grupo';

     $uid    = $id_username;
     $device = 'bs.'.ip().ip('dev');
     $sql = "DELETE FROM gr_session WHERE uid = $uid AND device = '$device'";
     $stmt = $db->prepare($sql);
     $stmt->execute();

    if($status_user==1){
            ses($db, $d, $id_username);
            setcookie($d.'usrdev', $_SESSION[$d.'usrdev'], time() + (86400 * 30), "/");
            setcookie($d.'usrcode', $_SESSION[$d.'usrcode'], time() + (86400 * 30), "/");
            setcookie($d.'usrses', $_SESSION[$d.'usrses'], time() + (86400 * 30), "/");
    }
    $r[0] = true;
    $r[2] = getDataUserById($db,$id_username);

    $sql = "INSERT INTO `gr_options`(type,v1,v2,v3,v4,v5) VALUES('gruser',:id_chat,:idUser,:idrole,0,0)";
    try {
        $response = array();
        $stmt = $db->prepare($sql);
        $stmt->bindValue("idUser",  $r[2]['data']['id']);
        $stmt->bindValue("idrole",  $r[2]['data']['role']);
        $stmt->bindValue("id_chat", $id_chat);
        if($stmt->execute()){
            $sql   = "UPDATE gr_options SET v4 = 1 WHERE v2 = '$codeInvitation'";
            $query = $db->prepare($sql);
            $query->execute();
            $response['data']    = null;
            $response['error']   = false;
            $response['message'] = "Invitation created succesfully";
        }
        
    } catch (PDOException $e) {
        $response['data']    = null;
        $response['error']   = true;
        $response['message'] = "An error occurred, try again." . $e->getMessage();
    }
    $r[3] = $response;

    echo json_encode($r);
}

function en($v, $t = 0, $m = 0)
{
    if ($t == '0') {
        $t = rand(1, 10);
    }
    function depict($t, $v, $m)
    {
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

function rn($number)
{
    if (empty($number)) {
        $length = rand(8, 20);
    } else {
        $length = $number;
    }

    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $size = strlen($chars);
    $str = "";
    for ($i = 0; $i < $length; $i++) {
        $str .= $chars[rand(0, $size - 1)];
        $str .= $chars[rand(0, $size - 1)];
    }
    $str = substr($str, 0, $length);
    if (isset($arg[2])) {
        $sym = $arg[2];
        if (!isset($arg[3])) {
            $str = $str . $sym;
            $str = str_shuffle($str);
        } else if ($arg[3] == 'left') {
            $str = $sym . $str;
        } else if ($arg[3] == 'right') {
            $str = $str . $sym;
        } else if ($arg[3] == 'mid') {
            $m = strlen($str) / 2;
            $f = substr($str, 0, $m);
            $l = substr($str, $m);
            $str = $f . $sym . $l;
        }
        // $str = vc($str);
    }
    return $str;
}

function ses($db,$d,$v) {
    $_SESSION[$d.'usrdev'] = ip().ip('dev');
    $_SESSION[$d.'usrcode'] = rn("5").rn("9");
  //  $_SESSION[$d.'usrses'] = db($d, 'i', 'session', 'uid,device,code,tms', $v,$_SESSION[$d.'usrdev'], $_SESSION[$d.'usrcode'], dt());

    $sql = "INSERT INTO `gr_session`
    (uid,
    device,
    code,
    tms
    )
    VALUES
    (:uid,
    :device,
    :code,
    NOW())";
    $stmt = $db->prepare($sql);
    $stmt->bindValue("uid",  $v);
    $stmt->bindValue("device",  $_SESSION[$d.'usrdev']);
    $stmt->bindValue("code",  $_SESSION[$d.'usrcode']);
    $stmt->execute();
    $_SESSION[$d.'usrses'] = $db->lastInsertId();
    return true;
  
}

