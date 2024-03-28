<?php
require_once __DIR__ . '/../../../Services/ConnectionServices.php'; 

if (isset($_GET['code'])) {
    $id = 1; 
    $_SESSION['sid'] = $id; 
    $_SESSION['username'] = $username;

    header('Location: ../Student/studentinfo.php');
    exit;
}
?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../public/assets/css/studentnav.css">
</head>

<body>

    <div class="topnav">
        <?php
        if (isset($_SESSION['id'])) {
            $xyz = new Database();
            $db = $xyz->getconnect();
            $id = $_SESSION['id'];

            $sql = "SELECT * FROM registration_infos WHERE id = $id"; 
            $res=$db->query($sql);
            while ($rows = $res->fetch_assoc()) {
                $datahobby = explode(',', $rows['hobby']);
        ?>
                <img class="logoo" src="../../Public/assets/images/student-management-8.svg" width="50px" height="50px" alt="">
                <a class="active" href="">Home</a>
                <a class="nav-link" href="student.php">Profile</a>

                <img src="./../../Public/uploads/<?php echo $rows['profile']; ?>" class="profile rounded-circle ml-5">
                <div class="login-container">
                    <a class="logoutbtn" href="../../Controllers/Auth/DestroySession.php"><i class="fa fa-sign-out"></i>Signout</a>
                </div>
        <?php
            }
        } else {
            echo "Student ID not found in session.";
        }
        ?>
    </div>

</body>

</html>
