<?php
require __DIR__ . '/../../Config/Mail.php';
require __DIR__ . '/../../Services/ConnectionServices.php'; 
session_start();

if (isset($_GET['code'])) {
    // $client = new Google_Client();
    
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    if (isset($token['error'])) {
        header('Location: ../index.php');
        exit;
    }
    $_SESSION['token'] = $token;

    $google_oauth = new Google\Service\Oauth2($client);
    $user_info = $google_oauth->userinfo->get();
    $_SESSION['user_info'] = $user_info;

    $email = $user_info['email'];
    $db = (new Database())->getconnect();
    $check_query = "SELECT * FROM login_infos WHERE email = '$email'";
    $res = $db->query($check_query);

    if ($res) {
        $row = $res->fetch_assoc(); 
        if ($res->num_rows > 0) {
            $_SESSION['role'] = 'student';
            $_SESSION['id'] = $row['sid']; 
            $_SESSION["username"] = $row['username'];
             header('Location: ../Student/studentinfo.php');
            exit;
        } else {
            $firstname = $user_info['given_name']; 
            $lastname = $user_info['family_name'];
            $username = explode("@", $email)[0]; 
            $sid = 0; 

            $insert_query = "INSERT INTO `registration_infos`(`firstname`, `lastname`) VALUES ('$firstname','$lastname')";
            $insert_res = $db->query($insert_query);

            $_SESSION['role'] = 'student';

            if ($insert_res) {
                $sid = $db->insert_id;

                $login_query = "INSERT INTO `login_infos`(`username`, `email`, `sid`) VALUES ('$username','$email',$sid)";
                $login_res = $db->query($login_query);

                if ($login_res) {
                    $_SESSION['id'] = $sid;
                    header('Location: ../Student/studentinfo.php');
                    exit;
                } else {
                    echo "Error inserting login info";
                }
            } else {
                echo "Error inserting user info";
            }
        }
    } else {
        echo "Error executing database query";
    }
}
?>
