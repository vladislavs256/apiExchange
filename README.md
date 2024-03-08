# apiExchange
Type in bash

```bash
make start

or to manualy 
	docker-compose up -d
	docker exec -it php-cli-1 composer install
	docker exec -it php-cli-1 php bin/console doctrine:migrations:migrate
	docker exec -it php-cli-1 php bin/console doctrine:fixtures:load
```
type yes everything

api server on localhost:8080 <br>
frontend server on localhost:8081

