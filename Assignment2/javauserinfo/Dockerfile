FROM openjdk:8
ADD target/dockerjar.jar .
EXPOSE 8090
ENTRYPOINT ["java","-jar","dockerjar.jar","--server.port=8090"]
