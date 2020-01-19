<?php

class ShopNow{
            
    public function getData(){
        $obj = new \stdClass() ;
        global $conn;
        $json = array();
         
         
        $cat = mysqli_query($conn,"SELECT * FROM categories"); 
      
        if(mysqli_num_rows($cat) > 0){
        
          while($row = mysqli_fetch_array($cat)){
              $category = $row['name'];

              $sub_cat = mysqli_query($conn,"SELECT * FROM sub_categories WHERE category = '$category'"); 
            while($row1 = mysqli_fetch_assoc($sub_cat)){
              
               $json[] = $row1;
          }
        
          }
        }
         
       
         return $json;
}
}

?>