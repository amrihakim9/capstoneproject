<?php
session_start();

$name = $_SESSION['name'];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "capstone";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
}

$sqlUpdateStatus = "UPDATE user SET status='offline' WHERE nama='" . $name . "'";

if ($conn->query($sqlUpdateStatus) === TRUE) {
    $sqlUpdateApproval = "UPDATE user SET approve='pending' WHERE nama='" . $name . "'";
    if ($conn->query($sqlUpdateApproval) === TRUE) {
        session_unset();
        session_destroy();
        header('Location: userlogin.html');
    } else {
        echo "Error updating approval status: " . $conn->error;
    }
} else {
    echo "Error updating status: " . $conn->error;
}

$conn->close();
?>