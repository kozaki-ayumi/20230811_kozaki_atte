# 20230811_kozaki_atte

# アプリケーション名：atte
就業での使用を想定した勤怠打刻システム。

初回使用時はユーザー登録が必要であり、以降はログインして使用。

勤務開始・終了時間、休憩開始・終了時間を打刻でき、1日の勤務合計時間を算出できる。

※トップ画面の画像を貼り付けることができませんでした。案件シートの「トップ画面画像」に添付しています。


## 作成した目的
勤務時間の管理に必要だったため。


## アプリケーションURL
今回はウェブサイトに構築できていません。


## 機能一覧
新規会員登録機能（メール認証あり）

ログイン機能

勤務開始・終了時間の打刻

休憩開始・終了時間の打刻（1日何回でも可能）

日付別勤怠表の表示

会員別勤怠表の表示


## 使用技術
laravel Framework 8.83.27


## テーブル設計
案件シートの「テーブル仕様書」をご確認ください


## ER図
案件シートの「ER図」をご確認ください。


# 環境構築
①Githubに開発したlaravelのファイルがありますので、以下をコマンドラインで入力してクローンしてください。

$ git clone git@github.com:kozaki-ayumi/20230811_kozaki_atte.git

②コマンドライン上に以下を入力し、Dockerにコンテナを作成してください。

$ docker-compose up -d --build

③PHPコンテナ内にログインしてください。

$ docker-compose exec php bash

④必要なパッケージをインストールしてください。

$ composer install

⑤ .envファイルを作成してください。 .env.exampleファイルをコピーして作成できます。

$ cp .env.example .env

⑥ ⑤で作成した .envファイルの11行目以降を下記のように修正してください。

// 前略
DB_CONNECTION=mysql
-  DB_HOST=127.0.0.1
+ DB_HOST=mysql
DB_PORT=3306
-  DB_DATABASE=laravel
-  DB_USERNAME=root
-  DB_PASSWORD=
+ DB_DATABASE=laravel_db
+ DB_USERNAME=laravel_user
+ DB_PASSWORD=laravel_pass
// 後略
