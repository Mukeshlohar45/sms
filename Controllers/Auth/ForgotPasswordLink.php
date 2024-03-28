<?php

require __DIR__."/../../Services/ConnectionServices.php";
require __DIR__."/../../Services/MailServices.php";

try {
    $email = $_POST['email'];
    $db = new Database();
    $conn = $db->getconnect();

    if ($conn) {
        $q = "SELECT email, sid FROM login_infos WHERE email = '$email'";
        $res = $conn->query($q);

        if ($res) {
            if ($res->num_rows == 1) {
                $data = $res->fetch_assoc();
                $sid = $data['sid'];
                $token = bin2hex(random_bytes(12));
                $storeEmail = "INSERT INTO `varified_emails`(`email`, `token`, `sid`) VALUES ('$email', '$token', $sid)";
                $storeResult = $conn->query($storeEmail);

                $emailServices = new EmailServices($email, $token);
                $emailServices->forgotPassword();
                header("Location: ../../Views/Auth/newPassword.php");
            }
        } else {
            throw new Exception("Error executing database query");
        }
    } else {
        throw new Exception("Failed to connect to the database");
    }
} catch (Exception $e) {
    $error_log = date("Y-m-d H:i:s") . " - " . "Error: " . $e->getMessage() . " - File: " . basename(__FILE__) . PHP_EOL;
    $log_file = "../../errors.log"; 
    file_put_contents($log_file, $error_log, FILE_APPEND);

    echo "Error: " . $e->getMessage();
} finally {
    if (isset($conn)) {
        $conn->close();
    }
}
?>
