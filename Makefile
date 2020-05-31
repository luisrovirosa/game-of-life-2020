.PHONY: default dependencies tests coverage docker-build docker-tests docker-coverage
default:
	@printf "$$HELP"

# Local commands
dependencies:
	composer install
run:
	./console gof:run
blinker:
	./console gof:run -t 500 -g 10 -f data/blinker_3x3.txt
glider:
	./console gof:run -t 500 -g 20 -f data/glider_10x10.txt
pulsar:
	./console gof:run -t 500 -g 20 -f data/pulsar_period3.txt
tests:
	./vendor/bin/phpunit --color=always
coverage:
	./vendor/bin/phpunit --coverage-text

# Docker commands
docker-build:
	docker build -t php-docker-bootstrap .
	@docker run --rm -v ${PWD}:/opt/project php-docker-bootstrap make dependencies

docker-in:
	@docker run --rm -it -v ${PWD}:/opt/project php-docker-bootstrap bash

define HELP
# Local commands
	- make dependencies\tInstall the dependencies using composer
	- make blinker\t\tRun the simulation with blinker setup
	- make glider\t\tRun the simulation with glider setup
	- make pulsar\t\tRun the simulation with pulsar setup
	- make tests\t\tRun the tests
	- make coverage\t\tRun the code coverage
# Docker commands
	- make docker-build\tCreates a PHP image with xdebug and install the dependencies
	- make docker-in\tEnter the docker container to be able to use all the commands as if you have installed PHP 7.4 locally
 Please execute "make <command>". Example make dependencies
 You can also run "./console gof:run --help" to play with the options

endef

export HELP
