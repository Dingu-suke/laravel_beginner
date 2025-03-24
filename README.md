## cloneしたディレクトリに移動
1. git clone後、cdコマンドを使用してcloneしたディレクトリに移動してください。
```
$ cd xxxx_xxxx_beginner_laravel
```

2. Docker Desktopアプリを立ち上げる
Docker Deskアプリを立ち上げてください。

■ Windowsを使用している方
ディスクトップに表示されている検索欄に「Dokcer Desktop」と打ち込んで、検索結果に表示された項目をクリックしてください。
[![Image from Gyazo](https://t.gyazo.com/teams/startup-technology/7ed4318805455ba0056ab6bd8b6d869d.gif)](https://startup-technology.gyazo.com/7ed4318805455ba0056ab6bd8b6d869d)

■ Macを使用している方
commandキー + スペースバー で Spotlight を表示したら、『docker」と打ち込んで、検索結果に表示された Docker.app をクリックしてください。
[![Image from Gyazo](https://t.gyazo.com/teams/startup-technology/e0744c7e3a010fddc4ba1057e36e89bb.gif)](https://startup-technology.gyazo.com/e0744c7e3a010fddc4ba1057e36e89bb)

3. コンテナの立ち上げ
以下のコマンドを順番に実行してコンテナを立ち上げてください。

```
$ docker compose build

$ docker compose up
```

4. パッケージ管理システムをインストールする
docker compose up が実行されているターミナルとは別のターミナルを立ち上げて、以下のコマンドを実行してください。

```
$ docker compose run app composer install

$ docker compose build --force-rm
```

5. マイグレーション実行
docker compose up が実行されているターミナルとは別のターミナルで、以下のコマンドを実行してください。

```
$ docker compose exec app php artisan migrate

$ docker compose run app php artisan migrate --env=testing

（※ Would you like to create it? (yes/no) [yes] と表示されたら yes と入力してください）
```

6. ブラウザにて画面が表示されるか確認する
http://localhost:3000/ にアクセスして、以下の画面が表示されるかを確認してください。

[![Image from Gyazo](https://t.gyazo.com/teams/startup-technology/9d5d8fc0ec9c2a52b1c14a4982d5d4d8.png)](https://startup-technology.gyazo.com/9d5d8fc0ec9c2a52b1c14a4982d5d4d8)


<br /><br />


### Dockerコンテナを終了する際の操作

```bash
$ docker compose down
```
