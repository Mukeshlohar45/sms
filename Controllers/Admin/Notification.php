<?php
require __DIR__."/../../Services/ConnectionServices.php";

try {
    $obj = new Database();
    $db = $obj->getconnect();
    
    if ($db) {
        $notificationData = [];
        $q = "SELECT * FROM `notifications_infos`";
        $res = mysqli_query($db, $q);

        if ($res) {
            while ($row = $res->fetch_assoc()) {
                $notificationData[] = $row; 
            }
            $json_response = json_encode($notificationData);
            echo $json_response;
        } else {
            throw new Exception("Data not found");
        }
    } else {
        throw new Exception("Server error");
    }
} catch (Exception $e) {
    $error_log = date("Y-m-d H:i:s") . " - " . "Error: " . $e->getMessage() . " - File: " . basename(__FILE__) . PHP_EOL;
    $log_file = "../../errors.log"; 
    file_put_contents($log_file, $error_log, FILE_APPEND);

    $response["status"] = 500;
    $response["msg"] = "Error: " . $e->getMessage();
    $json_response = json_encode($response);
    echo $json_response;
}
?>
