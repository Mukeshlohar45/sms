<?php
require __DIR__."/../../Services/ConnectionServices.php";
require __DIR__."/../../Config/Mail.php";

try {
    $obj = new Database();
    $conn = $obj->getconnect();
    $id = $_GET['id'];
    $value = $_GET['value'];

    if ($conn) {
        $q = "UPDATE `registration_infos` SET `is_approved` = '$value' WHERE id = $id";
        $res = mysqli_query($conn, $q);

        if ($res) {
            $fechstudent = "SELECT email FROM login_infos WHERE sid = $id";
            $result = $conn->query($fechstudent);

            if ($result) {
                $data = $result->fetch_assoc();
                $email = $data['email'];
                $EmailServices = new EmailServices($email);
                $EmailServices->approvelEmail();

                $response["msg"] = "data is updated";
                $response["status"] = "200";
                $json_response = json_encode($response);
                echo $json_response;
            } else {
                throw new Exception("Error fetching student email");
            }
        } else {
            throw new Exception("Error in updating data");
        }
    } else {
        throw new Exception("Failed to connect to the database");
    }
} catch (Exception $e) {
    $error_log = date("Y-m-d H:i:s") . " - " . "Error: " . $e->getMessage() . " - File: " . basename(__FILE__) . PHP_EOL;
    $log_file = "error/error_log.txt"; 
    file_put_contents($log_file, $error_log, FILE_APPEND);

    $response["status"] = 500;
    $response["msg"] = "Server error: " . $e->getMessage();
    $res = json_encode($response);
    echo $res;
} finally {
    if (isset($conn)) {
        mysqli_close($conn);
    }
}
?>
