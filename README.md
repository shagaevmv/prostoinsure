Для запуска приложения используем:
1) заходим в папку с приложением и в консоле запускаем команду vagrant up
2) после развертывания вирутальной машины, заходим в неё - `vagrant ssh`
3) переходим в папку с приложением `cd /app`
4) применяем миграцию `php yii migrate`
5) для обновления курса валюты `php yii currency/update`
6) для получения списка валют через api:

`curl -i -H "Authorization: Bearer 100-token" "http://yii2basic.test/currency?page=2"`

либо, если используете PhpStorm можно воспользоваться файлом ~/controllers/http/index.http

7) для получения валюты по id через api:

`curl -i -H "Authorization: Bearer 100-token" "http://yii2basic.test/currency/36"`

либо, если используете PhpStorm можно воспользоваться файлом ~/controllers/http/view.http

Email: shagaevmv@gmail.com

Skype: shagaev_mv