pipeline {
  agent {
    node {
      label 'jenkins_slave'
    }
    
  }
  stages {
    stage('My_Steps') {
      steps {
        git(url: 'https://github.com/airavata-courses/stephenpaul2727', branch: 'Assignment2')
        sh '''curl -fsSL https://download.docker.com/linux/ubuntu/gpg | sudo apt-key add -
sudo add-apt-repository "deb [arch=amd64] https://download.docker.com/linux/ubuntu $(lsb_release -cs) stable"
sudo apt-get update
sudo apt-get install -y docker-ce
tmp=$(docker-compose --version 2>&1 >> /dev/null)
if [ $tmp -eq 0];
then
    sudo curl -L https://github.com/docker/compose/releases/download/1.16.1/docker-compose-`uname -s`-`uname -m` -o /usr/local/bin/docker-compose
    sudo chmod +x /usr/local/bin/docker-compose
else
    echo "Already There! Skipping"
fi

docker run -d --hostname my-rabbit --name some-rabbit --net="host" -p 5672 -p 15672 rabbitmq:3-management
sudo apt-get -y install maven
cd Assignment2
cd javauserinfo
mvn clean install
mvn package
cd ..
sudo docker-compose up'''
      }
    }
  }
}