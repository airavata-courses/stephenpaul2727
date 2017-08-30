# SCIENCE GATEWAY ARCHITECTURE

## Assignment 1


## Technologies Used:

PHP (Laravel)
JAVA (Spring Boot)
PYTHON (Flask)

## Requirements:
1. Install phpstorm(free for students) with laravel, composer. [Follow this tutorial till 6:46](https://www.youtube.com/watch?v=QSZK1W0fbGQ).
2. Install Eclipse and Spring Tool Suite from eclipse market place.
3. Install Python -version > 2.7 & flask(use pip).


## USAGE

### Running Laravel Server.

1. Download source code from github.
2. open the project folder TimeTeller from phpstorm.
3. Run the following commands.
> composer update
> php artisan serve
4. Now, you can visit http://localhost:8000 to view the started server.

### Running Spring Boot Server.

1. Download the source code from github.
2. Start Eclipse with STS(Spring Tool Suite) installed.
3. Open the project folder from eclipse.
4. After the project is loaded, Right-Click on the project-> Run as-> Spring Boot App
5. Look for the in-built terminal to see whether the server is started.
6. Now, you can visit http://localhost:8080 to view the started server.

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
6. Clicking "Get Greetings from Python MicroService" will get the greeting from python server.
7. Clicking "Get Cars as Json from Python Server" will get JSON from Python server, stringifies and embeds in the html.

## Contact

> Please **let me know** if you have any troube regrading starting of the microservices or the client.




