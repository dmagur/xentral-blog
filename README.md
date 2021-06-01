### Installation
- go to docker subdir
- run ```docker-compose build```
- run ```docker-compose run php composer install```
- run ```docker-compose up```
- create database "blog" and import dump.sql with http://localhost:8080
- to create user run ```docker-compose run php bin/add_user.php _email_ _password_ _firstName_ _lastName_```

