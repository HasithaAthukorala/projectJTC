<?php
/**
 * Created by PhpStorm.
 * User: Dulaj Ariyaratne
 * Date: 4/11/2018
 * Time: 6:04 PM
 */

$conn = mysqli_connect('localhost','root','','project');

// Generating the id of the employee according to the order
$query_get_id = "SELECT * FROM `employee` ORDER BY `id` ASC";
$result_get_id = mysqli_query($conn,$query_get_id);

if(mysqli_num_rows($result_get_id)>0)
{
    $row_get_id = mysqli_fetch_assoc($result_get_id);
    $id = $row_get_id['id']+1;
}else{
    $id = 1;
}


date_default_timezone_set('Asia/Colombo');
$date = date("Y-m-d h:i A");
$allowance_date = date("Y-m-d");
$year = date("Y");
$empCode = mysqli_real_escape_string($conn,$_POST['empCode']);
$empName = mysqli_real_escape_string($conn,$_POST['empName']);
$empThumb = mysqli_real_escape_string($conn,$_POST['empThumb']);
$empTitle = mysqli_real_escape_string($conn,$_POST['empTitle']);
$empGender = mysqli_real_escape_string($conn,$_POST['empGender']);
$empDName = mysqli_real_escape_string($conn,$_POST['empDName']);
$empDoB = mysqli_real_escape_string($conn,$_POST['empDoB']);
$empAddress = mysqli_real_escape_string($conn,$_POST['empAddress']);
$empTelephone = mysqli_real_escape_string($conn,$_POST['empTelephone']);
$empMobile = mysqli_real_escape_string($conn,$_POST['empMobile']);
$empFax = mysqli_real_escape_string($conn,$_POST['empFax']);
$empEmail = mysqli_real_escape_string($conn,$_POST['empEmail']);
$empRefNo = mysqli_real_escape_string($conn,$_POST['empRefNo']);
$empDepartment = mysqli_real_escape_string($conn,$_POST['empDepartment']);
$empRemarks = mysqli_real_escape_string($conn,$_POST['empRemarks']);
$empWorkType = implode(',',$_POST['empWorkType']);
$empStatus = mysqli_real_escape_string($conn,$_POST['empStatus']);




$query_insert_data = "INSERT INTO `employee` (`id`,`empCode`, `empName`, `empThumb`, `empTitle`, `empGender`, `empDName`, `empDoB`, `empAddress`, `empTelephone`, `empMobile`, `empFax`, `empEmail`, `empRefNo`, `empDepartment`, `empRemarks`, `empWorkType`, `empStatus`, `empDate`) VALUES ($id,'$empCode', '$empName', '$empThumb', '$empTitle', '$empGender', '$empDName', '$empDoB', '$empAddress', '$empTelephone', '$empMobile', '$empFax', '$empEmail', '$empRefNo', '$empDepartment', '$empRemarks', '$empWorkType', '$empStatus', '$date')";
$result_insert_data = mysqli_query($conn,$query_insert_data);


if($result_insert_data) {
    $query_insert_allowance = "INSERT INTO `allowance` (`id`,`empCode`,`money`,`date`,`week`,`year`) VALUES (NULL,'$empCode',0,'$allowance_date',1,'$year')";
    $result_insert_allowance = mysqli_query($conn,$query_insert_allowance);
    if($result_insert_allowance){
        echo "true";
    }
}else {
    echo "false";
}