<?php
// クラスの読み込み
require_once('./class/ValidationUtil.php');

// セッションスタート
session_start();
session_regenerate_id(true);

// フォームで送信されてきたトークンが正しいかどうか確認（CSRF対策）
if (!isset($_SESSION['token']) || $_SESSION['token'] !== $_POST['token']) {
    $_SESSION['err_msg']['err'] = "不正な処理が行われました。";
    header('Location: ./');
    exit;
}

// サニタイズ
foreach ($_POST as $k => $v) {
    $post[$k] = htmlspecialchars($v, ENT_QUOTES, 'UTF-8');
}

// エラーメッセージをクリアする
unset($_SESSION['err_msg']);
$_SESSION['err_msg'] = null;

// POSTされてきた値をセッションに代入する
$_SESSION['post'] = $post;

// バリデーションチェック
$validityCheck = array();

// 名前のバリデーション
$validityCheck[] = ValidationUtil::isValidName($post['name'], $_SESSION['err_msg']['name']);

// 郵便番号のバリデーション
$validityCheck[] = ValidationUtil::isValidPostalCode($post['postal_code'], $_SESSION['err_msg']['postal_code']);

// 都道府県のバリデーション
$validityCheck[] = ValidationUtil::isValidPref($post['pref'], $_SESSION['err_msg']['pref']);

// 市区町村のバリデーション
$validityCheck[] = ValidationUtil::isValidAddress1($post['address1'], $_SESSION['err_msg']['address1']);

// 町名番地等のバリデーション
$validityCheck[] = ValidationUtil::isValidAddress2($post['address2'], $_SESSION['err_msg']['address2']);

// メールアドレスのバリデーション
$validityCheck[] = ValidationUtil::isValidEmail($post['email'], $_SESSION['err_msg']['email']);

// 電話番号のバリデーション
$validityCheck[] = ValidationUtil::isValidPhoneNumber($post['phone_number'], $_SESSION['err_msg']['phone_number']);

// お問い合わせ内容のバリデーション
$validityCheck[] = ValidationUtil::isValidContact($post['contact'], $_SESSION['err_msg']['contact']);

// バリデーションで不備があった場合
foreach ($validityCheck as $k => $v) {
    // $vにnullが代入されている可能性があるので、必ず「===」で比較する。ß
    if ($v === false) {
        header('Location: ./');
        exit;
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <title>お問い合わせ</title>
    <link rel="stylesheet" href="./css/normalize.css">
    <link rel="stylesheet" href="./css/main.css">
</head>

<body>
    <div class="container">
        <h1>お問い合わせ内容確認</h1>
        <p>
            下記の内容でよろしければ「送信」ボタンを押してください。
        </p>
        <table>
            <tr>
                <th>お名前</th>
                <td>
                    <?= $post['name'] ?>
                </td>
            </tr>
            <tr>
                <th>住所</th>
                <td>
                    〒<?= $post['postal_code'] ?><br>
                    <?= $post['pref'] ?><br>
                    <?= $post['address1'] ?><br>
                    <?= $post['address2'] ?><br>
                </td>
            </tr>
            <tr>
                <th>メールアドレス</th>
                <td>
                    <?= $post['email'] ?>
                </td>
            </tr>
            <tr>
                <th>電話番号</th>
                <td>
                    <?= $post['phone_number'] ?>
                </td>
            </tr>
            <tr>
                <th>お問い合わせ内容</th>
                <td>
                    <?= nl2br($post['contact']) ?>
                </td>
            </tr>
        </table>
        <button id="submit">送信</button>
        <button id="goback">戻る</button>
    </div>

    <script src="./js/jquery-3.4.1.min.js"></script>
    <script>
        // 送信ボタンがクリックされたイベントを取得
        $('#submit').click(function() {
            location.href = "./done.php";
        });

        // 戻るボタンがクリックされたイベントを取得
        $('#goback').click(function() {
            location.href = "./";
        });
    </script>

</body>

</html>