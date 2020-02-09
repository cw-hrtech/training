chạy lệnh sau để khơi tạo toàn bộ services 
```
docker-compose up -d
```

kiểm tra các services

```
docker-composer ps
```

```
        Name                       Command               State                    Ports                  
---------------------------------------------------------------------------------------------------------
training_mysql_1        docker-entrypoint.sh mysqld      Up      0.0.0.0:3306->3306/tcp, 33060/tcp       
training_nginx_1        nginx -g daemon off;             Up      0.0.0.0:443->443/tcp, 0.0.0.0:80->80/tcp
training_nuxtjs_1       docker-entrypoint.sh node        Up      3000/tcp                                
training_php-fpm_1      /bin/bash /opt/startup.sh        Up      9000/tcp, 9001/tcp                      
training_phpmyadmin_1   /docker-entrypoint.sh apac ...   Up      0.0.0.0:8080->80/tcp                    
training_redis_1        docker-entrypoint.sh redis ...   Up      0.0.0.0:3679->6379/tcp
```

|Services        |Description                    |Exec|
|----------------|-------------------------------|---|
|mysql      |nơi lưu trữ database của hệ thống  |docker-compose exec mysql bash|
|nginx      |webserver                          |docker-compose exec nginx bash|
|nuxtjs     |nơi thực thi code nuxtjs           |docker-compose exec --user=node nuxtjs bash|
|php-fpm    |compibe PHP                        |docker-compose exec --user=traning php-fpm bash|
|phpmyadmin |giao diện quản trị dữ liệu         |---|
|redis      |cache services                     |docker-compose exec redis bash|
