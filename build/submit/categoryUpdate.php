<?php
/**
 * Created by PhpStorm.
 * User: Dulaj Ariyaratne
 * Date: 4/9/2018
 * Time: 9:32 PM
 */


$conn = mysqli_connect('localhost','root','','project');

date_default_timezone_set('Asia/Colombo');
$date = date("d-m-Y h:i:s A");

$query_update_data = "UPDATE `category` SET `cat_name` = '{$_POST['update-category-name']}' WHERE `cat_id` = '{$_POST['update-category-id']}'";

$result_update_data = mysqli_query($conn,$query_update_data);

echo $query_update_data;