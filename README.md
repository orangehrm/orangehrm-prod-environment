# OrangeHRM PROD Image - PHP 7.2
[![Docker Automated](https://img.shields.io/docker/automated/orangehrm/orangehrm-environment-images.svg)](https://hub.docker.com/r/orangehrm/orangehrm-environment-images/) [![Docker Pulls](https://img.shields.io/docker/pulls/orangehrm/orangehrm-environment-images.svg)](https://hub.docker.com/r/orangehrm/orangehrm-environment-images/) [![Docker Status](https://img.shields.io/docker/build/orangehrm/orangehrm-environment-images.svg)](https://hub.docker.com/r/orangehrm/orangehrm-environment-images/) [![Build Status](https://travis-ci.org/orangehrm/orangehrm-prod-environment.svg?branch=php-7.2)](https://travis-ci.org/orangehrm/orangehrm-prod-environment)

## Introduction

This repository contains the prod 7.3.5 (PHP 7.3.5 production) image which is used by the OrangeHRM PROD Environment(This is a custom requirement to prepare ING dev environment). This image is extended from RHEL image which was taken from the RHEL docker registry.
## How to use ?

1. get a docker pull - `docker pull orangehrm/orangehrm-environment-images:prod-7.3.5-ing` 
2. run the image - `docker run -itd --name <NAME> -p 443:443 orangehrm/orangehrm-environment-images:prod-7.3.5-ing`