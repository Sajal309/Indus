<?php session_start();
    $user_details = $_SESSION['user_details'];
    require_once('db/db.php');
    global $url;
    global $media;
?> 

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Cart</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script> 
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,300,500,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
<?php
        $cart = $user_details['cart'];
        foreach($cart as $key => $value){
        echo $value['prd_id'] ."<br>";

    $curl = curl_init(); 
    curl_setopt_array($curl,array(
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_URL => $url . "products/item/" . $value['prd_id']
        ));

  	 $res = curl_exec($curl);
     $array = json_decode($res,true);
      
     foreach($array as $k => $v){
         foreach($v as $name => $details){
             echo $name ." => ". $details; }}}?>
    <div class="cart">
        <div id="image_div">
     
                <img src="<?php echo $media . $details['images'][0]['image'];?>">
        </div>
            <p><?php echo $details?></p>
            <p><?php echo $details['title'];?></p>
        <div id="size_div">
            <p><span>Size : </span> 8</p>
            <p><span>Quantity : </span> 1</p> 
            <p id="quantity" style="background:rgb(30,50,50);border: 1px solid rgb(50,50,50)"> -</p>
            <p id="quantity" style="background:#307a74;border: 1px solid #307a74"> +</p>
        </div>
        <div id="rate"><span id="price"><?php echo $details['price'];?> </span> 
            <span id="old_price"><strike>
                <?php echo ($details['discount'] / 100 ) * $details['price'] + $details['price'];?>
               </strike></span>
            <span id="discount">(<?php echo $details['discount'];?>% off)</span>
        </div>
   
    </div>
</body>
</html>