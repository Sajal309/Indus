<?php

class getGroup{
            
     public function getData($prd_id){
        global $conn;
        $data = "";
       
        $qry = mysqli_query($conn,"SELECT * FROM items WHERE product_id = '$prd_id'"); 
        if(mysqli_num_rows($qry) > 0){
           $row = mysqli_fetch_assoc($qry);
             $data = $row['grp_id'];
            
            }
    else{
        $data = '';
       
    }
return $data;

}

}
?>