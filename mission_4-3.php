<!DOCTYPE html>
<html lang = "ja">
    <head>
        <meta charset = "UTF-8">
        <title>mission4-3</title>
    </head>
    <body>
        <?php
        //データベースの接続
	    $dsn = 'データベース名';
    	$user = 'ユーザー名';
	    $password = 'パスワード';
    	$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
    	
    	//データベースのテーブル一覧を表示
    	$sql ='SHOW TABLES';
        $result = $pdo -> query($sql);
	    foreach ($result as $row){
		    echo $row[0];
		    echo '<br>';
	    }
	    echo "<hr>";
    	
        ?>
    </body>
</html>