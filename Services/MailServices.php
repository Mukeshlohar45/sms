<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__.'../../vendor/autoload.php';
require __DIR__.'../../Config/Mail.php';

class EmailServices
{
    public function __construct(private $email, private $token = 1)
    {
    }

    private function logError($errorMessage, $errorLine, $fileName)
    {
        $errorLog = date("Y-m-d H:i:s") . " - Error: " . $errorMessage . " - File: " . $fileName . " - Line: " . $errorLine . PHP_EOL;
        $logFile = __DIR__.'/../errors.log'; 
        file_put_contents($logFile, $errorLog, FILE_APPEND);
    }

    public function sendEmail()
    {
        try {
            $phpmailer = new PHPMailer();
            $phpmailer->isSMTP();
            $phpmailer->Host = Host;
            $phpmailer->SMTPAuth = SMTPAuth;
            $phpmailer->Port = Port;
            $phpmailer->Username = Username;
            $phpmailer->Password = Password;
            $phpmailer->setFrom(Username);
            $phpmailer->addAddress($this->email);
            $phpmailer->isHTML(isHTML);
            $phpmailer->Subject = Subject;
            $mailContent = "<h1>Verify your Email</h1>
                            <a href='http://localhost/student_management_system/checkMail.php?token=$this->token&email=$this->email'>Click here</a>";
            $phpmailer->Body = $mailContent;
            $phpmailer->send();
        } catch (Exception $e) {
            $this->logError($e->getMessage(), $e->getLine(), $e->getFile());
            throw new Exception("Email sending failed: " . $e->getMessage());
        }
    }

    public function forgotPassword()
    {
        try {
            $phpmailer = new PHPMailer();
            $phpmailer->isSMTP();
            $phpmailer->Host = Host;
            $phpmailer->SMTPAuth = SMTPAuth;
            $phpmailer->Port = Port;
            $phpmailer->Username = Username;
            $phpmailer->Password = Password;
            $phpmailer->setFrom(Username);
            $phpmailer->addAddress($this->email);
            $phpmailer->isHTML(isHTML);
            $phpmailer->Subject = Subject;
            $mailContent = "<h1>Verify your Email</h1>
                            <a href='http://localhost/student_management_system/Views/Auth/forgotpasswordcheckmail.php?token=$this->token'>Click here</a>";
            $phpmailer->Body = $mailContent;
            $phpmailer->send();
        } catch (Exception $e) {
            $this->logError($e->getMessage(), $e->getLine(), $e->getFile());
            throw new Exception("Email sending failed: " . $e->getMessage());
        }
    }

    public function adminApprovel()
    {
        try {
            $phpmailer = new PHPMailer();
            $phpmailer->isSMTP();
            $phpmailer->Host = Host;
            $phpmailer->SMTPAuth = SMTPAuth;
            $phpmailer->Port = Port;
            $phpmailer->Username = Username;
            $phpmailer->Password = Password;
            $phpmailer->setFrom(Username);
            $phpmailer->addAddress(adminemail);
            $phpmailer->isHTML(isHTML);
            $phpmailer->Subject = Subject;
            $mailContent = "<h1>Verify your Email</h1>
                            <p>New user registration</p>
                            <p>Email: $this->email</p>
                            <a href='http://localhost/student_management_system/index.php'>Click to login</a>";
            $phpmailer->Body = $mailContent;
            $phpmailer->send();        } catch (Exception $e) {
            $this->logError($e->getMessage(), $e->getLine(), $e->getFile());
            throw new Exception("Email sending failed: " . $e->getMessage());
        }
    }

    public function approvelEmail()
    {
        try {
            $phpmailer = new PHPMailer();
            $phpmailer->isSMTP();
            $phpmailer->Host = Host;
            $phpmailer->SMTPAuth = SMTPAuth;
            $phpmailer->Port = Port;
            $phpmailer->Username = Username;
            $phpmailer->Password = Password;
            $phpmailer->setFrom(Username);
            $phpmailer->addAddress($this->email);
            $phpmailer->isHTML(isHTML);
            $phpmailer->Subject = Subject;
            $mailContent = "<h1>Approval Email</h1>
                            <p>Now you can login into system</p>
                            <p>Email: $this->email</p>
                            <a href='http://localhost/student_management_system/index.php'>Click to login</a>";
            $phpmailer->Body = $mailContent;
            $phpmailer->send();
        } catch (Exception $e) {
            $this->logError($e->getMessage(), $e->getLine(), $e->getFile());
            throw new Exception("Email sending failed: " . $e->getMessage());
        }
    }
}
