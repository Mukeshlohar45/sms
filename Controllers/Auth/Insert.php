<?php

require __DIR__."../../../Services/ConnectionServices.php";
require __DIR__."../../../Services/MailServices.php";

try {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $phonenumber = $_POST['phonenumber'];
    $gender = $_POST['gender'];
    $hobby = $_POST['hobby'];
    $message = $_POST['message'];
    $grade = $_POST['grade'];
    $mul_hobby = "";
    $ency_pass = password_hash($password, PASSWORD_DEFAULT);
    $xyz = new Database();
    $db = $xyz->getconnect();
    $atr = explode("@", $email);
    $username = $atr[0];
    $date = date("Y-m-d h:i:s:a");
    $target_dir = "./../../Public/uploads/";
    $file_name = basename($_FILES["profile"]["name"]);
    $timestamp = time();
    $file_name_with_timestamp = $timestamp . '_' . $file_name;
    $target_file = $target_dir . $file_name_with_timestamp;

    $imageFileType = strtolower(pathinfo($file_name_with_timestamp, PATHINFO_EXTENSION));
    $mimeType = mime_content_type($_FILES["profile"]["tmp_name"]);

    if (($imageFileType == "jpg" || $imageFileType == "png") && ($mimeType == "image/jpeg" || $mimeType == "image/png")) {
        if (move_uploaded_file($_FILES['profile']['tmp_name'], $target_dir . $file_name_with_timestamp)) {
            foreach ($hobby as $i) {
                $mul_hobby .= $i . ",";
            }

            $q = "INSERT INTO `registration_infos`( `firstname`, `lastname`, `phonenumber`, `gender`, `hobby`, `message`, `profile`, `grade`) VALUES ('$firstname','$lastname','$phonenumber','$gender','$mul_hobby','$message','$file_name_with_timestamp','$grade')";
            $res = $db->query($q);

            if ($res) {
                $sid = $db->insert_id;
                $loginq = "INSERT INTO `login_infos`( `username`, `email`, `password`,`sid`) VALUES ('$username','$email','$ency_pass',$sid)";
                $loginres = $db->query($loginq);

                if ($loginres) {
                    $token = bin2hex(random_bytes(12));
                    $storeEmail = "INSERT INTO `varified_emails`(`email`, `token`, `sid`) VALUES ('$email','$token',$sid)";
                    $storeResult = $db->query($storeEmail);

                    $EmailServices = new EmailServices($email, $token);
                    $EmailServices->sendEmail();
                    header("Location: ../../index.php");
                }
            } else {
                throw new Exception("Error inserting data in table");
            }
        } else {
            throw new Exception("Error moving file to target directory");
        }
    } else {
        throw new Exception("Invalid file format. Only JPEG and PNG files are allowed.");
    }
} catch (Exception $e) {
    $error_log = date("Y-m-d H:i:s") . " - " . "Error: " . $e->getMessage() . " - File: " . basename(__FILE__) . PHP_EOL;
    $log_file = "/../../errors.log"; 
    file_put_contents($log_file, $error_log, FILE_APPEND);

    echo "Error: " . $e->getMessage();
} finally {
    if (isset($db)) {
        $db->close();
    }
}
?>
