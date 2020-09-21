<!DOCTYPE html>
<html lang = "ja">
    <head>
        <meta charset = "UTF-8">
        <title>mission4-5</title>
    </head>
    <body>
        <?php
        //データベースの接続
    	$dsn = 'データベース名';
    	$user = 'ユーザー名';
	$password = 'パスワード';
    	$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
    	
    	//テーブルtbtestに名前とコメントをinsert文で入力する
    	$sql = $pdo -> prepare("INSERT INTO tbtest (name,comment) VALUES (:name,:comment)");
    	$sql -> bindParam(':name' , $name , PDO::PARAM_STR);
    	$sql -> bindParam(':comment' , $comment , PDO::PARAM_STR);
    	$name = "beeta";
    	$comment = "これはテストです";
    	$sql -> execute();
    	
        ?>
    </body>
</html>
