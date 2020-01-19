<?php

require_once('model/size.php');
require_once('model/colors.php');
require_once('model/details.php');
require_once('model/images.php');

class ProductDetails{
            
     public function getData($prd_id,$grp_id){
         $obj = new \stdClass() ;
         global $conn;
         $json = "";
          
          $qry = mysqli_query($conn,"SELECT * FROM products WHERE group_id = '$grp_id'"); 
          if(mysqli_num_rows($qry) > 0){
           
          $row = mysqli_fetch_assoc($qry);

          $id = $row['id'];
          $brand_name = $row['brand_name'];
          $title = $row['title'];
          $type = $row['type'];
          $category = $row['category'];
          $sub_category = $row['sub_category'];
          $price = $row['price'];
          $discount = $row['discount'];
          $is_cod = $row['is_cod'];
          $time = $row['time'];
          $grp_id = $row['group_id'];
            
            
          $size_detail = new Size();
          $size_data = $size_detail->getData($grp_id);

          
          $color_detail = new Colors();
          $color_data = $color_detail->getData($prd_id);

          $image_detail = new Images();
          $image_data = $image_detail->getData($prd_id);
          
          $product_detail = new Details();
          $product_data = $product_detail->getData($grp_id);


          
          $obj->id = $id;
          $obj->brand_name = $brand_name;
          $obj->title = $title;
          $obj->type = $type;
          $obj->category = $category;
          $obj->sub_category = $sub_category;
          $obj->price = $price;
          $obj->discount = $discount;
          $obj->is_cod = $is_cod;
          $obj->time = $time;
          $obj->grp_id = $grp_id;
          $obj->size = $size_data;
          $obj->colors = $color_data;
          $obj->details = $product_data;
          $obj->images = $image_data;
          $json = $obj;
          
          
          }
          else{
          $json = '';
          }

          return $json;
    }
}

?>