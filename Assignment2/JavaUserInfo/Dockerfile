FROM openjdk:8
ADD target/dockerjar.jar dockerjar.jar
EXPOSE 8080
ENTRYPOINT ["java","-jar","dockerjar.jar"]
