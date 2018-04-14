<?php

// Basic example of PHP script to handle with jQuery-Tabledit plug-in.
// Note that is just an example. Should take precautions such as filtering the input data.

header('Content-Type: application/json');

$input = filter_input_array(INPUT_POST);

$conn = mysqli_connect('localhost','root','','project');

if (mysqli_connect_errno()) {
    echo json_encode(array('mysqli' => 'Failed to connect to MySQL: ' . mysqli_connect_error()));
    exit;
}
$empCode = $input['empCode'];
if ($input['action'] === 'edit') {

    $query_update_data = "UPDATE `allowance` SET `money` ='" . $input['empMoney'] . "' WHERE `empCode` ='" . $empCode. "'";
    $result_update_data = mysqli_query($conn,$query_update_data);
}

mysqli_close($mysqli);

echo json_encode($input);

