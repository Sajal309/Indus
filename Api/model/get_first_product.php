<?php
require_once('model/products.php');
require_once('model/get_items.php');
class FirstProduct{
    
            
     public function getData($grp_id){
        global $conn;
        $data = "";

                $prd = new getItems();
                $prd_id_array = $prd->getData($grp_id);
              
                $prd_id = $prd_id_array[0]['product_id'];
                $prd_detail = new ProductDetails();
                $product_data = $prd_detail->getData($prd_id,$grp_id);
                $data = $product_data;
    

return $data;
}
}

?>