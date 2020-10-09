<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
// ini_set('display_errors', '1');
// ini_set('display_startup_errors', '1');
// error_reporting(E_ALL);
require "../../key/Connection.php";


if ($_REQUEST) {
    $getVar = $_GET['smsvalidations'];

    initValidations($getVar);
}

function initValidations($getVar)
{
    $db          = Connection();
    $sql = "SELECT * FROM `gr_history_sms` WHERE `link` = '$getVar' and `used` = 99 and ( CURRENT_TIMESTAMP() BETWEEN `init_date` AND `finish_date` )";
    $stmt     = $db->query($sql);
    $rs       =  $stmt->fetchAll();


    if (count($rs) > 0) {

        $response = array();
        $db = null;
        $response['data'] = "success";
        $response['error'] = false;
        $response['message'] = "Continue...";
        $db2BetweenTime          = Connection();
        updateLink($rs[0]["link"], $db2BetweenTime);
        header("Location: http://ec2-54-208-211-67.compute-1.amazonaws.com/php-medical-app/signin");

        echo json_encode($response);
        return;
    }

    $sqlP2 = "SELECT * FROM `gr_history_sms` WHERE `link` = '$getVar' and `used` = 99 ";
    $stmtP2     = $db->query($sqlP2);
    $rsP2       =  $stmtP2->fetchAll();

    if (count($rsP2) > 0) {
        $responseOther = array();
        $db = null;
        $responseOther['data'] = "success";
        $responseOther['error'] = false;
        $responseOther['message'] = $rsP2[0]["phone_number"];
?>console.log("step 1")<?php
                                // $db3          = Connection();
                                // updateLink($rs[0]["link"], $db3);
                                ?>console.log("step 2")<?php
                                $db2          = Connection();

                                getSMSTestAndUpdate($rsP2[0]["phone_number"],  $db2, "signuplink", $rsP2[0]["id"]);
                                ?>console.log("step 3")<?php
                                // header("Location:http://ec2-54-208-211-67.compute-1.amazonaws.com/php-medical-app/expired");
                                echo json_encode($responseOther);
                                return;
                            } else {
                                $db = null;
                                header("Location: http://ec2-54-208-211-67.compute-1.amazonaws.com/php-medical-app/expired");
                                return;
                            }
                        }
                        function updateLinkWithId($idtoU, $dbsqlUpdateLink)
                        {
                            try {
                                // UPDATE `gr_history_sms` SET `used` = '1' WHERE `gr_history_sms`.`id` = 14;
                                ?>console.log("step update")<?php
                                    $responseUpdateLink = array();
                                    $sqlUpdateLink = "UPDATE `gr_history_sms` SET `used` = '80' WHERE `id` = :id";

                                    $stmtdbsqlUpdateLink = $dbsqlUpdateLink->prepare($sqlUpdateLink);
                                    $stmtdbsqlUpdateLink->bindValue("id", $idtoU);
                                    // $stmt->bindValue("phone", $phone);
                                    $stmtdbsqlUpdateLink->execute();
                                    // $id = $db->lastInsertId();
                                    // $lastInsertId = $id > 0 ? $id : 0;

                                    $dbsqlUpdateLink = null;
                                    // $dbsqlUpdateLink->close();
                                    // sendSMSTest($phone, $responseBitLy["link"], $typeSMS);


                                    // $response =  $lastInsertId;
                                    $responseUpdateLink['data'] = "success";
                                    $responseUpdateLink['error'] = false;
                                    $responseUpdateLink['message'] = "update";
                                    // $response['message'] =  $stringArray;
                                } catch (PDOException $e) {
                                    $responseUpdateLink['data'] = null;
                                    $responseUpdateLink['error'] = true;
                                    $responseUpdateLink['message'] = "An error occurred, try again." . $e->getMessage();
                                }
                                // echo json_encode($response);
                                // return json_encode($response);
                            }

                            function updateLink($link, $dbsqlUpdateLink)
                            {
                                try {
                                    // UPDATE `gr_history_sms` SET `used` = '1' WHERE `gr_history_sms`.`id` = 14;
                                    ?>console.log("step update")<?php
                                    $responseUpdateLink = array();
                                    $sqlUpdateLink = "UPDATE `gr_history_sms` SET `used` = '80' WHERE `link` = :link";

                                    $stmtdbsqlUpdateLink = $dbsqlUpdateLink->prepare($sqlUpdateLink);
                                    $stmtdbsqlUpdateLink->bindValue("link", $link);
                                    // $stmt->bindValue("phone", $phone);
                                    $stmtdbsqlUpdateLink->execute();
                                    // $id = $db->lastInsertId();
                                    // $lastInsertId = $id > 0 ? $id : 0;

                                    $dbsqlUpdateLink = null;
                                    // sendSMSTest($phone, $responseBitLy["link"], $typeSMS);


                                    // $response =  $lastInsertId;
                                    $responseUpdateLink['data'] = "success";
                                    $responseUpdateLink['error'] = false;
                                    $responseUpdateLink['message'] = "update";
                                    // $response['message'] =  $stringArray;
                                } catch (PDOException $e) {
                                    $responseUpdateLink['data'] = null;
                                    $responseUpdateLink['error'] = true;
                                    $responseUpdateLink['message'] = "An error occurred, try again." . $e->getMessage();
                                }
                                // echo json_encode($response);
                                // return json_encode($response);
                            }


                            function getSMSTestAndUpdate($phone, $db, $typeSMS, $idToUpdate)
                            {
                                try {


                                    $a = ['a', 'b', 'c', 'd', 'e', 'f', 'g', "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z", "0", "1", "2", "3", "4", "5", "6", "7", "8", "9"];
                                    $n = 8;
                                    $responseUpdate = array();
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


                                    $sqlMin = "SELECT CURRENT_TIMESTAMP() + INTERVAL 1 MINUTE as timeCur";

                                    $stmt1Update     = $db->query($sqlMin);
                                    $rs1       =  $stmt1Update->fetchAll();
                                    $timeCur = $rs1[0]["timeCur"];
                                    $refUse1 = "99";

                                    ?>console.log("step 4")<?php


                                    $sqlUpdate = "INSERT INTO `gr_history_sms`
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

                                    $stmtUpdate = $db->prepare($sqlUpdate);
                                    $stmtUpdate->bindValue("generatelink", $stringArray);
                                    $stmtUpdate->bindValue("timeproperly", $timeCur);
                                    $stmtUpdate->bindValue("refUse1", $refUse1);
                                    $stmtUpdate->bindValue("phone", $phone);
                                    $stmtUpdate->execute();
                                    // $id = $db->lastInsertId();
                                    // $lastInsertId = $id > 0 ? $id : 0;

                                    $db = null;
                                    sendSMSTest($phone, $responseBitLy["link"], $typeSMS);




                                    sleep(1);
                                    $db3 = Connection();
                                    updateLinkWithId($idToUpdate, $db3);


                                    // $response =  $lastInsertId;
                                    $responseUpdate['data'] = "success";
                                    $responseUpdate['error'] = false;
                                    $responseUpdate['message'] = $refUse1 . " " . $sqlUpdate;
                                    // $response['message'] =  $stringArray;
                                } catch (PDOException $e) {
                                    $responseUpdate['data'] = null;
                                    $responseUpdate['error'] = true;
                                    $responseUpdate['message'] = "An error occurred, try again." . $e->getMessage();
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
