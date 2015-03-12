
# Symfony Project #


## GITHUB ##
 
```
https://github.com/fozeek/Symfony
```


## Installation ##


Pour installer l'ensemble des modules via composer

```
php composer.phar install
```

Pour setupper le projet

```
cp app/config/parameters.yml.dist app/config/parameters.yml 
php app/console doctrine:database:create 
php app/console  doctrine:schema:update  --force

php app/console fos:user:create admin admin@test.fr admin
php app/console fos:user:activate admin
php app/console fos:user:promote admin ROLE_ADMIN

php app/console fos:user:create user user@test.fr user
php app/console fos:user:activate user

```

Pour ajouter les Data Fixtures

```
php app/console  doctrine:fixture:load
```

Pour updater le projet

```
php app/console  doctrine:schema:update  --force
```

### Assets ###

```
npm install
bower install
grunt
OU
grunt watch (DEV only)

```

### Changement de la config ###


Il faut changer les accès à la base de données 

```
    web_host: 127.0.0.1 
    proxy_host: 127.0.0.1
    database_driver:   pdo_mysql
    database_host:     127.0.0.1
    database_port:     ~
    database_name:     symfony
    database_user:     root
    database_password: ~
```

### Tests unitaires ###

```
cp app/phpunit.xml.dist app/phpunit.xml 
vendor/phpunit/phpunit/phpunit -c app
```

### PHP Fixer ###

```
php php-cs-fixer fix . --config=sf23
```