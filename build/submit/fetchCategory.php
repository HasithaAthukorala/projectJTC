<?php
/**
 * Created by PhpStorm.
 * User: Dulaj Ariyaratne
 * Date: 4/9/2018
 * Time: 10:53 PM
 */

$conn = mysqli_connect('localhost','root','','project');


$query_get_data = "SELECT * FROM `category`";

$result_get_data = mysqli_query($conn,$query_get_data);


$json = [];
while($row_get_data = mysqli_fetch_assoc($result_get_data)){
    $json[] = ['id'=>$row_get_data['cat_code'],'text'=>$row_get_data['cat_name']];
}
echo json_encode($json);
