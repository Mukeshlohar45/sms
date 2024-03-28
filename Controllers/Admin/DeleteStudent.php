<?php

require __DIR__."/../../Services/ConnectionServices.php";

try {
    $obj = new Database();
    $conn = $obj->getconnect();
    $id = $_GET['id'];

    if ($conn) {
        $deleteVerifiedEmailsQuery = "DELETE FROM `varified_emails` WHERE sid = $id";
        $deleteVerifiedEmailsResult = mysqli_query($conn, $deleteVerifiedEmailsQuery);

        if ($deleteVerifiedEmailsResult) {
            $deleteLoginInfoQuery = "DELETE FROM `login_infos` WHERE sid = $id";
            $deleteLoginInfoResult = mysqli_query($conn, $deleteLoginInfoQuery);

            if ($deleteLoginInfoResult) {
                $deleteRegistrationInfoQuery = "DELETE FROM `registration_infos` WHERE id = $id";
                $deleteRegistrationInfoResult = mysqli_query($conn, $deleteRegistrationInfoQuery);

                if ($deleteRegistrationInfoResult) {
                    $response["msg"] = "data deleted";
                    $response["status"] = "200";
                    $json_response = json_encode($response);
                    echo $json_response;
                } else {
                    throw new Exception("Error deleting data from registration_infos table on line " . __LINE__);
                }
            } else {
                throw new Exception("Error deleting data from login_infos table on line " . __LINE__);
            }
        } else {
            throw new Exception("Error deleting data from varified_emails table on line " . __LINE__);
        }
    } else {
        throw new Exception("Failed to connect to the database on line " . __LINE__);
    }
} catch (Exception $e) {
    $error_log = date("Y-m-d H:i:s") . " - " . "Error: " . $e->getMessage() . " - File: " . basename(__FILE__) . " - Line: " . $e->getLine() . PHP_EOL;
    $log_file = "error/error_log.txt"; 
    file_put_contents($log_file, $error_log, FILE_APPEND);

    $response["status"] = 500;
    $response["msg"] = "Server error: " . $e->getMessage() . " (line: " . $e->getLine() . ")";
    $res = json_encode($response);
    echo $res;
} finally {
    if (isset($conn)) {
        mysqli_close($conn);
    }
}
?>
