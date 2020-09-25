<!DOCTYPE html>
<html lang = "ja">
    <head>
        <meta charset = "UTF-8">
        <title>mission5-1</title>
    </head>
    <body>
        
        <?php
        //---------------------データベースに書き込むパート------------------------------
        
        //データベースの接続
    	// ・データベース名：tb220567db
	    // ・ユーザー名：tb-220567
    	// ・パスワード：m7hR9UfYP9
	    $dsn = 'mysql:dbname=tb220567db;host=localhost';
    	$user = 'tb-220567';
	    $password = 'm7hR9UfYP9';
    	$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
    	
    	//送信ボタンを押したときの動作
    	if(isset($_POST['submit'])&& !empty($_POST['pass'])){
    	    //名前
            $name = $_POST['name'];
            //コメント
            $comment = $_POST['com'];
            //日付
            $date = date("Y/n/j G:i:s");
            //パスワード
            $pass = $_POST['pass'];
            //編集する番号
            $edit = $_POST['categoly'];
            
            //編集する番号がないとき
            if(empty($edit)){
                //テーブルwebtestに名前とコメントをinsert文で入力する
            	$sql = $pdo -> prepare("INSERT INTO webtest (name,comment,password,date)"
            	                       ." VALUES (:name,:comment,:password,:date)");
            	//bindParamで変数に値を代入する
    	        $sql -> bindParam(':name' , $name , PDO::PARAM_STR);
        	    $sql -> bindParam(':comment' , $comment , PDO::PARAM_STR);
            	$sql -> bindParam(':password' , $pass , PDO::PARAM_STR);
        	    $sql -> bindParam(':date' , $date , PDO::PARAM_STR);
        	    //実行し情報を書き込む
    	        $sql -> execute();
            }else{//編集する番号があるとき
                //UPDATE文で入力した文を編集する
            	$id = $_POST['categoly'];//編集する番号
        	    //WHRERでidを条件とし、SETで各情報のプレースホルダーを作成する
            	$sql = 'UPDATE webtest SET name = :name , comment = :comment , password = :password , date = :date WHERE id = :id';
        	    //変数に値を代入するのでprepareを使う
            	$stmt = $pdo -> prepare($sql);
        	    //bindParamで変数に値を代入する
        	    $stmt -> bindParam(':name' , $name ,PDO::PARAM_STR);
            	$stmt -> bindParam(':comment' , $comment ,PDO::PARAM_STR);
            	$stmt -> bindParam(':password' , $password ,PDO::PARAM_STR);
        	    $stmt -> bindParam(':date' , $date ,PDO::PARAM_STR);
            	$stmt -> bindParam(':id' , $id ,PDO::PARAM_STR);
        	    //executeで実行する
    	        $stmt -> execute();   
            }
        }
        
        //削除ボタンを押したときの動作
        elseif(isset($_POST['dele']) && !empty($_POST['pass_de'])){
            //DELETE文で入力した文を削除する
        	$id = $_POST['num_de'];//削除する番号
        	//WHEREでidを条件とする
    	    $sql = 'DELETE from webtest WHERE id = :id';
        	//変数に値を代入するのでprepareを使う
        	$stmt = $pdo -> prepare($sql);
    	    //bindParamで変数に値を代入する
        	$stmt -> bindParam(':id' , $id ,PDO::PARAM_STR);
        	//executeで実行する
    	    $stmt -> execute();
        }
        
        //編集ボタンを押したときの動作
        elseif(isset($_POST['edit']) && !empty($_POST['pass_ed'])){
            $id = $_POST['num_ed'];//編集する番号
            $pass = $_POST['pass_ed'];//編集する番号のパスワード
            //WHEREでidを条件とし、SELECT文で編集する列を選択する
            $sql = 'SELECT * FROM webtest WHERE id = :id';
            //変数に値を代入するのでprepareを使う
        	$stmt = $pdo -> prepare($sql);
        	//bindParamで変数に値を代入する
        	$stmt->bindParam(':id', $id, PDO::PARAM_STR);
        	//executeで実行する
        	$stmt -> execute();
        	//fetchAll()で全てのデータを配列にして返す
    	    $result = $stmt -> fetchAll();
    	    //編集する列の番号と名前とコメントを送信するフォームに入れる
    	    foreach($result as $row){
        	    if($row['password'] == $pass){//パスワードが一致したとき
    	            //変数に情報を代入する
    		        $edi_num = $row['id'];
    	       	    $edi_name = $row['name'];
	           	    $edi_com = $row['comment'];
        	    }else{//一致しないとき何もしない
    	        }
    	    }
        }
    	?>
    	
    	<!--入力フォーム-->
        <form action = "" method = "post">
            <!--名前の入力-->
            名前：<input type = "text" name = "name" value = "<?php echo $edi_name?>">
            <br>
            <!--コメントの入力-->
            コメント:<input type = "text" name = "com" value = "<?php echo $edi_com?>">
            <br>
            パスワード:<input type = "password" name = "pass" placeholder = "パスワード">
            <input type = "hidden" name = "categoly" value = "<?php echo $edi_num?>">
            <br>
            <!--送信ボタン-->
            <button type = "submit" name = "submit">送信</button>
            <br>
            <!--削除する番号の入力-->
            <!--未入力のとき"削除する番号"と表示-->                                                      
            <input type = "number" name = "num_de" placeholder = "削除する番号">
            <br>
            パスワード:<input type = "password" name = "pass_de" placeholder = "パスワード">
            <br>
            <button type = "submit" name = "dele">削除</button>
            <br>
            <!--編集する番号の入力-->
            <!--未入力のとき"編集する番号"と表示-->                                                      
            <input type = "number" name = "num_ed" placeholder = "編集する番号">
            <br>
            パスワード:<input type = "password" name = "pass_ed" placeholder = "パスワード">
            <br>
            <button type = "submit" name = "edit">編集</button>
        </form>
        <hr>
        <?php
    	//------------------------PHPファイルに書き込むパート------------------------------
    	
    	//テーブルwebtestの全てのidと名前とコメントをseｌect文でデータを取得する
    	$sql = 'SELECT * FROM webtest';
    	//変数に値を代入しないのでqueryを使う
    	$stmt = $pdo -> query($sql);
    	//fetchAll()で全てのデータを配列にして返す
    	$results = $stmt -> fetchAll();
    	//1行ごとのidと名前とコメントと日付を表示する
    	foreach($results as $row){
    	    //情報を書き込む
    		echo $row['id'];
	    	echo ".名前:".$row['name'];
	    	echo " 日付:".$row['date'].'<br>';
	    	echo $row['comment']."<br>";
		    echo '<hr>';
    	}
        ?>
        
        
        
    </body>
</html>