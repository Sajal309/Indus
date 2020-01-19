<?php 
session_start();
require_once('db/db.php');
global $url;

if(isset($_GET['number'])){
    $number = $_GET['number'];
    $name = $_GET['name'];
    $password = $_GET['password'];
 

$_SESSION['number'] = $number;
$_SESSION['name'] = $name;
$_SESSION['passwrd'] = $password;

$fields = array(
    "name" => $name,
    "number" => $number,
    "password" => $password
);

        $url = "http://studyforfun.000webhostapp.com/Indus/Indus/Api/exists/".$number;
        
    
        $curl = curl_init(); 
        curl_setopt_array($curl,array(
           CURLOPT_RETURNTRANSFER => 1,
           CURLOPT_URL => $url,
           CURLOPT_POST=>1,
           CURLOPT_POSTFIELDS => http_build_query($fields)
       ));

       $res = curl_exec($curl);
       $array = json_decode($res,true);

       foreach($array as $key => $value){
           echo $key ." => ". $value ."<br>";
       }    
   if($value == "yes"){
      
       echo "Account Created";?>
       <script> 
     window.location = 'index.php?name=<?php echo $name;?>';
     </script>

     <?php
   }else if($value == "no"){
      echo "Invalid number";

  }else{
   echo "error";
  }
}
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
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,500i" rel="stylesheet">

<style>
@media only screen and (max-width:550px) {
   #main{
       width:100%;
   }
  .container{
     	width:100%;
        height:445px;
  }
}
@media only screen and (min-width: 550px) {
   #main{
       width: 100%;
       padding: 60px 80px;
   }
  .container{
    width:390px;
    height:485px;
  }
}
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
    #main{
       background-image: linear-gradient(180deg, #fdfcfb 0%, #e2d1c3 100%);
    }
   .container {
        position: relative;
        text-align: center;
        color: white;
     	background:white;
    }
    #img{
        padding:30px 25px 0px 25px;
        width:300px;
    }
    .centered {
        position: absolute;
        top: 65%;
        left: 50%;
        transform: translate(-50%, -50%);
    }
   #actions{ 
        padding:0px 0px;
        display: block; 
    }
    #save{
        border-radius: 4px;
        margin: 20px 5px;
        font-weight: 500;
        font-family: 'Roboto',sans-serif;
        color:white;
        width: 330px;
        padding:7px 25px;
        background:#ef4023;
        border:1px solid #ef4023;
    }
    #input_div{
        
        margin: 10px 5px;
        color:rgb(100,100,100);
        display: inline-flex;
    }   
    #number{
        font-weight: 500;
        font-family: 'Roboto',sans-serif;
        color:rgb(30,30,30);
        padding:5px 5px 5px 5px;
        margin-left:7px;
        width:290px;  
        vertical-align: center;
        border: none; 
        border-bottom: 0.4px solid rgb(0,0,0,0.5);
   }  
   #description{
        font-weight:300;
        font-size:13px;
        color:rgb(120,120,120);
        line-height: 0.5;
        font-family: 'Roboto', sans-serif;
        text-align: center;
        padding: 10px 10px 20px 10px;
    }
 </style>


</head>
<body>

    <div id="header"> 
        <div id="back"> <i class="material-icons" id="header_icon"> chevron_lefts</i></div>
        <div id="title">SIGN UP</div>
    </div>

    <div id="main">
    <div class="container">
        <img src="logo2.jpg" id="img">
        <div class="centered">
        <form action="" method="GET">
             <div id="actions"> 
             <div id="input_div">
                    <i class="material-icons">person</i><input type="text" name="name" id="number" placeholder="User Name"/>
                </div>
                <div id="input_div">
                    <i class="material-icons">local_phone</i><input type="text" name="number" id="number" placeholder="Phone Number"/>
                </div>
                <div id="input_div">
                    <i class="material-icons">lock</i><input type="password" name="password" id="number" placeholder="Password"/>
                </div>  
                <button href="name.php" id="save" >NEXT <i class="material-icons">arrow_forward</i></button>
             </div>
</form>
        </div>
        <p id="description">One Step Login</p>
    </div>
    </div>
   
