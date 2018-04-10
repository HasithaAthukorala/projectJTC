<?php
/**
 * Created by PhpStorm.
 * User: Dulaj Ariyaratne
 * Date: 4/10/2018
 * Time: 7:29 AM
 */
$conn = mysqli_connect('localhost','root','','project');
$query =mysqli_real_escape_string($conn,$_POST['query']);
$query = "SELECT * FROM `category` WHERE `cat_name` LIKE '%".$query."%'";
$result = mysqli_query($conn,$query);

$json = array();

if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)){
        $json[] = $row["cat_name"];
    }
    echo json_encode($json);
}
