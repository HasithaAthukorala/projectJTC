<?php
/**
 * Created by PhpStorm.
 * User: Dulaj Ariyaratne
 * Date: 4/9/2018
 * Time: 9:32 PM
 */


$conn = mysqli_connect('localhost','root','','project');

$query = "SELECT `cat_code` FROM `category` ORDER BY `cat_code` DESC";
$result = mysqli_query($conn,$query);
$row = mysqli_fetch_assoc($result);

date_default_timezone_set('Asia/Colombo');
$date = date("d-m-Y h:i:s A");

$query_insert_data = "INSERT INTO `category`(`cat_id`,`cat_code`,`cat_name`,`cat_remarks`,`last_update`) VALUES (NULL,'{$_POST['category-code']}','{$_POST['category-name']}','{$_POST['category-remarks']}','$date')";

$result_insert_data = mysqli_query($conn,$query_insert_data);

