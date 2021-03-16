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

## Reference
- Laravel 8.x タスクスケジュール  
https://readouble.com/laravel/8.x/ja/scheduling.html
