pipeline{

    agent {
        docker {
            image 'rakeshreddy0605/jenkins-docker-agent-image'
        }
    }

    environment{
        DOCKER_IMAGE = 'rakeshreddy0605/my-app'
        DOCKER_CREDENTIALS_ID = 'Dockerhub-credentials'
        KUBE_CONFIG_CREDENTIAL_ID = 'kubeconfig-credential-id'
    }

    stages('Checkout Source Code') {
        steps{
            git https://github.com/RakeshReddy05/Myapp.git
        }
    }

    stages('Build Docker Image') {
        steps{
            script {
                    docker.build("${DOCKER_IMAGE}")
                }
        }
    }

    stages('Push Docker Image') {
        steps{
            script {
                  docker.withRegistry('https://registry.hub.docker.com', env.DOCKER_CREDENTIALS_ID)
                  dockerImage.push('latest') 
          }
        }
    }

    stages('Deployment to Kubernetes') {
        steps{
            script{
                kubernetesDeploy (
                 configs: 'mariadb-configmap.yaml', 'mariadb-secret.yaml', 'mariadb-service.yaml', 'mariadb-deployment.yaml', 'myapp-service.yaml', 'myapp-deployment.yaml', 
                 kubeconfigId: env.KUBE_CONFIG_CREDENTIAL_ID
                )
            }
        }

    }
}