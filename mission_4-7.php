<!DOCTYPE html>
<html lang = "ja">
    <head>
        <meta charset = "UTF-8">
        <title>mission4-7</title>
    </head>
    <body>
        <?php
        //データベースの接続
	$dsn = 'データベース名';
    	$user = 'ユーザー名';
	$password = 'パスワード';
    	$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
    	
    	//UPDATE文入力した文を編集する
    	$id = 3;//編集する番号
    	$name = "gamma";//編集後の名前
    	$comment = "Hello!";//編集後のコメント
    	//WHRERでidを条件とし、SETでnameとcommentのプレースホルダーを作成する
    	$sql = 'UPDATE tbtest SET name = :name , comment = :comment WHERE id = :id';
    	//変数に値を代入するのでprepareを使う
    	$stmt = $pdo -> prepare($sql);
    	//bindParamで変数に値を代入する
    	$stmt -> bindParam(':name' , $name ,PDO::PARAM_STR);
    	$stmt -> bindParam(':comment' , $comment ,PDO::PARAM_STR);
    	$stmt -> bindParam(':id' , $id ,PDO::PARAM_STR);
    	//executeで実行する
    	$stmt -> execute();
    	
    	//bindParamを使わない場合
    	//$stmt -> execute(array(':name' => $name,':comment' => $comment,':id' => $id));
    	
    	//テーブルtbtestにidと名前とコメントをselect文でデータを取得する
    	$sql = 'SELECT * FROM tbtest';
    	$stmt = $pdo -> query($sql);
    	//fetchAll()で全てのデータを配列にして返す
    	$results = $stmt -> fetchAll();
    	//1行ごとのidと名前とコメントを表示する
    	foreach($results as $row){
    	    //$rowの中にはテーブルのカラム名が入る
    		echo $row['id'].',';
	    	echo $row['name'].',';
		echo $row['comment'].'<br>';
	        echo '<hr>';
    	}
    	
        ?>
    </body>
</html>
