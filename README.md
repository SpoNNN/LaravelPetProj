
# Laravel pet project

Сайт для пожертвований

Подключена Юкасса для оплат (Тестовый магазин)

Фронт: Html, Bootstrap, Jquery (Для обработки и ошибок через ajax; Анимация) \
Бэк: Laravel 12 , Php 8.3, MySQL 8.0

## Требования

Перед запуском убедитесь, что у вас установлено:

- PHP >= 8.3 
- Composer
- MySQL 
- Git


---
## Установка и настройка

### 1. Клонирование репозитория
```
git clone https://github.com/username/repository.git
cd repository
```
### 2. Установка зависимостей
```
composer install
```

### 3. Настройка env 
Необходимо переименовать .env.example в .env \
Сделать ключ ларавеля:

```
php artisan key:generate
```
Настройка бд:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=<Имя базы данных>
DB_USERNAME=<Логин>
DB_PASSWORD=<Пароль>
```

Необходимо указать поля для Юкассы:
```
YOO_KASSA_SHOP_ID=<ID магазина>
YOO_KASSA_SECRET_KEY=<Api ключ Юкассы>
YOO_KASSA_RETURN_URL=<Ссылка на сайт>/yookassa/webhook
```
Api ключ находится [Здесь](https://yookassa.ru/my/merchant/integration/api-keys) \
Для получения ID магазина, необходимо его создать в [Юкассе](https://yookassa.ru/my/merchant/integration/api-keys?shopMenuAction=createShop) \
YOO_KASSA_RETURN_URL необходим для получения статуса оплаты [Ссылка](https://yookassa.ru/my/merchant/integration/http-notifications) 

Для настройки уведомлений на почту необходимо заполнить:
```
MAIL_MAILER=log
MAIL_SCHEME=null
MAIL_HOST=127.0.0.1
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"
```
### 4. Настройка базы данных
Создайте базу данных и выполните миграции:
```
php artisan migrate
```
### 5. Запуск локального сервера и установка storage
```
php artisan storage:link
php artisan serve
```
### 6. Запуск событий и очередей, а также планировщика задач
```
php artisan queue:work
php artisan schedule:work
```
### TODO
Вывод ошибок на фронт(форма профиля, форма доната), вывод

### Полезные ссылки
[Php sdk Юкассы и документация](https://github.com/yoomoney/yookassa-sdk-php) \
[Работа с API Юкассы](https://yookassa.ru/developers) \
[Документация Laravel](https://laravel.com/docs/)

