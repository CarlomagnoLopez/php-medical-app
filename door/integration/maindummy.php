<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
// ini_set('display_errors', '1');
// ini_set('display_startup_errors', '1');
// error_reporting(E_ALL);
require "../../key/Connection.php";


if ($_REQUEST) {
    $getVar = $_GET['smsvalidations'];
    if ($getVar) {
        initValidations($getVar);
    }
}

function initValidations($getVar)
{
    $dbValiteS1          = Connection();
    $sqlValiteS1 = "SELECT * FROM `gr_history_sms` WHERE `link` = '$getVar' and `used` = 99 and ( CURRENT_TIMESTAMP() BETWEEN `init_date` AND `finish_date` )";
    $stmtValiteS1    = $dbValiteS1->query($sqlValiteS1);
    $rsValiteS1       =  $stmtValiteS1->fetchAll();


    if (count($rsValiteS1) > 0) {

        $responseValiteS1 = array();
        $dbValiteS1 = null;

        // $db2BetweenTime          = Connection();
        updateLink($rsValiteS1[0]["link"]);



        header("Location: http://ec2-54-208-211-67.compute-1.amazonaws.com/php-medical-app/signin");
        $responseValiteS1['data'] = "success";
        $responseValiteS1['error'] = false;
        $responseValiteS1['message'] = "Continue...";
        echo json_encode($responseValiteS1);
        return;
    }else{
        $dbValiteS1 = null;
    }


    $dbValiteS2          = Connection();
    $sqlValiteS2 = "SELECT * FROM `gr_history_sms` WHERE `link` = '$getVar' and `used` = 99 ";
    $stmtValiteS2     = $dbValiteS2->query($sqlValiteS2);
    $rsValiteS2       =  $stmtValiteS2->fetchAll();

    if (count($rsValiteS2) > 0) {
        $responsersValiteS2 = array();
        $dbValiteS2 = null;
       

        getSMSTestAndUpdate($rsValiteS2[0]["phone_number"], "signuplink", $rsValiteS2[0]["id"]);
        header("Location:http://ec2-54-208-211-67.compute-1.amazonaws.com/php-medical-app/expired");

        $responsersValiteS2['data'] = "success";
        $responsersValiteS2['error'] = false;
        $responsersValiteS2['message'] = $rsValiteS2[0]["phone_number"];
        echo json_encode($responsersValiteS2);
        return;
    } else {
        // $db = null;
        header("Location: http://ec2-54-208-211-67.compute-1.amazonaws.com/php-medical-app/expired");
        return;
    }
}
function updateLinkWithId($idtoU)
{
    try {

        $dbValiteS5          = Connection();
        $sqlValiteS5 = "UPDATE `gr_history_sms` SET `used` = '80' WHERE `id` = :idUser";

        $stmtValiteS5 = $dbValiteS5->prepare($sqlValiteS5);
        $stmtValiteS5->bindValue("idUser", $idtoU);
        $stmtValiteS5->execute();

        $dbValiteS5 = null;
    } catch (PDOException $e) {
    }
    // echo json_encode($response);
    // return json_encode($response);
}

function updateLink($link)
{
    try {

        $dbValiteS2          = Connection();
        $sqlUpdateLink = "UPDATE `gr_history_sms` SET `used` = '80' WHERE `link` = :link";

        $stmtdbsqlUpdateLink = $dbValiteS2->prepare($sqlUpdateLink);
        $stmtdbsqlUpdateLink->bindValue("link", $link);
        $stmtdbsqlUpdateLink->execute();

        $dbValiteS2 = null;

    } catch (PDOException $e) {
       
    }
    // echo json_encode($response);
    // return json_encode($response);
}


function getSMSTestAndUpdate($phone, $typeSMS, $idToUpdate)
{
    try {


        $a = ['a', 'b', 'c', 'd', 'e', 'f', 'g', "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z", "0", "1", "2", "3", "4", "5", "6", "7", "8", "9"];
        $n = 8;
        $createdArray = array_values(array_intersect_key($a, array_flip(array_rand($a, $n))));
        $stringArray = $createdArray[0] . $createdArray[1] . $createdArray[2] . $createdArray[3] . $createdArray[4] . $createdArray[5] . $createdArray[6] . $createdArray[7];
        $longLink = "http://ec2-54-208-211-67.compute-1.amazonaws.com/php-medical-app/door/integration/maindummy.php?smsvalidations=" . $stringArray;
        $data_array =  array(
            "group_guid" => "Bk9h1KBTFqy",
            "domain" => "bit.ly",
            "long_url" => $longLink
        );
        $make_call = callAPIAuth('POST', 'https://api-ssl.bitly.com/v4/shorten', json_encode($data_array));
        $responseBitLy  = json_decode($make_call, true);

        $dbValiteS3          = Connection();

        $sqlValiteS3  = "SELECT CURRENT_TIMESTAMP() + INTERVAL 1 MINUTE as timeCur";

        $stmtValiteS3     = $dbValiteS3->query($sqlValiteS3);
        $rsValiteS3      =  $stmtValiteS3->fetchAll();


        $timeCur = $rsValiteS3[0]["timeCur"];
        $dbValiteS3          = null;
        $refValiteS3 = "99";

        $dbValiteS4          = Connection();
        $sqlValiteS4 = "INSERT INTO `gr_history_sms`
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
        :generatelink, 
        current_timestamp(),
        :timeproperly,
        :refUse1,
        :phone
        );";

        $stmtValiteS4 = $dbValiteS4->prepare($sqlValiteS4);
        $stmtValiteS4->bindValue("generatelink", $stringArray);
        $stmtValiteS4->bindValue("timeproperly", $timeCur);
        $stmtValiteS4->bindValue("refUse1", $refValiteS3);
        $stmtValiteS4->bindValue("phone", $phone);
        $stmtValiteS4->execute();
        // $id = $db->lastInsertId();
        // $lastInsertId = $id > 0 ? $id : 0;

        $dbValiteS4 = null;
        sendSMSTest($phone, $responseBitLy["link"], $typeSMS);



        updateLinkWithId($idToUpdate);


    } catch (PDOException $e) {
    }
    // echo json_encode($responseUpdate);
    // return json_encode($response);
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
        $make_call = callAPI('POST', 'https://c4ymficygk.execute-api.us-east-1.amazonaws.com/dev/sendsms', json_encode($data_array));
        $response  = json_decode($make_call, true);
        $data    = $response['body']['MessageId'];
        $statusCode = $response['statusCode'];

        // $response =  $lastInsertId;
        $response['data'] = "success";
        $response['error'] = false;
        $response['message'] = "Sent SMS with tiny url";
    } catch (PDOException $e) {
        $response['data'] = null;
        $response['error'] = true;
        $response['message'] = "An error occurred, try again." . $e->getMessage();
    }
    // echo json_encode($response);
    // return json_encode($response);
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
