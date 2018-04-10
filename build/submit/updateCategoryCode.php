<?php
/**
 * Created by PhpStorm.
 * User: Dulaj Ariyaratne
 * Date: 4/10/2018
 * Time: 9:32 AM
 */


$conn = mysqli_connect('localhost','root','','project');

$query = "SELECT * FROM `category` WHERE `cat_name` = '{$_POST['query']}'";
$result = mysqli_query($conn,$query);
$row = mysqli_fetch_assoc($result);

echo $row['cat_code'];
