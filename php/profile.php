<?php
$conn = new mysqli("localhost", "root", "Unknown@123", "guvi_database");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

session_start();

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
?>