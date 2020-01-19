<?php

class Msg{
            
     public function status($status,$message){
          $data = ['status'=>$status,'message'=>$message];
          $json = json_encode($data);
          return $json;
    }
}

?>