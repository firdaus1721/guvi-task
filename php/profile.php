<?php

session_start();

// Use Redis as the session handler
ini_set('session.save_handler', 'redis');
ini_set('session.save_path', 'tcp://127.0.0.1:6379');

$mongoClient = new MongoDB\Client("mongodb://localhost:27017");
$db = $mongoClient->user_authentication_mongodb;
$collection = $db->users;

$conn = new mysqli("localhost", "root", "Unknown@123", "guvi_database");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id']; // Assuming you store user_id in the session during login
    $name = $_POST["name"];
    $age = $_POST["age"];
    $dob = $_POST["dob"];
    $mobile = $_POST["mobile"];
    $email = $_POST["email"];
    $address = $_POST["address"];
    $profession = $_POST["profession"];
    $company = $_POST["company"];

    // Update MongoDB
    $filter = ["user_id" => $user_id];
    $update = [
        '$set' => [
            "name" => $name,
            "age" => $age,
            "dob" => $dob,
            "mobile" => $mobile,
            "email" => $email,
            "address" => $address,
            "profession" => $profession,
            "company" => $company,
        ]
    ];
    $result = $collection->updateOne($filter, $update);

    // Check if MongoDB update was successful
    if ($result->getModifiedCount() > 0) {
        echo "Profile updated successfully!";
    } else {
        echo "Error updating profile: " . $conn->error;
    }

    // Update MySQL
    $sql = "UPDATE users SET 
            name='$name',
            age='$age',
            dob='$dob',
            mobile='$mobile',
            email='$email',
            address='$address',
            profession='$profession',
            company='$company'
            WHERE id=$user_id";

    if ($conn->query($sql) === TRUE) {
        echo "Profile updated successfully!";
    } else {
        echo "Error updating profile: " . $conn->error;
    }
}

$conn->close();
$mongoClient->close();

?>
