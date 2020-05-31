.PHONY: default dependencies tests coverage docker-build docker-tests docker-coverage
default:
	@printf "$$HELP"

# Local commands
dependencies:
	composer install
run:
	./console gof:run
run-blinker:
	./console gof:run -t 500 -g 10 -f data/blinker_3x3.txt
run-glider:
	./console gof:run -t 500 -g 20 -f data/glider_10x10.txt
run-pulsar:
	./console gof:run -t 500 -g 20 -f data/pulsar_period3.txt
tests:
	./vendor/bin/phpunit --color=always
coverage:
	./vendor/bin/phpunit --coverage-text

# Docker commands
docker-build:
	docker build -t php-docker-bootstrap .
	@docker run --rm -v ${PWD}:/opt/project php-docker-bootstrap make dependencies

docker-run:
	@docker run --rm -v ${PWD}:/opt/project php-docker-bootstrap make run
docker-run-blinker:
	@docker run --rm -t -v ${PWD}:/opt/project php-docker-bootstrap make run-blinker
docker-run-glider:
	@docker run --rm -t -v ${PWD}:/opt/project php-docker-bootstrap make run-glider
docker-run-pulsar:
	@docker run --rm -t -v ${PWD}:/opt/project php-docker-bootstrap make run-pulsar
docker-tests:
	@docker run --rm -v ${PWD}:/opt/project php-docker-bootstrap make tests
docker-coverage:
	@docker run --rm -v ${PWD}:/opt/project php-docker-bootstrap make coverage

define HELP
# Local commands
	- make dependencies\tInstall the dependencies using composer
	- make tests\t\tRun the tests
	- make coverage\t\tRun the code coverage
# Docker commands
	- make docker-build\tCreates a PHP image with xdebug and install the dependencies
	- make docker-tests\tRun the tests on docker
	- make docker-coverage\tRun the code coverage
 Please execute "make <command>". Example make help

endef

export HELP
