#FashionablyLate
お問い合わせフォームと管理画面を備えたWebアプリケーションです。
ユーザー登録・ログイン後、管理画面でお問い合わせ情報の検索・詳細表示・削除・CSVエクスポートができます。

##環境構築
Dockerビルド
・git clone git@github.com:shintaroooo/test_contact-form.git
・docker compose up -d --build

Laravel環境構築
・docker compose exec php bash
・composer install
・co .env.example .env , 環境変数を適宜変更
・php artisan key:generate
・php artisan migrate
・php artisan db:seed

開発環境
・お問い合わせ入力画面:http://localhost/
・ユーザー登録：http://localhost/register
・ユーザーログイン：http://localhost/login
・会員管理画面：http://localhost/admin
・
・phpMyAdmin:http://localhost:8080/index.php


##使用技術（実行環境）
・PHP / Laravel
・Laravel Fortify（認証）
・MySQL
・Docker / docker-compose
・Blade / CSS / JavaScript（管理画面のモーダルで使用）
・CSVエクスポート機能

##ER図
![ER図](./docs/er.png)

##URL
開発環境を参照

#動作確認手順
1. トップ（お問い合わせ入力）
http://localhost/ にアクセス
必須項目を未入力で「確認画面」を押し、バリデーションメッセージが表示されることを確認
正常入力 → Confirm → 送信 → thanks を確認

2. 会員登録 → 管理画面へ
http://localhost/register にアクセス
名前/メール/パスワードを入力して登録
登録完了後、管理画面（/admin）に遷移することを確認

3. ログイン → 管理画面へ
http://localhost/login にアクセス
登録済みユーザーでログイン
/admin に遷移することを確認

4. 管理画面（検索・詳細・削除）
/admin にアクセス
検索フォームで条件指定し「検索」→ 結果が表示されることを確認
一覧の「詳細」ボタン → モーダルが表示されることを確認
モーダル内の「削除」 → データ削除 → delete画面表示 を確認

5. CSVエクスポート
/admin または /search で一覧を表示
「エクスポート」クリック
CSVが自動ダウンロードされることを確認
export画面に遷移することを確認

6. リセット
/search で検索条件を指定
「リセット」→ reset画面表示 → 「TOPに戻る」→ /admin に戻ることを確認

7. ログアウト
管理画面右上の logout をクリック
ログアウト完了画面が表示されることを確認
「ログイン画面に戻る」→ /login に戻ることを確認
