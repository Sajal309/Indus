<?php 
require_once('db/db.php');
global $url;
global $media;
$where = $_GET['location'];
    $curl = curl_init(); 
    curl_setopt_array($curl,array(
       CURLOPT_RETURNTRANSFER => 1,
       CURLOPT_URL => $url . "products/" . $where
   ));

  	 $res = curl_exec($curl);
     $array = json_decode($res,true);
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
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <style>

textarea:focus, input:focus, button:focus{
        outline: none;
    }
    .material-icons, .icon-text {
      vertical-align: middle;
      padding-bottom:3px;
    }
    #header{  
        background:white;
        width:100%;
        border-bottom:1px solid rgb(200,200,200);
        display: inline-flex;
        padding: 5px 0px 5px 0px;
    }
    #header_icon{
        font-size: 28px;
        color: rgb(52, 52, 49);
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
        letter-spacing: 1px;
        font-size: 17px;
        padding:10px 0px;
        color:rgb(52, 52, 49);
        font-weight: 700;
    }
    #bag{
        padding:5px;
        text-align: center;
        width:10%;
    }
    #options{
        background:white;
        width:85%;
        margin:10px auto 10px auto;
        box-shadow:0 2px 2px 0 rgba(0,0,0,0.14), 0 3px 1px -2px rgba(0,0,0,0.12), 0 1px 5px 0 rgba(0,0,0,0.2);
        display: flow-root;
    }
   
    #filter,#sort,#type{
        float: left;
        width:33.3%;
        padding: 10px;
        text-align: center;
        font-family: 'Roboto',sans-serif;
        font-size: 16px;
        font-weight: 700;
    }
  
    </style>
   

         <style>
       @media only screen and (max-width:550px) {
           
             #top{
                width:47%;
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

   
    
    #top_deals{
        background: rgb(250,250,250);
        padding-top:15px;
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

    <div id="header"> 
        <div id="back"> <i class="material-icons" id="header_icon"> chevron_lefts</i></div>
        <div id="title">SHOP NOW</div>
        <div id="bag"> <i class="material-icons" id="header_icon"> local_mall</i></div>
    </div>


    <div id="options" >
        <div id="sort" class="icon-text">SORT <i class="material-icons">sort</i></div>
        <div id="type" class="icon-text">TYPE <i class="material-icons">equalizer</i></div>
        <div id="filter" class="icon-text">FILTER <i class="material-icons">style</i></div>
    </div>



                   
                <div id="deals" >              
                    <!-- top deals starts here -->
                    <?php foreach($array as $key => $value){ ?>
                    
                        <a href="product_details.php?product_id=<?php echo $value['images'][0]['prd_id']; 
                        ?>&group_id=<?php echo $value['grp_id'];?>">    
                            
                    <div id="top">
                            <div id="img_small">
                                <img src="<?php if(  $value['images'][0]['image'] == null){
                                echo "shoes.jpg";}else{echo $media. $value['images'][0]['image'];} ?>" alt="alt"  width="100%" id="image_image">
                            </div>
                            <div id="text" >
                                 <p id="brand"><?php echo $value['brand_name']; ?></p>
                                 <p id="description"><?php if(strlen($value['title']) > 27){
                                        echo substr($value['title'],0,27)."...";
                                 }else{echo $value['title'];}?> </p>
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
                
     

</body>
</html>

