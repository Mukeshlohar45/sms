<?php 
try {
    session_start();

    if (!isset($_SESSION['role'])) {
        header("Location: ../index.php");
    } else {
        if ($_SESSION['role'] == 'admin') {
            header("Location: ./Views/Admin/adminprofile.php");
        }
        if ($_SESSION['role'] == 'student') {
            header("Location: ./Views/Student/studentinfo.php");
        }
    }
} catch (Exception $e) {
    throw new Exception("An error occurred: " . $e->getMessage());
}
?>
