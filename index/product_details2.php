<?php 
    require_once('db/db.php');
    global $url;
    global $media;
    $item = $_GET['product_id'];
    $grp_id = $_GET['group_id'];
    $curl = curl_init(); 
    $curl2 = curl_init(); 
    curl_setopt_array($curl,array(
       CURLOPT_RETURNTRANSFER => 1,
       CURLOPT_URL => $url . "products/item/" . $item
       ));
    curl_setopt_array($curl2,array(
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_URL => $url . "products/group/" . $grp_id
    ));
    $mh = curl_multi_init();
    curl_multi_add_handle($mh,$curl);
    curl_multi_add_handle($mh,$curl2); 
    $run = null;
    do{
        curl_multi_exec($mh,$run);
    }while($run);
    
    curl_multi_remove_handle($mh,$curl);
    curl_multi_remove_handle($mh,$curl2);
    curl_multi_close($mh);
    $response = curl_multi_getcontent($curl);
    $response2 = curl_multi_getcontent($curl2);
    $details = json_decode($response,true);
    $similar = json_decode($response2,true);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Products</title>
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,300,500,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

   <style>
 @media only screen and (max-width:550px) {
            #main{
              min-width:360px;
   			}
   			#details{
              min-width:360px;
   			}
   
            #top_more{
                width:200px;
             }
            #img_box{
                display:inline-block;
            }
             #list_image{
                margin:5px;
                display:inline-flex;
             }
             #img_small{
                float: left;
                width:100px;
       			height:140px;
                margin-left:7px;
            }     
            #image{
                width:100%;
            }
            #img_more{
                    width:100%; 
                    height:250px;
            }
            #main{
                padding:5px;
            }
            #save{
                padding:7px 25px;
                width:350px;
                background:rgb(255, 104, 104);
                border:1px solid rgb(255, 104, 104)
            }
            #addtocart{
                padding:7px 25px;
                width:350px;
                background:rgb(32, 189, 153);
                border:1px solid rgb(32, 189, 153);
            }
            #details{
                padding-left: 10px;
            }
    }
    @media only screen and (min-width: 550px) {
            #main{
                padding:50px;
                display: inline-flex;
            }
             #top_more{
                width:250px;
             }
            #image{
                height:720px;
                width:640px;
            }   
            #img_small{
                width:100px;
                height:140px;
            }
            #img_more{
                width:250px;
                height:300px; 
            }
            #list_image{
                width:10%;
                float: left;
                min-width: 120px;
            }
            #details{
                width:36%;
                min-width: 360px;
                padding-left:40px;
            }
            #save{
                padding:7px 32px;
                background:rgb(255, 104, 104);
                border:1px solid rgb(255, 104, 104);
            }
            #addtocart{
                padding:7px 30px;
                background:rgb(32, 189, 153);
                border:1px solid rgb(32, 189, 153);
            }
    }
    textarea:focus, input:focus, button:focus{
        outline: none;
    }
    body{
        background: rgb(250,250,250);
    }
    #header{  
        background:white;
        width:100%;
        border-bottom:1px solid rgb(200,200,200);
        display: inline-flex;
        padding: 5px 20px 5px 20px;
    }
    #header_icon{
        font-size: 28px;
        color: rgb(100,100,100);
    }
    #back{
        padding:5px;
        text-align:center;
        width:10%;
    }
    #title{
        width: 80%;
        text-align: center;
        font-family: 'Roboto',sans-serif;
        font-size: 18px;
        padding:10px 0px;
        color:rgb(100,100,100);
        font-weight: 700;
    }
    #bag{
        padding:5px;
        text-align: center;
        width:10%;
    }
    
    .material-icons, .icon-text {
      vertical-align: middle;
      padding-bottom:3px;
    }
    
    #img_box{
       display:inline-block;
    }
    #img_small{
       overflow:hidden;
       float: left;
        margin-bottom: 10px;
    }
    #img_small img{
        height:100%;
        width: 100%;
        object-fit: cover;
    }
    #img_small:hover{
        box-shadow: 0 0 3px black;
    }
    #main_image{
        float: left;
    }
    #image{
        overflow:hidden; 
    }
    #image img{
        width:100%;
        object-fit: cover;
    }
    #details{
        float: left;
    }
    #text{
        display:block;
        margin:10px 0px;
        padding:10px 0px;
        font-family: 'Source Sans Pro', sans-serif;
        border-bottom: 1px dotted rgb(100,100,100,0.2);     
    }

    #brand{
        font-size:19px;
        color:rgb(55, 68, 43);
        font-family: 'Roboto',sans-serif;
        font-weight: 400;  
        line-height:0.7;
            }
    #description{
        font-weight:500;
        font-size:17px;
        color:rgb(100,100,100);
    }
    #rate{
        font-style:normal;
        font-size:16px;
        color: rgb(70,70,70,0.8);
        padding-left:5px;
    }
    #price{
        font-weight: 700;
    }
    #old_price{
        color:rgb(50,50,50,0.7);
        font-weight: 500px;
        line-height:0.5px;
        }
    #discount{
        color:red;
    }
    #span{
        font-family: 'Sans Source Pro',sans-serif;
        font-size: 14px;
        color:rgb(130,130,130);
        vertical-align: middle;
        font-style: italic;
        font-weight: 400;
    }
    #size_p, #color_p{
        border: 1px solid rgb(0,0,0,0.4);
        border-radius:50px;
        padding:15px;
        text-align: center;
        width:50px;
        height:50px;
        float: left;
        margin-left:7px;
        margin-right:7px;
        font-family: 'Roboto',sans-serif;
        color: rgb(0,0,0,0.7);
        font-weight: 500;
        font-size: 16px;
        background: transparent;
    }
    #save, #addtocart{
        border-radius: 4px;
        margin: 5px 5px;
        font-weight: 500;
        font-family: 'Roboto',sans-serif;
        color:white;
    }
    
    #size, #color{
        padding:10px 0px;
        border-bottom: 1px dotted rgb(100,100,100,0.2);    
    }
     #more_details{
       padding-bottom:10px;
     }
    #container{
        display: inline-flex;
    }
    #actions{ 
        width:100%;
        min-width:360px;
        padding:10px 0px;
        display: block;
        border-bottom: 1px dotted rgb(100,100,100,0.2);    
    }
    #details_text{
        font-style: normal;
        font-size:13px;
        color:rgb(148, 152, 159);
        font-family: 'Roboto',sans-serif;
        vertical-align: middle;
        font-weight: 400;
    }
    </style>

       <style>
        
           
    #size_p:focus, #color_p:focus{
        box-shadow: 0 0 4px black;
    }
    #size_p:hover, #color_p:hover{
        box-shadow: 0 0 3px black;
    }
    #save:hover, #addtocart:hover{
        box-shadow: 0 0 5px black;
    }
       </style>
<style>
        @media only screen and (max-width:550px) {
              .top{
                 width:47%;
              }
             
                 .img_small{
                     width:100%; 
                     height: 250px;
             }
          .deals{
            padding:10px 0px;
          }
          .description{
              width: 90%;
          }
             
         }
         @media only screen and (min-width: 550px) {
            
             .img_small{
                 width:250px;
                 height:330px; 
             }
             .deals{
                 padding:15px 20px 0px 20px;
         }
         .description{
             width: 225px;
         }
       }

   
    
     .material-icons, .icon-text {
       vertical-align: middle;
       padding-bottom:3px;
     }
     
     textarea:focus, input:focus{
         outline: none;
     }
     .top{
         background:white;
         margin:5px;
         float: left;
         box-shadow: 1px 1px 2px rgb(200,200,200);
     }
    
     .top:hover{
        box-shadow: 0 0 3px rgb(0,0,0,0.5);
    }
     
     .text{
         font-family: 'Roboto', sans-serif;
         text-align: center;
         padding: 10px 10px 14px 10px;
         background: rgb(240,240,240);
     }
    
     .brand{
         font-weight: 700;
         font-size:14px; 
         color:rgb(51, 51, 51);
     }
     .description{
         font-weight: 300;
         font-size:13px;
         color:rgb(100,100,100);
         white-space: nowrap; 
         line-height: 0.5;
         text-overflow: ellipsis; 
         text-align: center;
         margin-left: auto;
         margin-right: auto;
     }
     .rate{
         font-style:normal;
         font-size:12px;
         color:rgb(51, 51, 51);
     }
     .price{
         padding:0 3px;
         font-weight: 700;
     }
     .old_price{
         color:rgb(120,120,120);
         padding: 0 1px;
             }
     .discount{
         color:red;
         padding: 0 1px;
     }
    
    .deals{
         width:100%;
         display: inline-block;
         min-height: 300px;
     }
     .deals a{
         color:white;
     }
   
     .img_box{
        display:inline-block;  
        overflow:hidden;
     }
     .img_small img{
         height: 100%;
         object-fit: cover;
     }
     .top_deals{
        background: rgb(250,250,250);
        padding-top:15px;
        padding-bottom: 15px;
    }
    .options{
        background:rgb(255,255,255);
        width:100%;
        margin:5px 0px 10px 0px;
        box-shadow: 1px 1px 2px rgb(200,200,200);
        display: flow-root;
    }
    .now_title{
        text-align: center;
        font-family: 'Roboto',sans-serif;
        font-size: 17px;
        padding:10px;
        color:rgb(100,100,100);
        vertical-align: middle;
        font-style: italic;
        font-weight: 500;
    }

    
     </style>
</head>
<body>

    <div id="header"> 
        <div id="back"> <i class="material-icons" id="header_icon"> chevron_lefts</i></div>
        <div id="title"> <?php foreach($details as $key => $value){ echo $value['brand_name']; } ?> </div>
        <div id="bag"> <i class="material-icons" id="header_icon"> local_mall</i></div>
    </div>

    <div id="main" >
            <?php foreach($details as $key => $value){ ?>
        
        <div id="list_image" >
            <div id="img_box">
            <?php foreach($value['images'] as $k => $v){ ?>
                <div id="img_small">
                      <img src="<?php echo $media . $v['image']; ?>" alt="alt" id="change_image" onmouseover="myfunc(this);" >   
                </div> 
            <?php } ?>
            </div>  
        </div>  
        
        <div id="main_image" >
             <div id="image" >
                    <img src="<?php echo $media . $value['images'][0]['image']; }?>" alt="alt" id="myfunc_image">
            </div> 
        </div>
            <div id="details" >
                    <div id="text" >
                            <p id="brand" ><?php echo $value['brand_name'];?></p>
                            <p id="description" style="margin-top:-5px;"> <?php echo $value['title'];?> </p>
                            <div id="rate"><p id="price"><span id="span">Price : </span><?php echo $value['price'];?> </p> 
                                <p id="old_price" ><span id="span">Old Price : </span><strike> Rs. <?php echo ($value['discount'] / 100 ) * $value['price'] + $value['price'];?></strike></p>
                                <p id="discount"><span id="span">Discount : </span> (<?php echo $value['discount'];?>% off)</p>
                            </div>
                    </div>
                    <div id="additional">
                            <div id="size">
                                <p id="description" style="margin-top:10px">Select size</p>
                                <div id="container">
                                <?php foreach($value['size'] as $k => $v){ ?>
                                    <button id="size_p"><?php echo $v['size']; ?></button>
                                <?php } ?>
                                 </div>
                            </div>
                            <div id="color">
                                    <p id="description" style="margin-top:10px;">Select colour</p>
                                    <div id="container">
                                    <?php foreach($value['colors'] as $k => $v){ ?>
                                        <button id="color_p" style="background: <?php echo $v['color']; ?>"></button>
                                        <?php } ?>
                                    </div>
                                 </div>
                    </div>
                    <div id="actions">   
                            <button id="save" >BOOKMARK <i class="material-icons"> favorite</i></button>
                            <button id="addtocart" >ADD TO BAG   <i class="material-icons">local_mall </i></button>
                    </div>
                    <div id="more_details">
                            <p id="description" style="margin-top:10px;">More Details</p>
                                <ul>
                                    <?php foreach($value['details'] as $k => $v){ ?>
    
                                    <li><p id="details_text"><?php echo $v['point']; ?></p></li>
                                    <?php } ?>
                                    <li><p id="details_text"><?php if($value['is_cod'] == 1){
                                        echo "Cash on delivery available";}
                                        else{
                                            echo "Casn on delivery not available";
                                        } ?></p></li>
                               </ul> 
                        </div>
            </div>
            
    </div>

    <div  class="top_deals">
            <div class="options">
                <div class="now_title"><a style="color:rgb(100,100,100)">View Similar</a></div>
            </div>
            <div class="deals" >
            <?php foreach($similar as $key => $value){ ?>
        <a href="product_details.php?product_id=<?php foreach($value['images'] as $k => $v){ echo $v['prd_id']; } ?>&group_id=<?php echo $value['grp_id'];?>">
        <div class="top">
                <div class="img_small">
                    <img src="<?php echo $media . $value['images'][0]['image']; ?>" alt="alt" width="100%" class="image_image">
                </div>
                <div class="text" >
                    <p class="brand"><?php echo $value['brand_name']; ?></p>
                    <p class="description"><?php if(strlen($value['title']) > 27){
                                        echo substr($value['title'],0,27)."...";
                                 }else{echo $value['title'];}?></p>
                    <div class="rate"><span class="price">₹<?php echo $value['price']; ?></span> 
                        <span class="old_price"><strike>₹<?php echo ($value['discount'] / 100 ) * $value['price'] + $value['price'];?></strike></span>
                        <span class="discount">(<?php echo $value['discount']; ?>% off)</span>
                    </div>
                </div>
        </div>
                    </a>
<?php }  
curl_close($curl);?>
            </div>
            
        </div>  
<script>
function myfunc(imgs){
    var myfunc_image = document.getElementById("myfunc_image");
    myfunc_image.src = imgs.src;
}

</script>                                                  
    </body>
</html>