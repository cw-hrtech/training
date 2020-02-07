## laravel

SSH vào service **php-fpm** để thực hiện cài đặt laravel
```
docker-compose exec --user=training php-fpm bash
```

di chuyển tới thư mục chính để cài đặt

```
cd /var/www
rm -rf public
composer create-project --prefer-dist laravel/laravel .
```

edit file .env thay đổi thông tin kết nối database, redis

**database**
```
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=db_web
DB_USERNAME=default
DB_PASSWORD=123456
```

**redis**
```
REDIS_HOST=redis
REDIS_PASSWORD=null
REDIS_PORT=6379
```

```
QUEUE_CONNECTION=redis
SESSION_DRIVER=redis
```