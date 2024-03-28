<?php
require __DIR__ . '/../../Config/Mail.php';
require __DIR__ . '/../../Services/ConnectionServices.php'; 
require __DIR__ . '/../../vendor/autoload.php'; 
session_start();

use Google\Service\AIPlatformNotebooks\Location;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;

$_SESSION['oauth2state']=$options['state'];

if (!isset($_GET['code'])) {
    $_SESSION['oauth2state'] = $provider->getState();
    header('Location: '.$authUrl);
    exit;

} elseif (empty($_GET['state']) || ($_GET['state'] !== $_SESSION['oauth2state'])) {

    unset($_SESSION['oauth2state']);
    exit('Invalid state');

} else {

    $token = $provider->getAccessToken('authorization_code', [
        'code' => $_GET['code']  
    ]);
    // if (isset($token['error'])) {
    //     header('Location: ../index.php');
    //     exit;
    // }
    try {
        $user = $provider->getResourceOwner($token);
        print_r($user->toArray());
    } catch (Exception $e) {

        // Failed to get user details
        exit('failed to get user details');
    }

    // Use this to interact with an API on the users behalf
    echo $token->getToken();
}
?>
