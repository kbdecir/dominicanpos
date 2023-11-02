<?php
    class response{
        public function getResponse($status,$data,$code,$message){
            return array(
                "status" => $status,
                "data" => $data,
                "code" => $code,
                "message" => $message
            );
        }
    }

?>