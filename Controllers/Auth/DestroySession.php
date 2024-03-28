<?php
try {
    session_start();

    if (isset($_SESSION['role'])) {
        session_destroy();
        header("Location: ../../index.php"); 
    }
} catch (Exception $e) {
    $error_log = date("Y-m-d H:i:s") . " - " . "An error occurred: " . $e->getMessage() . " - File: " . basename(__FILE__) . PHP_EOL;
    $log_file = "error/error_log.txt"; 
    file_put_contents($log_file, $error_log, FILE_APPEND);

    throw new Exception("An error occurred: " . $e->getMessage());
}
?>
