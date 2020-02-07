**docker-compose ps**

```
          Name                        Command               State                    Ports                  
------------------------------------------------------------------------------------------------------------
historia_elasticsearch_1   /docker-entrypoint.sh elas ...   Up      0.0.0.0:9200->9200/tcp, 9300/tcp        
historia_mysql_1           docker-entrypoint.sh mysqld      Up      0.0.0.0:3306->3306/tcp, 33060/tcp       
historia_nginx_1           /bin/bash opt/startup.sh local   Up      0.0.0.0:443->443/tcp, 0.0.0.0:80->80/tcp
historia_nodejs_1          node                             Up      3000/tcp                                
historia_php-fpm_1         /bin/bash /opt/startup.sh        Up      9000/tcp, 0.0.0.0:9001->9001/tcp        
historia_redis_1           docker-entrypoint.sh redis ...   Up      0.0.0.0:3679->6379/tcp                  
historia_swagger_1         sh /usr/share/nginx/run.sh       Up      80/tcp, 0.0.0.0:81->8080/tcp
```


These services will be installed on AWS environment
- nginx
- nodejs
- php-fpm
