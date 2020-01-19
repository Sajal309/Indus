
<?php foreach($details as $key => $value){ 
        ?>
    <div id="main" >
            <div id="img_box" class="col-sm-1">
            <?php foreach($value['images'] as $k => $v){ ?>
                <div id="img_small">    
                      <img src="<?php echo $media . $v['image']; ?>" alt="alt" >   
                </div>   
            <?php } ?>
            </div>  
             <div id="image" class="col-sm-5">
             <?php foreach($value['images'] as $k => $v){ ?>
                    <img src="<?php echo $media . $v['image']; }?>" alt="alt" >
            </div> 

            <div id="details" class="col-sm-4">
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
<?php } ?>