<?php
require_once('model/cart.php');
require_once('model/status.php');

class PlaceOrder{
            
     public function getData($user_id){
        global $conn;
        $data = array();
        $cart_id = date('ymdHis');
        $msg = new Msg();
        $status = "";
        $qry = mysqli_query($conn,"INSERT INTO orders (user_id,cart_id) VALUES ('$user_id','$cart_id')"); 
            if(($qry)){
                 $cart = new Cart();
                 $cart_prd = $cart->getData($user_id);
                 foreach($cart_prd as $items){

                    $prd_id = $items['prd_id'];
                    $size = $items['size'];
                    $qty = $items['qty'];
                $qry = mysqli_query($conn,"INSERT INTO order_list (cart_id,prd_id,size,qty) VALUES ('$cart_id','$prd_id','$size','$qty')"); 
                
                 }
                
                 $status = $msg->status('success','order placed');

                
            }
    else{

        $status = $msg->status('failed','cannot place order');

       
    }
return $status;

}

}
?>