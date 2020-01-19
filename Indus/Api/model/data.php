<?php

class Data{
            
     public function getData($status,$message,$data){
          $data = ['status'=>$status,'message'=>$message,'data'=>$data];
          $json = json_encode($data);
          return $json;
    }
}

?>