<?php

$connect = new PDO("mysql:host=localhost;dbname=capstone", "root", "");

$column = array('id', 'nama ', 'kelompok');
$query = "SELECT * FROM user";
$search = $_POST['search'];

if ($search != '') {
    $query .= ' WHERE(nama LIKE "%' . $search . '%" OR kelompok LIKE "%' . $search . '%"';
}

$query2 = '';
if (isset($_POST['order'])) {
    $query2 = ' ORDER BY ' . $column[$_POST['order']['0']['column']] . ' ' . $_POST['order']['0']['dir'] . ' ';
} else {
    $query2 = ' ORDER BY id ASC ';
}

$query3 = '';
if ($_POST["length"] != -1) {
    $query3 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

$statement = $connect->prepare($query);
$statement->execute();
$number_filter_row = $statement->rowCount();
$statement = $connect->prepare($query . $query2 . $query3);
$statement->execute();
$result = $statement->fetchAll();
$data = array();

foreach ($result as $row) {
    $sub_array = array();
    $sub_array[] = $row['id'];
    $sub_array[] = $row['nama'];
    $sub_array[] = $row['kelompok'];
    $sub_array[] =  '<a href="javascript:void(0)" class="btn btn-success btn-edit" data-id="' . $row['id'] . '"  data-toggle="modal" data-target="#exampleModal"> Edit </a> <a href="javascript:void(0)" class="btn btn-danger btn-delete ml-2" data-id="' . $row['id'] . '"> Delete </a>';
    $data[] = $sub_array;
}

function count_all_data($connect)
{
    $query = "SELECT * FROM user";
    $statement = $connect->prepare($query);
    $statement->execute();
    return $statement->rowCount();
}

$output = array(
    "draw"       =>  intval($_POST["draw"]),
    "recordsTotal"   =>  count_all_data($connect),
    "recordsFiltered"  =>  $number_filter_row,
    "data"       =>  $data,
    "query" => $query . $query2 . $query3
);

echo json_encode($output);
?>