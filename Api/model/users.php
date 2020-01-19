<?php
require_once('model/user_details.php');
require_once('model/cart.php');
require_once('model/Token.php');

class Users{
            
     public function getData($number,$token){
         $obj = new \stdClass() ;
         global $conn;
         $json = "";
          
          $qry = mysqli_query($conn,"SELECT * FROM users WHERE number = '$number'"); 
          if(mysqli_num_rows($qry) > 0){

            
              
          $row = mysqli_fetch_array($qry);
          $id = $row['id'];
          $name = $row['name'];
          $number = $row['number'];
            
             $tok = new Token();
             $token = $tok->getData($id,$token);

          
          $user_detail = new UserDetails();
          $user_data = $user_detail->getData($id);

          $cart_detail = new Cart();
          $cart_data = $cart_detail->getData($id);
          
          $obj->id = $id;
          $obj->name = $name;
          $obj->number = $number;
          $obj->token = $token;
          $obj->user = $user_data;
          $obj->cart = $cart_data;
          $json = $obj;
          
          
          }
          else{
          $json = '';
          }
          return $json;
    }
}

?>