<?php

require __DIR__."/../../Services/ConnectionServices.php";

try {
    $obj = new Database();
    $db = $obj->getconnect();

    if ($db) {
        $q = "SELECT email FROM `login_infos` WHERE role = 'student'";
        $res = mysqli_query($db, $q);

        if ($res && mysqli_num_rows($res) > 0) {
            while ($rows = $res->fetch_assoc()) {
                $emails = $rows["email"];
                echo "<option value=\"$emails\" class=\"form-control\">$emails</option>";
            }
        } else {
            throw new Exception("No emails found");
        }
    } else {
        throw new Exception("Failed to connect to the server");
    }
} catch (Exception $e) {
    $error_log = date("Y-m-d H:i:s") . " - " . "Error: " . $e->getMessage() . " - File: " . basename(__FILE__) . PHP_EOL;
    $log_file = "error/error_log.txt"; 
    file_put_contents($log_file, $error_log, FILE_APPEND);

    echo "<option value=\"\" class=\"form-control\">Error: " . $e->getMessage() . "</option>";
}
?>
