<!DOCTYPE html>
<html lang = "ja">
    <head>
        <meta charset = "UTF-8">
        <title>mission2-3</title>
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
            $filename = "mission_2-3.html";
            $fp = fopen($filename,"a");
            fwrite($fp,"おめでとう"."<br>");
            fclose($fp);
                }else{
            $filename = "mission_2-3.html";
            $fp = fopen($filename,"a");
            fwrite($fp,$str."<br>");
            fclose($fp);
            }
        ?>
    
    </body>
</html>