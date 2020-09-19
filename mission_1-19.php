<?php
    for($i = 0;$i <= 99; $i++){
        //$numに$iを代入
        $num = $i;
        //場合分け
        if($num%3==0 && $num%5==0 ){
            echo "Fizz-Buzz" . "<br>";
        }
        elseif($num%3==0){
           echo "Fizz" . "<br>"; 
        }
        elseif($num%5==0){
            echo "Buzz" . "<br>";
        }
        else{
            echo $num . "<br>";
        }
    }
?>