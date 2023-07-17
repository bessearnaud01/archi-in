#!/bin/bash

# Attends le montage des fichiers sur la VM.
while [ ! -f /vagrant/vagrant-bootstrap.sh ]; do
	sleep 1
done

# Map des fichiers
rm -Rf /var/www/html
ln -sfn /vagrant /var/www/html


# Ajouter les lignes de config dans le fichier apache
cat >'/etc/apache2/sites-enabled/000-default.conf' << 'EOF'
<VirtualHost *:80>
	ServerAdmin webmaster@localhost
	DocumentRoot /var/www/html/public
    <Directory />
        Options FollowSymLinks
        AllowOverride None
    </Directory>
    <Directory /var/www/html/public/>
        AllowOverride None
        DirectoryIndex index.php
        <IfModule mod_negotiation.c>
            Options -MultiViews
        </IfModule>
        <IfModule mod_rewrite.c>
            Options +FollowSymlinks
            RewriteEngine On
            RewriteCond %{REQUEST_URI}::$0 ^(/.+)/(.*)::\2$
            RewriteRule .* - [E=BASE:%1]
            RewriteCond %{HTTP:Authorization} .+
            RewriteRule ^ - [E=HTTP_AUTHORIZATION:%0]
            RewriteCond %{ENV:REDIRECT_STATUS} =""
            RewriteRule ^index\.php(?:/(.*)|$) %{ENV:BASE}/$1 [R=301,L]
            RewriteCond %{REQUEST_FILENAME} !-f
            RewriteRule ^ %{ENV:BASE}/index.php [L]
        </IfModule>
        <IfModule !mod_rewrite.c>
            <IfModule mod_alias.c>
                RedirectMatch 307 ^/$ /index.php/
            </IfModule>
        </IfModule>
    </Directory>

	ErrorLog ${APACHE_LOG_DIR}/error.log
	CustomLog ${APACHE_LOG_DIR}/access.log combined
</VirtualHost>
EOF
sudo systemctl restart apache2

echo
echo 'Copie de la base de données...';
echo

dbname=archi-in

# Creation de la base de donnees
echo "create database ${dbname} character set utf8 collate utf8_general_ci;" | mysql -u root -pvagrant
echo "set names utf8;" | mysql -u root -pvagrant
echo "source /vagrant/${dbname}.sql" | mysql -u root -pvagrant --default-character-set=utf8 ${dbname}
echo "grant all privileges on ${dbname}.* to root identified by 'vagrant'" | mysql -u root -pvagrant

echo
echo 'Terminé !'
echo
