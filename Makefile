default: pulsar

DOCKER_COMMAND = docker run --rm -v ${PWD}:/app composer:2.8

vendor:
	@${DOCKER_COMMAND} composer install

.PHONY: run
run: vendor
	@${DOCKER_COMMAND} ./console gof:run

.PHONY: blinker
blinker: vendor
	@${DOCKER_COMMAND} ./console gof:run -t 500 -g 10 -f data/blinker_3x3.txt

.PHONY: glider
glider: vendor
	@${DOCKER_COMMAND} ./console gof:run -t 500 -g 20 -f data/glider_10x10.txt

.PHONY: pulsar
pulsar: vendor
	@${DOCKER_COMMAND} ./console gof:run -t 500 -g 20 -f data/pulsar_period3.txt

.PHONY: tests
tests: vendor
	@${DOCKER_COMMAND} ./vendor/bin/phpunit --color=always

