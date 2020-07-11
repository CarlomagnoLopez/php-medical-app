<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
// ini_set('display_errors', '1');
// ini_set('display_startup_errors', '1');
// error_reporting(E_ALL);
require "../../key/Connection.php";

$db          = Connection();
$json = json_decode(file_get_contents("php://input"));
// $method = $json->method;
// switch ($method) {
    
//     case 'saveOrganizationtest':
//         // sleep(3000);
//        test();
//     break;
//     case 'saveOrganization':
//         $organization = $json->summaryOrg->orgName;
//         $secret_key   = $json->summaryOrg->orgName;
//         $contact_email   = $json->summaryOrg->contactEmail;
//         $contact_name   = $json->summaryOrg->contactName;
//         $web_site   = $json->summaryOrg->orgWesite;
//         $phone_number   = $json->summaryOrg->phoneNumber;
//         $tax_number   = $json->summaryOrg->taxNumber;
//         saveOrganization($db, $organization, $secret_key, $contact_email, $contact_name, $web_site, $phone_number, $tax_number, $json);

//         break;
// }





// function saveOrganization($db, $organization, $secret_key, $contact_email, $contact_name, $web_site, $phone_number, $tax_number, $json)
// {
    $sql = "SELECT `id_organization`, `organization` as orgname, `secret_key` as secretcode, `contact_email` as contactEmail, `contact_name` as contactName, `phone_number` as phoneNumber, `tax_number` as taxNumber FROM `gr_organizations` WHERE 1";
    try {
        $response = array();
        // $log = array();
        $stmt = $db->prepare($sql);
        // $stmt->bindValue("organization",  $organization);
        // $stmt->bindValue("secret_key", $secret_key);
        // $stmt->bindValue("contact_email", $contact_email);
        // $stmt->bindValue("contact_name", $contact_name);
        // $stmt->bindValue("web_site", $web_site);
        // $stmt->bindValue("phone_number", $phone_number);
        // $stmt->bindValue("tax_number", $tax_number);
        $stmt->execute();
        $stmt = $db->query($sql); 
        $rs   =  $stmt->fetchAll();
        // $id = $db->lastInsertId();
        // $lastInsertId = $id > 0 ? $id : 0;

        // $idGruoup = createGroup($db, $organization, $lastInsertId);
        // // $arrayLength = count($json->usersOrg);
        // // for ($i = 0; $i < $arrayLength; $i++) {
        // $log[1] = createUser($db, $json->usersOrg[0], $lastInsertId, $idGruoup);
        // $log[2] = createUser($db, $json->usersOrg[1], $lastInsertId, $idGruoup);
        // $log[3] = createUser($db, $json->usersOrg[2], $lastInsertId, $idGruoup);
        // $log[4] = createUser($db, $json->usersOrg[3], $lastInsertId, $idGruoup);

        
        $totalRows  = count($rs);
        $results = "nodata";
        if($totalRows > 0){
            $results = "data";
            $data = $totalRows;
        }


// contactEmail: "jallumalla@cogentibs.com" // contact_email:""
// contactName: "Jayanth"                   // contact_name:""
// disable: false
// faxNumber: "12587412368"
// orgname: "Jayanth test"                  // organization:"Jayanth Test"
// phoneNumber: "+12485318731"              // phone_number:""
// secretcode: "5ae-3"                      // secret_key:"5ae-3"
// taxNumber: "20147896"                    // tax_number:""
// website: "www.cogentibs.com"             // web_site:""

// logo: "https://medicalprojectlogos.s3.amazonaws.com/Jayanthtest.jpeg"
// mcp-1-pk: "mcp-org-19b6f5ae-36bd-4664-9266-d43d491df1eb"
// mcp-1-sk: "org-19b6f5ae-36bd-4664-9266-d43d491df1eb"

// id_organization:"2"










        $db = null; 
        $response['data'] = $rs;
        $response['error'] = false;
        $response['message'] = $results;
    } catch (PDOException $e) {
        $response['data'] = null;
        $response['error'] = true;
        $response['message'] = "An error occurred, try again." . $e->getMessage();
    }
    echo json_encode($response);
// }

