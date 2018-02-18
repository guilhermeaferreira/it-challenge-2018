# IT Challenge 2018

The task is located in the [task.pdf][task_pdf] file.

### How to test the project?

First, you need to [install docker in your environment][docker_install_link].

Then, you will need [Docker Compose][docker_compose_more_info] to be able to run the [docker-compose.yml][docker_compose] file. 

As soon as you get both configured properly, you just have to run the following command from the repository folder:
 
```sh
$ docker-compose up -d
```

### References
 - [API Platform][api_platform_link] - used to build the API.
 - [AdminLTE][adminlte_link] - admin theme used for that project.
 - [Symfony][symfony_link] - PHP framework used.

### TIPS

 - Be aware about the ports required in the [docker-compose file][docker_compose]. If you are already using any of them locally, the compose command will fail.


[task_pdf]: <https://github.com/guilhermeaferreira/it-challenge-2018/blob/master/task.pdf>
[docker_compose]: <https://github.com/guilhermeaferreira/it-challenge-2018/blob/master/docker-compose.yml>
[docker_compose_more_info]: <https://docs.docker.com/compose/>
[docker_install_link]: <https://docs.docker.com/install/>
[api_platform_link]: <https://api-platform.com/>
[adminlte_link]: <https://adminlte.io/>
[symfony_link]: <https://symfony.com/>
