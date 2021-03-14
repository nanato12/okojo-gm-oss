# okojo-gm-oss
LINEBot おこじょGM OSS

## Local setup
```shell
% cp ./env/okojo-gm/.env.dev ./laravel/.env
% docker-compose up -d
```

## Cron
```
% crontab -e
```

Input this.

```
* * * * * cd ~/okojo-gm-oss/laravel && php artisan schedule:run >> /dev/null 2>&1
```
