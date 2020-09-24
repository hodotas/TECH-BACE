<!DOCTYPE html>
<html lang = "ja">
    <head>
        <meta charset = "UTF-8">
        <title>mission3-5</title>
    </head>
    <body>
        
        
        <?php
        //---------------------テキストファイルに書き込むパート------------------------------
        //追加・削除・編集する前のテキストファイルを読み込む
        $filename = "mission_3-5.txt";
        $fp = fopen($filename,"r");
        if(file_exists($filename)){//テキストファイルに中身があるとき
                $lines = file($filename,FILE_IGNORE_NEW_LINES);
        }
        fclose($fp);
        //投稿番号
        $num = 1;        
        
        //送信ボタンを押したときの動作        
        if(isset($_POST['submit']) && !empty($_POST["pass"])){
            //名前
            $name = $_POST["name"];
            //コメント
            $com = $_POST["com"];
            //日付
            $day = date("Y/n/j G:i:s");
            //編集する番号
            $edit = $_POST["categoly"];
            
            $pass = $_POST["pass"];
            
            
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
                    fwrite($fp,"$num<>$name<>$com<>$day<>$pass<>".PHP_EOL.PHP_EOL);
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
                            fwrite($fp,$edit."<>".$name."<>".$com."<>".$day."<>".$pass."<>".PHP_EOL.PHP_EOL);
                        }else{//一致しないとき$lineをそのまま書き込む
                            fwrite($fp,$line.PHP_EOL.PHP_EOL);
                        }
                    }
                }    
            }
        
        //削除ボタンを押したときの動作    
        }elseif(isset($_POST['dele']) && !empty($_POST["pass_de"])){ // && !empty($_POST["pass_de"])
            //書き込むモードに変更する
            $fp = fopen($filename,"w");
            //削除する番号
            $del_num = $_POST["num_de"];
            $pass_de = $_POST["pass_de"];
            $alert = "";
            //テキストファイルに削除する番号以外の情報を書き込む
            foreach($lines as $line){
                if($line == ""){
                }else{
                    //投稿番号を分けるために分割するexplode関数
                    $info = explode("<>",$line);
                    if($info[0] == $del_num){//投稿番号$info[0]と削除する番号$del_numが一致したとき
                        if($pass_de == $info[4]){//指定した番号のパスワードが一致したとき
                            //投稿番号のみ書き込む
                            fwrite($fp,$info[0]."<>".PHP_EOL.PHP_EOL);    
                        }else{//パスワードが一致しないとき削除しない
                            fwrite($fp,$info[0]."<>".$info[1]."<>".$info[2]."<>".$info[3]."<>".$info[4]."<>".PHP_EOL.PHP_EOL);
                            $alert =  "パスワードが違います。";
                            
                        }   
                    }else{//番号が一致しないとき削除しない
                        fwrite($fp,$info[0]."<>".$info[1]."<>".$info[2]."<>".$info[3]."<>".$info[4]."<>".PHP_EOL.PHP_EOL);
                    }
                }
            }
            
        //編集ボタンを押したときの動作    
        }elseif(isset($_POST['edit']) && !empty($_POST["pass_ed"])){
            //書き込むモードに変更する
            $fp = fopen($filename,"w");
            //編集する番号
            $edi_num = $_POST["num_ed"];
            $pass_ed = $_POST["pass_ed"];
            
            //テキストファイルに書き込みつつ編集する番号の情報を取得する
            foreach($lines as $line){
                if($line == ""){
                }else{
                    //テキストファイルに書き込む
                    fwrite($fp,$line.PHP_EOL.PHP_EOL);
                    //投稿番号を分けるために分割するexplode関数
                    $info = explode("<>",$line);
                    if($info[0] == $edi_num){//投稿番号$info[0]と編集する番号$edi_numが一致したとき
                        if($pass_ed == $info[4]){//パスワードが一致したとき
                            //投稿番号と名前とコメントを取得する
                            $edi_num = $info[0];
                            $edi_name = $info[1];
                            $edi_com = $info[2];    
                        }else{//パスワードが一致しないとき
                            $edi_num = "";
                            $alert =  "パスワードが違います。";
                        }
                        
                    }
                }
            }
            
        }
        ?>
        
        <?php
                echo $alert."<br>";//パスワードが違うとき"パスワードが違います。"と表示
        ?>
        
        <!--入力フォーム-->
        <form action = "" method = "post">
            <!--名前の入力-->
            <input type = "text" name = "name" value = "<?php echo $edi_name?>" placeholder = "名前">
            <br>
            <!--コメントの入力-->
            <input type = "text" name = "com" value = "<?php echo $edi_com?>" placeholder = "コメント">
            <br>
            <!--パスワードの入力-->
            <input type = "password" name = "pass" placeholder = "パスワード">
            <input type = "hidden" name = "categoly" value = "<?php echo $edi_num?>">
            <br>
            <!--送信ボタン-->
            <button type = "submit" name = "submit">送信</button>
            <br>
            <!--削除する番号の入力-->
            <!--未入力のとき"削除する番号"と表示-->                                                      
            <input type = "number" name = "num_de" placeholder = "削除する番号">
            <br>
            <input type = "password" name = "pass_de" placeholder = "パスワード">
            <br>
            <button type = "submit" name = "dele">削除</button>
            <br>
            <!--編集する番号の入力-->
            <!--未入力のとき"編集する番号"と表示-->                                                      
            <input type = "number" name = "num_ed" placeholder = "編集する番号">
            <br>
            <input type = "password" name = "pass_ed" placeholder = "パスワード">
            <br>
            <button type = "submit" name = "edit">編集</button>
            
        </form>
        <?php
        //------------------------PHPファイルに書き込むパート------------------------------
        //テキストファイルを読み込み、PHPファイルに書き込む    
        if(file_exists($filename)){
            //もう一度、テキストファイルの中身を1列ずつ配列に入れる
            $lines = file($filename,FILE_IGNORE_NEW_LINES);
            foreach($lines as $line){
                if($line == ""){
                }else{
                    $info = explode("<>",$line);
                    if(!empty($info[1])){
                        echo $info[0].".名前:".$info[1]." コメント:".$info[2]." 日付:".$info[3]."<br><br>";
                    }else{
                        
                    }
                }
            }
        }
        //テキストファイルをとじる
        fclose($fp);
        ?>

    </body>
</html>
