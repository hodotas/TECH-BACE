<!DOCTYPE html>
<html lang = "ja">
    <head>
        <meta charset = "UTF-8">
        <title>mission3-4</title>
    </head>
    <body>
        
        <?php
        //---------------------テキストファイルに書き込むパート------------------------------
        //追加・削除・編集する前のテキストファイルを読み込む
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
            
            //名前
            $name = $_POST["name"];
            //コメント
            $com = $_POST["com"];
            //日付
            $day = date("Y/n/j G:i:s");
            //編集する番号
            $edit = $_POST["categoly"];
            
            //編集する番号がないとき
            if($edit == ""){
                //書き込むモードに変更する
                $fp = fopen($filename,"a");
                
                //投稿番号をきめる
                foreach($lines as $line){
                    if($line == ""){
                    }else{
                    $info = explode("<>",$line);
                    $num = $info[0];
                    }
                }
                $num++;
                
                
                //テキストファイルに新しい情報を書き込む
                if($name == "" && $com == ""){
                }else{
                    fwrite($fp,"$num<>$name<>$com<>$day".PHP_EOL.PHP_EOL);
                }
            }else{//編集する番号があるとき
                //書き込むモードに変更する
                $fp = fopen($filename,"w");
                foreach($lines as $line){
                    if($line == ""){
                    }else{
                        //投稿番号を分けるために分割するexplode関数
                        $info = explode("<>",$line);
                        
                        if($info[0] == $edit){
                            //投稿番号$info[0]と編集する番号$editが一致したとき書き変える
                            fwrite($fp,$edit."<>".$name."<>".$com."<>".$day.PHP_EOL.PHP_EOL);
                        }else{//一致しないとき$lineをそのまま書き込む
                            fwrite($fp,$line.PHP_EOL.PHP_EOL);
                        }
                    }
                }    
            }
        
        //削除ボタンを押したときの動作    
        }elseif(isset($_POST['dele'])){
            //書き込むモードに変更する
            $fp = fopen($filename,"w");
            //削除する番号
            $del_num = $_POST["num_de"];
            
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
            
        //編集ボタンを押したときの動作    
        }elseif(isset($_POST['edit'])){
            //書き込むモードに変更する
            $fp = fopen($filename,"w");
            //編集する番号
            $edi_num = $_POST["num_ed"];
            
            //テキストファイルに書き込みつつ編集する番号の情報を取得する
            foreach($lines as $line){
                if($line == ""){
                }else{
                    //テキストファイルに書き込む
                    fwrite($fp,$line.PHP_EOL.PHP_EOL);
                    //投稿番号を分けるために分割するexplode関数
                    $info = explode("<>",$line);
                    if($info[0] == $edi_num){//投稿番号$info[0]と編集する番号$edi_numが一致したとき
                        //投稿番号と名前とコメントを取得する
                        $edi_num = $info[0];
                        $edi_name = $info[1];
                        $edi_com = $info[2];
                    }
                }
            }
            
        }
        ?>
        <!--入力フォーム-->
        <form action = "" method = "post">
            <!--名前の入力-->
            <input type = "text" name = "name" value = "<?php echo $edi_name?>" placeholder = "名前">
            <br>
            <!--コメントの入力-->
            <input type = "text" name = "com" value = "<?php echo $edi_com?>" placeholder = "コメント">
            <input type = "hidden" name = "categoly" value = "<?php echo $edi_num?>">
            <br>
            <!--送信ボタン-->
            <button type = "submit" name = "submit">送信</button>
            <br>
            <!--削除する番号の入力-->
            <!--未入力のとき"削除する番号"と表示-->                                                      
            <input type = "number" name = "num_de" placeholder = "削除する番号">
            <br>
            <button type = "submit" name = "dele">削除</button>
            <br>
            <!--編集する番号の入力-->
            <!--未入力のとき"編集する番号"と表示-->                                                      
            <input type = "number" name = "num_ed" placeholder = "編集する番号">
            <br>
            <button type = "submit" name = "edit">編集</button>
            
        </form>
        <?php
        if(file_exists($filename)){
            //もう一度、テキストファイルの中身を1列ずつ配列に入れる
            $lines = file($filename,FILE_IGNORE_NEW_LINES);
            foreach($lines as $line){
                if($line == ""){
                }else{
                    //"<>"を外して書き込む
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
