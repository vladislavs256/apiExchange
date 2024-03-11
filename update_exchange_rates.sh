#!/bin/bash

# Define the Docker container name
CONTAINER_NAME="php-cli-1"

# Define the Symfony command to run
SYMFONY_COMMAND="php bin/console UpdateExchangeRatesCommand EUR"

# Execute the Symfony command within the Docker container
docker exec -it $CONTAINER_NAME $SYMFONY_COMMAND
