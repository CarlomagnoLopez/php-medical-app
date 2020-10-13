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
    case 'updateStatusUser':
        $phone  = $json->phone;
        $status = $json->status;
        updateStatusUser($db, $phone, $status);
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
        fastLogin($db, $phone, $status);
        break;
}

function deleteOrganization($db, $id_organization)
{
    // 3 org admin / 5 approver
    $response = array();
    $response['data'] = 0;
    //   echo  $countRole['count'];
    $countRoleOrg = countRole($db, 3, $id_organization);
    $countRoleApp = countRole($db, 5, $id_organization);
    $countRoleUser = countRole($db, 0, $id_organization);






    try {

        if ($countRoleOrg['count'] == "2" &&  $countRoleApp['count'] == "2" &&  $countRoleUser['count'] == "0") {
            $sql = "UPDATE gr_organizations SET deleted = 1 WHERE 	id_organization=:id_organization";
            $stmt = $db->prepare($sql);
            $stmt->bindValue("id_organization",    $id_organization);
            $stmt->execute();
            $rs = $stmt->rowCount() ? 1 : 0;
            $response['data'] = true;
            $response['message'] = "Available to delete this organization. Deleting...";
        } else {
            $response['data'] = false;

            $response['message'] = "You are not available to delete this organization";
        }

            // $response['data'] = $rs;
        ; //. " ". $countRoleApp. " ". $countRoleUser;
        $response['error'] = false;
        // $response['message'] = "Success";
    } catch (PDOException $e) {
        $response['data'] = null;
        $response['error'] = true;
        $response['message'] = "An error occurred, try again." . $e->getMessage();
    }
    echo json_encode($response);
    return;
    //return $response;
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
            $response['message'] = "The username: '$email' or phone : '$phone' exist.";
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
            if($rs[0]['phone']==$phone){
                $response['message'] = "Phone: '$phone' already exists";
            }else if($rs[0]['username']==$username){
                $response['message'] = "User: '$username' already exists";
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
