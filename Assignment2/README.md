# SCIENCE GATEWAY ARCHITECTURE

## Assignment 1

## Image Description of the Project:

![alt text](https://github.com/airavata-courses/stephenpaul2727/blob/master/Assignment1/images/scg1.png "Project Image Layout")


## Technologies Used:

PHP (Laravel)
JAVA (Spring Boot)
PYTHON (Flask)

## Requirements:
1. Install latest version of composer.
2. Install latest version of maven.
3. Install Python -version > 2.7 & flask(use pip).


## USAGE

### New Usage process using docker. (Tentative)

1. Install docker on your machine. 
2. Download the project from the github and migrate to the root directory of Assignment 2.
3. Run the following command->
> docker-compose up
4. If you face any issues while build process and it relates to port allocation, please make sure you have the following ports closed : 8080,8000,5000,15672, 5672.

### Running Laravel Server.

1. Install xampp from this [get xampp link](https://www.apachefriends.org/download.html)
2. Install Composer from this [get composer link](https://getcomposer.org/download)
3. Download source code for timeteller from github and paste in htdocs folder inside C:/xampp directory.
4. Start the Apache Server from xampp control panel. 
5. Go to the command prompt and migrate to the timeteller root directory.
6. Run the following commands.
> php composer.phar install

> php artisan key:generate

>php artisan serve
7. Now you can visit http://localhost:8000 to view the started server.


### Running Spring Boot Server.

1. Download the source code from github.
2. Migrate to the projects root directory.
3. Run the following commands.
> mvn clean install

> mvn spring-boot:run
4. Look for the in-built terminal to see whether the server is started.
5. Now, you can visit http://localhost:8080 to view the started server.

### Running Flask Server.

1. Download the source code from github.
2. Migrate to the project folder from terminal/command-prompt.
3. Run the following command.
> python pyserver.py
4. Now you can visit the link from flask on which port the server is started. Normally, http://localhost:5000

### Starting the php client.php

1. Download the source code from github.
2. Migrate to the folder where client.php is present.
3. Run the following Command.
> php -S localhost:2000
4. Now you can go to http://localhost:2000 which will start the in-built PHP server. 
5. Now visit the client interface through http://localhost:2000/client.php


### Testing

1. After Every Server and client mentioned above are started. you can do the following:
2. Clicking "Get user data from Java Server Database through Laravel" button will get the users in the postgres db which is linked to java spring boot server from laravel. (Communications between laravel PHP and Spring Boot).
3. Clicking "Get Current Time From Laravel MicroService" will get current time from laravel microservice.
4. Clicking "Get Greetings from Java SpringBoot MicroService" will get greeting from Spring Boot Java Microservice.
5. Clicking "Say Hello to the MicroService." will return hello greeting.
6. Clicking "Get User data from Java Server Database through python flask." will get users JSON data from java server to python to client.
7. Clicking "Get Cars as Json from Python Server" will get JSON from Python server, stringifies and embeds in the html.

### Database

1. If you want to recreate my remote postgresql database in your local postgres db system. You can do so by using the latest.dump file in the Assignment 1 Repository.
2. The command that you have to run is :
3. After you have installed the version 9.6.4 of PostgreSQl, Login to psql terminal.
4. Create a role.( eg. myuser ), Create a db ( eg. mydb ). Grant all privileges of mydb to myuser. 
5. Exit psql terminal, Migrate to directory where latest.dump is present and type the following command.
> pg_restore --verbose --clean --no-acl --no-owner -h localhost -U myuser -d mydb latest.dump
6. Some Errors may be present due to differences between heroku db and local db but ignore them.
7. Now open psql terminal again and connet to mydb. You can see the data in the table 'users'.
-------------------------------------------------------------------------------------------------------
** I'm happy to share credentials of remote db if you have a third party postgres client for your machine like POSTICO( only available for mac) to escape all the above mentioned process.

## Contact

> Please **let me know** if you have any troube regrading starting of the microservices or the client.




