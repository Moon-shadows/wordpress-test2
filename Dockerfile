################################################################################
# Frontend build
################################################################################

FROM ohmy/node-frontend-build:node-16 AS frontend-build

# Only copy files necessary to install npm packages so that these can be cached by Docker between builds (unless these files change)
COPY --chown=node package.json /app/
COPY --chown=node package-lock.json /app/

WORKDIR /app
# Install
RUN npm ci

# Now copy everything else and run the build
COPY --chown=node . /app
RUN npm run build
RUN rm -r node_modules


################################################################################
# Backend
################################################################################

FROM ohmy/apache-php8.1-prod

# We need root to make the following changes to the base image
USER root

# First, only copy composer.* files and install packages
COPY composer.json /app/
COPY composer.lock /app/

WORKDIR /app

ARG COMPOSER_AUTH
RUN composer install --no-dev --no-interaction --prefer-dist --no-autoloader && rm -rf /root/.composer

# Copy everything else (including artefacts from frontend build)
COPY . /app
COPY --from=frontend-build /app /app
COPY assets /app/web/assets

# Finish Composer
RUN composer dump-autoload --no-scripts --no-dev --optimize

# Copy object-cache.php
RUN cp /app/web/wp-content/plugins/redis-cache/includes/object-cache.php /app/web/wp-content/

COPY docker/supervisor.d/* /etc/supervisor/conf.d/

RUN mkdir /app/web/wp-content/uploads && chmod -R 777 /app/web/wp-content/uploads
RUN mkdir /app/web/wp-content/cache && chmod -R 777 /app/web/wp-content/cache
RUN mkdir /app/web/wp-content/w3tc-config && chmod -R 777 /app/web/wp-content/w3tc-config

# Handle the languages folder
RUN mv /app/web/wp-content/languages /app/web/wp-content/languages-git && chown -R www-data:www-data /app/web/wp-content/languages-git
RUN mkdir /app/web/wp-content/languages && chown -R www-data:www-data /app/web/wp-content/languages
COPY docker/synclanguages.sh /synclanguages.sh
RUN chmod +x /synclanguages.sh

# Enable mod_brotli
RUN a2enmod brotli

VOLUME /app/web/wp-content/uploads
VOLUME /app/web/wp-content/w3tc-config
VOLUME /app/web/wp-content/cache
VOLUME /app/web/wp-content/languages

ENV WEBROOT /app/web
ENV DISABLE_WP_CRON_SPAWNING 1

# Disable opening URLs with fopen (including file_get_contents etc)
ENV PHP_ALLOW_URL_FOPEN Off

EXPOSE 8000

# Important! We don't want to run the container as root
USER www-data
