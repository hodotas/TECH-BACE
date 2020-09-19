<!DOCTYPE html>
<html lang = "ja">
    <head>
        <meta charset = "UTF-8">
        <title>mission2-4</title>
    </head>
    <body>
        <!--入力フォーム-->
        <form action = "" method = "post">
            <!--文字の入力-->
            <!--未入力のとき"コメント"と表示-->                                                      
            <input type = "text" name = "str" value = "コメント">
            <!--送信ボタン-->
            <input type = "submit" name = "submit">
        </form>
        <?php
            $str = $_POST["str"];
            
            if($str==""){
            }elseif($str=="完成！"){
            $filename = "mission_2-4.txt";
            $fp = fopen($filename,"a");
            fwrite($fp,"おめでとう".PHP_EOL);
            fclose($fp);
                }else{
            $filename = "mission_2-4.txt";
            $fp = fopen($filename,"a");
            fwrite($fp,$str.PHP_EOL);
            fclose($fp);
            }
            
            if(file_exists($filename)){
                $lines = file($filename,FILE_IGNORE_NEW_LINES);
                foreach($lines as $line){
                    if($line == "おめでとう"){
                        echo $line."<br>";    
                    }else{
                        echo "「".$line ."」を受け付けました。". "<br>";    
                    }
            
                }
            }
        ?>
    
    </body>
</html>