<?php
/**
 * Created by PhpStorm.
 * User: Dulaj Ariyaratne
 * Date: 4/7/2018
 * Time: 7:03 AM
 */

$conn = mysqli_connect('localhost','root','','project');
$output = "";

$query_get_data = "SELECT * FROM `request` ORDER BY `status` ASC, `date` DESC";
$result_get_data = mysqli_query($conn,$query_get_data);
$rows = array();
while($row_get_data=mysqli_fetch_assoc($result_get_data)) {
    $currentStatus = $row_get_data['status'];
    $status = "";
    if ($currentStatus == "1"){
        $status = "checked";
        $output .= '  <li>
                    <p>
                        
                       <input type="checkbox" '.$status.' class="flat" style="position: absolute;" value="'.$row_get_data['id'].'">
                               
                        <del>' . $row_get_data['details'] . '<del>
                    </p>
                    <span class="requestDate">' . $row_get_data['date'] . '</span>
                   </li>';
    }else {
        $output .= '  <li>
                    <p>
                        
                       <input type="checkbox"  class="flat" style="position: absolute;" value="'.$row_get_data['id'].'">
                               
                        ' . $row_get_data['details'] . '
                    </p>
                    <span class="requestDate">' . $row_get_data['date'] . '</span>
                   </li>';
    }


}
echo $output;

