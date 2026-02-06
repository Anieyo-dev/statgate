#!/bin/bash

cd ../docker/

echo "WHICH SERVER TO RUN?:"
echo "1. server"
echo "2. server + rebuild"
read -s -n1 choice

echo "STARTING SERVER"
if [ $choice -eq "1" ]; then    
    echo "Starting server"
    docker-compose -f docker-compose.yml up --remove-orphans #> ../logs/dev.log
elif [ $choice -eq "2" ]; then
    echo "Starting server with rebuild"
    docker-compose -f docker-compose.yml up --remove-orphans --build #> ../logs/dev.log
else
    echo "DONE NOTHING NO OPTION SELECTED!"
fi
# turned off log collector.