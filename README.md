![#f03c15](https://placehold.it/15/f03c15/000000?text=+) `CUSTOMIZATION IMAGE`

# OrangeHRM PROD Image - Ubuntu 18.04 Image - PHP 7.1

[![Docker Automated](https://img.shields.io/docker/automated/orangehrm/orangehrm-environment-images.svg)](https://hub.docker.com/r/orangehrm/orangehrm-environment-images/) [![Docker Pulls](https://img.shields.io/docker/pulls/orangehrm/orangehrm-environment-images.svg)](https://hub.docker.com/r/orangehrm/orangehrm-environment-images/) [![Docker Status](https://img.shields.io/docker/build/orangehrm/orangehrm-environment-images.svg)](https://hub.docker.com/r/orangehrm/orangehrm-environment-images/) [![Build Status](https://travis-ci.org/orangehrm/orangehrm-prod-environment.svg?branch=php-7.1-ubuntu-18.04)](https://travis-ci.org/orangehrm/orangehrm-prod-environment)


## Introduction

This repository contains the prod 7.1 (PHP 7.1 production) ubuntu image which is added as a customization image. Prod Ubuntu 7.1 image has been extended from the Ubuntu 18.04 official image. 

All the added configurations and installed modules are crucial to the OrangeHRM application. And the image will only listen to the 443 port by default.

## How to use ?

1. get a docker pull - `docker pull orangehrm/orangehrm-environment-images:prod-7.1-ubuntu-18.04` 
2. run the image - `docker run -itd --name <NAME> -p 443:443 orangehrm/orangehrm-environment-images:prod-7.1-ubuntu-18.04`