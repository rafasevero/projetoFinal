Portas:

backend: 8001
frontend: 8085
phpmyadmin: 8002
mailhog: 8003

Para utilizar o docker: docker compose up --build -d
Para instalar algum pacote no front: docker compose run --rm npm COMANDO

docker compose run --rm composer update

docker compose run --rm artisan key:generate

docker compose run --rm artisan migrate