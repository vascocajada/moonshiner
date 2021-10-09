# Moonshiner

### Installation
- install docker-compose
- cd to folder "docker"
- run command
    ```sh
    docker-compose up
    ```
- wait for docker to build all the containers
- still inside the folder "docker", run command
    ```sh
    docker-compose exec php-fpm '/bin/bash'
    ```
- you are now inside the PHP container. Run
    ```sh
    cd /var/www && composer update
    ```
    
At this point you should be all setup and see the app on your browser at localhost/ .

----
### Testing


To run the tests, go again inside the container
```sh
docker-compose exec php-fpm '/bin/bash'
```
And run
```sh
cd /var/www/ && php ./vendor/bin/phpunit
```

----

### About

I chose challenge #2 - PHP eCommerce Rule Engine

I tried to keep this as simple as possible and just show off a basic SF5 setup.

It looked like a good occasion to explore Doctrine and the model relationships, so I put some together.

As requested, I wrote a basic test suite that runs on demand.

You might have noticed, but I set up an environment with docker so that we can easily run the code accross different machines, and because there's no reason to just run servers locally anymore :P

