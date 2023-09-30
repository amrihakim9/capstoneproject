<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = filter_input(INPUT_POST, 'nama', FILTER_SANITIZE_STRING);
    $group = filter_input(INPUT_POST, 'kelompok', FILTER_SANITIZE_NUMBER_INT);
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $password = $_POST["password"];

    $name = trim($name);
    $group = trim($group);
    $username = trim($username);

    if (strlen($name) < 4 || strlen($group) < 1 || strlen($username) < 5) {
        echo "Invalid data format";
        exit;
    }

    if (strlen($password) < 8 || !preg_match('/[a-z]/', $password) || !preg_match('/[A-Z]/', $password) || !preg_match('/\d/', $password) || !preg_match('/[@$!%*?&]/', $password)) {
        echo "Invalid password format";
        exit;
    }

    $host = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbName = "capstone";

    try {
        $conn = new PDO("mysql:host=$host;dbname=$dbName", $dbUsername, $dbPassword);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	    $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

        $stmt_check_username = $conn->prepare("SELECT COUNT(*) FROM user WHERE username = :username");
        $stmt_check_username->bindParam(':username', $username);
        $stmt_check_username->execute();

        if ($stmt_check_username->fetchColumn() > 0) {
	    echo "Username sudah digunakan. Silakan pilih username lain.";
	    exit;
        }

        $hashed_password = sha1($password);

        $stmt = $conn->prepare("INSERT INTO user (nama, kelompok, username, password) VALUES (:nama, :kelompok, :username, :hashed_password)");
        $stmt->bindParam(':nama', $name);
        $stmt->bindParam(':kelompok', $group);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':hashed_password', $hashed_password);

        if ($stmt->execute()) {
            echo "Data baru sukses dibuat!";
            exit();
        } else {
            echo "Error ketika registrasi. Mohon coba lagi nanti.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>