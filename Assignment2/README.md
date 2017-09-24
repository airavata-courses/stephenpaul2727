# SCIENCE GATEWAY ARCHITECTURE

## Assignment 2

## Image Description of the Project:

![alt text](https://github.com/airavata-courses/stephenpaul2727/blob/Assignment2/Assignment2/assignment2sga.png "Project Image Layout")

## Technologies Used:

PHP (Laravel)
JAVA (Spring Boot)
PYTHON (Flask)
JAVASCRIPT (JS)

## Requirements:
Link for the instance:
Client: 129.114.104.44
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

## Testing REMOTELY:

### Fanning out userinfo retrieved from java db to python microservice an laravel microservice: (Communication between microservices)

1. go to this link: 129.114.104.44:8000/PhpListener
2. go to this link: 129.114.104.44:5000/PythonListener
3. go to this link: 129.114.104.44:8090/fanoutjavauserdata
4. visit 1 & 2 links to check for output. Python microservice displays results on console.

### Testing API Server Connection:

1. Open the client at  http://129.114.104.44/
2. Click the button "Test API Server Connection" to verify whether the NODE API Gateway is Successfully connected!

### Getting User Data from Remote DB -> JavaUserInfo -> RabbitMQ -> TimeTeller -> RabbitMQ -> API Gateway -> Client

1. Open the listener for Laravel microservice at http://129.114.104.44:8000/PhpListener 
2. Now Click the button "Get user data from Java Server Database through Laravel" to get the user information.
3. Please wait some time to get results as the db is remote and free, Speeds are not that great!

### Getting User Data from Remote DB -> JavaUserInfo -> RabbitMQ -> PythonWorld-> RabbitMQ -> API Gateway -> Client

1. Open the listener for Laravel microservice at http://129.114.104.44:5000/PythonListener 
2. Now Click the button "Get user data from Java Server Database through python flask." to get the user information.
3. Please wait some time to get results as the db is remote and free, Speeds are not that great!

### Getting Cars Information from PythonWorld-> RabbitMQ -> API Gateway -> Client

1. Open the listener for Laravel microservice at http://129.114.104.44:5000/PythonListener 
2. Now Click the button "Get Cars as Json from Python Server." to get the cars list.

### Getting Current Time from TimeTeller -> RabbitMQ -> API Gateway -> Client

1. Open the listener for Laravel microservice at http://129.114.104.44:8000/PhpListener 
2. Now Click the button "Get Current Time From Laravel MicroService" to get the time.

## Testing LOCALLY:

1. Ensure Docker is started and Docker Compose is accessible.
2. Download the Project From GitHub Branch Assignment2.
3. Migrate to project root folder through your Machine CLI.
4. Run the Following Command:

> docker-compose up

5. Wait for all the services to start.
6. Now you can visit the services at :
> http://0.0.0.0:8000
> http://0.0.0.0:5000
> http://0.0.0.0:3000
> http://0.0.0.0:8090

7. The Services may not run as ip's are hardcoded and queue's in remote RabbitMQ are exclusive to the remote microservices.

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




