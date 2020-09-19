<!DOCTYPE html>
<html lang = "ja">
    <head>
        <meta charset = "UTF-8">
        <title>mission1-21</title>
    </head>
    <body>
        <!--入力フォーム-->
        <form action = "" method = "post">
            <!--数字の入力-->
            <!--未入力のとき"数字を入力してください"と表示-->                                                      
            <input type = "number" name = "num" placeholder = "数字を入力してください">
            <!--送信ボタン-->
            <input type = "submit" name = "submit">
        </form>
    <?php
        //入力した文を$numに代入する
        $num = $_POST["num"];
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
    ?>
    </body>
</html>