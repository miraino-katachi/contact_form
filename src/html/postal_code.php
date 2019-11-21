<?php
// サニタイズ
$code = htmlspecialchars($_GET['postal_code'], ENT_QUOTES, 'UTF-8');

// HTMLではなく、JSONとしてレスポンスを返却する。
header('Content-Type: application/json');

$msg = '';
$validityCheck = true;

// 郵便番号のバリデーション
if (empty($code)) {
    $msg = "郵便番号を入力してください。";
    $validityCheck = false;
}

if (!preg_match('/^[0-9]{3}-?[0-9]{4}$/', $code)) {
    $msg = "郵便番号は半角数字と半角ハイフンで、正しく入力してください。";
    $validityCheck = false;
}

// 郵便番号の数字だけを抜き取る。
$code = preg_replace('/\D/', '', $code);

// バリデーションエラーのときは、エラーメッセージをJSONで出力する。
if (!$validityCheck) {
    echo json_encode(array('msg' => $msg));
    exit;
}

try {
    // データベースに接続
    $dsn = 'mysql:dbname=contact_form;host=localhost;charset=utf8';
    $dbh = new PDO($dsn, 'root', 'root');
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // 住所を検索
    $sql = '';
    $sql .= "select ";
    $sql .= "prefecture, address1, address2 ";
    $sql .= "from postal_code ";
    $sql .= "where postal_code=:postal_code";

    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':postal_code', $code, PDO::PARAM_STR);
    $stmt->execute();

    $ret = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // レコードカウントが0のときは、エラーメッセージをJSONで出力する。
    if (count($ret) == 0) {
        echo json_encode(array('msg' => '該当の郵便番号が見つかりませんでした。'));
        exit;
    }

    // 取得したレコードをJSONエンコードして出力する。
    echo json_encode($ret[0]);
} catch (Exception $e) {
    // 例外が発生したときは、エラーメッセージをJSONで出力する。
    echo json_encode(array('msg' => 'エラーが発生しました。'));

    // 例外の内容を知りたいとき
    // echo json_encode(array('msg' => $e->getMessage()));
    exit;
}
