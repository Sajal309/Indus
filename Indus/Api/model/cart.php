<?php

class Cart{
            
     public function getData($id){
        global $conn;
        $data = array();
       
        $qry = mysqli_query($conn,"SELECT * FROM cart WHERE user_id = '$id'"); 
       
        if(mysqli_num_rows($qry) > 0){
        
          while($row = mysqli_fetch_assoc($qry)){
               $data[] = $row;
          }
        
          }
          
    
    else{
        $data = '';
       
    }

return $data;
}
}

?>