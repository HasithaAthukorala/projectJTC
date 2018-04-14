<?php

/**
 * Created by PhpStorm.
 * User: Dulaj Ariyaratne
 * Date: 4/12/2018
 * Time: 6:49 PM
 */


date_default_timezone_set('Asia/Colombo');
$allowance_date = date("Y-m-d");
$output = "";


$conn = mysqli_connect('localhost','root','','project');
$total = 0;
$query_get_data = "SELECT * FROM `employee`WHERE `empStatus` = 'active'  ORDER BY `id` ASC ";
$result_get_data = mysqli_query($conn,$query_get_data);

$rows = array();
while($row_get_data=mysqli_fetch_assoc($result_get_data)) {

    $query_get_allowance = "SELECT * FROM `allowance` WHERE `empCode` = '{$row_get_data['empCode']}' AND `date` = '{$allowance_date}'";
    $result_get_allowance = mysqli_query($conn,$query_get_allowance);
    $row_get_allowance =mysqli_fetch_assoc($result_get_allowance);
    $total += $row_get_allowance['money'];

    $output .= ' <tr>
                       
                        <td width="50px;" style="text-align: center">
                            <img class="emp-thumb" src="build/upload/'.$row_get_data['empThumb'].'">
                        </td>
                        <td>
                            '.$row_get_data['empCode'].'
                        </td>
                        <td>
                            '.$row_get_data['empName'].'
                        </td>
                        <td class="text-right">
                           '.$row_get_allowance['money'].'.00
                        </td>
                    </tr>';


}

$output.= '<tr>
                     
                       <td colspan="3" class="text-right" style="font-weight: bold;font-size: large;">Total</td>
                      
                       <td style="font-weight: bold;font-size: large;" class="text-right">'.$total.'.00</td>
                    </tr>';
echo $output;