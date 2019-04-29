# OrangeHRM PROD Image - PHP 5.6 centos
[![Docker Automated](https://img.shields.io/docker/automated/orangehrm/orangehrm-environment-images.svg)](https://hub.docker.com/r/orangehrm/orangehrm-environment-images/) [![Docker Pulls](https://img.shields.io/docker/pulls/orangehrm/orangehrm-environment-images.svg)](https://hub.docker.com/r/orangehrm/orangehrm-environment-images/) [![Docker Status](https://img.shields.io/docker/build/orangehrm/orangehrm-environment-images.svg)](https://hub.docker.com/r/orangehrm/orangehrm-environment-images/) [![Build Status](https://travis-ci.org/orangehrm/orangehrm-prod-environment.svg?branch=php-7.1)](https://travis-ci.org/orangehrm/orangehrm-prod-environment)

## Introduction

This repository contains the prod-5.6-centos (PHP 5.6 production) image which is used by the OrangeHRM PROD Environment. Prod 5.6 image has been extended from the centos/systemd image. 

All the added configurations and installed modules are crucial to the OrangeHRM application. And the image will only listen to the 443 port by default.

## How to use ?

1. get a docker pull - `docker pull orangehrm/orangehrm-environment-images:prod-5.6-centos` 
2. run the image - `docker run -itd --name <NAME> -p 443:443 orangehrm/orangehrm-environment-images:prod-5.6-centos`