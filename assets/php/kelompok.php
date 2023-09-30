<?php

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
        insert_user();
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
	    $nama = $data["nama"];
	    $kelompok = $data["kelompok"];
	    $query = "INSERT INTO user SET nama='" . $nama . "', kelompok='" . $kelompok . "', status='offline'";
	    if (mysqli_query($connection, $query)) {
		    $addUser = "INSERT INTO `user` (`id`, `nama`, `kelompok`, `status`, `username`, `password`) VALUES (NULL, '" . $nama . "', '" . $kelompok . "', '', 'offline', '" . $nama . "', SHA1('" . $nama . "'), '')";
		    if (mysqli_query($connection, $addUser)) {
			    $response = [];
		            $response[]['status'] = 1;
			    $response[]['status_message'] = 'User Added Successfully.';					            $response[]['q'] =  $addUser;
		            header('Content-Type: application/json');
			    echo json_encode($response);
		    } else {
			    $response = [];
			    $response[]['status'] = 0;
			    $response[]['status_message'] = 'User Added Successfully.';
			    $response[]['q'] =  $addUser;
			    header('Content-Type: application/json');
			    echo json_encode($response);
		    }
	    } else {
		    $response = [];
		    $response[]['status'] = 0;
	            $response[]['status_message'] = 'User Addition Failed.';
		    $response[]['q'] =  $query;
		    header('Content-Type: application/json');
		    echo json_encode($response);$response = [];
	    }
}

function update_user()
{
    global $connection;
    $post_vars = json_decode(file_get_contents("php://input"), true);
    $nama = $post_vars["nama"];
    $kelompok = $post_vars["kelompok"];
    $id = $post_vars["id"];
    $query = "UPDATE user SET nama='" . $nama . "', kelompok='" . $kelompok . "' WHERE id=" . $id;
    if (mysqli_query($connection, $query)) {
        $response = array(
            'status' => 1,
            'status_message' => 'User Updated Successfully.'
        );
    } else {
        $response = array(
            'status' => 0,
            'status_message' => 'User Updation Failed.'
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
            'status_message' => 'User Deleted Successfully.'
        );
    } else {
        $response = array(
            'status' => 0,
            'status_message' => 'User Deletion Failed.'
        );
    }
    header('Content-Type: application/json');
    echo json_encode($response);
}