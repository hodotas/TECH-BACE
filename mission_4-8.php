<!DOCTYPE html>
<html lang = "ja">
    <head>
        <meta charset = "UTF-8">
        <title>mission4-8</title>
    </head>
    <body>
        <?php
        //データベースの接続
	$dsn = 'データベース名';
    	$user = 'ユーザー名';
	$password = 'パスワード';
    	$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
    	
    	//DELETE文で入力した文を削除する
    	$id = 2;//削除する番号
    	//WHRERでidを条件とする
    	$sql = 'DELETE from tbtest WHERE id = :id';
    	//変数に値を代入するのでprepareを使う
    	$stmt = $pdo -> prepare($sql);
    	//bindParamで変数に値を代入する
    	$stmt -> bindParam(':id' , $id ,PDO::PARAM_STR);
    	//executeで実行する
    	$stmt -> execute();
    	
    	//bindParamを使わない場合
    	//$stmt -> execute(array(':name' => $name,':comment' => $comment,':id' => $id));
    	
    	//テーブルtbtestにidと名前とコメントをseｌect文でデータを取得する
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
