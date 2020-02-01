<?php
// セッションスタート
session_start();
session_regenerate_id(true);

// ワンタイムトークンを生成してセッションに保存（CSRF対策）
// https://www.php.net/manual/ja/function.openssl-random-pseudo-bytes.php
$token = bin2hex(openssl_random_pseudo_bytes(16));
$_SESSION['token'] = $token;

// 都道府県のリスト
$prefList = [
    1 => '北海道', 2 => '青森県', 3 => '岩手県', 4 => '宮城県', 5 => '秋田県',
    6 => '山形県', 7 => '福島県', 8 => '茨城県', 9 => '栃木県', 10 => '群馬県',
    11 => '埼玉県', 12 => '千葉県', 13 => '東京都', 14 => '神奈川県', 15 => '新潟県',
    16 => '富山県', 17 => '石川県', 18 => '福井県', 19 => '山梨県', 20 => '長野県',
    21 => '岐阜県', 22 => '静岡県', 23 => '愛知県', 24 => '三重県', 25 => '滋賀県',
    26 => '京都府', 27 => '大阪府', 28 => '兵庫県', 29 => '奈良県', 30 => '和歌山県',
    31 => '鳥取県', 32 => '島根県', 33 => '岡山県', 34 => '広島県', 35 => '山口県',
    36 => '徳島県', 37 => '香川県', 38 => '愛媛県', 39 => '高知県', 40 => '福岡県',
    41 => '佐賀県', 42 => '長崎県', 43 => '熊本県', 44 => '大分県', 45 => '宮崎県',
    46 => '鹿児島県', 47 => '沖縄県',
];
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
        <h1>お問い合わせ</h1>
        <p>
            お問い合わせは下記のフォームよりお願いいたします。<br>
            <span class="required">必須</span>マークは必須入力項目です。
        </p>
        <?php if (isset($_SESSION['err_msg']['err'])) : ?><p class="warning"><?= $_SESSION['err_msg']['err'] ?></p><?php endif ?>

        <form method="post" action="./confirm.php">
            <input type="hidden" name="token" value="<?= $token ?>">
            <table>
                <tr>
                    <th><span class="input_name">お名前</span><span class="required input_required">必須</span></th>
                    <td>
                        <?php if (isset($_SESSION['err_msg']['name'])) : ?><p class="warning"><?= $_SESSION['err_msg']['name'] ?></p><?php endif ?>
                        <input type="text" name="name" class="name" data-target="form" value="<?php if (isset($_SESSION['post']['name'])) echo $_SESSION['post']['name'] ?>">
                        （50文字以内）
                    </td>
                </tr>
                <tr>
                    <th>
                        <span class="input_name">住所</span><span class="required input_required">必須</span>
                    </th>
                    <td>
                        郵便番号：（半角数字と半角ハイフンのみ）<br>
                        <?php if (isset($_SESSION['err_msg']['postal_code'])) : ?><p class="warning" id="posttal_err"><?= $_SESSION['err_msg']['postal_code'] ?></p><?php endif ?>
                        <input type="text" class="postal" name="postal_code" id="postal_code" data-target="form" value="<?php if (isset($_SESSION['post']['postal_code'])) echo $_SESSION['post']['postal_code'] ?>">
                        <button id="search" type="button">住所検索</button><br>
                        都道府県：
                        <?php if (isset($_SESSION['err_msg']['pref'])) : ?><p class="warning" id="pref_err"><?= $_SESSION['err_msg']['pref'] ?></p><?php endif ?>
                        <select name="pref" id="pref" data-target="form">
                            <option value="">--選択してください--</option>
                            <?php foreach ($prefList as $v) : ?>
                                <option value="<?= $v ?>" <?php if (isset($_SESSION['post']['pref']) && $_SESSION['post']['pref'] == $v) echo " selected" ?>><?= $v ?></option>
                            <?php endforeach ?>
                        </select><br>
                        市区町村：（50文字以内）<br>
                        <?php if (isset($_SESSION['err_msg']['address1'])) : ?><p class="warning" id="address1_err"><?= $_SESSION['err_msg']['address1'] ?></p><?php endif ?>
                        <input type="text" class="address" name="address1" id="address1" data-target="form" value="<?php if (isset($_SESSION['post']['address1'])) echo $_SESSION['post']['address1'] ?>">
                        <br>
                        町名番地等：（50文字以内）<br>
                        <?php if (isset($_SESSION['err_msg']['address2'])) : ?><p class="warning" id="address2_err"><?= $_SESSION['err_msg']['address2'] ?></p><?php endif ?>
                        <input type="text" class="address" name="address2" id="address2" data-target="form" value="<?php if (isset($_SESSION['post']['address2'])) echo $_SESSION['post']['address2'] ?>">
                    </td>
                </tr>
                <tr>
                    <th>
                        <span class="input_name">メールアドレス</span><span class="required input_required">必須</span>
                    </th>
                    <td>
                        <?php if (isset($_SESSION['err_msg']['email'])) : ?><p class="warning"><?= $_SESSION['err_msg']['email'] ?></p><?php endif ?>
                        <input type="email" class="email" name="email" data-target="form" value="<?php if (isset($_SESSION['post']['email'])) echo $_SESSION['post']['email'] ?>">
                    </td>
                </tr>
                <tr>
                    <th>
                        <span class="input_name">電話番号</span>
                    </th>
                    <td>
                        <?php if (isset($_SESSION['err_msg']['phone_number'])) : ?><p class="warning"><?= $_SESSION['err_msg']['phone_number'] ?></p><?php endif ?>
                        <input type="tel" name="phone_number" data-target="form" value="<?php if (isset($_SESSION['post']['phone_number'])) echo $_SESSION['post']['phone_number'] ?>">（半角数字と半角ハイフンのみ）
                    </td>
                </tr>
                <tr>
                    <th>
                        <span class="input_name">お問い合わせ内容</span>
                    </th>
                    <td>
                        <?php if (isset($_SESSION['err_msg']['contact'])) : ?><p class="warning"><?= $_SESSION['err_msg']['contact'] ?></p><?php endif ?>
                        <textarea name="contact" data-target="form"><?php if (isset($_SESSION['post']['contact'])) echo $_SESSION['post']['contact'] ?></textarea><br>
                        （1,000文字以内）
                    </td>
                </tr>
            </table>
            <input type="submit" value="確認">
            <button type="button" id="reset">リセット</button>
        </form>
    </div>
    <script src="./js/jquery-3.4.1.min.js"></script>
    <script>
        // 郵便番号→住所検索
        $('#search').click(function() {
            var postal = $('#postal_code').val();
            $.ajax({
                type: "GET",
                url: "./postal_code.php",
                data: {
                    postal_code: postal
                },
                success: function(data) {
                    if (data['msg']) {
                        // エラーメッセージがあるとき→住所検索失敗
                        $('#pref').val('');
                        $('#address1').val('');
                        $('#address2').val('');
                        $('#posttal_err').text(data['msg']);
                    } else {
                        // エラーメッセージがないとき→住所検索成功
                        $('#pref').val(data.prefecture);
                        $('#address1').val(data.address1);
                        $('#address2').val(data.address2);
                        $('#posttal_err').text('');
                    }
                }
            });
        });

        // 入力内容のリセット
        $('#reset').click(function() {
            // .worningのクラス名がついた要素のテキストを空にする。
            $('.warning').text('');
            // data-target="form"の入力項目の内容を空にする。
            $('[data-target="form"]').val('');
        });
    </script>
</body>

</html>