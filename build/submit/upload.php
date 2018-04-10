<?php
/**
 * Created by PhpStorm.
 * User: Dulaj Ariyaratne
 * Date: 4/10/2018
 * Time: 10:50 PM
 */
$target_dir = "../upload/";
$target_file = $target_dir . basename($_FILES["file"]["name"]);


if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_dir.$_FILES['file']['name'])) {
    $status = 1;
}