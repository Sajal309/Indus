<?php

require_once('model/brands.php');
require_once('model/shop_now.php');
require_once('model/get_items.php');
require_once('model/products.php');

class Start{
            
     public function getData(){
         $obj = new \stdClass() ;
         global $conn;
         $json = "";
         $data = array();
        
         $offers = array();
         $brands = array();
         $categories = array();
         $shop_now = array();
         $top_deals = array();

          $offer_qry= mysqli_query($conn,"SELECT * FROM offers"); 
          if(mysqli_num_rows($offer_qry) > 0){

          while($offer_row = mysqli_fetch_assoc($offer_qry)){
              $offers[] = $offer_row;
          }

          $brand_model = new Brands();
          $brands = $brand_model->getData();

          $category_model = new ShopNow();
          $categories = $category_model->getData();

          foreach($categories as $items){
              
            $name = $items['name'];
            $image = "";

          $item_qry= mysqli_query($conn,"SELECT * FROM products WHERE sub_category = '$name'"); 
          if(mysqli_num_rows($item_qry) > 0){
          
          $item_row = mysqli_fetch_array($item_qry);
          $grp_id = $item_row['group_id'];
        
          $prd = new getItems();
          $prd_data = $prd->getData($grp_id);
          $prd_id =  $prd_data[0]['product_id'];

          $image_qry= mysqli_query($conn,"SELECT * FROM images WHERE prd_id = '$prd_id'"); 
          $image_row = mysqli_fetch_array($image_qry);
          $image = $image_row['image'];
          $shop_now[] = array(
              'name'=>$name,
              'image'=>$image
          );
          }
  
          }

          $top_deal_qry= mysqli_query($conn,"SELECT * FROM products ORDER BY discount ASC"); 
          if(mysqli_num_rows($top_deal_qry) > 0){

          while($top_deal_row = mysqli_fetch_assoc($top_deal_qry)){
                  $id = $top_deal_row['group_id'];
                  $prd = new getItems();
                  $prd_id_array = $prd->getData($id);
                
                  $prd_id = $prd_id_array[0]['product_id'];
                  $prd_detail = new ProductDetails();
                  $product_data = $prd_detail->getData($prd_id,$id);
                  $top_deals[] = $product_data;
                  
                
          }

        }


        //   $id = $row['id'];
        //   $brand_name = $row['brand_name'];
        //   $title = $row['title'];
        //   $type = $row['type'];
        //   $category = $row['category'];
        //   $sub_category = $row['sub_category'];
        //   $price = $row['price'];
        //   $discount = $row['discount'];
        //   $is_cod = $row['is_cod'];
        //   $time = $row['time'];
        //   $grp_id = $row['group_id'];
            
            
        //   $size_detail = new Size();
        //   $size_data = $size_detail->getData($grp_id);

          
        //   $color_detail = new Colors();
        //   $color_data = $color_detail->getData($prd_id);

        //   $image_detail = new Images();
        //   $image_data = $image_detail->getData($prd_id);
          
        //   $product_detail = new Details();
        //   $product_data = $product_detail->getData($grp_id);


          
          $obj->offers = $offers;
          $obj->brands = $brands;
          $obj->shop_now = $shop_now;
          $obj->top_deals = $top_deals;
        //   $obj->brand_name = $brand_name;
        //   $obj->title = $title;
        //   $obj->type = $type;
        //   $obj->category = $category;
        //   $obj->sub_category = $sub_category;
        //   $obj->price = $price;
        //   $obj->discount = $discount;
        //   $obj->is_cod = $is_cod;
        //   $obj->time = $time;
        //   $obj->grp_id = $grp_id;
        //   $obj->size = $size_data;
        //   $obj->colors = $color_data;
        //   $obj->details = $product_data;
        //   $obj->images = $image_data;
          $json = $obj;
          
          
          }
          else{
          $json = '';
          }

          return json_encode($json);
    }
}

?>