<?php
header('Content-Type: application/json');
require_once('../DashBoard/Db/db.php');
require_once('model/users.php');
require_once('model/data.php');
 
global $conn;
$otp = $_POST['otp'];
$number = $_POST['number'];
$token = $_POST['token'];
$json = "";		
$qry = mysqli_query($conn,"SELECT * FROM otp_store WHERE number = '$number' && otp = '$otp'");
if(mysqli_num_rows($qry) > 0){
    $row = mysqli_fetch_array($qry);
       
       
       $user_detail = new Users();
       $user_data = $user_detail->getData($number,$token);
         

        $data = new Data();
        $json = $data->getData('success','user_details',$user_data);
       

}
else{
    $data = new Data();
    $json = $data->getData('failed','number not exists','');
       
}

echo $json;

?>

