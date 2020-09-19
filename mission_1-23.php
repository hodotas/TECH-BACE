<?php
    $names = array("Ken","Alice","Judy","BOSS","Bob");
    foreach($names as $name){
        if($name == "BOSS"){
            echo "Goodmoring ".$name."!"."<br>";
        }else{
            echo "Hi! ".$name."<br>";
        }
    }
?>