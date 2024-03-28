<?php
require __DIR__."/../../Services/ConnectionServices.php";

try {
    $obj = new Database();
    $conn = $obj->getconnect();
    $id = $_GET['id'];
    $value = $_GET['value'];

    if ($conn) {
        $q = "UPDATE `registration_infos` SET `status`='$value' WHERE id = $id";
        $res = mysqli_query($conn, $q);

        if ($res) {  
            $response["msg"] = "data is updated";
            $response["status"] = "200";
            $json_response = json_encode($response);
            echo $json_response;
        } else {
            $response["msg"] = "data not found";
            $response["status"] = "100";
            $json_response = json_encode($response);
            echo $json_response;
        }
    } else {
        throw new Exception("Failed to connect to the database.");
    }
} catch (Exception $e) {
    $response["status"] = 500;
    $response["msg"] = "Server error: " . $e->getMessage();
    $res = json_encode($response);
    echo $res;

    $error_log = date("Y-m-d H:i:s") . " - " . $e->getMessage() . " - " . basename(__FILE__) . PHP_EOL;
    $log_file = "errors.log"; 
    file_put_contents($log_file, $error_log, FILE_APPEND);
} finally {
    if ($conn) {
        mysqli_close($conn);
    }
}
?>
