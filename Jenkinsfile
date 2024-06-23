pipeline{

    agent {
        node {
            label 'docker-agent'
            args '-v /var/run/docker.sock:/var/run/docker.sock'
        }
    }

    environment{
        DOCKER_IMAGE = 'rakeshreddy0605/my-app'
        DOCKER_CREDENTIALS_ID = 'Dockerhub-credentials'
        KUBE_CONFIG_CREDENTIAL_ID = 'kubeconfig-credential-id'
    }
stages {
    stage ('Checkout Source Code') {
        steps {
            git branch: 'main', url: 'https://github.com/RakeshReddy05/Myapp.git'
        }
    }

    stage ('Build Docker Image') {
        steps {
            script {
                    docker.build("${DOCKER_IMAGE}")
                }
        }
    }

    stage ('Push Docker Image') {
        steps {
            script {
                  docker.withRegistry('https://registry.hub.docker.com', env.DOCKER_CREDENTIALS_ID)
                  dockerImage.push('latest') 
          }
        }
    }

    stage ('Deployment to Kubernetes') {
        steps {
            script {
                kubernetesDeploy (
                 configs: 'mariadb-configmap.yaml', 'mariadb-secret.yaml', 'mariadb-service.yaml', 'mariadb-deployment.yaml', 'myapp-service.yaml', 'myapp-deployment.yaml', 
                 kubeconfigId: env.KUBE_CONFIG_CREDENTIAL_ID
                )
            }
        }

    }
}

}