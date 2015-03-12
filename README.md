
# Symfony Fuse #


## GITHUB ##
 
```
https://github.com/fozeek/Symfony
```


## Installation ##


Pour installer l'ensemble des modules via composer

```
php composer.phar install
```

Pour installer l'ensemble des packages via bower et créer les assets via Grunt

```
npm install
bower install
grunt
OU
grunt watch (DEV only)
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


Pour updater le projet

```
php app/console  doctrine:schema:update  --force
```

### Assets ###

```
npm install

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

### Configure your webserver
#### Apache

You can create a virtual host 

```
    <VirtualHost *:80>
        ServerName <host>
        DocumentRoot <pathtomyprovence>
        SetEnv APPLICATION_ENV "development"
        <Directory <pathtomyprovence>>
            DirectoryIndex app.php
            Options Indexes FollowSymLinks Includes ExecCGI
            AllowOverride All
            Order allow,deny
            Allow from all
        </Directory>
    </VirtualHost>
```