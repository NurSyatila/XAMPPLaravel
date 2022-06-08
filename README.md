# XAMPPLaravel
Web development using Laravel and XAMPP

XAMPP is software for a web development where it contains the configuration of Apache, PHP and MySQL. XAMPP is a useful platform that can be used to develop and test a website in the testing server (localhost) before releasing it to the main server. XAMPP is an abbreviation for cross-platform (X) which means that the software can be installed in various platforms including Windows, Linux and Mac OS X operating system; Apache (A) which is a web server software that can run a website such as WordPress and others; MySQL (M) which is a database management software which manages database objects, PHP (P) which is a programming language used for server-side programming; Perl (P) which is an object-oriented programming language for general purposes.  

Laravel is a web application framework that builds application using PHP with designated syntax. Laravel has several components: i) Model (connects to the database which allows retrieval of data), ii) Controller (compiles requests and actions) and (iii) Views (render pages on the front-end side of the web). Additionally, routes are used to map URLs to controller actions.  

Laravel is best used to build a website that is based on CRUD operations – create, read, update and delete resources available on the website. Here, we will build a simple web application/database using XAMPP and Laravel version 5.8. Note that the steps in this guideline are performed on Mac OS X (Catalina). The installation steps and directories could be different according to the operating systems of your computer.  

The data used for database generation in MySQL are obtained from DrugBank, which includes information related to approved drugs and their targets.  

####Installation
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
5. dsd
6. ds


