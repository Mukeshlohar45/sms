<?php

use Svg\Tag\Path;

require __DIR__ . "./../../services/connectionServices.php";
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../../public/assets/css/admin.css">
</head>
<body>
    <?php
    if (!isset($_SESSION['role'])) {
         header("Location: ./index.php");
    }
 
    if ($_SESSION['role'] != 'student') {
         header("Location: ./index.php");
    }
    ?>
    <?php
    require_once "./layout/studentnav.php";
    ?>
    <div class="containerr">
        <h1 style="margin-top: 20px;">Welcome student <?php echo $_SESSION['username']; ?></h1>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="../../public/assets/js/student.js"></script>

</html>