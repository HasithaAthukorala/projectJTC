<?php
/**
 * Created by PhpStorm.
 * User: Dulaj Ariyaratne
 * Date: 4/9/2018
 * Time: 5:48 PM
 */
$conn = mysqli_connect('localhost','root','','project');

$query_delete_data = "DELETE FROM `request` WHERE `status` = '1'";
$result_delete_data = mysqli_query($conn,$query_delete_data);
