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
temp=$(docker-compose --version)
if [ $? -eq 0]
then
   echo "already done!"
else
     sudo curl -o /usr/local/bin/docker-compose -L "https://github.com/docker/compose/releases/download/1.15.0/docker-compose-$(uname -s)-$(uname -m)"
     sudo chmod +x /usr/local/bin/docker-compose
fi
sudo apt-get -y install maven
cd Assignment2
cd javauserinfo
mvn clean install
cd ..
sudo docker-compose up'''
      }
    }
  }
}