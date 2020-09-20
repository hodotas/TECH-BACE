<!DOCTYPE html>
<html lang = "ja">
    <head>
        <meta charset = "UTF-8">
        <title>mission3-1</title>
    </head>
    <body>
        <!--入力フォーム-->
        <form action = "" method = "post">
            <!--名前の入力-->
            <input type = "text" name = "name" value = "名前">
            <br>
            <!--コメントの入力-->
            <input type = "text" name = "com" value = "コメント">
            <br>
            <!--送信ボタン-->
            <input type = "submit" name = "submit">
        </form>
        
        <?php
            $num = 1;
            $name = $_POST["name"];
            $com = $_POST["com"];
            $day = date("Y/n/j G:i:s");
            
            $filename = "mission_3-1.txt";
            $fp = fopen($filename,"a");
            
            if(file_exists($filename)){
            $lines = file($filename,FILE_IGNORE_NEW_LINES);
            foreach($lines as $line){
                if($line == ""){
                    
                }else{
                    $num++;
                }
            }
        }
        
            if($name == "" && $com == ""){
                
            }else{
                fwrite($fp,"$num<>$name<>$com<>$day".PHP_EOL.PHP_EOL);
                
            }
            
            fclose($fp);
            
            
            
        ?>
    </body>
</html>