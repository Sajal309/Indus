<?php

class Brands{
            
     public function getData(){
        global $conn;
        $data = array();
       
        $qry = mysqli_query($conn,"SELECT * FROM brands"); 
       
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