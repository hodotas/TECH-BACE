<!DOCTYPE html>
<html lang = "ja">
    <head>
        <meta charset = "UTF-8">
        <title>mission4-2</title>
    </head>
    <body>
        <?php
        //データベースの接続
	    $dsn = 'データベース名';
    	$user = 'ユーザー名';
	    $password = 'パスワード';
    	$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
    	
    	//データベース内にテーブルを作成
    	$sql = "CREATE TABLE IF NOT EXISTS tbtest"
	    ." ("
    	. "id INT AUTO_INCREMENT PRIMARY KEY,"
	    . "name char(32),"
    	. "comment TEXT"
	    .");";
    	$stmt = $pdo->query($sql);
    	
        ?>
    </body>
</html>