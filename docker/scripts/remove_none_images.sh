#!/bin/bash

# script created special for delete none images

# This helps to reduce memory using for old dockers

# Remember that it is possible to not delete some of them. You has to delete them manual
docker rmi $(docker images | grep "<none>")