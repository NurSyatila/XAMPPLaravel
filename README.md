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
#### Connecting Laravel project to MySQL database: 

###### Step 1: Create a database using the phpMyAdmin web interface (http://localhost/phpmyadmin) or using the 'mysql' command in the command line (/Applications/XAMPP/xamppfiles/mysql).

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

# Enter MySQL. By default, the username and password are ‘root’ and ‘’ 
$ /Applications/XAMPP/xamppfiles/bin/mysql -u root -p (press Enter when ‘Enter password’ argument popup)

# MySQL monitor will be displayed. Show available databases
> SHOW DATABASES;

# Create a database named ‘drugdb’, CREATE DATABASE {database name}
> CREATE DATABASE drugdb;
> USE drugdb;

# create tables, CREATE TABLE {Table name} ({Columns})

# a) create approved_drugs table according to the column name in CSV file
> CREATE TABLE approved_drugs ( drugbankid TEXT DEFAULT NULL, drugname TEXT DEFAULT NULL, drugtype TEXT DEFAULT NULL, indication TEXT DEFAULT NULL, pubchemid TEXT DEFAULT NULL, hetid TEXT DEFAULT NULL);
# import the CSV file to be included as rows of the table
> LOAD DATA LOCAL INFILE 'db/approved_drugs.csv' INTO TABLE approved_drugs FIELDS TERMINATED BY ',' ENCLOSED BY '"' LINES TERMINATED BY '\n';

# b) create drug_targets table according to the column name in CSV file
> CREATE TABLE drug_targets ( pharmaactive TEXT DEFAULT NULL, proteinname TEXT DEFAULT NULL, genename TEXT DEFAULT NULL, gbproteinid TEXT DEFAULT NULL, gbgeneid TEXT DEFAULT NULL, uniprotid TEXT DEFAULT NULL, uniprottitle TEXT DEFAULT NULL, pdbids TEXT DEFAULT NULL, species TEXT DEFAULT NULL, drugids TEXT DEFAULT NULL);
# import the CSV file to be included as rows of the table
> LOAD DATA LOCAL INFILE 'db/drug_targets.csv' INTO TABLE drug_targets FIELDS TERMINATED BY ',' ENCLOSED BY '"' LINES TERMINATED BY '\n';

# c) create target_sequences table according to the column name in CSV file
> CREATE TABLE target_sequences (moleculetype TEXT DEFAULT NULL, uniprotid TEXT DEFAULT NULL, name TEXT DEFAULT NULL, drugids TEXT DEFAULT NULL, sequence TEXT DEFAULT NULL);
# import the CSV file to be included as rows of the table
> LOAD DATA LOCAL INFILE 'db/target_sequences.csv' INTO TABLE target_sequences FIELDS TERMINATED BY ',' ENCLOSED BY '"' LINES TERMINATED BY '\n';

# show tables in database drugdb that have been generated
> SHOW TABLES;

#exit MySQL monitor
> exit
```
###### Step 2: Configure database connection and settings

a. configure database connection in myproject/.env configuration file. Set DB_DATABASE to newly created database.
```
DB_CONNECTION=mysql
DB_HOST=190.0.0.1
DB_PORT=4008
DB_DATABASE=drugdb
DB_USERNAME=root
DB_PASSWORD=
```
b. configure a database connection in myproject/config/database.php. Set the 'database', 'username', and 'password'.
```
        'mysql' => [
            'driver' => 'mysql',
            'url' => env('DATABASE_URL'),
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB_DATABASE', 'drugdb'),
            'username' => env('DB_USERNAME', 'root'),
            'password' => env('DB_PASSWORD', ''),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => true,
            'engine' => null,
            'options' => extension_loaded('pdo_mysql') ? array_filter([
                PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
            ]) : [],
        ],
```
c. Use the ‘migrate’ artisan command to connect the database to Laravel. Note: User php command from XAMPP to prevent errors.
```
#clear the cache after changing the configuration
$ /Applications/XAMPP/xamppfiles/bin/php artisan cache:clear
# run migration to update the database
$ /Applications/XAMPP/xamppfiles/bin/php artisan migrate
```
#### Configure Model, View and Controllers
###### Step 1: Configure database and model (myproject/app/Models)
Model is an entity in Laravel that communicates with the database. User 'make:model' artisan commadnd to create model for individual tables in the database. Models are stored in myproject/app/Models. View the file and manually edit the model to specify the table that will be used.
```
#create model for individual tables
$ /Applications/XAMPP/xamppfiles/bin/php artisan make:model ApprovedDrugs
$ /Applications/XAMPP/xamppfiles/bin/php artisan make:model DrugTargets
$ /Applications/XAMPP/xamppfiles/bin/php artisan make:model TargetSequences
#open each file and manually edit the 'protected $table' variable,
# e.g. ApprovedDrugs; table = approved_drugs, Drugtargets; table = drug_targets,  e.g. TargetSequences; table = target_sequences
```
###### Step 2: Configure views (myproject/resources/views, myproject/routes/web.php) and controllers (myproject/app/Http/COntrollers)

**Routes**: The web.php (myproject/routes/web.php) defines all routes for web interfaces that are connected to PHP files from the view entity in Laravel.  

**Views** contain the HTML or PHP codes that are stored with prefix blade.php (myproject/resources/views). Views serves as the front-end side of the website which present the data to users. The default homepage for myproject website is located at myproject/resources/views/welcome.blade.php. The welcome.blade.php can be edited to fit the purpose of the website, such as to include a query to a selected table in the database or to include a link to another section.   

**Controller** organizes request handling (myproject/app/Http/Controllers/). The 'make:controller' artisan command can be used to create a controller file. For starting, we can create a single controller that communicates with the tables in selected database, extract necessary information and produce a view containing the list of the information we needed on the web page.   
```
#to create a controller
$ /Applications/XAMPP/xamppfiles/bin/php artisan make:controller SectionController
#manually edit the controller file to include functions for extracting and storing information
```

For more details: https://github.com/NurSyatila/XAMPPLaravel/blob/main/sampledata/Database%20Development%20using%20Laravel%20and%20XAMPP.pdf


