<?php
/**
 * Created by PhpStorm.
 * User: Dulaj Ariyaratne
 * Date: 4/10/2018
 * Time: 11:07 PM
 */

     $toDelete= $_POST['filetodelete'];
     unlink("../upload/{$toDelete}");
     die;
