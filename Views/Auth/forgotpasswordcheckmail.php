<?php

require __DIR__."/../../Services/ConnectionServices.php";

try {
    $db = new Database();
    $conn = $db->getconnect();

    if ($conn) {
        $token = $_GET['token'];
        $q = "SELECT sid FROM varified_emails WHERE token = '$token'";
        $res = $conn->query($q);

        if ($res && $res->num_rows == 1) {
            $data = $res->fetch_assoc();
            $deletetoken = "DELETE FROM varified_emails WHERE token = '$token'";
            $deleteRecode = $conn->query($deletetoken);
            ?>
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Update Password</title>
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
                <link rel="stylesheet" href="../../Public/assets/css/login.css">
            </head>
            <body>
                <div class="page-content">
                    <div class="form-v5-content">
                        <form class="form-detail" id="validate" method="POST" enctype="multipart/form-data" action="../../Controllers/Auth/UpdatePassword.php?id=<?php echo $data['sid']; ?>">
                            <h2>Update Password</h2>
                            <div class="form-row">
                                <input type="password" placeholder="Enter Your New Password" class="form-control" name="newpassword" id="inpnewpassword">
                            </div>
                            <div class="form-row">
                                <input type="password" placeholder="Confirm Password" class="form-control" name="confirmpassword" id="inpconfirmpassword">
                            </div>
                            <div class="form-row-last">
                                <input id='myButton' type="submit" name="" class="register" value="Update Password">
                            </div>
                        </form>
                    </div>
                </div>
            </body>
            </html>
            <?php
        } else {
            throw new Exception("Invalid link");
        }
    } else {
        throw new Exception("Failed to connect to the database");
    }
} catch (Exception $e) {
    $error_log = date("Y-m-d H:i:s") . " - " . "Error: " . $e->getMessage() . " - File: " . basename(__FILE__) . PHP_EOL;
    $log_file = "error/error_log.txt"; 
    file_put_contents($log_file, $error_log, FILE_APPEND);

    echo "Error: " . $e->getMessage();
}
?>
