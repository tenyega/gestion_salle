-CREATED A DATABASE IN HOSTINGER 

-CHANGES in .env file for the databse name, id, password and the site. 
    DATABASE_URL="mysql://DB_USER:DB_PASSWORD@DB_HOST/DB_NAME"

- Run these cmd to prepare the local for the production environment 
    php bin/console cache:clear --env=prod --no-debug
    php bin/console cache:warmup --env=prod

- and to remove the dependencies for the prod 
    composer install --no-dev --optimize-autoloader

- GO TO HOSTINGER tableau aboard of the hall4all.fr  then gestionnaire des fichier

- inside public_html, drop all the files of symfony project of local

-Open cmd line terminal in your computer and login to the hostinger SSH using the connection SSH provided by the hostinger 

- enter the password for the db which you have set for the db_hall4all 

-and then lanch the command to change the permissions to the dossier public_html
    chmod -R 755 public_html


-for .htaccess inside public folder of the symfony 
    in terminal launch 
        composer require symfony/apache-pack
    // this will create a file .htaccess automatically inside the public folder of the symfony projet

- create another .htaccess file at the root level of the projet gestion_salle 
    and heres the content of it 
        <IfModule mod_rewrite.c >
    RewriteEngine on
    RewriteOptions inherit

    # SSL and let's encrypt
    RewriteCond %{REQUEST_URI} !^/\.well-known/acme-challenge/.+$
    RewriteCond %{REQUEST_URI} !^/\.well-known/pki-validation/[A-F0-9]{32}\.txt(?:\ Comodo\ DCV)?$
    RewriteRule ^.well-known/acme-challenge - [L]

    # redirect to no-www
    RewriteBase /
    RewriteCond %{HTTP_HOST} ^www\.(.*)$ [NC]
    RewriteRule ^(.*)$ http://%1/$1 [R=301,L]

    # https redirect
    RewriteCond %{HTTPS} !=on
    RewriteRule .* https://%{HTTP_HOST}%{REQUEST_URI} [R=301,L]

    # redirect all requests to public directory
    RewriteCond %{REQUEST_URI} !public/
    RewriteRule (.*) /public/$1 [L]
    </IfModule>

the same content you will find on the github  https://github.com/Helmi74130/.htaccess/blob/main/.htaccess

- inside the cmd line terminal 
    go to public_html (cd public_html)
    and run 
        php bin/console doctrine:migrations:migrate --env=prod
    // BUT THIS WAS NOT WORKING SAID PDO DRIVER NOT FOUND 
    THEN use phpmyadmin of the hostinger for hall4all.fr and import the db directly using phpMyAdmin


-installation of the dependencies at the server side 
    go to https://getcomposer.org/download/ 
        and copy all the code inside the command line installations of the composer 
        and paste it to our cmd line terminal connected via SSH of hall4all
            php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
            php -r "if (hash_file('sha384', 'composer-setup.php') === 'dac665fdc30fdd8ec78b38b9800061b4150413ff2e3b6f88543c636f7cd84f6db9189d43a81e5503cda447da73c7e5b6') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
            php composer-setup.php
            php -r "unlink('composer-setup.php');"

    then do 
        php composer.phar install  // to install all dependencies of the project at server side 