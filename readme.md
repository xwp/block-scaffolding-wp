# Block Scaffolding for WordPress

[![Build Status](https://travis-ci.com/xwp/block-scaffolding-wp.svg?branch=master)](https://travis-ci.com/xwp/block-scaffolding-wp)
[![Coverage Status](https://coveralls.io/repos/github/xwp/block-scaffolding-wp/badge.svg?branch=master)](https://coveralls.io/github/xwp/block-scaffolding-wp?branch=master)

## Requirements

- WordPress 5.0+ or the [Gutenberg Plugin](https://wordpress.org/plugins/gutenberg/).
- PHP 7.2 or later, [Composer](https://getcomposer.org) and [Node.js](https://nodejs.org) for dependency management.
- [Docker](https://docs.docker.com/install/) or [Vagrant](https://www.vagrantup.com) with [VirtualBox](https://www.virtualbox.org) for a local development environment.

We suggest using a software package manager for installing the development dependencies such as [Homebrew](https://brew.sh) on MacOS:

	brew install php composer node docker docker-compose

or [Chocolatey](https://chocolatey.org) for Windows:

	choco install php composer node nodejs docker-compose


## Development

1. Clone the plugin repository.

2. Setup the development environment and tools using [Node.js](https://nodejs.org) and [Composer](https://getcomposer.org):

		npm install

	Note that both Node.js and PHP 7.2 or later are required on your computer for running the `npm` scripts. Use `npm run docker -- npm install` to run the installer inside a Docker container if you don't have the required version of PHP installed locally.

## Development Environment

This repository includes a WordPress development environment based on [Docker](https://docs.docker.com/install/) that can be run on your computer or inside a [Vagrant](https://www.vagrantup.com/) and [VirtualBox](https://www.virtualbox.org/) wrapper for network isolation and simple `.local` domain names.

### Using Vagrant

To use the Vagrant based environment, run:

	vagrant up

which will make it available at [block-scaffolding-wp.local](http://block-scaffolding-wp.local).

Use the included wrapper command for running scripts inside the Docker container running inside Vagrant:

	npm run vagrant -- npm run test:php

where `npm run test:php` is any of the scripts you would like to run.

Visit [block-scaffolding-wp.local:8025](http://block-scaffolding-wp.local:8025) to check all emails sent by WordPress.


### Using Native Docker

To use the Docker based environment with the Docker engine running on your host, run:

	docker-compose up -d

which will make it available at [localhost](http://localhost). Ensure that no other Docker containers or services are using port 80 on your machine. 

Use the included wrapper command for running scripts inside the Docker container:

	npm run docker -- npm run test:php

where `npm run test:php` is any of the scripts you would like to run.

Visit [localhost:8025](http://localhost:8025) to check all emails sent by WordPress.


### Scripts

We use `npm` as the canonical task runner for the project. Some of the PHP related scripts are defined in `composer.json`.

All of these commands can be run inside the Docker or Vagrant environments by prefixing the scripts with `npm run docker --` for Docker or with `npm run vagrant --` for Vagrant.

- `npm run build` to build the plugin JS and CSS assets. Use `npm run dev` to watch and re-build as you work.

- `npm run lint:js` to lint JavaScript files with [eslint](https://eslint.org/).

- `npm run lint:php` to lint PHP files with [phpcs](https://github.com/squizlabs/PHP_CodeSniffer).

- `npm run test:php` to run PHPUnit tests without generating a coverage report.

- `npm run test:php:coverage` to run PHPUnit tests and generate a coverage report in both XML Clover and HTML format.
