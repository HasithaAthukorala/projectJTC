<?php
/**
 * Created by PhpStorm.
 * User: Dulaj Ariyaratne
 * Date: 4/7/2018
 * Time: 8:54 AM
 */

$conn = mysqli_connect('localhost','root','','project');
$request = $_POST['request'];
date_default_timezone_set('Asia/Colombo');
$date = date("d-m-Y h:i A");

$query_insert_data = "INSERT INTO `request`(`id`,`details`,`status`,`date`) VALUES (NULL,'$request','0','$date')";
$result_insert_data = mysqli_query($conn,$query_insert_data);