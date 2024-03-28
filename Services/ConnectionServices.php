<?php
class Database
{
    private $serverName = "localhost";
    private $userName = "root";
    private $password = "";
    private $databaseName = "student_db";

    function getconnect()
    {
        try {
            $conn = new mysqli($this->serverName, $this->userName, $this->password, $this->databaseName);
            
            if ($conn->connect_error) {
                throw new Exception("Failed to connect: " . $conn->connect_error);
            }
            return $conn;
            
        } catch (Exception $e) {
            throw new Exception("Connection error: " . $e->getMessage());
        }
    }   
}
?>

