<?php
/**
 * Created by PhpStorm.
 * User: Dulaj Ariyaratne
 * Date: 4/7/2018
 * Time: 11:08 AM
 */

$conn = mysqli_connect('localhost','root','','project');
$status = $_POST['status'];
$id = $_POST['id'];

$query_update_data = "UPDATE `request` SET `status` = '$status' WHERE `id` = '$id'";
$result_update_data = mysqli_query($conn,$query_update_data);
