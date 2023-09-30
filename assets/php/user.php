<?php
session_start();
include("connection.php");
$db = new dbObj();
$connection =  $db->getConnstring();
$connection = mysqli_connect('localhost', 'root', '', 'capstone');
$request_method = $_SERVER["REQUEST_METHOD"];

switch ($request_method) {
    case 'GET':
        // Retrive Admin
        if (!empty($_GET["id"])) {
            $id = intval($_GET["id"]);
            get_user($id);
        } else {
            get_users();
        }
        break;

    case 'POST':
        if (isset($_SERVER['QUERY_STRING'])) {
            $query_string = $_SERVER['QUERY_STRING'];
            parse_str($query_string, $params);
            $data = json_encode($params);
            $datas = json_decode($data);
            $tipe = $datas->tipe;
            if ($tipe == 'login') {
                login_user();
            } else if ($tipe == 'insert') {
                insert_user();
            }
        }
        break;

    case 'PUT':
        // Update Admin
        update_user();
        break;

    case 'DELETE':
        // Delete Admin
        $id = intval($_GET["id"]);
        delete_user($id);
        break;

    default:
        // Invalid Request Method
        header("HTTP/1.0 405 Method Not Allowed");
        break;
}

function get_user($id = 0)
{
    global $connection;
    $query = "SELECT * FROM user";
    if ($id != 0) {
        $query .= " WHERE id=" . $id . " LIMIT 1";
    }
    $response = array();
    $result = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        $response[] = $row;
    }
    header('Content-Type: application/json');
    echo json_encode($response);
}

function get_users()
{
    global $connection;
    $query = "SELECT * FROM user";
    $response = array();
    $result = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        $response[] = $row;
    }
    header('Content-Type: application/json');
    echo json_encode($response);
}

function insert_user()
{
    global $connection;

    $data = json_decode(file_get_contents('php://input'), true);
    $name = $data["nama"];
    $username = $data["username"];
    $password = $data["password"];
    $checkUname = mysqli_query($connection, "SELECT * FROM user WHERE username = '" . $username . "' ");
    if (mysqli_num_rows($checkUname) > 0) {
        $response = array(
            'status' => 0,
            'status_message' => 'Username Sudah Digunakan.'
        );
    } else {
        $password = $data["password"];
        $query = "INSERT INTO user SET nama='" . $nama . "', username='" . $username . "', password='" . sha1($password) . "'";
        if (mysqli_query($connection, $query)) {
            $response = array(
                'status' => 1,
                'status_message' => 'Data Berhasil Ditambah.'
            );
        } else {
            $response = array(
                'status' => 0,
                'status_message' => 'Data Gagal Ditambah.'
            );
        }
    }
    header('Content-Type: application/json');
    echo json_encode($response);
}

function update_user()
{
    global $connection;
    $post_vars = json_decode(file_get_contents("php://input"), true);
    $nama = $post_vars["nama"];
    $username = $post_vars["username"];
    $password = sha1($post_vars["password"]);
    $id = $post_vars["id"];
    $query = "UPDATE user SET nama='" . $nama . "', username='" . $username . "', password='" . $password . "' WHERE id=" . $id;
    if (mysqli_query($connection, $query)) {
        $response = array(
            'status' => 1,
            'status_message' => 'Data Berhasil Diperbarui.'
        );
    } else {
        $response = array(
            'status' => 0,
            'status_message' => 'Data Gagal Diperbarui.'
        );
    }
    header('Content-Type: application/json');
    echo json_encode($response);
}

function delete_user($id)
{
    global $connection;
    $query = "DELETE FROM user WHERE id=" . $id;
    if (mysqli_query($connection, $query)) {
        $response = array(
            'status' => 1,
            'status_message' => 'Data Berhasil Dihapus.'
        );
    } else {
        $response = array(
            'status' => 0,
            'status_message' => 'Data Gagal Dihapus.'
        );
    }
    header('Content-Type: application/json');
    echo json_encode($response);
}

function login_user()
{
    global $connection;
    $post_vars = json_decode(file_get_contents("php://input"), true);
    $username = $post_vars["username"];
    $password = sha1($post_vars["password"]);
    
    $check = mysqli_query($connection, "SELECT * FROM user WHERE username = '" . $username . "' AND password = '" . $password . "'");
    
    if (mysqli_num_rows($check) > 0) {
        $fetch = mysqli_fetch_assoc($check);
        
        if ($fetch['approve'] === 'approved') {
            $id = $fetch['id'];
            $_SESSION['id'] = $id;
            $_SESSION['name'] = $fetch['nama'];
            mysqli_query($connection, "UPDATE user SET status='online' WHERE id=" . $id);
            
            $response = array(
                'status' => 1,
                'status_message' => 'Berhasil Masuk.'
            );
        } else {
            $response = array(
                'status' => 0,
                'status_message' => 'Masuk Gagal. Akun Anda sedang menunggu persetujuan.'
            );
        }
    } else {
        $response = array(
            'status' => 0,
            'status_message' => 'Username atau Password Anda Salah.'
        );
    }
    header('Content-Type: application/json');
    echo json_encode($response);
}