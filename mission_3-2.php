<!DOCTYPE html>
<html lang = "ja">
    <head>
        <meta charset = "UTF-8">
        <title>mission3-2</title>
    </head>
    <body>
        <!--入力フォーム-->
        <form action = "" method = "post">
            <!--名前の入力-->
            <input type = "text" name = "name" placeholder = "名前">
            <br>
            <!--コメントの入力-->
            <input type = "text" name = "com" placeholder = "コメント">
            <br>
            <!--送信ボタン-->
            <input type = "submit" name = "submit">
        </form>
        
        <?php
            //投稿番号
            $num = 1;
            //名前
            $name = $_POST["name"];
            //コメント
            $com = $_POST["com"];
            //日付
            $day = date("Y/n/j G:i:s");
            
            $filename = "mission_3-1.txt";
            $fp = fopen($filename,"a");
            
            //投稿番号を決める
            if(file_exists($filename)){//テキストファイルに中身があるとき
            //1列ずつ配列に入れる
            $lines = file($filename,FILE_IGNORE_NEW_LINES);
            
            //投稿番号を1ずつ足す
            foreach($lines as $line){
                if($line == ""){
                }else{
                    $num++;
                }
            }
            
        }
        
        //名前かコメントを送信したときテキストファイルに書き込む
        if($name == "" && $com == ""){
            }else{
                fwrite($fp,"$num<>$name<>$com<>$day".PHP_EOL.PHP_EOL);
            }
        
        //テキストファイルを読み込み、PHPファイルに書き込む    
        if(file_exists($filename)){
            //テキストファイルに書き込んだ後
            //もう一度、1列ずつ配列に入れる
            $lines = file($filename,FILE_IGNORE_NEW_LINES);
            foreach($lines as $line){
                if($line == ""){
                }else{
                    $info = explode("<>",$line);
                    echo $info[0].".名前:".$info[1].
                    " コメント:".$info[2]." 日付:".$info[3]."<br><br>";
                }
            }
        }
            //テキストファイルをとじる
            fclose($fp);
        ?>
    </body>
</html>