FROM shinsenter/php:8.2-fpm-nginx

# Change the nginx root to avoid having to do more complicated set up
RUN sed 's/root \/var\/www\/html;/root \/var\/www\/html\/public;/' /etc/nginx/sites-enabled/default -i