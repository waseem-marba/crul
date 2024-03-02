<?php
session_start();

function display_response(){
     if(isset($_SESSION['response']['error']) && $_SESSION['response']['error']){ 
        return "<p class='alert alert-danger'>". $_SESSION['response']['error']."</p>";
     }elseif(isset($_SESSION['response']['data']) && $_SESSION['response']['data']){
           return $json_pretty = "<pre>".json_encode($_SESSION['response']['data'], JSON_PRETTY_PRINT). "<pre/>"; 
    } 
        
}

?>