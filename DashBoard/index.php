<?php
$products = isset($_COOKIE['products']) ? $_COOKIE['products'] : 1;
$images = isset($_COOKIE['images']) ? $_COOKIE['images'] : 1;

setcookie("products", "", time()-3600);
setcookie("images", "", time()-3600);
require_once('Db/db.php');

$prd_id = 1;
$brand_name = "";
$title = "";
$type = "";
$category = "";
$sub_category = "";
$price = "";
$discount = "";
$is_cod = "";
$group_id = "";



?>
<script>
var products = 1;
var images = [];
var size = 1;
var details = 1;
var colors = 1;



</script>



<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script
            src="https://code.jquery.com/jquery-3.3.1.min.js"
            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
            crossorigin="anonymous"></script>
  <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
</head>

<style>
#product_container{
    padding:10px;
    margin:10px;
    display:block;
}

}
#container_block{
    margin:50px;
    display:block;

    border:1px solid rgb(240,240,240); background:rgb(250,250,250);
}
#label{
color:rgb(100,100,100);
font-size:16px;
font-family: 'Roboto', sans-serif;
margin:10px;
}
#remove_item{
    float:right; border:none;
}
#main_block{
  
    margin:10px;
    margin-bottom:50px;
    padding:10px;
    background:white;
    border:1px solid rgb(220,220,220);

    border-radius:2px;  
}
.input_field{
    border:none;
    border-bottom:1px solid rgb(100,100,100,0.4);
    background:rgb(252,248,248);
    width:250px;
    height:46px;
    border-radius:2px;
    margin-left:2%;
    padding:5px;
    outline:none;
    
}

.small_input_field{
    border:none;
    border-bottom:1px solid rgb(100,100,100,0.4);
    background:rgb(252,248,248);
    width:70px;
    height:46px;
    border-radius:2px;
    margin-left:5%;
    padding:5px;
    outline:none;
    
}

.medium_input_field{
    border:none;
    border-bottom:1px solid rgb(100,100,100,0.4);
    background:rgb(252,248,248);
    width:200px;
    height:46px;
    border-radius:2px;
    margin-left:5%;
    padding:5px;
    outline:none;
    
}

.small_remove_item{
  
    border:none;
}
#inner_block{
    margin:10px;
}
#detail_item{
    margin-top:10px;
}
.rem_btn{
    border:none;
    padding:10px;
    background:white;
    outline:none;
    margin-top:-30px;
    
}
.add_btn{
    border:1px solid rgb(200,200,200);
    padding:10px;
    background:white;
    outline:none;
    margin-top:-30px;
    border-radius:10px;
    
}
.sub_file{
    margin-top:20px;
    
}
.col-xs-5{
    width:250px;
    min-height:70px;

    margin:10px;
    padding:10px;
    background:white;
    box-shadow: 0 1px 6px rgba(0, 0, 0, 0.12), 0 1px 4px rgba(0, 0, 0, 0.24);
    border:none;
    border-radius:2px;
}
.add_file_btn{
    margin:2px 0px 10px 10px;

    background:none;
    padding:6px;
    border:1px solid rgb(200,200,200);
    border-radius:10px;
}
.col-xs-5{

    width:250px;
    min-height:70px;
    margin:10px;
    padding:10px;
    background:white;
    box-shadow: 0 1px 6px rgba(0, 0, 0, 0.12), 0 1px 4px rgba(0, 0, 0, 0.24);
    border:none;
    border-radius:2px;
}

.product{
padding:10px;
width:250px;
min-height:70px;
margin:10px;
padding-bottom:20px;
background:white;
box-shadow: 0 1px 6px rgba(0, 0, 0, 0.12), 0 1px 4px rgba(0, 0, 0, 0.24);
border:none;
border-radius:2px;
}
.remove_btn{
  border:none;
  background:none;
  padding:5px;
  margin-bottom:10px;
  margin-top:-10px;
}
.remove_product{
  border:1px solid rgb(200,200,200);
  background:rgb(200,200,200);
  border-radius:10px;
  padding:5px;
  margin-top:-80px;
}
.chooser{
    margin-bottom:25px;
}

#size_item{
    
}
#color{
    margin:10px;
}
</style>

<body  style="background:rgb(250,250,252);"> 
<center>
<form id="form"  action="index.php" method="post" enctype="multipart/form-data">

<div id="product_container" align="left" style="border:1px solid rgb(240,240,240); background:white ; ">

<button type="button" style="" onclick="addProducts()" class="btn btn-default btn-sm"> <span class="glyphicon glyphicon-plus-sign"></span> Add Products </button>

<div id = "product1" class="product" align="left" style="">

<input class="medium_input_field" id="color" type="text" placeholder="Color" name="color[]">
<input type="file" class="chooser" name ='file[]' >
<button type="button"  class="add_file_btn"   onclick="addMoreImages(1)" > <span class="glyphicon glyphicon-plus-sign"></span>  </button>

<div id="sub_file_div">
</div>

</div>
</div>


<div id="main_block" align="left">
<div id="inner_block">
<h4 id="label" >Brand Name*</h4>
<input class="input_field" type="text" name="brand_name">

<h4 id="label" >Title*</h4>
<input  class="input_field" type="text" name="title">

<h4 id="label" >Price*</h4>
<input  class="input_field" type="text" name="price">

<h4 id="label" >Discount*</h4>
<input  class="input_field" type="text" name="discount">


<h4 id="label" >COD*</h4>
<select id="type" class="input_field" type="text" name="cod">
<option value="1">Yes</option>
<option value="0">No</option>
</select>


<h4 id="label" >Type*</h4>
<select id="type" class="input_field" type="text" name="type">
<option value="men">Men</option>
<option vlaue="women">Women</option>
<option value="kids">Kids</option>
</select>



<h4 id="label" >Category*</h4>
<select id="category" class="input_field" type="text" name="category"> 
  <option value="clothing">Clothing</option>
  <option value="footwear">Footwear</option>
  <option value="accessories">Accessories</option>
       
</select>


<h4 id="label" >Sub-Category*</h4>
<select id="sub_category"  class="input_field" list="products" placeholder="Sub-Category" name="sub_category" >
<option value="shirt">Shirt </option>
<option value="t-shirt">T-shirt </option>
<option value="jeans">Jeans </option>
<option value="trouser">Trouser </option>
     </select>


</div>
</div>
<div id="size" class="col-sm-11"  style="display:block;background:white;margin:15px;border:1px solid rgb(200,200,200);padding:10px;">

<h4 id="label" align="left">Size*</h4>
<div id="size_item" class="col-sm-2"> 
<input type="text" name="size[]" class="small_input_field"  >
<button type="button"  class="add_btn"  onclick="addSize()"  > <span class="glyphicon glyphicon-plus-sign"></span>  </button>
</div>

</div>

<div id="detail" class="col-sm-11"  style="display:block;background:white;margin:15px; margin-bottom:100px;border:1px solid rgb(200,200,200);padding:10px;">

<h4 id="label" align="left">Detail*</h4>
<div id="detail_item"   class="col-sm-3" > 
<input type="text" name="detail[]" class="medium_input_field" >
<button type="button"  class="add_btn"  onclick="addDetails()" > <span class="glyphicon glyphicon-plus-sign"></span>  </button>
</div>

</div>


<button style="position:fixed; opacity:0; bottom:0; left:0; right:0; width:100%; background:rgb(140,140,140);padding:10px; border:none;color:white;" name="submit">submit</button>
</form>



<script>
function removeItem(item){

    var elem = item.parentNode;
    elem.remove();
    products--;

}

function removeProducts(item){

var elem = item.parentNode;
elem.remove();
products--;

document.cookie = "products = " + products;

}

images[0] = 0;

function addMoreImages($i){
 
 images[products-1]+=1;
 document.cookie = "images = " + JSON.stringify(images);

var container = document.getElementById('product'+$i);
var div = document.createElement('div');
div.id = 'sub_file_div';

     
 

    var remove_btn  = document.createElement('button');
     remove_btn.type = 'button';
     remove_btn.id = 'remove_item';
     remove_btn.className = 'remove_btn';


     var icon = document.createElement("span");
     icon.className ="glyphicon glyphicon-remove";
     remove_btn.appendChild(icon);      
     
     remove_btn.onclick = function(){
         removeItem(this);
         images[products]--;
         document.cookie = "images = " +  JSON.stringify(images);
     }

   


    var input = document.createElement('input');
    input.name = 'sub_file[]';
    input.type = 'file';

    div.appendChild(input);
    div.appendChild(remove_btn);
    

    container.appendChild(div);


}
function addProducts(){
    
 products++;
 
 images[products-1] = 0;
 document.cookie = "products = " + products;
 document.cookie = "images = " + JSON.stringify(images);

var container = document.getElementById('product_container');
   
     
    var prod = document.createElement('div');
    prod.id = 'product'+products;
    prod.className = 'product';
    
    var add_btn  = document.createElement('button');
     add_btn.type = 'button';
     add_btn.className = 'add_file_btn';

     var icon = document.createElement("span");
     icon.className ="glyphicon glyphicon-plus-sign";
     add_btn.appendChild(icon);      
     
     add_btn.onclick = function(){
         addMoreImages(products);
     }

    var remove_btn  = document.createElement('button');
     remove_btn.type = 'button';
     remove_btn.id = 'remove_item';
     remove_btn.className = 'remove_product';


     var icon = document.createElement("span");
     icon.className ="glyphicon glyphicon-remove";
     remove_btn.appendChild(icon);      
     
     remove_btn.onclick = function(){
         removeProducts(this);  
        document.cookie = "images = " + JSON.stringify(images);
     }



    var input = document.createElement('input');
    input.name = 'file[]';
    input.type = 'file';
    input.className = 'chooser';

    var color = document.createElement('input');
    color.name = 'color[]';
    color.type = 'text';
    color.id = 'color';
    color.placeholder = 'Color';
    color.className = 'medium_input_field';

  

    prod.appendChild(color);
    prod.appendChild(add_btn);
    prod.appendChild(input);
    prod.appendChild(remove_btn);
    
    
    container.appendChild(prod);;


}
function addSize(){
   
var container = document.getElementById('size');

     
     var size_item = document.createElement('div');
    size_item.id= 'size_item';
    size_item.className = 'col-sm-2';

    var remove_btn  = document.createElement('button');
     remove_btn.type = 'button';
     remove_btn.id = 'small_remove_item';
     remove_btn.className = 'rem_btn';

     var icon = document.createElement("span");
     icon.className ="glyphicon glyphicon-remove";
     remove_btn.appendChild(icon);      
     
     remove_btn.onclick = function(){
         removeItem(this);
     }



    var input = document.createElement('input');
    input.name = 'size[]';
    input.type = 'text';
    input.className = 'small_input_field';
    
    size_item.appendChild(input);
    size_item.appendChild(remove_btn);
    container.appendChild(size_item);
    
}

function addDetails(){
   
   
   var container = document.getElementById('detail');
   
        
        var item = document.createElement('div');
       item.id= 'detail_item';
       item.className = 'col-sm-4';
   
       var remove_btn  = document.createElement('button');
        remove_btn.type = 'button';
        remove_btn.id = 'small_remove_item';
        remove_btn.className = 'rem_btn';
   
        var icon = document.createElement("span");
        icon.className ="glyphicon glyphicon-remove";
        remove_btn.appendChild(icon);      
        
        remove_btn.onclick = function(){
            removeItem(this);
        }
   
   
   
       var input = document.createElement('input');
       input.name = 'detail[]';
       input.type = 'text';
       input.className = 'medium_input_field';
       
       item.appendChild(input);
       item.appendChild(remove_btn);
       container.appendChild(item);
       
       
   }
   


hel = "Clothing";
   $("#category").on('change',function(){
      
       hel =  $("#category").val();
     console.log(hel); 
     document.getElementById('sub_category').innerHTML = '';  
 
  var langArray = {};
  if(hel == "clothing"){
        langArray = [
      {value:"Shirt",text:"shirt"},
 {value:"T-shirt",text:"t-shirt"},
 {value:"Jeans",text:"jeans"},
 {value:"Trouser",text:"trouser"}


  ]}
  else if(hel == "footwear"){
     langArray = [
      {value:"Snickers",text:"snickers"},
      {value:"Sport-Shoes",text:"sport-shoes"}
  ]
  }else if(hel == "accessories"){
      langArray = [
      {value:"Sun-Glasess",text:"sun-glasses"},
      {value:"Wallet",text:"wallet"}
  ]
  }
  console.log("sub",langArray);

   for(var i = 0; i < langArray.length; i+=1){
    var categories = document.getElementById("sub_category");
   
            var option = document.createElement("option");
            option.text = langArray[i].text;
            categories.add(option);

            console.log("value",langArray[i].value+langArray[i].text);

        }
});

</script>

<?php
if(isset($_POST['submit'])){


    group();
    

// $num_file =  count($_FILES['file']['name']);
// for($i = 0; $i < $num_file; $i++){
//     images($i);
// }
}


function group(){

    global $conn,$brand_name,$title,$type,$category,$sub_category,$price,$discount,$is_cod,$group_id,$products;
    $brand_name = $_POST['brand_name'];
    $title = $_POST['title'];
    $type = $_POST['type'];
    $category = $_POST['category'];
    $sub_category = $_POST['sub_category'];
    $price = $_POST['price'];
    $discount = $_POST['discount'];
    $is_cod = $_POST['cod'];
    $group_id = date("ymdHis");
    
    $qry = mysqli_query($conn,"INSERT INTO products (brand_name,title,type,category,sub_category,price,discount,is_cod,group_id) VALUES ('$brand_name','$title','$type','$category','$sub_category','$price','$discount','$is_cod','$group_id')");
    for($i = 0; $i < $products; $i++){
    items($group_id,$i);
    
    }

    size($group_id);
    details($group_id);
}


function items($grp_id,$i){
    global $conn;
    $product_id = date("ymdHis").$i;
    $qry = mysqli_query($conn,"INSERT INTO items (grp_id,product_id) VALUES ('$grp_id','$product_id')");
    
    
        images($product_id,$i);
        color($product_id,$i);
        
        

}


function images($product_id,$i){
       
         global $conn,$images;

        $file = $_FILES['file']['name'][$i];
        $tmp = $_FILES['file']['tmp_name'][$i];
        
        $path = "../media/";
        $time = date('dymHis')."";
        $file = $time.$file;
        
        
        if(move_uploaded_file($tmp,$path.$file)){
            echo "success";
            
        }
        
        $qry = mysqli_query($conn,"INSERT INTO images (prd_id,image) VALUES ('$product_id','$file')");
        $arr = json_decode($images);
        
        for($j = 0; $j <$arr[$i]; $j++){
            $file = $_FILES['sub_file']['name'][$j];
            $tmp = $_FILES['sub_file']['tmp_name'][$j];
            
            $path = "../media/";
            $time = date('dymHis')."";
            $file = $time.$file;
            
            
            if(move_uploaded_file($tmp,$path.$file)){
                echo "success";
                
            }
            $qry = mysqli_query($conn,"INSERT INTO images (prd_id,image) VALUES ('$product_id','$file')");
       
    
        }
   
        
        
}




function size($grp_id){
    global $conn;
    for($i=0; $i<count($_POST['size']); $i++){
        $size = $_POST['size'][$i];
    $qry = mysqli_query($conn,"INSERT INTO size (grp_id,size) VALUES ('$grp_id','$size')");

    }
}

function color($product_id,$i){
    global $conn;
    $color = $_POST['color'][$i];
    $qry = mysqli_query($conn,"INSERT INTO colors (prd_id,color) VALUES ('$product_id','$color')");


}

function details($grp_id){
    global $conn;
    for($i=0; $i<count($_POST['detail']); $i++){
        $point = $_POST['detail'][$i];
        $qry = mysqli_query($conn,"INSERT INTO details (grp_id,point) VALUES ('$grp_id','$point')");

    }

}
?>
</body>
</html>


