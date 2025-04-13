<?php 

class Alert{
    public function success($msg){
        echo "<div class='alert alert-success w-50 mx-auto my-5'>{$msg}</div>";
    }

    public function warning($msg){
        echo "<div class='alert alert-warning w-50 mx-auto my-5'>{$msg}</div>";
    }
}