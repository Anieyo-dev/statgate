#Setting new project

## dockers

1. change .env.dev file with new data,
2. change creacustomapp.conf with new data + filename
3. change docker-compose file data with new names and ports ips


## Laravel

1. Create project using
```shell
laravel new project-name
```
2. Configure .env file with new database etc.
3. Configure database at phpstorm // if using phpstorm
4. run commands
```shell
npm install
php artisan migrate //if not migrated
```

## Creating package

https://github.com/Oliwer-Budnik/laravel-package-skeleton/archive/main.zip"