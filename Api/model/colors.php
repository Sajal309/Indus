<?php

class Colors{
            
     public function getData($prd_id){
        global $conn;
        $data = array();
       
        $qry = mysqli_query($conn,"SELECT * FROM colors WHERE prd_id = '$prd_id'"); 
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