FROM 595468017717.dkr.ecr.eu-west-1.amazonaws.com/alpine-nginx-php-base:latest

COPY ./ops/docker/webserver/nginx-site.conf /etc/nginx/conf.d/default.conf
COPY ./ops/docker/php/php.ini /etc/php7/php.ini
COPY ./ /opt/roulette/app/
