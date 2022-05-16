## このシステムは家にあるものの在庫を管理したり、買い物リストを作成することを目的としたシステムです。

# 使用方法
このTeamDevelopmentをxamppのhtdocsの中にダウンロードしたらcomposerのダウンロードをしてlaravelの環境構築をしてください。
そのあとに、.envのAPP＿NAMEにデータベースの名前を入力し、xamppのphpmyadminの新規作成の部分でAPP_NAMEに入力した内容と同じ内容を入力し、
php artisan migrateを実行して、DBデータを作成してください。
作成したらphp artisan serveを実行し、URLの部分の後ろに、/registerを入力するか右上のregisterをクリックすることで、
会員登録画面に遷移することができます。そこで、フォームにすべて入力して登録すれば、メイン画面へ遷移し使用ができるようになります。

# 環境について
使用エディタ　VScode
OS Windows10
laravel v9.12.2
php：^ 8.0.2
