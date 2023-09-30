<?php
session_start();
$connection = mysqli_connect('localhost', 'root', '', 'capstone');

$name = $_POST['nama'];

$sql = "UPDATE user SET status='offline' WHERE nama='" . $name . "'";
$sql1 = "UPDATE praktikum SET status='offline' WHERE nama='" . $name . "'";
$sql2 = "UPDATE kelompok SET status='offline' WHERE nama='" . $name . "'";


if (mysqli_query($connection, $sql) && mysqli_query($connection, $sql1) && mysqli_query($connection, $sql2)) {
    $response = array(
        'status' => 1,
        'status_message' => 'ok!.'
    );
    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    $response = array(
        'status' => 0,
        'status_message' => 'Failed.'
    );
    header('Content-Type: application/json');
    echo json_encode($response);
}
