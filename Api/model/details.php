<?php

class Details{
            
     public function getData($grp_id){
        global $conn;
        $data = array();
       
        $qry = mysqli_query($conn,"SELECT * FROM details WHERE grp_id = '$grp_id'"); 
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