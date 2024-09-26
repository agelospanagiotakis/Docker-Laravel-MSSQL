# Docker +  PHP 8 + Laravel + MSSQL 

## Versions 

- PHP 8.2-fpm
- Laravel 11
- Laravel 11 - must have ODBC Driver 17 for SQL Server
- MS SQL Server


## Build
build the docker images 
```
docker compose build 
```
or 
```
docker compose build --no-cache
```

important files to review and change: 

- for the overall docker configuration 
    - see [docker-compose.yml](docker-compose.yml)
- for variables see .env files on [.env](.env)
- see how the MSSQL support is created [docker/app.dockerfile](docker/app.dockerfile)
- see how nginx is created to serve laravel [docker/web.dockerfile](docker/web.dockerfile)
- see how nginx is configured [docker/vhost.conf](docker/vhost.conf)
  - remember : app:9000 is pointing to the laravel php container 

## Setup 

place you laravel app on app folder
if needed (for example if you are using Vite) go to app folder and run 

```
docker exec -it app sh
#cd /var/www/app/ 
# npm run dev
or
npm run dev -- --host

```


## RUN

simply run 
```
docker compose up -d 
```

visit [your web app at ](https://laravel.docker.localhost/)
laravel.docker.localhost
do not forget to [configure your laravel app .env file as shown in our sample file](app/.env.sample) with 

```
DB_CONNECTION=sqlsrv
DB_HOST=sqlsrv
# DB_PORT=1433
DB_DATABASE=ekne
DB_USERNAME=sa
DB_PASSWORD=yourStrong!pass
DB_TRUST_SERVER_CERTIFICATE=true
```


Also visit [adminner as sql client ](http://laravel.docker.localhost:8081/) to import your database

```
System: MS SQL (beta)
Server: sqlsrv
Username: sa
Pass: ${DB_PASSWORD} see .env file
db: databases
```


# Setting up your db 

we MSSQL Adminer 

on 
http://laravel.docker.localhost:8081/

using these credentials 
```
server: MS SQL (beta)
mssql: sqlsrv
username: sa
password: yourStrong!pass
```

find databases on adminer 
```
SELECT name, database_id, create_date FROM sys.databases; GO  
```


on your laravel app add this connection string to MSSQL
```
 'sqlsrv' => [
            'driver' => 'sqlsrv',
            'host' => env('DB_HOST', 'sqlsrv'),
            'port' => env('DB_PORT', '1433'),
            'database' => env('DB_DATABASE', 'test'),
            'username' => env('DB_USERNAME', 'sa'),
            'password' => env('DB_PASSWORD', ''),
            'charset' => 'utf8',
            'prefix' => '',
            'options'  => [
                'TrustServerCertificate' => 'Yes',
                'trust_server_certificate'=>'yes'
            ],
            'trust_server_certificate'=>'yes',
            'TrustServerCertificate' => 'Yes',
        ],
```

## Import db 

Go ahead and read

 https://learn.microsoft.com/en-us/sql/linux/quickstart-install-connect-ubuntu?view=sql-server-ver16&tabs=ubuntu2004

but speed instructions are here :


```
curl https://packages.microsoft.com/config/ubuntu/22.04/prod.list | sudo tee /etc/apt/sources.list.d/mssql-release.list
sudo apt-get update && sudo apt-get install mssql-tools18

```

now you can import your db

```
source .env
docker exec -it sqlsrv sh 

docker exec -it sqlsrv /opt/mssql-tools18/bin/sqlcmd -S localhost -U sa -P yourStrong!pass -C  -i /var/www/test_export.sql
```
or from iside of the container 
```
docker exec -it sqlsrv sh
/opt/mssql-tools18/bin/sqlcmd -S localhost -U sa -P  '${DB_PASSWORD}' -C
```

# Possible errors when connecting 

Getting : 
```
SQLSTATE[08001]: [Microsoft][ODBC Driver 17 for SQL Server]SSL Provider: [OpenSSL library could not be loaded, make sure OpenSSL 1.0 or 1.1 is installed] (Connection: sqlsrv, SQL: select top 1 * from [User] where [UserID] = agelos)
```
this change (to update to the latest deb)
 seems to resolve the issue
RUN curl -o msodbcsql17_amd64.deb https://packages.microsoft.com/debian/9/prod/pool/main/m/msodbcsql17/msodbcsql17_17.10.6.1-1_amd64.deb
RUN ACCEPT_EULA=Y dpkg -i msodbcsql17_amd64.deb


### Do not forget to Say "thank you" 

- ![GitHub Repo stars](https://img.shields.io/github/stars/agelospanagiotakis/Docker-Laravel-MSSQL?style=social)

- [donate](https://paypal.me/agelospanagiotakis?country.x=GR&locale.x=el_GR)


