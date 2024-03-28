<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require __DIR__.'/../../vendor/autoload.php';
require __DIR__.'/../../Config/Mail.php';

class EmailServices
{
    private string $email;
    private int $token;

    public function __construct(string $email, int $token)
    {
        $this->email = $email;
        $this->token = $token;
    }

    private function logError(Exception $e)
    {
        $errorLog = date("Y-m-d H:i:s") . " - Error: " . $e->getMessage() . " - File: " . $e->getFile() . " - Line: " . $e->getLine() . PHP_EOL;
        $logFile = __DIR__.'/../errors.log'; 
        file_put_contents($logFile, $errorLog, FILE_APPEND);
    }

    private function sendMail(string $subject, string $mailContent)
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
            $phpmailer->Subject = $subject;
            $phpmailer->Body = $mailContent;
            $phpmailer->send();
        } catch (Exception $e) {
            $this->logError($e);
            throw new Exception("Email sending failed: " . $e->getMessage());
        }
    }

    public function sendEmail()
    {
        $subject = "Verify your Email";
        $mailContent = "<h1>Verify your Email</h1><a href='http://localhost/student_management_system/checkMail.php?token={$this->token}&email={$this->email}'>Click here</a>";
        $this->sendMail($subject, $mailContent);
    }

    public function forgotPassword()
    {
        $subject = "Forgot Password";
        $mailContent = "<h1>Forgot Password</h1><a href='http://localhost/student_management_system/Views/Auth/forgotpasswordcheckmail.php?token={$this->token}'>Click here</a>";
        $this->sendMail($subject, $mailContent);
    }

    public function adminApproval()
    {
        $subject = "New User Registration";
        $mailContent = "<h1>New User Registration</h1><p>Email: {$this->email}</p><a href='http://localhost/student_management_system/index.php'>Click to login</a>";
        $this->sendMail($subject, $mailContent);
    }

    public function approvalEmail()
    {
        $subject = "Approval Email";
        $mailContent = "<h1>Approval Email</h1><p>Now you can login into the system</p><p>Email: {$this->email}</p><a href='http://localhost/student_management_system/index.php'>Click to login</a>";
        $this->sendMail($subject, $mailContent);
    }
}
