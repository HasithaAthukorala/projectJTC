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
$cat_code = mysqli_real_escape_string($conn,$_POST['category-code']);
$cat_name = mysqli_real_escape_string($conn,$_POST['category-name']);
$cat_remarks = mysqli_real_escape_string($conn,$_POST['category-remarks']);

// Checking Whether the cat_code is already exists in the table..
$query_check_code = "SELECT * FROM `category` WHERE `cat_code` = '$cat_code'";
$result_check_code = mysqli_query($conn,$query_check_code);

if(mysqli_num_rows($result_check_code) > 0)
{
    $query_update_data = "UPDATE `category` SET `cat_name` = '$cat_name',`cat_remarks` = '$cat_remarks',`last_update`='$date' WHERE `cat_code` = '$cat_code'";
    $result_update_data = mysqli_query($conn,$query_update_data);
    if($result_update_data){
        echo "true";
    }else {
        echo "false";
    }
}else{

    $query_insert_data = "INSERT INTO `category`(`cat_code`,`cat_name`,`cat_remarks`,`last_update`) VALUES ('$cat_code','$cat_name','$cat_remarks','$date')";
    $result_insert_data = mysqli_query($conn,$query_insert_data);
    if($result_insert_data){
        echo "true";
    }else {
        echo "false";
    }

}


