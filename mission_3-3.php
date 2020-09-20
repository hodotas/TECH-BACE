<!DOCTYPE html>
<html lang = "ja">
    <head>
        <meta charset = "UTF-8">
        <title>mission3-3</title>
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
            <button type = "submit" name = "submit">送信</button>
            <br>
            <!--削除する番号の入力-->
            <!--未入力のとき"削除する番号"と表示-->                                                      
            <input type = "number" name = "num" placeholder = "削除する番号">
            <br>
            <button type = "submit" name = "dele">削除</button>
        </form>
        
        <?php
        
        $filename = "mission_3-1.txt";
        $fp = fopen($filename,"r");
        if(file_exists($filename)){//テキストファイルに中身があるとき
                $lines = file($filename,FILE_IGNORE_NEW_LINES);
        }
        fclose($fp);
        
        //投稿番号
        $num = 1;        
        
        //送信ボタンを押したときのの動作        
        if(isset($_POST['submit'])){
            $fp = fopen($filename,"w");
            //名前
            $name = $_POST["name"];
            //コメント
            $com = $_POST["com"];
            //日付
            $day = date("Y/n/j G:i:s");
            
            //テキストファイルに1行ずつ書き込む
            foreach($lines as $line){
                if($line == ""){
                }else{
                    fwrite($fp,$line.PHP_EOL.PHP_EOL);
                    $num++;
                }
            }
            
            //テキストファイルに新しい情報を書き込む
            if($name == "" && $com == ""){
            }else{
                fwrite($fp,"$num<>$name<>$com<>$day".PHP_EOL.PHP_EOL);
            }
        
        //削除ボタンを押したときの動作    
        }elseif(isset($_POST['dele'])){
            $fp = fopen($filename,"w");
            //削除する番号
            $del_num = $_POST["num"];
            
            //テキストファイルに削除する番号以外の情報を書き込む
            foreach($lines as $line){
                if($line == ""){
                }else{
                    //投稿番号を分けるために分割するexplode関数
                    $info = explode("<>",$line);
                    
                    if($info[0] == $del_num){
                    //投稿番号$info[0]と削除する番号$del_numが一致したとき書き込まない   
                    }else{//一致しないとき書き込む
                        fwrite($fp,$num."<>".$info[1]."<>".$info[2]."<>".$info[3].PHP_EOL.PHP_EOL);
                        $num++;
                    }
                }
            }
            
        }
        
        //テキストファイルを読み込み、PHPファイルに書き込む    
        if(file_exists($filename)){
            //もう一度、テキストファイルの中身を1列ずつ配列に入れる
            $lines = file($filename,FILE_IGNORE_NEW_LINES);
            foreach($lines as $line){
                if($line == ""){
                }else{
                    $info = explode("<>",$line);
                    echo $info[0].".名前:".$info[1]." コメント:".$info[2]." 日付:".$info[3]."<br><br>";
                    
                }
            }
        }
        //テキストファイルをとじる
        fclose($fp);
        ?>
    </body>
</html>