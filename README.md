# symfony-client
Deploy:
1. docker network create symfony-network
2. docker compose -f ./docker/docker-compose.yml build
3. docker compose -f ./docker/docker-compose.yml run php-cli-client bash
4. run in a container composer install
