# Conway's Game of Life
Kata solution of [Conway's Game of Life](https://en.wikipedia.org/wiki/Conway%27s_Game_of_Life) in PHP done in strict TDD.

# How to run the kata
This repository can be used either having installed PHP 7.4 in your machine or docker.
## Install the dependencies
Using PHP 7.4 installed locally

    make install

or using docker

    make docker-build

## Run the simulations
If you are using docker before running any of the simulations please run  

    make docker-in

There are 3 simulations prepared

    make blinker
    make glider
    make pulsar

## Play with arguments and options
    ./console gof:run --help

## Run the tests
    make tests

## Code coverage
    make coverage
