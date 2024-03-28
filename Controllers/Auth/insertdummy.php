<?php

require __DIR__ . "/../../Services/ConnectionServices.php";
require __DIR__ . "/../../Services/MailServices.php";

// Database connection
$database = new Database();
$db = $database->getconnect();

// Dummy data generation loop
for ($i = 0; $i < 500; $i++) {
    // Generate random data
    $firstname = generateRandomString();
    $lastname = generateRandomString();
    $phonenumber = generateRandomPhoneNumber();
    $gender = rand(0, 1) ? 'Male' : 'Female'; // Random gender
    $hobby = generateRandomHobby();
    $message = generateRandomString();
    $grade = generateRandomGrade();

    // Generate a unique email address for each entry
    $email = strtolower($firstname . '.' . $lastname . '@example.com');

    // Hash the password
    $password = generateRandomString(); // Generate a random password
    $ency_pass = password_hash($password, PASSWORD_DEFAULT);

    // Prepare and execute the SQL query
    $query = "INSERT INTO `registration_infos` (`firstname`, `lastname`, `phonenumber`, `gender`, `hobby`, `message`, `profile`, `grade`, `status`, `is_varified`, `is_approved`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, 'active', 'true', 'true')";
    $statement = $db->prepare($query);
    $statement->bind_param("ssssssss", $firstname, $lastname, $phonenumber, $gender, $hobby, $message, $email, $grade);
    $statement->execute();
}

// Function to generate a random string
function generateRandomString($length = 8) {
    $characters = 'abcdefghijklmnopqrstuvwxyz';
    $string = '';

    for ($i = 0; $i < $length; $i++) {
        $string .= $characters[rand(0, strlen($characters) - 1)];
    }

    return ucfirst($string); // Capitalize the first letter
}

// Function to generate a random phone number
function generateRandomPhoneNumber() {
    return '0' . rand(100000000, 999999999); // Generate a random 10-digit number
}

// Function to generate a random hobby
function generateRandomHobby() {
    $hobbies = ['Reading', 'Sports', 'Gardening', 'Cooking', 'Music', 'Traveling'];
    $randomIndex = array_rand($hobbies);
    return $hobbies[$randomIndex];
}

// Function to generate a random grade
function generateRandomGrade() {
    $grades = ['A', 'B', 'C', 'D', 'E'];
    $randomIndex = array_rand($grades);
    return $grades[$randomIndex];
}

// Close the database connection
$db->close();

echo "Dummy data inserted successfully.";

?>
