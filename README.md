# Installation
From host machine
```
docker-compose up -d

docker exec -it cushon_app bash
```
Then, from within container
```
composer install

vendor/bin/phinx migrate && vendor/bin/phinx seed:run

vendor/bin/codecept run
```