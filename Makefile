up:
	docker compose up -d

build:
	docker compose build --no-cache --force-rm

laravel-install:
	docker compose exec app composer create-project --prefer-dist laravel/laravel .

create-project:
	mkdir -p src
	@make build
	@make up
	@make laravel-install
	docker compose exec app php artisan key:generate
	docker compose exec app php artisan storage:link
	docker compose exec app chmod -R 777 storage bootstrap/cache
	@make fresh
	@make npm-install

npm-install:
	docker compose exec app apt update
	docker compose exec app apt install nodejs npm

install-recommend-packages:
	docker compose exec app composer update
	docker compose exec app composer require --dev ucan-lab/laravel-dacapo
	docker compose exec app composer require --dev barryvdh/laravel-ide-helper
	docker compose exec app composer require --dev beyondcode/laravel-dump-server
	docker compose exec app composer require --dev barryvdh/laravel-debugbar
	docker compose exec app composer require --dev nunomaduro/phpinsights
	docker compose exec app composer require --dev doctrine/dbal
	docker compose exec app php artisan vendor:publish --provider="BeyondCode\DumpServer\DumpServerServiceProvider"
	docker compose exec app php artisan vendor:publish --provider="Barryvdh\Debugbar\ServiceProvider"
	docker compose exec app mkdir -p tools/php-cs-fixer
	docker compose exec app composer require --working-dir=tools/php-cs-fixer friendsofphp/php-cs-fixer
	docker compose exec app mkdir -p tools/larastan
	docker compose exec app composer require --dev --working-dir=tools/larastan nunomaduro/larastan

init:
	docker compose up -d --build
	docker compose exec app composer install
	docker compose exec app cp .env.example .env
	docker compose exec app php artisan key:generate
	docker compose exec app php artisan storage:link
	docker compose exec app chmod -R 777 storage bootstrap/cache
	@make fresh

remake:
	@make destroy
	@make init

stop:
	docker compose stop

down:
	docker compose down --remove-orphans

down-v:
	docker compose down --remove-orphans --volumes

restart:
	@make down
	@make up

destroy:
	docker compose down --rmi all --volumes --remove-orphans

ps:
	docker compose ps

logs:
	docker compose logs

logs-watch:
	docker compose logs --follow

log-web:
	docker compose logs web

log-web-watch:
	docker compose logs --follow web

log-app:
	docker compose logs app

log-app-watch:
	docker compose logs --follow app

log-db:
	docker compose logs db

log-db-watch:
	docker compose logs --follow db

web:
	docker compose exec web bash

app:
	docker compose exec app bash

migrate:
	docker compose exec app php artisan migrate

fresh:
	docker compose exec app php artisan migrate:fresh --seed

seed:
	docker compose exec app php artisan db:seed

dacapo:
	docker compose exec app php artisan dacapo

rollback-test:
	docker compose exec app php artisan migrate:fresh
	docker compose exec app php artisan migrate:refresh

tinker:
	docker compose exec app php artisan tinker

test:
	docker compose exec app php artisan test

optimize:
	docker compose exec app php artisan optimize

optimize-clear:
	docker compose exec app php artisan optimize:clear

cache:
	docker compose exec app composer dump-autoload -o
	@make optimize
	docker compose exec app php artisan event:cache
	docker compose exec app php artisan view:cache

cache-clear:
	docker compose exec app composer clear-cache
	@make optimize-clear
	docker compose exec app php artisan event:clear
	docker compose exec app php artisan cache:clear
	docker compose exec app php artisan config:clear
	docker compose exec app php artisan route:clear
	docker compose exec app php artisan view:clear
	docker compose exec app composer dump-autoload

db:
	docker compose exec db bash

sql:
	docker compose exec db bash -c 'mysql -u $$MYSQL_USER -p$$MYSQL_PASSWORD $$MYSQL_DATABASE'

redis:
	docker compose exec redis redis-cli

ide-helper:
	docker compose exec app php artisan clear-compiled
	docker compose exec app php artisan ide-helper:generate
	docker compose exec app php artisan ide-helper:meta
	docker compose exec app php artisan ide-helper:models --write --reset

php-cs-fix:
	docker compose exec app ./tools/php-cs-fixer/vendor/bin/php-cs-fixer fix --config=.php-cs-fixer.dist.php --verbose

larastan:
	docker compose exec app ./tools/larastan/vendor/bin/phpstan analyse

insights:
	docker compose exec app php artisan insights -v
insights-fix:
	docker compose exec app php artisan insights --fix

quality:
	@make ide-helper
	@make php-cs-fix
	@make larastan
	@make insights-fix
