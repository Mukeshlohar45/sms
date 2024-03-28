<?php
require_once __DIR__ . "/conn.php";
$body = file_get_contents('php://input');
$data = json_decode($body, true);

$firstname = $data['firstname'];
$id = $data['id'];
$lastname = $data['lastname'];
$phonenumber = $data['phonenumber'];
$gender = $data['gender'];
$hobby = $data['hobby'];
$grade = $data['grade'];
$mul_hobby = "";
$xyz = new Database();
$db = $xyz->getconnect();


foreach ($hobby as $i) {
    $mul_hobby .= $i . ",";
}
    $q = "UPDATE `registration_infos` SET `firstname` = '$firstname', `lastname` = '$lastname', `phonenumber` = '$phonenumber', `gender` = '$gender', `hobby` = '$mul_hobby', `grade` = '$grade' WHERE id = $id";
    $res = $db->query($q);
    $sid=  $db->insert_id;
    if ($res) {
        $response["msg"] = "data is updated";
        $response["stutas"] = "200";
        $json_response = json_encode($response);
        echo $json_response;
       
    }
    else{header("Location: ./index.php");}

// echo "$fname<br>";
// echo "$lname<br>";
// echo "$email<br>";
// echo "$password<br>";
// echo "$cpassword<br>";
// echo "$phonenumber<br>";
// echo "$gender<br>";
// print_r($hobby);
// echo "$studmasg<br>";
// echo "$grade<br>";