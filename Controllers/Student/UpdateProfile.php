<?php
require __DIR__ . "/../../Services/ConnectionServices.php";

try {
    $firstname = $_POST['firstname'];
    $id = $_POST['sid'];
    $lastname = $_POST['lastname'];
    $phonenumber = $_POST['phonenumber'];
    $gender = $_POST['gender'];
    $hobby = $_POST['hobby'];
    $grade = $_POST['grade'];
    $old_image = $_POST['old_image'];
    $date = date("Y-m-d h:i:s:a");
    
    if (isset($_FILES["profile"]["name"])) {
        $file_name = basename($_FILES["profile"]["name"]);
        $timestamp = time();
        $file_name_with_timestamp = $timestamp . '_' . $file_name;
        
        $target_dir = "./../../Public/uploads/";
        $target_file = $target_dir . $file_name_with_timestamp;
        
        if (move_uploaded_file($_FILES['profile']['tmp_name'], $target_file)) {
            if (file_exists($old_image)) {
                unlink($old_image);
            }
        } else {
            throw new Exception("Error moving file to target directory");
        }
    } else {
        $file_name_with_timestamp = basename($old_image);
    }

    $mul_hobby = "";
    $xyz = new Database();
    $db = $xyz->getconnect();

    foreach ($hobby as $i) {
        $mul_hobby .= $i . ",";
    }

    $sqlq = "UPDATE `registration_infos` SET `firstname` = '$firstname', `lastname` = '$lastname', `phonenumber` = '$phonenumber', `gender` = '$gender', `hobby` = '$mul_hobby', `grade` = '$grade', profile = '$file_name_with_timestamp' WHERE id = $id";

    $res = $db->query($sqlq);
    if ($res) {
        header("Location: ../../index.php");
    } else {
        throw new Exception("Error updating data in the database: " . $db->error);
    }
} catch (Exception $e) {
    $error_log = date("Y-m-d H:i:s") . " - " . "Error: " . $e->getMessage() . " - File: " . basename(__FILE__) . PHP_EOL;
    $log_file = "../../errors.log"; 
    file_put_contents($log_file, $error_log, FILE_APPEND);

    header("Location: studentinfo.php");
}
?>
