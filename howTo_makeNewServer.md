apt update && apt upgrade
apt install -y gnupg gosu curl ca-certificates zip unzip git supervisor sqlite3 libcap2-bin libpng-dev dnsutils
apt install -y apt-transport-https lsb-release ca-certificates wget
wget -O /etc/apt/trusted.gpg.d/php.gpg https://packages.sury.org/php/apt.gpg
echo "deb https://packages.sury.org/php/ $(lsb_release -sc) main" | sudo tee /etc/apt/sources.list.d/php.list
apt update
apt install -y php8.2

apt install -y php8.2-cli php8.2-dev php8.2-pgsql php8.2-sqlite3 php8.2-gd php8.2-imagick php8.2-curl php8.2-imap php8.2-mysql php8.2-mbstring php8.2-xml php8.2-zip php8.2-bcmath php8.2-soap php8.2-intl php8.2-readline php8.2-ldap php8.2-msgpack php8.2-igbinary php8.2-redis php8.2-swoole php8.2-memcached php8.2-pcov php8.2-xdebug
curl -sLS https://getcomposer.org/installer | php -- --install-dir=/usr/bin/ --filename=composer

apt install -y nodejs npm
npm install -g npm

apt install mariadb-server -y
mariadb-secure-installation
mariadb -u root -p
> CREATE DATABASE mcslide;
> CREATE USER 'mcslide_user'@'%' IDENTIFIED BY 'McSlide@112358';
> GRANT ALL PRIVILEGES ON mcslide.* TO mcslide_user@%;
> FLUSH PRIVILEGES;
> quit;
nano /etc/mysql/mariadb.conf.d/50-server.cnf
> #bind=...
service mariadb restart
apt install net-tools -y
netstat -ntlup | grep maria

apt install software-properties-common apt-transport-https curl ca-certificates -y
apt install redis
systemctl status redis-server
redis-cli
> ping
> exit
nano /etc/redis/redis.conf
>maxmemory 500mb 
>maxmemory-policy allkeys-lru
> # bind 127.0.0.1 ::1
> requirepass YourStrongPasswordHere
systemctl restart redis

apt install acl

apt install apache2
php -v
nano /etc/php/8.2/apache2/php.ini
> extension=fileinfo
> extension=mbstring
> extension=openssl

systemctl restart apache2
php -m
a2enmod rewrite
nano /etc/apache2/sites-available/mcslide.lucaciotti.space.conf

<VirtualHost *:80>
    ServerName mcslide.lucaciotti.space

    ServerAdmin info@lucaciotti.space
    DocumentRoot /var/www/mcslide.lucaciotti.space/current/public

    <Directory "/var/www/mcslide.lucaciotti.space/current/public">
            Options FollowSymLinks MultiViews
            Order Allow,Deny
            AllowOverride All
            Require all granted
            Allow from all
            ReWriteEngine On
    </Directory>

    ErrorLog ${APACHE_LOG_DIR}/error.log
    CustomLog ${APACHE_LOG_DIR}/access.log combined

</VirtualHost>

a2ensite mcslide.lucaciotti.space.conf
apachectl configtest
systemctl restart apache2

apt install certbot python3-certbot-apache
certbot --apache
systemctl status certbot.timer
certbot renew --dry-run

