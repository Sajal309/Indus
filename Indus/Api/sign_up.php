<?php
header('Content-Type: application/json');
require_once('../DashBoard/Db/db.php');
require_once('model/users.php');
require_once('model/data.php');
 
global $conn;
$name = $_POST['name'];
$otp = $_POST['otp'];
$number = $_POST['number'];
$token = $_POST['token'];
$json = "";		
$qry = mysqli_query($conn,"SELECT * FROM otp_store WHERE number = '$number' && otp = '$otp'");
if(mysqli_num_rows($qry) > 0){

    
    $qry = mysqli_query($conn,"INSERT INTO users (name,number) VALUES ('$name','$number')");
    if($qry){
         
         

        $user_detail = new Users();
        $user_data = $user_detail->getData($number,$token);
          
 
         $data = new Data();
         $json = $data->getData('success','user registered',$user_data);
    }


      
       

}
else{
    $data = new Data();
    $json = $data->getData('failed','otp not matched','');
       
}

echo $json;

?>

