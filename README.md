# Conway's Game of Life
Kata solution in PHP done in strict TDD.

# How to run the kata
## Install the dependencies
Using PHP 7.4 installed locally

    make install

or using docker

    make docker-build
## Run the code
Using PHP 7.4 installed locally

    make run
 or using docker

    make docker-run

## Run the tests
Using PHP 7.4 installed locally

    make tests
 or using docker

    make docker-tests
## Play with arguments and options
Using PHP 7.4 installed locally

    ./console gof:run --help
 or using docker

    docker run --rm -v ${PWD}:/opt/project php-docker-bootstrap ./console gof:run --help

## Code coverage
Using PHP 7.4 installed locally

    make coverage
 or using docker

    make docker-coverage
