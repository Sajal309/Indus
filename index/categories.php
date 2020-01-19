<?php 
require_once('db/db.php');
global $url;
global $media;
    $curl = curl_init(); 
    curl_setopt_array($curl,array(
       CURLOPT_RETURNTRANSFER => 1,
       CURLOPT_URL => $url ."categories",
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
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,300,500,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <style>
        @media only screen and (max-width:550px) {  
             #block{
                 width:100%;
             }
            }
        @media only screen and (min-width: 550px) {
           #block{
               width: 70%;
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
    #text2{
        font-family: 'Roboto', sans-serif;
        text-align: center;
        padding: 7px 10px 5px 10px;
        background: rgb(240,240,240);
        border-radius:0px 0px 5px 5px;
    }
    #description{
        font-weight: 300;
        font-size:13px;
        color:rgb(100,100,100);
    }
    
    #options{
        background:white;
        box-shadow:0 2px 2px 0 rgba(0,0,0,0.14), 0 3px 1px -2px rgba(0,0,0,0.12), 0 1px 5px 0 rgba(0,0,0,0.2);
        padding: 5px 30px;
        width:54%;
        margin:10px auto 10px auto;
    }
    .material-icons, .icon-text {
      vertical-align: middle;
      padding-bottom:3px;
    }
    #block{   
        display: inline-flex;
        padding: 7px 20px;
        border-bottom: 1px dotted rgba(0,0,0,0.04);
    }
    #icons{
        width: 30px;
        margin-left: 5px;
    }
    
    </style>
   
    
</head>
<body>

    <div id="header"> 
        <div id="back"> <i class="material-icons" id="header_icon"> chevron_lefts</i></div>
        <div id="title"> Categories </div>
        <div id="bag"> <i class="material-icons" id="header_icon"> local_mall</i></div>
    </div>

 <center>
     <div style="padding: 30px;">
            <?php foreach($array as $value){ ?>  
                <a href="products.php?location=category/<?php echo $value;?>/10" >
                <p id="description" style="font-weight: 300px"><?php echo $value; ?> <i class="material-icons"> chevron_rights</i> </p>
                </a>
                <?php  } ?> 
     </div>
 </center>
    
</body>
</html>
