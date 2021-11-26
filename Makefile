setup: start

start:
	@docker-compose up -d

shell: start
	@docker-compose exec php sh

composer: start
	@docker-compose exec php composer install
	
