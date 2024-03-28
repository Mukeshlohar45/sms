<?php

require __DIR__."/../../Services/ConnectionServices.php";
require '../../vendor/autoload.php';


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["recipientEmail"])) {
        $subject = $_POST["subject"];
        $message = $_POST["message"];
        $selectedEmails = $_POST["recipientEmail"]; 
        $newDb = new Database();
        $db = $newDb->getconnect();

        $emailsString = implode(',', $selectedEmails);

        $subject = $db->real_escape_string($subject);
        $message = $db->real_escape_string($message);

        $mail = new PHPMailer(true);
        
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.mailtrap.io';
            $mail->SMTPAuth = true;
            $mail->Username = '988d5f5f5b0227';
            $mail->Password = 'e5d35835a5a8bf';
            $mail->Port = 2525; 
            $mail->setFrom('admin_123@gmail.com', 'admin');

            foreach ($selectedEmails as $email) {
                $email = trim($email); 
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    throw new Exception("Invalid email address: $email");
                }
                $email = $db->real_escape_string($email);

                $mail->addAddress($email);
                $mail->Subject = $subject;
                $mail->Body    = $message;

                $mail->send();
                echo "Notification sent successfully to: $email<br>";

                $mail->clearAddresses();
            }

            $insertQuery = "INSERT INTO notifications_infos (emails, subject, message) VALUES ('$emailsString', '$subject', '$message')";
            if ($db->query($insertQuery)) {
                echo "Notification information inserted into the database successfully.";
            } else {
                throw new Exception("Failed to insert notification information into the database.");
            }

            header("Location: ../../Views/Admin/adminprofile.php");
        } catch (Exception $e) {
            $error_log = date("Y-m-d H:i:s") . " - " . "Error: " . $e->getMessage() . " - File: " . basename(__FILE__) . PHP_EOL;
            $log_file = "error/error_log.txt"; 
            file_put_contents($log_file, $error_log, FILE_APPEND);

            echo "Failed to send notification. Error: " . $e->getMessage();
        }
    } else {
        echo "No recipient email selected.";
    }
} else {
    echo "Form not submitted.";
}
?>
