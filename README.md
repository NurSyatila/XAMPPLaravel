# XAMPP - Laravel
Web development using Laravel and XAMPP

XAMPP is software for a web development where it contains the configuration of Apache, PHP and MySQL. XAMPP is a useful platform that can be used to develop and test a website in the testing server (localhost) before releasing it to the main server. XAMPP is an abbreviation for cross-platform (X) which means that the software can be installed in various platforms including Windows, Linux and Mac OS X operating system; Apache (A) which is a web server software that can run a website such as WordPress and others; MySQL (M) which is a database management software which manages database objects, PHP (P) which is a programming language used for server-side programming; Perl (P) which is an object-oriented programming language for general purposes.  

Laravel is a web application framework that builds application using PHP with designated syntax. Laravel has several components: i) Model (connects to the database which allows retrieval of data), ii) Controller (compiles requests and actions) and (iii) Views (render pages on the front-end side of the web). Additionally, routes are used to map URLs to controller actions.  

Laravel is best used to build a website that is based on CRUD operations – create, read, update and delete resources available on the website. Here, we will build a simple web application/database using XAMPP and Laravel version 5.8. Note that the steps in this guideline are performed on Mac OS X (Catalina). The installation steps and directories could be different according to the operating systems of your computer.  

The data used for database generation in MySQL are obtained from DrugBank, which includes information related to approved drugs and their targets.  

#### Installation
1. XAMPP
2. Code Editor (IDE): To create, read and edit the code.
3. Composer: A tool for PHP dependency management, where it manages the dependencies or libraries needed for your project
```
# Get a copy of PHP setup file to the local directory
$ php -r "copy('https://getcomposer.org/installer','composer-setup.php');"
$ php -r "if (hash_file('sha384', 'composer-setup.php') === '756890a4488ce9024fc62c56153228907f1545c228516cbf63f885e036d37e9a59d27d63f46af1d4d07ee0f76181c7d3') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"

# Run the setup file
$ php composer-setup.php
$ php -r "unlink('composer-setup.php');"

# Move the file to executable path
$ sudo mv composer.phar /usr/local/bin/composer

# Run composer to test whether it works or not
$ composer
```
4. Install Laravel on localhost XAMPP using the composer: Create a Laravel project in the XAMPP htdocs folder (C:\XAMPP\htdocs\ in Windows or /Applications/XAMPP/xamppfiles/htdocs/ in Mac OS X)
```
# Go to the htdocs directory
$ cd /Applications/XAMPP/xamppfiles/htdocs/

# Create a new Laravel project called myproject. 
# The folder ‘myproject’ will be stored under htdocs directory
$ composer create-project –prefer-dist laravel/laravel myproject

#OR to install a specific version of Laravel (e.g. Laravel 5.8)
$ composer create-project –prefer-dist laravel/laravel myproject “5.8.*”

```

#### Configuration
1. Run XAMPP. Click Start All. Localhost is available on http://localhost or htpp://127.0.0.1
2. Open Laravel project in the web browser on http://localhost/myproject/public/. Use the following commands to change the link from localhost/myproject/public to localhost/myproject:
```
# Go to myproject directory
$ cd /Applications/XAMPP/xamppfiles/htdocs/myproject

# Rename server.php in your Laravel root folder to index.php
$ mv server.php index.php

# Copy the .htaccess file from /public directory to myproject root folder
$ cp public/.htaccess ./
```
3. Connecting Laravel project to MySQL database: Create a database using the phpMyAdmin web interface (http://localhost/phpmyadmin) or using the 'mysql' command in the command line (/Applications/XAMPP/xamppfiles/mysql).
Sample data (truncated version):
  - approved_drugs.csv
  - drug_targets.csv
  - target_sequences.csv

```
# Create a folder named ‘db’ inside myproject root directory
$ cd /Applications/XAMPP/xamppfiles/htdocs/myproject
$ mkdir db 

# Download the data and store it in ‘db’ folder using curl or wget command
$ curl -LJ -o db/approved_drugs.csv https://raw.githubusercontent.com/syatilanur/sampledata/main/approved_drugs.csv

$ curl -LJ -o db/drug_targets.csv https://raw.githubusercontent.com/syatilanur/sampledata/main/drug_targets.csv

$ curl -LJ -o db/target_sequences.csv https://raw.githubusercontent.com/syatilanur/sampledata/main/target_sequences.csv

# Enter MySQL
# By default, the username and password are ‘root’ and ‘’ 
$ /Applications/XAMPP/xamppfiles/bin/mysql -u root -p (press Enter when ‘Enter password’ argument popup)

# MySQL monitor will be displayed
# show available databases
> SHOW DATABASES;

# create a database named ‘drugdb’, CREATE DATABASE {database name}
> CREATE DATABASE drugdb;
> USE drugdb;

# create tables, CREATE TABLE {Table name} ({Columns})

# a) create approved_drugs table according to the column name in CSV file
> CREATE TABLE approved_drugs (
	drugbankid TEXT DEFAULT NULL, 
	drugname TEXT DEFAULT NULL, 
	drugtype TEXT DEFAULT NULL,	
 	indication TEXT DEFAULT NULL,
	pubchemid TEXT DEFAULT NULL,
	hetid TEXT DEFAULT NULL);
# import the CSV file to be included as rows of the table
> LOAD DATA LOCAL INFILE 'db/approved_drugs.csv' INTO TABLE approved_drugs FIELDS TERMINATED BY ',' ENCLOSED BY '"' LINES TERMINATED BY '\n';

```



