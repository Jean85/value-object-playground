setup: start

start:
	@docker-compose up -d

shell: start
	@docker-compose exec php sh

composer: start
	@docker-compose exec -T php composer install
	

code-style-fix:
	@echo "CODE STYLE FIX"
	@echo ""
	@docker-compose exec -T php vendor/bin/php-cs-fixer fix --ansi --verbose

phpstan: start
	@docker-compose exec -T php ./vendor/bin/phpstan analyse --ansi

phpstan-update-baseline: start
	@docker-compose exec -T php ./vendor/bin/phpstan analyse --generate-baseline=phpstan-baseline.neon

phpstan-clear-cache: start
	@docker-compose exec -T php ./vendor/bin/phpstan clear-result-cache

psalm: start
	@docker-compose exec -T php ./vendor/bin/psalm

psalm-update-baseline: start
	@docker-compose exec -T php ./vendor/bin/psalm --update-baseline --set-baseline=psalm-baseline.xml

psalm-clear-cache: start
	@docker-compose exec -T php ./vendor/bin/psalm --clear-cache

pre-commit-check: code-style-fix psalm phpstan

clear-cache: psalm-clear-cache phpstan-clear-cache

test:
	@docker-compose exec -T php ./vendor/bin/phpunit
