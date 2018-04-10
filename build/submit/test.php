<?php
/**
 * Created by PhpStorm.
 * User: Dulaj Ariyaratne
 * Date: 4/8/2018
 * Time: 8:49 PM
 */

$conn = mysqli_connect('localhost','root','','project');
$query = "SELECT `cat_code` FROM `category` ORDER BY `cat_code` DESC";
$result = mysqli_query($conn,$query);
$row = mysqli_fetch_assoc($result);

echo $row['cat_code'];
