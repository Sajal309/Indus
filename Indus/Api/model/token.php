<?php
class Token{

    public function getData($id,$token){
        global $conn;
        $ins_tok = mysqli_query($conn,"INSERT INTO token (user_id,token) VALUES ('$id','$token')");

        $sel_tok = mysqli_query($conn,"SELECT * FROM token WHERE user_id = '$id'");
        $token = array();

        while($row = mysqli_fetch_assoc($sel_tok)){
          $token[] = $row;
          }  
          return $token;
    }
}