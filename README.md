<p align="center">Cars App</p>

<p align="center">
    <a target="_blank" href="http://3.14.84.114/" alt="Cars App"><strong>Working Instance Link</strong></a>
</p>

## Application
<p>The Cars Application ---. A working instance of the appication can be found <a target="_blank" href="http://3.14.84.114/" alt="Cars App"><strong>here</strong></a>.</p>

## Stack

- AWS t.2 micro
- Ubuntu 18.04 (https://help.ubuntu.com/lts/installation-guide/)
- nginx v1.14.0 (https://www.nginx.com/resources/wiki/start/topics/tutorials/install/)
- PHP v7.4.1 
- Laravel Framework v6.10.1
- MySql v14.14 Dist. v5.7.28,
- composer v1.9.1
- node v8.10.0
    - npm v3.5.2
- git v2.17.1
- Other: 
    - JQuery, SASS, Blade templating, Bootstrap 

## Deployment for full environment
### Install Nginx
- sudo su
- apt update
- apt install nginx -y

### Install MySql Server
- apt install mysql-server -y
- mysql_secure_installation
	- answer prompts

### Alter root user permissions
	- mysql
	- ALTER USER 'root'@'localhost' IDENTIFIED WITH mysql_native_password BY 'password';
	- FLUSH PRIVILEGES;

### Install Default DB
    - CREATE DATABASE Cars;
    - exit
    
### Install PHP
- apt install software-properties-common -y
- add-apt-repository ppa:ondrej/php -y
- apt update
- apt install php7.4-fpm php7.4-mysql php7.4-common php7.4-mysql php7.4-xml php7.4-xmlrpc php7.4-curl php7.4-gd php7.4-imagick php7.4-cli php7.4-dev php7.4-imap php7.4-mbstring php7.4-opcache php7.4-soap php7.4-zip unzip -y

### Nginx Config
- nano /etc/nginx/sites-available/Cars

### Enter this configuration into the Cars file, remember to update your public IP into the server_name field
```
server {
    listen 80;
    listen [::]:80;
    root /var/www/html/Cars/public;
    index  index.php index.html index.htm;
    server_name {ENTER_PUBLIC_IP_HERE};

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
       include snippets/fastcgi-php.conf;
       fastcgi_pass             unix:/var/run/php/php7.4-fpm.sock;
       fastcgi_param   SCRIPT_FILENAME $document_root$fastcgi_script_name;
    }
}
```

- ln -s /etc/nginx/sites-available/Cars /etc/nginx/sites-enabled/
- service nginx restart

### Install Laravel
- cd /var/www/html
- apt install git -y
- git clone https://github.com/jbrown1384/Cars.git
- cd Cars/
- chown -R www-data:www-data /var/www/html/Cars/
- chmod -R 755 /var/www/html/Cars/
- cp .env.example .env
- bash ./public/scripts/deploy.sh

