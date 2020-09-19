<!DOCTYPE html>
<html lang = "ja">
    <head>
        <meta charset = "UTF-8">
        <title>mission1-20</title>
    </head>
    <body>
        <!--入力フォーム-->
        <form action = "" method = "post">
            <!--一行の入力-->
            <input type = "text" name = "str">
            <!--送信ボタン-->
            <input type = "submit" name = "submit">
        </form>
    
        <?php
            //入力した文を$strに代入する
            $str = $_POST["str"];
            echo $str;
        ?>
    </body>
</html>