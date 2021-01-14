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

    case 'userlist':
        getUserByUSer();
        break;
        // case 'test':
        //     $sqlMin = "SELECT CURRENT_TIMESTAMP() + INTERVAL 5 MINUTE as timeCur";
        //     $stmt1     = $db->query($sqlMin);
        //     $rs1       =  $stmt1->fetchAll();
        //     $response['data'] = null;
        //     $response['error'] = true;
        //     $response['message'] = "We can't  create: " . $rs1[0]["timeCur"] . " because the name it is already exist! Select a different one.";
        //     echo json_encode($response);
        //     break;
    case 'updateOrganization':
        updateOrganization($json);
        break;
    case 'saveOrganization':
        $organization = $json->summaryOrg->orgName;
        $secret_key   = $json->summaryOrg->secretKey;
        $contact_email   = $json->summaryOrg->contactEmail;
        $contact_name   = $json->summaryOrg->contactName;
        $web_site   = $json->summaryOrg->orgWesite;
        $phone_number   = $json->summaryOrg->phoneNumber;
        $tax_number   = $json->summaryOrg->taxNumber;
        $sqlSaveOrganization = "SELECT * FROM `gr_organizations` WHERE `organization` = '$organization' and  deleted = 0";
        $dbSaveOrg = Connection();
        $stmtSaveOrganization     = $dbSaveOrg->query($sqlSaveOrganization);
        $rsSaveOrganization      =  $stmtSaveOrganization->fetchAll();
        $dbSaveOrg = null;
        if (count($rsSaveOrganization) > 0) {
            $response = array();
            $response['data'] = null;
            $response['error'] = true;
            $response['message'] = "We can't  create: " . $organization . " because the name it is already exist! Select a different one.";
            echo json_encode($response);
            return;
        }

        $userDuplicity = userDuplicity($json->usersOrg);

        if ($userDuplicity["duplicity"] === "0") {
            $response = array();
            $response['data'] = null;
            $response['error'] = true;
            $response['message'] = "The following data is already exist on the system: " . $userDuplicity['values'] . "We did not crete organization.";
            echo json_encode($response);
            return;
        }

        saveOrganization($organization, $secret_key, $contact_email, $contact_name, $web_site, $phone_number, $tax_number, $json);

        // $response = array();
        // $response['data'] = $userDuplicity;
        // $response['error'] = false;
        // $response['message'] = "Test user no errors";
        // echo json_encode($response);
        return;



        break;
    case 'saveUserByOrg':
        $organization = $json->record->orgid;
        $role         = $json->record->role;
        $email         = $json->record->email;
        $phoneNumber         = $json->record->phoneNumber;
        $response     = array();
        $response['message']  = '';
        if ($role == 3 || $role == 5) {
            $countRole = countRole($role, $organization);
            if ($countRole['count'] >= 4) {
                $response['data']    = 0;
                $response['error']   = true;
                if ($role == 3) {
                    $response['message'] = "You can’t create more than 4 org admin";
                } else if ($role == 5) {
                    $response['message'] = "You can’t create more than 4 approver";
                } else {
                    $response['message']  = '';
                }
                echo json_encode($response);
                return;
            }
        }

        $validatorQuery = initValidationsStepsCreation($organization,  $email, $phoneNumber);



        switch ($validatorQuery['error']) {
            case 1:
                // 
                $response['data'] = null;
                $response['error'] = true;
                // $response['message'] = "User '" .  $value->email . "' created successfully.";
                $response['message'] = $validatorQuery['message'];
                echo json_encode($response);
                return;
                # code...
                break;
            case 0:
                createOneUser($json->record, $json->record->orgid, $validatorQuery["rs1"][0]["id"]);
                // $response['data'] = null;
                // $response['error'] = true;
                // // $response['message']  = "User '" .  $email . "' created successfully.";
                // $response['message']  = $validatorQuery["rs1"][0]["id"];

                // echo json_encode($response);

                return;
                # code...
                break;
            default:
                # code...
                break;
        }


        break;
}

function userDuplicity($userValidation)
{

    $results = array();
    for ($i = 0; $i < count($userValidation); $i++) {
        $phoneNumber = $userValidation[$i]->phoneNumber;

        $sqlDuplicity = "SELECT * FROM `gr_users` WHERE `phone` = '$phoneNumber' and deleted = 0";
        $dbDuplicity = Connection();
        $stmtDuplicity    = $dbDuplicity->query($sqlDuplicity);
        $rsDuplicity      =  $stmtDuplicity->fetchAll();

        if (count($rsDuplicity) > 0) {
            // $email = $userValidation[$i]->email;
            // $results[$i] = $phoneNumber;
            array_push($results,  $phoneNumber);
        }
    }

    $resultsResponse = array();
    $results2 = "";

    if (count($results) > 0) {
        for ($j = 0; $j < count($results); $j++) {
            // if($results[$j]){
            $results2 .=  $results[$j] . ",  ";
            // $results2 .=  $results[$j] . ",  ";

            // }
        }
        $resultsResponse["duplicity"] = "0";
        $resultsResponse["values"] = $results2;
        return  $resultsResponse;
    } else {
        $resultsResponse["duplicity"] = "1";
        return  $resultsResponse;
    }
}


function initValidationsStepsCreation($organization,  $email, $phoneNumber)
{


    $responseCreation = array();
    $responseCreation['error'] = 1;
    $dbQueryInit = Connection();

    // $sql2 = "SELECT * FROM `gr_users` WHERE `email` = '" . $email . "' and deleted = 0 ";
    // $stmt2     = $dbQueryInit->query($sql2);
    // $rs2      =  $stmt2->fetchAll();

    // if (count($rs2) > 0) {
    //     $responseCreation['error'] = 1;
    //     $responseCreation['message'] = "We can't create user:  " . $email . " because the email it is already exist! Select a different one.";
    //     $dbQueryInit = null;
    //     return  $responseCreation;
    // } else {
    //     $responseCreation['error'] = 0;
    // }

    // $dbQueryInit = null;

    $sql3 = "SELECT * FROM `gr_users` WHERE `phone` = '" . $phoneNumber . "' and deleted = 0 ";
    $stmt3     = $dbQueryInit->query($sql3);
    $rs3      =  $stmt3->fetchAll();
    if (count($rs3) > 0) {
        $responseCreation['error'] = 1;
        $responseCreation['message'] = "We can't create user with:  " . $phoneNumber . " because the phone number it is already exist! Select a different one.";
        $dbQueryInit = null;
        return  $responseCreation;
    } else {
        $responseCreation['error'] = 0;
    }



    $sql = "SELECT * FROM `gr_organizations` WHERE `id_organization` = $organization";
    $stmt     = $dbQueryInit->query($sql);
    $rs       =  $stmt->fetchAll();

    $sql1 = "SELECT * FROM `gr_options` WHERE `id_organization` = $organization";
    $stmt1     = $dbQueryInit->query($sql1);
    $rs1      =  $stmt1->fetchAll();

    $responseCreation['rs1'] = $rs1;

    $dbQueryInit = null;

    return  $responseCreation;
}


function countRole($role, $id_organization)
{
    try {
        $sql = "SELECT COUNT(*) as count FROM gr_users WHERE role = $role and id_organization = $id_organization and deleted = 0"  ;
        $dbcountingrole  = Connection();
        $response = array();
        $stmt = $dbcountingrole->query($sql);
        $rs   =  $stmt->fetchAll();
        if (count($rs) > 0) {
            $response['count'] = (int) $rs[0]['count'];
        } else {
            $response['count'] = (int) $rs[0]['count'];
        }
        // $response['error'] = false;
    } catch (PDOException $e) {
        // $response['exist'] = false;
        // $response['count'] = 0;
    }
    return $response;
}



function getSMSTest($phone, $typeSMS)
{
    try {


        // sleep(2);
        $a = ['a', 'b', 'c', 'd', 'e', 'f', 'g', "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z", "0", "1", "2", "3", "4", "5", "6", "7", "8", "9"];
        $n = 8;
        $createdArray = array_values(array_intersect_key($a, array_flip(array_rand($a, $n))));
        $stringArray = $createdArray[0] . $createdArray[1] . $createdArray[2] . $createdArray[3] . $createdArray[4] . $createdArray[5] . $createdArray[6] . $createdArray[7];
        $longLink = "http://ec2-54-166-131-223.compute-1.amazonaws.com/php-medical-app/door/integration/maindummy.php?smsvalidations=" . $stringArray;
        $data_array =  array(
            "group_guid" => "Bk9h1KBTFqy",
            "domain" => "bit.ly",
            "long_url" => $longLink
        );
        $make_call = callAPIAuth('POST', 'https://api-ssl.bitly.com/v4/shorten', json_encode($data_array));
        sleep(2);

        $responseBitLy  = json_decode($make_call, true);

        $dbValiteS3          = Connection();

        $sqlValiteS3  = "SELECT NOW() + INTERVAL 5 MINUTE as timeCur";

        $stmtValiteS3     = $dbValiteS3->query($sqlValiteS3);
        $rsValiteS3      =  $stmtValiteS3->fetchAll();


        $timeCur = $rsValiteS3[0]["timeCur"];
        $dbValiteS3          = null;
        // $refValiteS3 = "99";

        $dbValiteS4          = Connection();

        $sqlValiteS4 = $dbValiteS4->exec("INSERT INTO gr_history_sms
        (
            `id`,
        `link`, 
        `init_date`,
        `finish_date`,
        `used`,
        `phone_number`
        )
        VALUES
        (NULL, 
        '$stringArray', 
        NOW(),
        '$timeCur',
        '99',
        '$phone'
        );");


        $dbValiteS4 = null;
        sendSMSTest($phone, $responseBitLy["link"], $typeSMS);
    } catch (PDOException $e) {
    }
}

function sendSMSTest($phone, $linkBitLy, $typeSMS)
{

    try {
        $response = array();
        $data_array =  array(
            "sms"   => "",
            "link" => $linkBitLy,
            "type"  => $typeSMS,
            "phone" => $phone
        );
        $make_call = callAPI('POST', 'https://qow7oum5sd.execute-api.us-east-1.amazonaws.com/dev/sendsms', json_encode($data_array));
        $response  = json_decode($make_call, true);
        // $data    = $response['body']['MessageId'];
        // $statusCode = $response['statusCode'];

        // $response =  $lastInsertId;
        // $response['data'] = "success";
        // $response['error'] = false;
        // $response['message'] = "Sent SMS with tiny url";
    } catch (PDOException $e) {
        // $response['data'] = null;
        // $response['error'] = true;
        // $response['message'] = "An error occurred, try again." . $e->getMessage();
    }
}


function createOneUser($value, $org, $idGruoup)
{

    try {
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
        deleted
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
        0)";
        $dbcreateoneuser  = Connection();
        $roleOrg = $value->role;
        if ($value->role === "OrgAdmin") {
            $roleOrg = "3";
        }

        if ($value->role === "OrgApproval") {
            $roleOrg = "5";
        }
        if ($value->role === "User") {
            $roleOrg = "6";
        }

        $p = en("Soporte20#");
        $response = array();
        $stmt = $dbcreateoneuser->prepare($sql);
        $stmt->bindValue("name",             $value->name);
        $stmt->bindValue("email",            $value->email);
        $stmt->bindValue("pass",             $p['pass']);
        $stmt->bindValue("mask",             $p['mask']);
        $stmt->bindValue("depict",           $p['type']);
        $stmt->bindValue("role",             $roleOrg);
        $stmt->bindValue("extra",            0);
        $stmt->bindValue("phone",            $value->phoneNumber);
        $stmt->bindValue("id_organization",  $org);
        $stmt->execute();


        $id = $dbcreateoneuser->lastInsertId();
        $lastInsertId = $id > 0 ? $id : 0;
        $dbcreateoneuser = null;
        sleep(2);
        getSMSTest($value->phoneNumber, "signuplink");
        // sleep(2);



        addUserToGroup($idGruoup, $lastInsertId, $value->name);

        // $db = null;
        $response['data'] = "success";
        $response['error'] = false;
        $response['message'] = "User '" .  $value->email . "' created successfully.";
    } catch (PDOException $e) {
        $response['data'] = null;
        $response['error'] = true;
        $response['message'] = "An error occurred, try again." . $e->getMessage();
    }
    echo json_encode($response);
}


function getUserByUSer()
{
    try {
        $dbListUSer = Connection();
        // $sqlListUSer = "SELECT * FROM `gr_users` where deleted = '0'";
        $sqlListUSer = "SELECT t1.* , t2.id_organization, t2.organization FROM gr_users t1 INNER JOIN gr_organizations t2 ON t1.id_organization = t2.id_organization where t1.deleted = 0 ORDER by t1.name, t1.id_organization DESC

        ";

        
        $stmtListUSer     = $dbListUSer->query($sqlListUSer);
        $rsListUSer      =  $stmtListUSer->fetchAll();
        if (count($rsListUSer) > 0) {
        }

        $dbListUSer = null;
        $response = array();
        $response['data'] = $rsListUSer[0];
        $response['error'] = false;
        $response['message'] = "Get users for admin.";
    } catch (PDOException $e) {
        $response['data'] = null;
        $response['error'] = true;
        $response['message'] = "An error occurred, try again.";
    }
    echo json_encode($response);
}



function updateOrganization($json)
{
    $dbUpdateOrg = Connection();
    $sqlU = "UPDATE `gr_organizations` SET 
    `contact_email`=:contact_email,
    `contact_name`=:contact_name,
    `web_site`=:web_site,
    `phone_number`=:phone_number,
    `tax_number`=:tax_number 
    WHERE
         `gr_organizations`.`id_organization` = :orgid ";

    try {
        $response = array();

        $stmt = $dbUpdateOrg->prepare($sqlU);
        // $stmt->bindValue("orgName",   $json->summaryOrg->orgName);
        $stmt->bindValue("contact_email",   $json->summaryOrg->contactEmail);
        $stmt->bindValue("contact_name",  $json->summaryOrg->contactName);
        $stmt->bindValue("web_site", $json->summaryOrg->orgWesite);
        $stmt->bindValue("phone_number", $json->summaryOrg->phoneNumber);
        $stmt->bindValue("tax_number", $json->summaryOrg->taxNumber);
        $stmt->bindValue("orgid",   $json->summaryOrg->orgid);

        $stmt->execute();
        // $id = $db->lastInsertId();
        // $lastInsertId = $id > 0 ? $id : 0;
        $dbUpdateOrg = null;
        $response['data'] = "success";
        $response['error'] = false;
        $response['message'] = "We updated the " . $json->summaryOrg->orgName . " organization for you!";
        // $response['message'] = $rs;
    } catch (PDOException $e) {
        $response['data'] = null;
        $response['error'] = true;
        $response['message'] = "An error occurred, try again." . $e->getMessage();
    }
    echo json_encode($response);
}

function callAPIAuth($method, $url, $data)
{
    $curl = curl_init();
    switch ($method) {
        case "POST":
            curl_setopt($curl, CURLOPT_POST, 1);
            if ($data)
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            break;
        case "PUT":
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
            if ($data)
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            break;
        default:
            if ($data)
                $url = sprintf("%s?%s", $url, http_build_query($data));
    }
    // OPTIONS:
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Authorization: Bearer 6f5224025b67c2f3da413a6762f5d885ff698302'
    ));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    // EXECUTE:
    $result = curl_exec($curl);
    if (!$result) {
        die("Connection Failure");
    }
    curl_close($curl);
    return $result;
}


function callAPI($method, $url, $data)
{
    $curl = curl_init();
    switch ($method) {
        case "POST":
            curl_setopt($curl, CURLOPT_POST, 1);
            if ($data)
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            break;
        case "PUT":
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
            if ($data)
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            break;
        default:
            if ($data)
                $url = sprintf("%s?%s", $url, http_build_query($data));
    }
    // OPTIONS:
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
    ));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    // EXECUTE:
    $result = curl_exec($curl);
    if (!$result) {
        die("Connection Failure");
    }
    curl_close($curl);
    return $result;
}

function test($json)
{

    try {

        $response = array();
        $response['data'] = "success";
        $response['error'] = false;
        $response['message'] = $json;
    } catch (PDOException $e) {
        $response['data'] = null;
        $response['error'] = true;
        $response['message'] = "An error occurred, try again.";
    }
    echo json_encode($response);
}


function saveOrganization($organization, $secret_key, $contact_email, $contact_name, $web_site, $phone_number, $tax_number, $json)
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
        $dbsaveorg = Connection();
        $response = array();
        $log = array();
        $stmt = $dbsaveorg->prepare($sql);
        $stmt->bindValue("organization",  $organization);
        $stmt->bindValue("secret_key", $secret_key);
        $stmt->bindValue("contact_email", $contact_email);
        $stmt->bindValue("contact_name", $contact_name);
        $stmt->bindValue("web_site", $web_site);
        $stmt->bindValue("phone_number", $phone_number);
        $stmt->bindValue("tax_number", $tax_number);
        $stmt->execute();
        $id = $dbsaveorg->lastInsertId();
        $lastInsertId = $id > 0 ? $id : 0;
        $db = null;


        $idGruoup = createGroup($organization, $lastInsertId);
        // $arrayLength = count($json->usersOrg);
        // for ($i = 0; $i < $arrayLength; $i++) {
        $log[1] = createUser($json->usersOrg[0], $lastInsertId, $idGruoup);
        $log[2] = createUser($json->usersOrg[1], $lastInsertId, $idGruoup);
        $log[3] = createUser($json->usersOrg[2], $lastInsertId, $idGruoup);
        $log[4] = createUser($json->usersOrg[3], $lastInsertId, $idGruoup);






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

function addUserToGroup($idGroupCreated, $log, $nameUser)
{
    $sql = "INSERT INTO `gr_options`
    (type,
    v1,
    v2,
    v3,
    v4,
    v5
    )
    VALUES
    (:group,
    :organization,
    :idUser,
    0,
    0,
    0
  ),
  (:lview,
    :organization,
    :idUser,
    0,
    0,
    0
  ),
  (:profile,
    :name,
    :nameUser,
    :idUser,
    0,
    0
  ),
  (:profile,
  :status,
    :offline,
    :idUser,
    0,
    0
  )
  ";
    try {


        $dbadduser = Connection();
        $response = array();
        $stmt = $dbadduser->prepare($sql);
        $stmt->bindValue("profile",             "profile");
        $stmt->bindValue("name",             "name");
        $stmt->bindValue("status",             "status");
        $stmt->bindValue("offline",             "offline");
        $stmt->bindValue("group",             "gruser");
        $stmt->bindValue("lview",             "lview");
        $stmt->bindValue("organization",       $idGroupCreated);
        $stmt->bindValue("nameUser",       $nameUser);
        $stmt->bindValue("idUser",       $log);
        $stmt->execute();
        $id = $dbadduser->lastInsertId();
        $lastInsertId = $id > 0 ? $id : 0;
        $dbadduser = null;
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
    // echo json_encode($response);
}


function createGroup($organization, $idOrg)
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
    :default,
    :idOrg


  )";
    try {
        $dbsavegroup = Connection();
        $response = array();
        $stmt = $dbsavegroup->prepare($sql);
        $stmt->bindValue("group",             "group");
        $stmt->bindValue("organization",       $organization);
        $stmt->bindValue("default",       "default");
        $stmt->bindValue("idOrg",       $idOrg);
        $stmt->execute();
        $id = $dbsavegroup->lastInsertId();
        $lastInsertId = $id > 0 ? $id : 0;
        $dbsavegroup = null;
        $response = $lastInsertId;

        return $lastInsertId;
        // $response['error'] = false;
        // $response['message'] = "Group created succesfully";
    } catch (PDOException $e) {
        $response['data'] = null;
        $response['error'] = true;
        $response['message'] = "An error occurred, try again." . $e->getMessage();
    }
    // echo json_encode($response);
    // return json_encode($response);
}


function createUser($value, $org, $idGruoup)
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
    status,
    deleted
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
    0)";
    try {
        $dbCreateUser = Connection();
        $roleOrg = "";
        if ($value->role === "OrgAdmin") {
            $roleOrg = "3";
        }

        if ($value->role === "OrgApproval") {
            $roleOrg = "5";
        }

        $p = en($value->password);
        $response = array();
        $stmt = $dbCreateUser->prepare($sql);
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
        $id = $dbCreateUser->lastInsertId();
        $lastInsertId = $id > 0 ? $id : 0;
        $dbCreateUser = null;
        // -----------------------
        getSMSTest($value->phoneNumber, "signuplink");
        addUserToGroup($idGruoup, $lastInsertId, $value->contactName);

        $response =  $lastInsertId;
    } catch (PDOException $e) {
        $response['data'] = null;
        $response['error'] = true;
        $response['message'] = "An error occurred, try again." . $e->getMessage();
    }
    // echo json_encode($response);
    // return json_encode($response);
}


// function sendSMS(phone){
//     var getData = $.ajax({
//         url: 'https://qow7oum5sd.execute-api.us-east-1.amazonaws.com/dev/sendsms',
//         data: JSON.stringify( { "sms" : "", "type" : "signin" , phone : phone } ),
//         processData: false,
//         type: 'POST',
//         contentType: "application/json",
//         success: function (data) {},
//         async: false,
//         error: function(error){
//             console.log(error);
//             $.loadingBlockHide();
//         }
//     }).responseText;
//     return JSON.parse(getData);
// }

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
