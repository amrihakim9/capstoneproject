<?php

$table = 'user';

$primaryKey = 'id';

$columns = array(
    array('db' => 'nama', 'dt' => 0),
    array('db' => 'kelompok',  'dt' => 1),
    array(
        'db'        => 'id',
        'dt'        => 2,
        'formatter' => function ($d, $row) {
            return '<button type="button" name="update" id="' . $row["id"] . '" class="btn btn-success update"  data-toggle="modal" data-target="#exampleModalCenter">Update</button> <button type="button" name="delete" id="' . $row["id"] . '" class="btn btn-danger delete" >Delete</button>';
        }
    )
);

$sql_details = array(
    'user' => 'root',
    'pass' => '',
    'db'   => 'capstone',
    'host' => 'localhost'
);

require('ssp.class.php');
echo json_encode(
    SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns)
);