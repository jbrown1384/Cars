<p align="center">Dealer Inspire Site</p>

## Application
<p>This Dealer Inspire site contains a contact form that will validate the entered name, email, optional phone number, and message upon submission. This data will be saved to the database as well as emailed to a pre-defined recipient.</p>

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
    - Mailtrap.io, SASS, Blade templating, Bootstrap

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

##  Data Import
- there are currently two options for importing the schema for the application

### SQL Data File
<p>The sql datafile is located in the database/schema folder as a sql file. This contains all of the sql needed to create the schema</p>

### Autogenerating the DB structure
<p>The application utilizes database migrations. The migrations can be run manually with the command: </p>

```
sudo php artisan migrate
```

<p>Or, by running the deploy script outlined in the full deployment instructions</p>

```
sudo bash ./public/scripts/deploy.sh
```

##  Sending Emails
<p>The Dealer Inspire site uses mailtrap.io to send and catch emails for formatting. My default configuration is set up in the .env to use this method but any SMTP variables can be applied.</p>

<p>Emails are initialized withing the boot function within the Contact model found here: <a href="https://github.com/jbrown1384/Cars/blob/master/app/Contact.php">Contact.php</a>
</p>

##  PHPUnit Testing
<p>Unit tests can be run by executing the following command: </p>

```
sudo vendor/bin/phpunit
```
