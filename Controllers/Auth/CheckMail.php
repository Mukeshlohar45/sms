<?php
require __DIR__."/../../Services/ConnectionServices.php";
require __DIR__."/../../Config/Mail.php";

$obj = new Database();
$conn = $obj->getconnect();
$id = $_GET['token'];
$email = $_GET['email'];

if ($conn) {
        $q = "SELECT token, sid, email FROM varified_emails WHERE email = '$email'";
        $res = mysqli_query($conn, $q);

        if ($res) {
            $data = $res->fetch_assoc();
            $token = $data['token'];
            $email = $data['email'];
            $sid = $data['sid'];
            if ($id == $token) {
                $sql = "UPDATE `registration_infos` SET `is_varified` = 'true',`status` = 'active' WHERE id = $sid";
                $result = mysqli_query($conn, $sql);
                if ($result) {
                    $deletetoken = "DELETE FROM varified_emails WHERE email = '$email'";
                    $deleteRecode = $conn->query($deletetoken);
                    $EmailServices = new EmailServices($email);
                    $EmailServices->adminApprovel();
                    header("Location: ./approval.php");     
                    
                } else {
                    $response["msg"] = "Data not found";
                    $response["status"] = "100";
                    $json_response = json_encode($response);
                    echo $json_response;
                }    
            } else {
                    $response["msg"] = "Sorry! Your link is not valid";
                    $response["status"] = "100";
                    $json_response = json_encode($response);
                    echo $json_response;
            }
          
        }
    
} else {
    $response["status"] = 500;
    $response["msg"] = "server error";
    $res = json_encode($response);
    echo $res;
}
