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
        $validationsLevel = initValidationsSteps($getVar);
    } else {
        return;
    }
    $response  = array();
    $response['data'] = null;
    $response['error'] = true;
    $response['message'] = "We can validate your link.";
    switch ($validationsLevel["level"]) {
        case 0:
            $responseSql = $validationsLevel["resposeSql"];
            updateLink($responseSql[0]["link"]);
            header("Location: https://letstrackme.com/track-it/signin");
            // header("Location: http://localhost/track-it/signin");
            $response['data'] = "success";
            $response['error'] = false;
            $response['message'] = "level 0";
            break;
        case 1:
            $responseSql = $validationsLevel["resposeSql"];
            getSMSTestAndUpdate($responseSql[0]["phone_number"], "signuplink", $responseSql[0]["id"]);
            // header("Location:http://localhost/track-it/expired");
            header("Location:https://letstrackme.com/track-it/expired");
            $response['data'] = "success";
            $response['error'] = false;
            $response['message'] = "level 1";
            break;
        case 2:
            // header("Location: http://localhost/track-it/expired");
            header("Location: https://letstrackme.com/track-it/expired");
            $response['data'] = "success";
            $response['error'] = false;
            $response['message'] = "level 2";
            break;
    }



    echo json_encode($response);
    return;
}


function initValidationsSteps($getVar)
{
    $dbValiteS1          = Connection();
    // $sqlValiteS1 = "SELECT * FROM `gr_history_sms` WHERE `link` = '$getVar' and `used` = 99 and ( CURRENT_TIMESTAMP() BETWEEN `init_date` AND `finish_date` )";
    $sqlValiteS1 = "SELECT * FROM `gr_history_sms` WHERE `link` = '$getVar' and ( CURRENT_TIMESTAMP() BETWEEN `init_date` AND `finish_date` )";
    $stmtValiteS1    = $dbValiteS1->query($sqlValiteS1);
    $rsValiteS1       =  $stmtValiteS1->fetchAll();

    $values = array();
    if (count($rsValiteS1) > 0) {
        $dbValiteS1 = null;
        $values["level"] = 0;
        $values["resposeSql"] = $rsValiteS1;

        return $values;
    }

    // $sqlValiteS2    = "SELECT * FROM `gr_history_sms` WHERE `link` = '$getVar' and `used` = 99 ";
    $sqlValiteS2    = "SELECT * FROM `gr_history_sms` WHERE `link` = '$getVar'";
    $stmtValiteS2   = $dbValiteS1->query($sqlValiteS2);
    $rsValiteS2     =  $stmtValiteS2->fetchAll();

    if (count($rsValiteS2) > 0) {
        $dbValiteS1 = null;
        $values["level"] = 1;
        $values["resposeSql"] = $rsValiteS2;

        return $values;
    } else {
        $dbValiteS1 = null;
        $values["level"] = 2;
        return $values;
    }
}


function updateLinkWithId($idtoU)
{
    try {

        $dbValiteS5          = Connection();
        $stmtValiteS5 = $dbValiteS5->exec("UPDATE gr_history_sms SET used = '80' WHERE id = '$idtoU'");
        $dbValiteS5          = null;
    } catch (PDOException $e) {
    }
}

function updateLink($link)
{
    try {

        $dbValiteS2          = Connection();
        $stmtValiteS5 = $dbValiteS2->exec("UPDATE gr_history_sms SET used = '80' WHERE link = '$link'");
        $dbValiteS2 = null;
        sleep(2);
    } catch (PDOException $e) {
    }
}


function getSMSTestAndUpdate($phone, $typeSMS, $idToUpdate)
{
    try {

        updateLinkWithId($idToUpdate);
        sleep(2);
        $a = ['a', 'b', 'c', 'd', 'e', 'f', 'g', "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z", "0", "1", "2", "3", "4", "5", "6", "7", "8", "9"];
        $n = 8;
        $createdArray = array_values(array_intersect_key($a, array_flip(array_rand($a, $n))));
        $stringArray = $createdArray[0] . $createdArray[1] . $createdArray[2] . $createdArray[3] . $createdArray[4] . $createdArray[5] . $createdArray[6] . $createdArray[7];
        $longLink = "https://letstrackme.com/track-it/door/integration/maindummy.php?smsvalidations=" . $stringArray;
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
        $data    = $response['body']['MessageId'];
        $statusCode = $response['statusCode'];
    } catch (PDOException $e) {
    }
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
