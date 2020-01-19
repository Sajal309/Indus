<?php
require_once('model/cart.php');
require_once('model/status.php');

class OrderDetails{
            
     public function getData($user_id){
        global $conn;
        $obj = new \stdClass() ;
        
        $data = array();
        // $cart_id = array();
        // $cancelled = array();
        // $received = array();
        $products = array();
        

        $qry = mysqli_query($conn,"SELECT * FROM orders WHERE user_id = '$user_id' && cancelled = 0 && received = 0");      
        
        if(($qry)){   
            while($row = mysqli_fetch_array($qry)){
            $cart_id = $row['cart_id'];
            $cancelled = $row['cancelled'];
            $received = $row['received'];

            $qry1 = mysqli_query($conn,"SELECT * FROM order_list WHERE cart_id = '$cart_id'");    
            while($row1 = mysqli_fetch_array($qry1)){
                    $products[] = array(
                        'id'=>$row1['id'],
                        'prd_id'=>$row1['prd_id'],
                        'size'=>$row1['size'],
                        'qty'=>$row1['qty']
                    );
            }
                     
               $data[] = array('cart_id'=>$cart_id,'cancelled'=>$cancelled,'received'=>$received,'products'=>$products);
                 }
                       
                 
                    
                }

               
            
        
    else{
        $data = '{}';
       
    }
return $data;

}

}
?>