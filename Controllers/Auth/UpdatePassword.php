<?php 
require __DIR__."../../../Services/ConnectionServices.php";

try {
    $id = $_GET['id'];
    $newpassword = $_POST['newpassword'];
    $confirmpassword = $_POST['confirmpassword'];

    if ($newpassword != $confirmpassword) {
        throw new Exception("Password and confirm password do not match");
    }

    $db = new Database();
    $conn = $db->getconnect();

    if (!$conn) {
        throw new Exception("Please check your internet connection");
    }

    $enpPassword = password_hash($newpassword, PASSWORD_DEFAULT);
    $q = "UPDATE login_infos SET password = '$enpPassword' WHERE sid = $id";
    $res = $conn->query($q);

    if (!$res) {
        throw new Exception("Invalid user");
    }

    header("Location: ../../index.php");
} catch (Exception $e) {
    $error_log = date("Y-m-d H:i:s") . " - " . "Error: " . $e->getMessage() . " - File: " . basename(__FILE__) . PHP_EOL;
    $log_file = "../../errors.log"; 
    file_put_contents($log_file, $error_log, FILE_APPEND);

    echo $e->getMessage();
} finally {
    if (isset($conn)) {
        $conn->close();
    }
}
?>
