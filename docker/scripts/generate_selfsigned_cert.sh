#!/bin/bash

echo "Enter key settings:"
read -p "Enter country:" country
read -p "Enter state:" state
read -p "Enter locality:" locality
read -p "Enter organisation:" org
read -p "Enter organisation unit:" orgUnit
read -p "Enter full domain name:" domain

openssl req -newkey rsa:4096 \
            -x509 \
            -sha256 \
            -days 3650 \
            -nodes \
            -out ../apache2/ssl/certs/apache-selfsigned.crt \
            -keyout ../apache2/ssl/private/apache-selfsigned.key \
            -subj "/C=$country/ST=$state/L=$locality/O=$org/OU=$orgUnit/CN=$domain"
