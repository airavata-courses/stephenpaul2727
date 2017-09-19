# SCIENCE GATEWAY ARCHITECTURE

## Assignment 2

## Technologies Used:

PHP (Laravel)
JAVA (Spring Boot)
PYTHON (Flask)
JAVASCRIPT (JS)

## Requirements:
Link for the instance:
Client: 129.114.104.44---->(Not Working For Now)
APIGateway: 129.114.104.44:3000
PythonMicroservice: 129.114.104.44:5000
SpringBootMicroservice: 129.114.104.44:8090
LaravelMicroService: 129.114.104.44:8000
RabbitMQ: 129.114.104.44:15672 -> All messages are implemented using topic exchange. 

## Process Completed:
1. Used RabbitMQ for communication between API Gateway and microservices and in between microservices.
2. Used Docker-compose to build all the microservices including gateway and client in docker containers.
3. Created Jenkins File to run the docker-compose up command and other necessary commands to start all the build running.
4. Allocated a VM in jetstream for the project. 
5. Linked Jenkins Slave to the VM Instance.


## USAGE ---- BRANCH: Assignment2

### Fanning out userinfo retrieved from java db to python microservice an laravel microservice:

1. go to this link: 129.114.104.44:8000/PhpListener
2. go to this link: 129.114.104.44:5000/PythonListener
3. go to this link: 129.114.104.44:8090/fanoutjavauserdata
4. visit 1 & 2 links to check for output. Python microservice displays results on console.

### Sending out user to store in java db from laravel microservice.

1. go to this link: 129.114.104.44:8000/postUserThroughRabbit. The following user can be now posted:
"Prudhvi","prudacha@iu.edu","8129551384" -> (hardcoded)
2. Now check the console to see whether user is saved or not! if it says USER EXISTS, then the user is already there in the database.
3. if he is not!, then you can visit: 129.114.104.44:8090/getuserdata 
4. It will list all the users from the database and you can find the person there!

### Sending out user to store in java db from python microservice.

1. go to this link: 129.114.104.44:5000/postUserThroughRabbit. The following user can be now posted:
"python","python@iu.edu","8128558585" -> (hardcoded)
2. Now check the console to see whether user is saved or not! if it says USER EXISTS, then the user is already there in the database.
3. if he is not!, then you can visit: 129.114.104.44:8090/getuserdata 
4. It will list all the users from the database and you can find the person there!

### Getting time from Laravel Microservice to API Gateway through RabbitMQ.

1. go to this link: 129.114.104.44:8000/PhpListener
2. go to this link: 129.114.104.44:3000/laraveltime
3. Now visit the link in point 1 to get the time from laravel microservice through RabbitMQ.

### Getting cars from Python Microservice to API Gateway through RabbitMQ.
1. go to this link: 129.114.104.44:5000/PythonListener
2. go to this link: 129.114.104.44:3000/pythoncars
3. Now visit the link in point 1 to get the time from laravel microservice through RabbitMQ.

ALSO, javauserdata in its database can be retrieved from laravel and python microservices through rabbitmq to apigateway which in turn sends that information to client. 


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




