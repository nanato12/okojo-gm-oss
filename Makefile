all: build run
check: test format

build:
	docker-compose build

build-no-cache:
	docker-compose build --no-cache

run:
	docker-compose up

run-d:
	docker-compose up -d

stop:
	docker-compose down

migrate:
	docker-compose exec php php artisan migrate

seed:
	docker-compose exec php php artisan db:seed

schedule-run:
	docker-compose exec php php artisan schedule:run

test:
	docker-compose exec php ./vendor/bin/phpunit ./tests/

format:
	phpcbf ./laravel/
