<?php
require __DIR__.'../../vendor/autoload.php';

use League\OAuth2\Client\Provider\Github;

define('BASE_URL', 'http://localhost/student_management_system');

define("Host", "sandbox.smtp.mailtrap.io");
define("SMTPAuth", true);
define("Port", 2525);
define("Username", "988d5f5f5b0227");
define("Password", "e5d35835a5a8bf");
define("isHTML", true);
define("Subject", "Test Email For verification");
define("adminemail","admin_123@gmail.com");

$client_id = "11377482266-4ks6bfl20uqr1ugd62e6i7se6aassvan.apps.googleusercontent.com";
$client_secret = "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";

$client = new Google\Client();
$client->setClientId($client_id);
$client->setClientSecret($client_secret);

$redirect_uri = 'http://localhost/student_management_system/Views/Auth/googlelogin.php';
$client->setRedirectUri($redirect_uri);
$client->addScope("email");
$client->addScope("profile");


$provider = new League\OAuth2\Client\Provider\Github([
    'clientId'          => '1dba87e35f3af168b1ea',
    'clientSecret'      => 'f4442bc15e4b738ee6d2c2881d32b110fe6c6ef0',
    'redirectUri'       => 'http://localhost/student_management_system/Controllers/Auth/GitHub.php',
]);

$options = [
    'state' => 'OPTIONAL_CUSTOM_CONFIGURED_STATE',
    'scope' => ['user','user:email','repo'] // array or string; at least 'user:email' is required
  ];


?>