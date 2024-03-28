<?php
require __DIR__.'/../../vendor/autoload.php';

use League\OAuth2\Client\Provider\Github;

$github_client_id = "1dba87e35f3af168b1ea";
$github_client_secret = "f4442bc15e4b738ee6d2c2881d32b110fe6c6ef0";

$github_client = new Github([
    'clientId' => $github_client_id,
    'clientSecret' => $github_client_secret,
    'redirectUri' => 'http://localhost/student_management_system/Controllers/Auth/GitHub.php'
]);

$authorizationUrl = $github_client->getAuthorizationUrl([
    'scope' => ['user:email'],
]);

$_SESSION['oauth2state'] = $github_client->getState();

header('Location: ' . $authorizationUrl);
exit;
?>
