up: docker-up
down: docker-down
init: env-file build composer-install up migration-up

migration-up:
	docker-compose run --rm php php yii migrate --interactive=0

ps:
	docker-compose ps

docker-up:
	docker-compose up --detach

docker-down:
	docker-compose down --remove-orphans

build:
	docker-compose build

rebuild:
	docker-compose build --no-cache

shell-php:
	docker-compose run --rm php bash

shell-nginx:
	docker-compose exec nginx bash

composer-install:
	docker-compose run --rm php composer install

logs:
	docker-compose logs --follow

env-file:
	cp -n .env-sample .env
