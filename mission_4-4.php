<!DOCTYPE html>
<html lang = "ja">
    <head>
        <meta charset = "UTF-8">
        <title>mission4-4</title>
    </head>
    <body>
        <?php
        //データベースの接続
    	$dsn = 'データベース名';
    	$user = 'ユーザー名';
	    $password = 'パスワード';
    	$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
    	
    	//データベースのテーブルの構成詳細を表示
    	$sql ='SHOW CREATE TABLE tbtest';
	    $result = $pdo -> query($sql);
	    foreach ($result as $row){
		    //echo $row[1];
		    print_r($row);
	    }
	    echo "<hr>";
    	
        ?>
    </body>
</html>