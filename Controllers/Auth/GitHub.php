<?php

require_once __DIR__ . '/../../Config/Mail.php';
require_once __DIR__ . '/../../Services/ConnectionServices.php';
require_once __DIR__ . '/../../vendor/autoload.php';

session_start();

use League\OAuth2\Client\Provider\Exception\IdentityProviderException;

$_SESSION['oauth2state'] = $options['state'];

if (!isset($_GET['code'])) {
    $_SESSION['oauth2state'] = $provider->getState();
    header('Location: ' . $authUrl);
    exit;
} elseif (empty($_GET['state']) || ($_GET['state'] !== $_SESSION['oauth2state'])) {
    unset($_SESSION['oauth2state']);
    exit('Invalid state');
} else {
    try {
        $token = $provider->getAccessToken('authorization_code', [
            'code' => $_GET['code']
        ]);

        $_SESSION['token'] = $token;

        $github_user = $provider->getResourceOwner($token);
        $user_info = $github_user->toArray();
        $_SESSION['user_info'] = $user_info;

        $email = $user_info['email'];
        $date = date("Y-m-d h:i:s:a");
        $target_dir = "./../../Public/uploads/";
        
        $profile_image_url = $user_info['avatar_url'];
        $profile_image_data = file_get_contents($profile_image_url);
        // echo $profile_image_data;
        $timestamp = time();
        $file_extension = pathinfo($profile_image_url, PATHINFO_EXTENSION);
        $file_name_with_timestamp = $timestamp . '_profile.' . $file_extension;

        $save_path = $target_dir . $file_name_with_timestamp;
        $save_result = file_put_contents($save_path, $profile_image_data);
        // if ($save_result === false) {
        //     exit('profile image is  not saved.');
        // }
        echo $save_result;

        $db = (new Database())->getconnect();

        $check_query = "SELECT * FROM login_infos WHERE email = '$email'";
        $res = $db->query($check_query);

        if ($res) {
            // if email exists
            if ($res->num_rows > 0) {
                $row = $res->fetch_assoc();
                $_SESSION['role'] = 'student';
                $_SESSION['id'] = $row['sid'];
                $_SESSION["username"] = $row['username'];

                $update_query = "UPDATE registration_infos SET firstname = '{$user_info['name']}', profile = '$file_name_with_timestamp' WHERE id = {$row['sid']}";
                $update_res = $db->query($update_query);

                if ($update_res) {
                    header('Location: ../../Views/Student/studentinfo.php');
                    exit;
                } else {
                    echo "Error updating user info";
                }
            } else {
                $firstname = $user_info['name'];
                $username = $user_info['login'];
                $sid = 0;

                $insert_query = "INSERT INTO `registration_infos`(`firstname`, `profile`) VALUES ('$firstname', '$file_name_with_timestamp')";
                $insert_res = $db->query($insert_query);

                $_SESSION['role'] = 'student';

                if ($insert_res) {
                    $sid = $db->insert_id;

                    $login_query = "INSERT INTO `login_infos`(`username`, `email`, `sid`) VALUES ('$username','$email',$sid)";
                    $login_res = $db->query($login_query);

                    if ($login_res) {
                        $_SESSION['id'] = $sid;
                        header('Location: ../../Views/Student/studentinfo.php');
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
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
