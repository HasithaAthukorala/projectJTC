<?php
/**
 * Created by PhpStorm.
 * User: Dulaj Ariyaratne
 * Date: 4/12/2018
 * Time: 12:01 AM
 */

$conn = mysqli_connect('localhost','root','','project');
$query = "SELECT `auto_increment` FROM INFORMATION_SCHEMA.TABLES
WHERE table_name = 'employee'";
$result = mysqli_query($conn,$query);
$row = mysqli_fetch_assoc($result);

echo str_pad($row['auto_increment'], 6, "0", STR_PAD_LEFT);;