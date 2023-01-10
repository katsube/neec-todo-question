# 日本工学院 ToDo（JS+PHP版）
日本工学院八王子専門学校 ゲーム科 実習用リポジトリです。

## 利用方法
### データベースにテーブル作成
`sql/initialize/01_createtable_task.sql`内にあるデータベース名を変更し後に以下のコマンドを実行、テーブルを作成します。
```shellsession
$ mysql -u G999A9999 -p < sql/initialize/*.sql
```

### 接続情報を保存
`config/database.php.sample`をコピーし`config/database.php`という名前で保存、内容を編集します。

```php
// 接続先
define('CONFIG_DB_DSN',  'mysql:dbname=(学籍番号+db);host=localhost');

// アカウント
define('CONFIG_DB_USER', '学籍番号');		// ユーザー名
define('CONFIG_DB_PASS', 'xxxxxxxx');		// パスワード
```
パスワードなどの接続情報は各自のホームディレクトリに保存してあります。

```shellsession
$ cat ~/.mysqlpasswd
```


### WinSCPでアップロード
必要なファイルを`htdocs`配下にアップロードし、Webブラウザから`index.html`へアクセスすれば動作を確認できます。


