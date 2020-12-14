git clone https://github.com/Laradock/laradock.git
cp env-example .env
docker-compose up -d apache2 mysql phpmyadmin php-fpm workspace selenium
