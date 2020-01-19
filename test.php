<form action="" method="GET">
    <input name="name" type="text">
    <input type="submit" value="submit" >
</form>


<?php 
require_once('index/db.php');
global $url;

$number = $_GET['name'];

        $url = "http://studyforfun.000webhostapp.com/Indus/Indus/Api/exists/".$number;
        
    
        $curl = curl_init(); 
        curl_setopt_array($curl,array(
           CURLOPT_RETURNTRANSFER => 1,
           CURLOPT_URL => $url,
       ));

       $res = curl_exec($curl);
       $array = json_decode($res,true);

       foreach($array as $key => $value){
           echo $key ." => ". $value ."<br>";
       }    
   if($value == "no"){
      
       echo "number not exists"; ?>
       <script> 
     window.location = 'index/name.php?<?php echo $number;?>';
     </script>

     <?php
   }else if($value == "yes"){
       echo "number exists";
     ?><script> 
     window.location = 'index/otp.php?<?php echo $number;?>';
     </script>
     <?php
   }else{
    echo "Invalid number";
   }
   
?>








else{
    if(!empty($otp = $_GET['otp'])){
        $_SESSION['otp'] = $otp;
            $url = "http://studyforfun.000webhostapp.com/Indus/Indus/Api/login/";
            
            $curl = curl_init(); 
            curl_setopt_array($curl,array(
               CURLOPT_RETURNTRANSFER => 1,
               CURLOPT_URL => $url,
               CURLOPT_POST => 1,
               CURLOPT_POSTFIELDS => array(
                   "otp" => $otp,
                   "number" => $number  
               )
           ));
    
           if(!$res = curl_exec($curl)){
               die('error : "' . curl_error($curl) . curl_errno($curl));
           }
           $array = json_decode($res,true);
    
           $_SESSION['user_data'] = $array;
    
              
       if($array['status'] == "success"){
          
           echo $array['message']; ?>
           <script> 
         window.location = 'index.php?name=<?php echo $name; ?>';
         </script>
    
         <?php
       }else if($array['status'] == "failed"){
           echo $array['message'];
       }else{
        echo "error";
       }












       http_build_query(array(
        "name" => $name,
        "number" => $number,
        "otp" => $otp
       )),










       if(!empty($otp = $_GET['otp'])){
        echo $_SESSION['code'] = $otp;
             $url = "http://studyforfun.000webhostapp.com/Indus/Indus/Api/sign_up?";
             
     
            $fields = array(
                "name" => $name,
                "number" => $number,
                "otp" => $otp
            );
     
            $curl = curl_init();
     
            curl_setopt_array($curl,array(
             CURLOPT_URL => $url,
             CURLOPT_POST => 1,
             CURLOPT_POSTFIELDS => http_build_query($fields),
             CURLOPT_RETURNTRANSFER => 1
         ));
            $res = curl_exec($curl);
            $array = json_decode($res,true);
            echo $array;
            
            foreach($array as $key => $value){
                echo $key ."=>  ". $value;
            }
     
         if($array['status'] == "success"){
              echo "User Registered" ?>
         <script> 
             window.location = 'index.php?name=<?php echo $name; ?>';
          </script>
     
          <?php
     }else if($array['status'] == "failed"){
         echo "otp not matched";
     }else{
      echo "error";
     }
     }















     <?php foreach($array as $key => $value){ ?> <a href="product_details.php?product_id=<?php foreach($value['images'] as $k => $v){ echo $v['prd_id']; } ?>">
                <div id="top_more">
                    <div id="image_more">
                    <?php foreach($value['images'] as $k => $v){ ?>
                        <img src="<?php echo $media . $v['image']; }?>" alt="alt" width="100%" id="image_image">
                    </div>
                    <div id="text_more" >
                        <p id="brand_more"><?php echo $value['brand_name']; ?></p>
                        <p id="description_more"><?php echo $value['title']; ?></p>
                        <div id="rate_more"><span id="price"><?php echo $value['price']; ?></span> 
                            <span id="old_price_more"><strike>Rs.<?php echo ($value['discount'] / 100 ) * $value['price'] + $value['price'];?></strike></span>
                            <span id="discount_more">(<?php echo $value['discount']; ?>% off)</span>
                        </div>
                    </div>
                </div>
            <?php }  ?>



