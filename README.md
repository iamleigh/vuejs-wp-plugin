# Leighton Quito

Awesome Motive Developer Applicant Challenge, Part 1

## 1. Install Required Tools

Run the following commands in the `leighton-quito` plugin folder:

```
#!bash
$ cd <path-to-wordpress>/wp-content/plugins/leighton-quito

# Install composer:
$ php -r "readfile('https://getcomposer.org/installer');" > composer-setup.php
$ php composer-setup.php --filename=composer
$ php -r "unlink('composer-setup.php');"

# Install PHP Unit
$ php composer require --dev "phpunit/phpunit=^8"
```
