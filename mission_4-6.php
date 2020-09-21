<!DOCTYPE html>
<html lang = "ja">
    <head>
        <meta charset = "UTF-8">
        <title>mission4-6</title>
    </head>
    <body>
        <?php
        //データベースの接続
    	$dsn = 'データベース名';
    	$user = 'ユーザー名';
	    $password = 'パスワード';
    	$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
    	
    	//テーブルtbtestにidと名前とコメントをselect文でデータを取得する
    	$sql = "SELECT * FROM tbtest";
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