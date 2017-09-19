FROM openjdk:8
ADD target/dockerjar.jar /home
EXPOSE 8090
ENTRYPOINT ["java","-jar","/home/dockerjar.jar","--server.port=8090"]
