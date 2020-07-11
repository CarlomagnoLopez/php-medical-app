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
    
    case 'saveOrganizationtest':
        // sleep(3000);
       test();
    break;
    case 'saveOrganization':
        $organization = $json->summaryOrg->orgName;
        $secret_key   = $json->summaryOrg->orgName;
        $contact_email   = $json->summaryOrg->contactEmail;
        $contact_name   = $json->summaryOrg->contactName;
        $web_site   = $json->summaryOrg->orgWesite;
        $phone_number   = $json->summaryOrg->phoneNumber;
        $tax_number   = $json->summaryOrg->taxNumber;
        saveOrganization($db, $organization, $secret_key, $contact_email, $contact_name, $web_site, $phone_number, $tax_number, $json);

        break;
}



function test()
{

    try {
        $response = array();
        $response['data'] = null;
        $response['error'] = true;
        $response['message'] = "An error occurred, try again.";
    } catch (PDOException $e) {
        $response['data'] = null;
        $response['error'] = true;
        $response['message'] = "An error occurred, try again.";
    }
    echo json_encode($response);
}


function saveOrganization($db, $organization, $secret_key, $contact_email, $contact_name, $web_site, $phone_number, $tax_number, $json)
{
    $sql = "INSERT INTO `gr_organizations`
   (organization,
   secret_key,
   contact_email,
   contact_name,
   web_site,
   phone_number,
   tax_number
   )
   VALUES
   (:organization,
   :secret_key,
   :contact_email,
   :contact_name,
   :web_site,
   :phone_number,
   :tax_number
   )";
    try {
        $response = array();
        $log = array();
        $stmt = $db->prepare($sql);
        $stmt->bindValue("organization",  $organization);
        $stmt->bindValue("secret_key", $secret_key);
        $stmt->bindValue("contact_email", $contact_email);
        $stmt->bindValue("contact_name", $contact_name);
        $stmt->bindValue("web_site", $web_site);
        $stmt->bindValue("phone_number", $phone_number);
        $stmt->bindValue("tax_number", $tax_number);
        $stmt->execute();
        $id = $db->lastInsertId();
        $lastInsertId = $id > 0 ? $id : 0;

        $idGruoup = createGroup($db, $organization, $lastInsertId);
        // $arrayLength = count($json->usersOrg);
        // for ($i = 0; $i < $arrayLength; $i++) {
        $log[1] = createUser($db, $json->usersOrg[0], $lastInsertId, $idGruoup);
        $log[2] = createUser($db, $json->usersOrg[1], $lastInsertId, $idGruoup);
        $log[3] = createUser($db, $json->usersOrg[2], $lastInsertId, $idGruoup);
        $log[4] = createUser($db, $json->usersOrg[3], $lastInsertId, $idGruoup);

        




        $db = null; 
        $response['data'] = "success";
        $response['error'] = false;
        $response['message'] = "Organization created successfully.";
    } catch (PDOException $e) {
        $response['data'] = null;
        $response['error'] = true;
        $response['message'] = "An error occurred, try again." . $e->getMessage();
    }
    echo json_encode($response);
}

function addUserToGroup($db, $idGroupCreated, $log, $nameUser)
{
    $sql = "INSERT INTO `gr_options`
    (type,
    v1,
    v2,
    v3
    )
    VALUES
    (:group,
    :organization,
    :idUser,
    0
  ),
  (:lview,
    :organization,
    :idUser,
    0
  ),
  (profile,
    name,
    :nameUser,
    :idUser
  ),
  (profile,
  status,
    offline,
    :idUser
  )
  ";
    try {
        $response = array();
        $stmt = $db->prepare($sql);
        $stmt->bindValue("group",             "gruser");
        $stmt->bindValue("lview",             "lview");
        $stmt->bindValue("organization",       $idGroupCreated);
        $stmt->bindValue("nameUser",       $nameUser);
        $stmt->bindValue("idUser",       $log);
        $stmt->execute();
        $id = $db->lastInsertId();
        $lastInsertId = $id > 0 ? $id : 0;
        // $db = null;
        $response = $log;
        // $response['error'] = false;
        // $response['message'] = "Group created succesfully";
    } catch (PDOException $e) {
        $response['data'] = null;
        $response['error'] = true;
        $response['message'] = "An error occurred, try again." . $e->getMessage();
    }
    // echo json_encode($response);
    echo json_encode($response);
}


function createGroup($db, $organization, $idOrg)
{


    $sql = "INSERT INTO `gr_options`
    (type,
    v1,
    v2,
    v3,
    v4,
    v5,
    id_organization
    )
    VALUES
    (:group,
    :organization,
    0,
    0,
    0,
    0,
    :idOrg


  )";
    try {
        $response = array();
        $stmt = $db->prepare($sql);
        $stmt->bindValue("group",             "group");
        $stmt->bindValue("organization",       $organization);
        $stmt->bindValue("idOrg",       $idOrg);
        $stmt->execute();
        $id = $db->lastInsertId();
        $lastInsertId = $id > 0 ? $id : 0;
        // $db = null;
        $response = $lastInsertId;

        return $lastInsertId;
        // $response['error'] = false;
        // $response['message'] = "Group created succesfully";
    } catch (PDOException $e) {
        $response['data'] = null;
        $response['error'] = true;
        $response['message'] = "An error occurred, try again." . $e->getMessage();
    }
    echo json_encode($response);
    // return json_encode($response);
}


function createUser($db, $value, $org, $idGruoup)
{
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
        $roleOrg = "";
        if ($value->role === "OrgAdmin") {
            $roleOrg = "3";
        }

        if ($value->role === "OrgApproval") {
            $roleOrg = "5";
        }

        $p = en($value->password);
        $response = array();
        $stmt = $db->prepare($sql);
        $stmt->bindValue("name",             $value->contactName);
        $stmt->bindValue("email",            $value->email);
        $stmt->bindValue("pass",             $p['pass']);
        $stmt->bindValue("mask",             $p['mask']);
        $stmt->bindValue("depict",           $p['type']);
        $stmt->bindValue("role",             $roleOrg);
        $stmt->bindValue("extra",            0);
        $stmt->bindValue("phone",            $value->phoneNumber);
        $stmt->bindValue("id_organization",  $org);
        $stmt->execute();
        $id = $db->lastInsertId();
        $lastInsertId = $id > 0 ? $id : 0;


        addUserToGroup($db, $idGruoup, $lastInsertId, $value->contactName);

        // $db = null;
        $response =  $lastInsertId;
        // $response['data'] = $lastInsertId;
        // $response['error'] = false;
        // $response['message'] = "User '" .  $value->email . "' created successfully.";
    } catch (PDOException $e) {
        $response['data'] = null;
        $response['error'] = true;
        $response['message'] = "An error occurred, try again." . $e->getMessage();
    }
    echo json_encode($response);
    // return json_encode($response);
}


function en($v, $t = 0, $m = 0)
{
    if ($t == '0') {
        $t = rand(1, 10);
    }

    return depict($t, $v, $m);
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

function rn()
{
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
        $str = vc($str);
    }
    return $str;
}
