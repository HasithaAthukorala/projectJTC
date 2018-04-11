<?php
/**
 * Created by PhpStorm.
 * User: Dulaj Ariyaratne
 * Date: 4/11/2018
 * Time: 6:04 PM
 */

$conn = mysqli_connect('localhost','root','','project');

date_default_timezone_set('Asia/Colombo');
$date = date("d-m-Y h:i A");
$_POST['empThumb'] = "dasdas";
$_POST['empWorkType'] = "asd";


$query_insert_data = "INSERT INTO `employee` (`id`,`empCode`, `empName`, `empThumb`, `empTitle`, `empGender`, `empDName`, `empDoB`, `empAddress`, `empTelephone`, `empMobile`, `empFax`, `empEmail`, `empRefNo`, `empDepartment`, `empRemarks`, `empWorkType`, `empStatus`, `empDate`) VALUES (NULL,'{$_POST['empCode']}', '{$_POST['empName']}', '{$_POST['empThumb']}', '{$_POST['empTitle']}', '{$_POST['empGender']}', '{$_POST['empDName']}', '{$_POST['empDoB']}', '{$_POST['empAddress']}', '{$_POST['empTelephone']}', '{$_POST['empMobile']}', '{$_POST['empFax']}', '{$_POST['empEmail']}', '{$_POST['empRefNo']}', '{$_POST['empDepartment']}', '{$_POST['empRemarks']}', '{$_POST['empWorkType']}', '{$_POST['empStatus']}', '$date')";
$result_insert_data = mysqli_query($conn,$query_insert_data);
