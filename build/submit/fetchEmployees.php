<?php
/**
 * Created by PhpStorm.
 * User: Dulaj Ariyaratne
 * Date: 4/12/2018
 * Time: 5:03 PM
 */

date_default_timezone_set('Asia/Colombo');
$allowance_date = date("Y-m-d");
$output = "";


$conn = mysqli_connect('localhost','root','','project');

$query_get_data = "SELECT * FROM `employee`WHERE `empStatus` = 'active'  ORDER BY `id` ASC ";
$result_get_data = mysqli_query($conn,$query_get_data);
$total = 0;
$rows = array();
while($row_get_data=mysqli_fetch_assoc($result_get_data)) {


        $query_get_allowance = "SELECT * FROM `allowance` WHERE `empCode` = '{$row_get_data['empCode']}' AND `date` = '{$allowance_date}'";
        $result_get_allowance = mysqli_query($conn,$query_get_allowance);

        $row_get_allowance =mysqli_fetch_assoc($result_get_allowance);
        $total += $row_get_allowance['money'];

        if($row_get_allowance['money'] == 0){
            $money = "";
        }else {
            $money = $row_get_allowance['money'].".00";
        }

        $output .= ' <tr>
                        <td style="display: none;">
                            <span class="tabledit-span tabledit-identifier">'.$row_get_data['id'].'</span>
                            <input class="tabledit-input tabledit-identifier" type="hidden" name="empId" value="1" disabled="">
                        </td>
                        <td width="50px;" style="text-align: center">
                            <img class="emp-thumb" src="build/upload/'.$row_get_data['empThumb'].'">
                        </td>
                        <td>
                        <span class="tabledit-span tabledit-identifier">'.$row_get_data['empCode'].'</span>
                        <input class="tabledit-input tabledit-identifier" type="hidden" name="empCode" value="'.$row_get_data['empCode'].'" disabled="">
                            
                        </td>
                        <td>
                            '.$row_get_data['empName'].'
                        </td>
                        <td class="tabledit-view-mode text-right" width="15%">
                            <span class="tabledit-span" style="display: inline;">'.$money.'</span>
                            <input class="tabledit-input form-control input-sm" type="number" name="empMoney" value="'.$money.'" style="display: none;" disabled="">

                        </td>
                    </tr>';


}
        $output.= '<tr>
                     
                       <td colspan="3" class="text-right" style="font-weight: bold;font-size: large;">Total</td>
                      
                       <td style="font-weight: bold;font-size: large;" class="text-right">'.$total.'.00</td>
                    </tr>';

echo $output;