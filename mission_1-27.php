<!DOCTYPE html>
<html lang = "ja">
    <head>
        <meta charset = "UTF-8">
        <title>mission1-27</title>
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
        //mission_1-27.txtに書き込む（mission1-24~25）
        $filename = "mission_1-27.txt";
        $fp = fopen($filename,"a");
        if($num != ""){
            fwrite($fp,$num.PHP_EOL);
        }
        fclose($fp);
        echo "書き込み成功！"."<br>";
        //mission_1-27.txtに送った数字をmission_1-27.phpに書き込む (mission1-26)  　
        if(file_exists($filename)){
            $lines = file($filename,FILE_IGNORE_NEW_LINES);
            foreach($lines as $line){
                //数字を3と5と15の倍数に場合分けする（mission1-17） 
                if($line%3==0 && $line%5==0 ){
                    echo "Fizz-Buzz" . "<br>";
                }
                elseif($line%3==0){
                    echo "Fizz" . "<br>"; 
                }
                elseif($line%5==0){
                    echo "Buzz" . "<br>";
                }
                else{
                    echo $line . "<br>";
                }
            }
        }
        
    ?>
    </body>
</html>