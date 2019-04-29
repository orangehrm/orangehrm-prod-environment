# OrangeHRM PROD Environment - PHP 7.1
[![Docker Automated](https://img.shields.io/docker/automated/orangehrm/orangehrm-environment-images.svg)](https://hub.docker.com/r/orangehrm/orangehrm-environment-images/) [![Docker Pulls](https://img.shields.io/docker/pulls/orangehrm/orangehrm-environment-images.svg)](https://hub.docker.com/r/orangehrm/orangehrm-environment-images/) [![Docker Status](https://img.shields.io/docker/build/orangehrm/orangehrm-environment-images.svg)](https://hub.docker.com/r/orangehrm/orangehrm-environment-images/) [![Build Status](https://travis-ci.org/orangehrm/orangehrm-prod-environment.svg?branch=php-7.1)](https://travis-ci.org/orangehrm/orangehrm-prod-environment)

## Introduction

prod-environment-php71 is a dockerized production environment for OrangeHRM. This dev environment mainly contains three containers as follows,

- web container (PHP 7.1)
- MySQL container (MariaDB 10.2)
- phpmyadmin container

Configuration of each layer has been added according to the OrangeHRM requirements.

## Architecture
![php71 architecture](./doc-helpers/architecture.png)

## How to use ?

1. Download the zip
2. Extract the downloaded zip file 
3. run `docker-compose up -d` - this will up web, phpmyadmin and database containers


## Notes
- Custom configurations can be added through the docker-compose file. 