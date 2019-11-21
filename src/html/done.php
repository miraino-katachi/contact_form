<?php
// セッションスタート
session_start();
session_regenerate_id(true);

// セッションをクリア
$_SESSION['err_msg'] = null;
$_SESSION['post'] = null;

/*
必要に応じて
メール送信の処理
データベースへのインサート処理
を行う。
*/
?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <title>お問い合わせ完了</title>
    <link rel="stylesheet" href="./css/normalize.css">
    <link rel="stylesheet" href="./css/main.css">
</head>

<body>
    <div class="container">
        <h1>お問い合わせ完了</h1>
        <p>
            お問い合わせいただき、ありがとうございます。<br>
            担当より連絡いたしますので、しばらくお待ち下さい。
        </p>
        <button id="goback">戻る</button>
    </div>

    <script src="./js/jquery-3.4.1.min.js"></script>
    <script>
        // 戻るボタンがクリックされたイベントを取得
        $('#goback').click(function() {
            location.href = "./";
        });
    </script>

</body>

</html>