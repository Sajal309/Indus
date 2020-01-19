<?php session_start();

if(isset($_SESSION['user_details'])){
    $user_details = $_SESSION['user_details'];
}


require_once('db/db.php');
global $url;
global $media;
    $curl = curl_init(); 
    curl_setopt_array($curl,array(
       CURLOPT_RETURNTRANSFER => 1,
       CURLOPT_URL => $url ."start",
   ));

  	 $res = curl_exec($curl);
     $array = json_decode($res,true);
?>  


<!DOCTYPE html>
<html>
<head>  
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Indus</title>

    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,500" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
       @media only screen and (max-width:550px) {
            #categories_icon,#bag_icon,#notification_icon,#login_icon{
                margin-top: 10px;
                display: block;
             } 
             #categories,#bag,#notification,#login{
                 display: none;
             }
             #top{
                width:47%;
             }
             #offer_image{
                width:100%;
                }
                #img_small{
                    width:100%; 
                    height: 250px;
            }
          #deals{
           padding:10px 0px;
         }
         #description{
              width: 90%;
          } 
        }
        @media only screen and (min-width: 550px) {
            #categories_icon,#bag_icon,#notification_icon,#login_icon{
                display: none;
             }
             #categories,#bag,#notification,#login{
                 display: block;
             }
             
             #offer_image{
               width: 70%;
               margin-left:15%;
            }   
            #img_small{
                width:250px;
                height:330px; 
            }
             #deals{
                padding:15px 20px 0px 20px;
        }
        #description{
             width: 225px;
         }
      }
#header{  
        background:white;
        width:100%;
        border-bottom:1px solid rgb(200,200,200);
        display: inline-flex;
        padding: 10px 10px;
    }
    #header_icon{
        font-size: 25px;
        color: rgb(100,100,100);
    }
    #title{
        text-align: center;
        width:60%;
    }
   #logo_image{
        width: 130px;
        vertical-align: middle;
   }
    #categories,#bag,#notification,#login{
        width:10%;
        text-align: center;
        font-family: 'Roboto',sans-serif;
        font-size: 14px;
        color:rgb(100,100,100);
        vertical-align: middle;
        font-style: italic;
        font-weight: 500;
        padding-top:10px;
    }
    #login a, #bag a, #categories a, #notification a{
        color:rgb(100,100,100);
    }
    #categories_icon,#bag_icon,#notification_icon,#login_icon{
        padding: 0px 10px 0px 10px;
        text-align: center;
        font-family: 'Roboto',sans-serif;
        font-size: 16px;
        color:rgb(100,100,100);
    }
    .material-icons, .icon-text {
      vertical-align: middle;
      padding-bottom:3px;
    }
    #search{
        width:85%;
        margin:15px auto 10px auto;
        display: flow-root;
        border-radius:5px;
        background: rgb(250,250,250);
        box-shadow:0 2px 2px 0 rgba(0,0,0,0.14), 0 3px 1px -2px rgba(0,0,0,0.12), 0 1px 5px 0 rgba(0,0,0,0.2);
    }
    #search_icon{
        padding:6px 20px;
        font-size:32px;
        color:rgb(100,100,100);
    }
    #search_box{
        padding:5px;
    }
    #search_input{
        border:0;
        width:70%;
        background: rgb(250,250,250);
        font-family: 'Roboto',sans-serif;
        color:rgb(100,100,100);
        font-size: 18px;
        padding:6px;
    }
    textarea:focus, input:focus{
    outline: none;
    }
    #offer{
        background:rgb(255,255,255);
        margin:20px 0px 0px 0px;
    }
    
    #Offer_image{
        margin:10px 0px;
        overflow:hidden;   
    }
    #offer_image img{
        width:100%;
        object-fit: cover;
    }
    
    #top_deals{
        background: rgb(250,250,250);
        padding-top:15px;
    }
    #options{
        background:rgb(255,255,255);
        width:100%;
        margin:5px 0px 10px 0px;
        box-shadow: 1px 1px 2px rgb(200,200,200);
        display: flow-root;
    }
    #now_title{
        text-align: center;
        font-family: 'Roboto',sans-serif;
        font-size: 17px;
        padding:10px;
        color:rgb(100,100,100);
        vertical-align: middle;
        font-style: italic;
        font-weight: 500;
    }
    #top{
        background:white;
        margin:5px;
        float: left;
        box-shadow: 1px 1px 2px rgb(200,200,200);
    }
    
    #top:hover{
        box-shadow: 0 0 3px rgb(0,0,0,0.5);
    }
    
    #text{
        font-family: 'Roboto', sans-serif;
        text-align: center;
        padding: 10px 10px 14px 10px;
        background: rgb(240,240,240);
    }
    #text2{
        font-family: 'Roboto', sans-serif;
        text-align: center;
        padding: 5px 10px 5px 10px;
        background: rgb(240,240,240);
    }
    #brand{
        font-weight: 700;
        font-size:14px; 
        color:rgb(51, 51, 51);
    }
    #description{
        font-weight: 300;
        font-size:13px;
        color:rgb(100,100,100);
        font-weight: 300;
         font-size:13px;
         color:rgb(100,100,100);
         line-height:0.5;
         white-space: nowrap; 
         text-overflow: ellipsis; 
         text-align: center;
         margin-left: auto;
         margin-right: auto;
    }
    #rate{
        font-style:normal;
        font-size:12px;
        color:rgb(51, 51, 51);
    }
    #price{
        padding:0 3px;
        font-weight: 700;
    }
    #old_price{
        color:rgb(120,120,120);
        padding: 0 1px;
            }
    #discount{
        color:red;
        padding: 0 1px;
    }
    #category{
        vertical-align: middle;
        align-content: center;
        text-align: center;
        font-family: 'Roboto',sans-serif;
        font-size: 18px;
        color:rgb(100,100,100);
        font-style: italic;
        font-weight: 500;

    }
   #deals{
        width:100%;
        display: inline-block;
        min-height: 300px;
    }
    #deals a{
        color:white;
    }
    #top_sec{
        background: rgb(100,100,100);
        height:50px;
        margin-top:10px;
        
        }
        #social_icons{
            vertical-align: middle;
            text-align: center;
        }
        #social_icons a{
            color: white;
            text-decoration: none;
            text-align: center;
            vertical-align: middle;
            font-size: 30px;
            padding: 10px 5%;
        }
        #social_icons a:hover{
            color: rgb(32, 189, 153);
        }
        #list_div{
            background:rgb(240,240,240);
            padding:30px;
            height:300px;
            border-right: 1px dotted rgba(0,0,0,0.12);
        }
        #sec1{
            float: left;
            padding-right:12px;
        }
    #sec2, #sec3{
        background:rgb(240,240,240);
        height:300px;
        padding: 30px;
        border-right: 1px dotted rgba(0,0,0,0.12);
    }
    
    #paytm{
        margin:5px 0px;
        width:150px;
        clear: left;
    }
    #playstore{
        margin:5px 0px;
        width:250px;
        clear: left;
    }
    .title_last{
        padding-top:7px; 
    }
    #footer{
        margin-top:20px;
    }
    #footer_links{
        line-height: 2;
        font-weight: 300;
        font-size:13px;
        color:rgb(100,100,100);
    }
    #footer_links a{
        color:rgb(100,100,100);
    }
  
    #img_box{
       display:inline-block;  
       overflow:hidden;
    }
    #img_small img{
        height: 100%;
        object-fit: cover;
    }
    </style>
</head>
<body>
    <div id="main" class="main" >

            <div id="header"> 
                <div id="login" class="icon-text"><a href="login.php"><i class="material-icons" id="header_icon">person</i> Login/SignUp</a></div>
                <div id="login_icon" ><a href="login.php"><i class="material-icons" id="header_icon">person</i></a></div>
                <div id="title"><img src="logo.png" id="logo_image"></div>
                <div id="categories" class="icon-text"> <a href="categories.php"><i class="material-icons" id="header_icon">list</i> Categories</a></div>
                <div id="bag" class="icon-text"> <a href="cart.php"><i class="material-icons" id="header_icon">local_mall</i> Bag</a></div>
                <div id="notification" class="icon-text"><a href="notification.php"> <i class="material-icons" id="header_icon">notifications_active</i> Notifications</a></div>
                <div id="categories_icon" > <a href="categories.php"><i class="material-icons" id="header_icon">list</i></a></div>
                <div id="bag_icon" ><a href="cart.php"><i class="material-icons" id="header_icon">local_mall</i> </a> </div>
                <div id="notification_icon" ><a href="notification.php"><i class="material-icons" id="header_icon">notifications_active</i></a>  </div>  
            </div>

            <div id="search" class="search">
                <div id="search_box"> <i class="material-icons" id="search_icon">search</i>
                    <input id="search_input" type="search" placeholder="Search here...">
                </div>   
            </div>


            <div id="offer" class="offer">
                <!-- offers php starts here-->
            <?php foreach($array['offers'] as $key => $value){ ?> 
                <a href="products.php?location=discount/<?php echo $value['discount'];?>/15" >
                <div id="offer_image" >
                    <img src="<?php if( $value['pic'] == null){
                                    echo "b1.jpg";}else{echo $media.$value['pic'];} ?> ">
                </div>
            </a>
                <?php } ?>
            </div>
            

             <div id="top_deals" class="top_deals">
                    <div id="options">
                            <div id="now_title"><a style="color:rgb(100,100,100)">Top Brands</a></div>
                        </div>
                   
                <div id="deals" style="min-height:300px;">  
                <!-- Brands php starts here-->
                <?php foreach($array['brands'] as $key => $value){ ?> 

            <a href="products.php?location=brand/<?php echo $value['name'];?>/10">
                        

                    <div id="top" >
                        <div id="img_small">
                            <img src="<?php if( $value['image'] == null){
                                echo "shoes.jpg";}else{echo $media.$value['image'];} ?>" alt="alt"  width="100%" id="image_image">
                        </div>
                        <div id="text2" >
                                <div><div id="category"> <?php echo $value['name'];?> <i class="material-icons"> done_all</i> </div>
                                    <p id="description" class="title_last"> <?php if( $value['title'] == null){
                                echo "Men White Sneakers";}else{echo $value['title'];} ?></p> 
                                    <div id="category"><p id="description" style="margin-bottom: 0px;">View All <i class="material-icons" > arrow_forward</i></p></div>
                                </div>            
                        </div>
                    </div>
            </a>
                    
                    <!-- Brands php ends here-->
                    <?php } ?>

                </div>    
            </a>                 
            </div>   

             <div id="top_deals" class="top_deals">
                    <div id="options">
                            <div id="now_title"><a style="color:rgb(100,100,100)">Shop Now</a></div>
                        </div>
                   
                <div id="deals" style="min-height:300px;">  
                <!-- Brands php starts here-->
                <?php foreach($array['shop_now'] as $key => $value){ ?> 

            <a href="products.php?location=brand/<?php echo $value['name'];?>/10">
                        

                    <div id="top" >
                        <div id="img_small">
                            <img src="<?php if( $value['image'] == null){
                                echo "shoes.jpg";}else{echo $media.$value['image'];} ?>" alt="alt"  width="100%" id="image_image">
                        </div>
                        <div id="text2" style="padding:10px 0px;">
                                <div><div id="category" style="color:rgb(0,0,0,0.9)"> <?php echo $value['name'];?> <i class="material-icons"> done_all</i> </div>
                                   
                                    <div id="category"><p id="description" style="margin-bottom: 0px;">View All <i class="material-icons" > arrow_forward</i></p></div>
                                </div>            
                        </div>
                    </div>

                       
            </a>
                    
                    <!-- Brands php ends here-->
                    <?php } ?>

                </div>    
            </a>                 
            </div>   
            
            
            <div id="top_deals" class="top_deals">
                    <div id="options">
                            <div id="now_title"><a style="color:rgb(100,100,100)">Top Deals</a></div>
                        </div>

                <div id="deals" >
                
                    <!-- top deals starts here -->

                    <?php foreach($array['top_deals'] as $key => $value){ ?>
                        <a href="product_details2.php?product_id=<?php echo $value['images'][0]['prd_id'] ; ?>&group_id=<?php echo $value['grp_id'];?>">
                    <div id="top">
                            <div id="img_small">
                                <img src="<?php if(  $value['images'][0]['image'] == null){
                                echo "shoes.jpg";}else{echo $media. $value['images'][0]['image'];} ?>" alt="alt"  width="100%" id="image_image">
                            </div>
                            <div id="text" >
                                 <p id="brand"><?php echo $value['brand_name']; ?></p>
                                 <p id="description"><?php if(strlen($value['title']) > 27){
                                        echo substr($value['title'],0,27)."...";
                                 }else{echo $value['title'];}?></p>
                                 <div id="rate"><span id="price"><?php echo $value['price'];?> </span> 
                                     <span id="old_price"><strike>
                                         <?php echo ($value['discount'] / 100 ) * $value['price'] + $value['price'];?>
                                        </strike></span>
                                     <span id="discount">(<?php echo $value['discount'];?>% off)</span>
                                 </div>
                            </div>
                    </div>
                                </a>
                    <!-- top deals ends here -->
                    <?php } ?>
                </div>
                
                                                             
            </div>   
    </div>       
     
    
    <div id="footer" >
        <div id="top_sec" class="col-sm-12">
            <div id="social_icons" >
                <a href="#" class="fa fa-facebook"></a>
                <a href="#" class="fa fa-instagram"></a>
                <a href="#" class="fa fa-twitter"></a>
                <a href="#" class="fa fa-google"></a> 
            </div>  
        </div>
<div id="list_div" class="col-sm-4">
    <div id="sec1" >
        <label id="brand">Top Items </label>
        <ul style="list-style-type:none;" id="footer_links">
            <li><a >Shirts</a></li>
            <li><a>T-shirts</a></li>
            <li><a>Jeans</a></li>
            <li><a>Watches</a></li>
            <li><a>Sun-Glasses</a></li>
            <li><a>Accessories</a></li>
        </ul>
    </div>
    <div id="sec1" >
            <label id="brand">Useful Links </label>
            <ul style="list-style-type:none;" id="footer_links">
                <li><a>Shirts</a></li>
                <li><a>Contact us</a></li>
                <li><a>FAQ</a></li>
                <li><a>Terms&condition</a></li>
                <li><a>Payments</a></li>
                <li><a>Cancellation</a></li>
            </ul>
    </div>
</div>
        <div id="sec2" class="col-sm-4">
            <label id="brand">Payment Options </label><br>

    <img src="paytm.png" id="paytm">
       <img src="cod.png" id="paytm" > 

       <br>

       <label id="brand">Get Indus on play store </label><br>

       <img src="gplay.png" id="playstore">
         
        </div>

        <div id="sec3" class="col-sm-4">
                <label id="brand">About us </label>
                <ul style="list-style-type:none;">
                    <li id="brand" style="line-height: 2;color: rgb(120,120,120);font-weight:500">Address. Bhopal Madhya Pradesh</li>
                    <li id="brand"  style="line-height: 2;color: rgb(120,120,120);font-weight:500">Email. sajalrai96309@gmail.com</li>
                    <li id="brand"  style="line-height: 2;color: rgb(120,120,120);font-weight:500">Contact No. 6261541723</li>
                    <li id="brand"  style="line-height: 1.8;color: rgb(120,120,120);font-weight:500">&copy; 2018 <a style="color: rgb(10,10,10);font-size: 16px;"> www.indus.com </a></li>
                    <li id="brand"  style="line-height: 1.8;color: rgb(120,120,120);font-weight:500"> All rights reserved</li>
                    <li id="brand"  style="line-height: 1.8;color: rgb(120,120,120);font-weight: 500">Developed by @ Cool.Inc</li>
                    </ul>
        </div>

    </div>

</body>
</html>

<?php
curl_close($curl);
?>