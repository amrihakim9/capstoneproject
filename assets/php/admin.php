<?php
session_start();

$connection = mysqli_connect('localhost', 'root', '', 'capstone');
// $connection = mysqli_connect('localhost', 'root', '', 'absen');

$request_method = $_SERVER["REQUEST_METHOD"];

switch ($request_method) {
    case 'GET':
        // Retrive Admin
        if (!empty($_GET["id"])) {
            $id = intval($_GET["id"]);
            get_admin($id);
        } else {
            get_admins();
        }
        break;

    case 'POST':
        // Login Admin
        if (isset($_SERVER['QUERY_STRING'])) {
            $query_string = $_SERVER['QUERY_STRING'];
            parse_str($query_string, $params);
            // login_admin();
            header('Content-Type: application/json');
            $data = json_encode($params);
            $datas = json_decode($data);
            $tipe = $datas->tipe;
            if ($tipe == 'login') {
                login_admin();
            } else if ($tipe == 'insert') {
                insert_admin();
            }
        }
        break;

    case 'PUT':
        // Update Admin
        update_admin();
        break;

    case 'DELETE':
        // Delete Admin
        $id = intval($_GET["id"]);
        delete_admin($id);
        break;

    default:
        // Invalid Request Method
        header("HTTP/1.0 405 Method Not Allowed");
        break;
}

function get_admin($id = 0)
{
    global $connection;
    $query = "SELECT * FROM admin";
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

function get_admins()
{
    global $connection;
    $query = "SELECT * FROM admin";
    $response = array();
    $result = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        $response[] = $row;
    }
    header('Content-Type: application/json');
    echo json_encode($response);
}

function insert_admin()
{
    global $connection;

    $data = json_decode(file_get_contents('php://input'), true);
    $name = $data["name"];
    $username = $data["username"];
    $checkUname = mysqli_query($connection, "SELECT * FROM admin WHERE username = '" . $username . "' ");
    if (mysqli_num_rows($checkUname) > 0) {
        $response = array(
            'status' => 0,
            'status_message' => 'Username Telah Digunakan.'
        );
    } else {
        $password = $data["password"];
        $query = "INSERT INTO admin SET name='" . $name . "', username='" . $username . "', password='" . sha1($password) . "'";
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

function update_admin()
{
    global $connection;
    $post_vars = json_decode(file_get_contents("php://input"), true);
    $name = $post_vars["name"];
    $username = $post_vars["username"];
    $id = $post_vars["id"];
    $password = sha1($post_vars["id"]);
    $checkUname = mysqli_query($connection, "SELECT username FROM admin WHERE id = '" . $id . "' ");
    if (mysqli_num_rows($checkUname) > 0) {
        $fetch = mysqli_fetch_row($checkUname);
        $usernameDB = $fetch[0];
        $username = $post_vars["username"];
        if ($username == $usernameDB) {
            $password = sha1($post_vars["password"]);
            $query = "UPDATE admin SET name='" . $name . "', username='" . $username . "', password='" . $password . "' WHERE id=" . $id;
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
    } else {
        header('Content-Type: application/json');
        echo json_encode(array("query" => 'pl'));
    }
}

function delete_admin($id)
{
    global $connection;
    $query = "DELETE FROM admin WHERE id=" . $id;
    if (mysqli_query($connection, $query)) {
        $response = array(
            'status' => 1,
            'status_message' => 'Data Berhasil Dihapus.'
        );
    } else {
        $response = array(
            'status' => 0,
            'status_message' => 'Data Gagal Dihapus'
        );
    }
    header('Content-Type: application/json');
    echo json_encode($response);
}

function login_admin()
{
    global $connection;
    $post_vars = json_decode(file_get_contents("php://input"), true);
    $username = $post_vars["username"];
    $password = sha1($post_vars["password"]);

    $check = mysqli_query($connection, "SELECT * FROM admin WHERE username = '" . $username . "' AND password = '" . $password . "'");
    if (mysqli_num_rows($check) > 0) {
        $fetch = mysqli_fetch_row($check);
        $id = $fetch[0];
        $_SESSION['id'] = $id;
        $_SESSION['admin'] = $fetch[1];
        $response = array(
            'status' => 1,
            'status_message' => 'Admin Berhasil Masuk.'
        );
    } else {
        $response = array(
            'status' => 0,
            'status_message' => 'Username atau Password Salah.'
        );
    }
    header('Content-Type: application/json');
    echo json_encode($response);
}