<?php
header('Content-Type: application/json');
require_once('../DashBoard/Db/db.php');
$otp = mt_rand(1000,9999);
$auth_key = "228540AK4QtRdViEcb5b5b0595";
$message = $otp." is your OTP for Indus";
$sender = $_POST['sender'];
$number = $_POST['number'];
$url = "http://control.msg91.com/api/sendotp.php";

$status = "";
$fields = array(
           "authkey"=>$auth_key,
		   "message"=>$message,
		   "sender"=>$sender,
		   "mobile"=>$number,
           "otp"=>$otp,
           "otp_expiry"=>10
		   );
		   
		   

		   $con = curl_init();
		   curl_setopt($con,CURLOPT_URL,$url);
		   curl_setopt($con, CURLOPT_POST, count($fields));
           curl_setopt($con, CURLOPT_POSTFIELDS, http_build_query($fields));
		   
		   
$result = curl_exec($con);


$qry = mysqli_query($conn,"SELECT * FROM otp_store WHERE number = '$number'");
if(mysqli_num_rows($qry) < 1){
    $qry = mysqli_query($conn,"INSERT INTO otp_store (number,is_valid,otp) VALUES ('$number','1','$otp')");
if($qry){
$status = ['status'=>'success','message'=>'otp sent'];
}
}
else{
$qry = mysqli_query($conn,"UPDATE otp_store set otp = '$otp' WHERE number = '$number'"); 
if($qry){
    $status = ['status'=>'success','message'=>'otp sent'];
    }
}

curl_close($con);



?>

