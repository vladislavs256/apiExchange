start:
	docker-compose up -d
	docker exec -it php-cli-1 composer install
	docker exec -it php-cli-1 php bin/console doctrine:migrations:migrate
	docker exec -it php-cli-1 php bin/console doctrine:fixtures:load
