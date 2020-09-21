<!DOCTYPE html>
<html lang = "ja">
    <head>
        <meta charset = "UTF-8">
        <title>mission4-9</title>
    </head>
    <body>
        <?php
        //データベースの接続
    	$dsn = 'データベース名';
    	$user = 'ユーザー名';
	    $password = 'パスワード';
    	$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
    	
    	//DROP文でテーブルを削除する
    	$sql = 'DROP TABLE tbtest';
    	$stmt = $pdo -> query($sql);
        ?>
    </body>
</html>