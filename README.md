**INSTALL DEPENDENCIES**

`sudo apt-get install git unzup mysql-server apache2 libapache2-mod-php php php-xml php-gd php-opcache php-mbstring`

Database configured by default > Access: root:root, Name: daily_trends

**INSTALL COMPOSER GLOBALLY**

`curl -sS https://getcomposer.org/installer -o composer-setup.php`

`sudo php composer-setup.php --install-dir=/usr/local/bin --filename=composer`

**CONFIGURE PROJECT**

`sudo rm -rf /var/www/html`

`cd /var/www`

`composer create-project symfony/website-skeleton html`

`cd /var/www/html`

`composer require doctrine/doctrine-bundle`

`composer update`


**CREATE DE DB**

`php bin/console doctrine:database:create`

`php bin/console doctrine:schema:update --force`

**Add feeds to the system**

`php bin/console daily-trends:channel-add "El País" "http://ep00.epimg.net/rss/elpais/portada.xml"`

`php bin/console daily-trends:channel-add "El Mundo" "http://estaticos.elmundo.es/elmundo/rss/portada.xml"`

**Get the data form the feeds**

`php bin/console daily-trends:channel-pull`