# 【PHP】お問い合わせフォーム

https://demo.miraino-katachi.com/contact_form/

入力フォームを作成します。下記のことを練習できます。
- フォームから入力した値の受け取り
- ワンタイムトークンを使ったCSRF対策
- 受け取った値のサニタイジング（XSS対策）
- 受け取った値のバリデーション
- セッションの使い方

*郵便番号→住所検索は、余力があればチャレンジしてみてください！*

## 仕様書について

doc/お問合せフォーム.pdf

を御覧ください。

## 学習期間の目安（5日）

学習時間は1日4時間を想定しています。

1. 仕様書の把握 → 1日
2. フォームから入力した値を確認ページで受け取れるようにする → 1日
3. 確認ページから最終ページへセッションを使って値を渡せるようにする → 1日
4. フォームから入力した値の妥当性チェック（バリデーション）を実装する → 1日
5. バリデーションエラーの内容をフォームに表示できるようにする → 1日

## HTMLの雛形

doc/mock/

以下にあるファイルをご利用ください。

HTMLフィルの拡張子を「.php」に変えて、PHPのソースを埋め込むと、効率よく学習していただけます。

## サンプルソース

src/html

以下に、サンプルのソースを置いています。

## そのほか

ソースコードの中に、コメントで「ヒント」をたくさん書いてあります。 書き方がわからないときは、ソースコードを見て確認しましょう。
