<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';
require '../DashBoard/Db/db.php';
require_once('host.php');
require_once('model/status.php');
require_once('model/products.php');
require_once('model/get_first_product.php');

$app = new \Slim\App;
$app->get('/getotp/{number}', function (Request $request, Response $response, array $args) {
    
    $number = $request->getAttribute('number');
    global $api;
    $url = $api.'/getotp.php';
   $fields = array(
    "sender"=>"INDUSIN",
    "number"=>$number
    );
    
    
   
    $con = curl_init();
    curl_setopt($con,CURLOPT_URL,$url);
    curl_setopt($con, CURLOPT_POST, count($fields));
    curl_setopt($con, CURLOPT_POSTFIELDS, http_build_query($fields));
    if(strlen($number) == 10){
    $result = curl_exec($con); 
    ob_end_clean();
    $data = new Msg();
    $json = $data->status('success','otp sent to your number');
    echo $json;
    }
    else{

        $data = new Msg();
        $json = $data->status('failed','mobile number is invalid');
        echo $json;
    }

    return $response;
});



$app->get('/exists/{number}', function (Request $request, Response $response, array $args) {
     global $conn;
    $number = $request->getAttribute('number');
     $json = "";
     
    $qry = mysqli_query($conn,"SELECT * FROM users WHERE number = '$number'");  
    if(mysqli_num_rows($qry) > 0){
          
        $data = new Msg();
        if(strlen($number) == 10){
        $json = $data->status('success','yes');
        }
        else{
         $json = $data->status('failed','invalid number');
       
        }
        
    }  
    else{
        $data = new Msg(); 
        if(strlen($number) == 10){
            $json = $data->status('success','no');
            }
            else{
             $json = $data->status('failed','invalid number');
           
            }
        
    }
    echo $json;
    return $response;
});

$app->post('/login', function (Request $request, Response $response, array $args) {
    global $conn,$api;
   $number = $request->getParam('number');
   $otp = $request->getParam('otp');
   $token = $request->getParam('token');

   
   $url = $api.'/login.php';

   $fields = array(
    "otp"=>$otp,
    "number"=>$number,
    "token"=>$token
    );
    
    
   
    $con = curl_init();
    curl_setopt($con,CURLOPT_URL,$url);
    curl_setopt($con, CURLOPT_POST, count($fields));
    curl_setopt($con, CURLOPT_POSTFIELDS, http_build_query($fields));
    if(strlen($number) == 10){
    $result = curl_exec($con); 
    }

   return $response;
});

$app->post('/sign_up', function (Request $request, Response $response, array $args) {
    global $conn,$api;
   $number = $request->getParam('number');
   $otp = $request->getParam('otp');
   $token = $request->getParam('token');
   $name = $request->getParam('name');

   
   $url = $api.'/sign_up.php';

   $fields = array(
    "otp"=>$otp,
    "number"=>$number,
    "name"=>$name,
    "token"=>$token
    );
    
    
   
    $con = curl_init();
    curl_setopt($con,CURLOPT_URL,$url);
    curl_setopt($con, CURLOPT_POST, count($fields));
    curl_setopt($con, CURLOPT_POSTFIELDS, http_build_query($fields));
    if(strlen($number) == 10){
    $result = curl_exec($con); 
    }

   return $response;
});



$app->get('/products/{grp_id}', function (Request $request, Response $response, array $args) {
    require_once('model/get_items.php');
    global $conn;
    $grp_id = $request->getAttribute('grp_id');
    $json = "";

    
    $prd = new getItems();
    $prd_id = $prd->getData($grp_id);

    $prd_data = array();
    foreach($prd_id as $item){
    $prd_detail = new ProductDetails();
    $prd_data[] = $prd_detail->getData($item['product_id'],$grp_id);
    }
    
    echo json_encode($prd_data);
   return $response;
});

$app->get('/group/{prd_id}', function (Request $request, Response $response, array $args) {
    require_once('model/get_grp.php');
    global $conn;
    $prd_id = $request->getAttribute('prd_id');
    $json = "";


    $grp = new getGroup();
    $grp_id = $grp->getData($prd_id);
    echo $grp_id;
   return $response;
});

$app->post('/cart', function (Request $request, Response $response, array $args) {
    
    global $conn;
    $prd_id = $request->getParam('prd_id');
    $user_id = $request->getParam('user_id');
    $qty = $request->getParam('qty');
    $size = $request->getParam('size');
   
    $check = mysqli_query($conn,"SELECT * FROM cart WHERE prd_id = '$prd_id' && user_id = '$user_id'");
   if(mysqli_num_rows($check) < 1){
    $qry = mysqli_query($conn,"INSERT INTO cart (prd_id,user_id,qty,size) VALUES ('$prd_id','$user_id','$qty','$size')"); 
     $msg = "";
    if($qry){
         $status = new Msg();
         $msg = $status->status('success','Product added to cart');
    }
    else{
        $status = new Msg();
        $msg = $status->status('failed','error in adding product');
   }
}
else{
    $status = new Msg();
    $msg = $status->status('failed','Product already added');
  
}
     
    echo $msg;
   return $response;
});


$app->get('/cart/{prd_id}/{user_id}', function (Request $request, Response $response, array $args) {
    
    global $conn;
    $prd_id = $request->getAttribute('prd_id');
    $user_id = $request->getAttribute('user_id');
   
    $check = mysqli_query($conn,"SELECT * FROM cart WHERE prd_id = '$prd_id' && user_id = '$user_id'");
   if(mysqli_num_rows($check) > 0){
    $qry = mysqli_query($conn,"DELETE FROM cart WHERE prd_id = '$prd_id' && user_id = '$user_id'"); 
     $msg = "";
    if($qry){
         $status = new Msg();
         $msg = $status->status('success','Product removed from cart');
    }
    else{
        $status = new Msg();
        $msg = $status->status('failed','error in removing product');
   }
}
else{
    $status = new Msg();
    $msg = $status->status('failed','Product not exists');
  
}
     
    echo $msg;
   return $response;
});



$app->post('/user_details/{user_id}', function (Request $request, Response $response, array $args) {
    
    global $conn;
    $user_id = $request->getAttribute('user_id');
    $locality = $request->getParam('locality');
    $landmark = $request->getParam('landmark');
    $pincode = $request->getParam('pincode');
    $city = $request->getParam('city');
    $state = $request->getParam('state');
    $alt_number = $request->getParam('alt_number');
    $email = $request->getParam('email');
    $latitude = $request->getParam('latitude');
    $longitude = $request->getParam('longitude');
   
    $status = new Msg();
    $msg = "";
    $check = mysqli_query($conn,"SELECT * FROM user_details WHERE user_id = '$user_id'");
    if(mysqli_num_rows($check) < 1){
    $qry = mysqli_query($conn,"INSERT INTO user_details (locality,landmark,pincode,city,state,alt_number,email,latitude,longitude,user_id) VALUES ('$locality','$landmark','$pincode','$city','$state','$alt_number','$email','$latitude','$longitude','$user_id')"); 
    
    if($qry){
        
         $msg = $status->status('success','Details added');
    }
    else{
        
        $msg = $status->status('failed','error in adding details');
   }
}
else{

    $qry = mysqli_query($conn,"UPDATE user_details set locality = '$locality', landmark = '$landmark',pincode = '$pincode', city = '$city', state = '$state', alt_number = '$alt_number', email = '$email', latitude = '$latitude', longitude = '$longitude' WHERE user_id = '$user_id'"); 
   if($qry){
   
    $msg = $status->status('success','Details Updated');
   }
   else{
   
    $msg = $status->status('failed','Cannot update details');

   }
}
     
    echo $msg;
   return $response;
});



$app->get('/bookmark/{prd_id}/{user_id}', function (Request $request, Response $response, array $args) {
    
    global $conn;
    $prd_id = $request->getAttribute('prd_id');
    $user_id = $request->getAttribute('user_id');
    $msg = "";
    $status = new Msg();
    $check = mysqli_query($conn,"SELECT * FROM bookmark WHERE prd_id = '$prd_id' && user_id = '$user_id'");
   if(mysqli_num_rows($check) < 1){ 
    $qry = mysqli_query($conn,"INSERT INTO bookmark (prd_id,user_id) VALUES ('$prd_id','$user_id')"); 
   
    
    if($qry){
        
         $msg = $status->status('success','Added to Favourite');
    }
    else{
       
        $msg = $status->status('failed','error in adding product');
   }
}
else{
    
    $msg = $status->status('failed','Already added');
  
}
     
    echo $msg;
   return $response;
});

$app->delete('/bookmark/{prd_id}/{user_id}', function (Request $request, Response $response, array $args) {
    
    global $conn;
    $prd_id = $request->getAttribute('prd_id');
    $user_id = $request->getAttribute('user_id');
    $msg = "";
    $status = new Msg();
    $check = mysqli_query($conn,"SELECT * FROM bookmark WHERE prd_id = '$prd_id' && user_id = '$user_id'");
   if(mysqli_num_rows($check) > 0){
    $qry = mysqli_query($conn,"DELETE FROM bookmark WHERE prd_id = '$prd_id' && user_id = '$user_id'"); 
    
   
    if($qry){
        
         $msg = $status->status('success','Removed from Favourite');
    }
    else{
       
        $msg = $status->status('failed','error in removing product');
   }
}
else{
    
    $msg = $status->status('failed','Does not exists');
  
}
     
    echo $msg;
   return $response;
});


$app->get('/categories', function (Request $request, Response $response, array $args) {
    require_once('model/categories.php');

    $cat = new Categories();
    $categories = $cat->getData();
    echo $categories;
   
   return $response;
});

$app->get('/start', function (Request $request, Response $response, array $args) {
    require_once('model/start.php');

    $start = new Start();
    $start_data = $start->getData();
    echo $start_data;
   
   return $response;
});


$app->get('/products/discount/{off}', function (Request $request, Response $response, array $args) {
   global $conn;
   $products = array();
    $discount = $request->getAttribute('off');
 $qry = mysqli_query($conn,"SELECT * FROM products WHERE discount = '$discount'"); 
 if(mysqli_num_rows($qry) > 0){
    while($row = mysqli_fetch_array($qry)){
          $grp_id = $row['group_id'];
           $prd = new FirstProduct();
           $products[] = $prd->getData($grp_id);
           
    } 
}
else{
    
}
echo json_encode($products);


   return $response;
});

$app->get('/products/category/{category}', function (Request $request, Response $response, array $args) {
    global $conn;
    $products = array();
    $category = $request->getAttribute('category');
  $qry = mysqli_query($conn,"SELECT * FROM products WHERE category = '$category'"); 
  if(mysqli_num_rows($qry) > 0){
     while($row = mysqli_fetch_array($qry)){
           $grp_id = $row['group_id'];
            $prd = new FirstProduct();
            $products[] = $prd->getData($grp_id);
            
     } 
 }
 else{
     
 }
 echo json_encode($products);
 
 
    return $response;
 });
$app->get('/products/sub_category/{sub_category}', function (Request $request, Response $response, array $args) {
    global $conn;
    $products = array();
    $sub_category = $request->getAttribute('sub_category');
  $qry = mysqli_query($conn,"SELECT * FROM products WHERE sub_category = '$sub_category'"); 
  if(mysqli_num_rows($qry) > 0){
     while($row = mysqli_fetch_array($qry)){
           $grp_id = $row['group_id'];
            $prd = new FirstProduct();
            $products[] = $prd->getData($grp_id);
            
     } 
 }
 else{
     
 }
 echo json_encode($products);
 
 
    return $response;
 });
 $app->get('/products/type/{type}', function (Request $request, Response $response, array $args) {
    global $conn;
    $products = array();
     $type = $request->getAttribute('type');
  $qry = mysqli_query($conn,"SELECT * FROM products WHERE type = '$type'"); 
  if(mysqli_num_rows($qry) > 0){
     while($row = mysqli_fetch_array($qry)){
           $grp_id = $row['group_id'];
            $prd = new FirstProduct();
            $products[] = $prd->getData($grp_id);
            
     } 
 }
 else{
     
 }
 echo json_encode($products);
 
 
    return $response;
 });

 
 $app->get('/place_order/{user_id}', function (Request $request, Response $response, array $args) {
     
    require_once('model/place_order.php');
    $user_id = $request->getAttribute('user_id');
    global $conn;
    $order = new PlaceOrder();
    $order_details = $order->getData($user_id);

  
 
 echo $order_details;
 
 
    return $response;
 });

    $app->get('/order_details/{user_id}', function (Request $request, Response $response, array $args) {
     
    require_once('model/order_details.php');
    $user_id = $request->getAttribute('user_id');
    
    $order = new OrderDetails();
    $order_details = $order->getData($user_id);
       echo json_encode($order_details);
 
 
    return $response;
 });

 $app->get('/cancel_order/{cart_id}', function (Request $request, Response $response, array $args) {
     
    $cart_id = $request->getAttribute('cart_id');
    global $conn;
    
    $order = new Msg();
    $order_details = "";
    $qry = mysqli_query($conn,"DELETE FROM orders WHERE cart_id = '$cart_id'"); 
    if($qry){
    
    $order_details = $order->status('success','order cancelled');
    }
    else{
        $order_details = $order->status('failed','error in cancelling order');
   
    }
 
 echo $order_details;
 
 
    return $response;
 });


$app->run();
