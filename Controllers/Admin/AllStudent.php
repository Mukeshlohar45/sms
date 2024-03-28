<?php
require __DIR__ . "/../../Services/ConnectionServices.php";

try {
    $obj = new Database();
    $db = $obj->getconnect();

    if ($db) {
        $data = [];
        $q = "SELECT * FROM `registration_infos`";
        $res = mysqli_query($db, $q);

        if ($res) {
            while ($row = $res->fetch_assoc()) {
                $data[] = $row;
            }
            $json_response = json_encode($data);
            echo $json_response;
        } else {
            throw new Exception("Data not found");
        }
    } else {
        throw new Exception("Server error");
    }
} catch (Exception $e) {
    $response["status"] = 500;
    $response["msg"] = "Error: " . $e->getMessage();
    $json_response = json_encode($response);
    echo $json_response;
}


