# Block Scaffolding for WordPress

[![Build Status](https://travis-ci.com/xwp/block-scaffolding-wp.svg?branch=master)](https://travis-ci.com/xwp/block-scaffolding-wp)
[![Coverage Status](https://coveralls.io/repos/github/xwp/block-scaffolding-wp/badge.svg?branch=master)](https://coveralls.io/github/xwp/block-scaffolding-wp?branch=master)

## Requirements

- WordPress 5.0+ or the [Gutenberg Plugin](https://wordpress.org/plugins/gutenberg/).
- [Composer](https://getcomposer.org) and [Node.js](https://nodejs.org) for dependency management.
- [Vagrant](https://www.vagrantup.com) and [VirtualBox](https://www.virtualbox.org), or [Docker](https://docs.docker.com/install/), for a local development environment.

## Development

1. Clone the plugin repository.

2. Setup the development environment and tools using [Node.js](https://nodejs.org) and [Composer](https://getcomposer.org):

		npm install

	_running the `npm` commands locally requires PHP 7.2+ be installed on your machine_

3. If you need a WordPress development environment, start one using [Vagrant](https://www.vagrantup.com/) and [VirtualBox](https://www.virtualbox.org/), or [Docker](https://docs.docker.com/install/):

	**These steps are optional, and the plugin will still run in a typical WordPress development environment.**

		vagrant up

	which will be available at [block-scaffolding-wp.local](http://block-scaffolding-wp.local) after provisioning (username: `admin`, password: `password`).

	Alternatively, run it on your local Docker host:

		docker-compose up -d

	which will make it available at [localhost](http://localhost)  (username: `admin`, password: `password`).

	To run `npm` inside the Vagrant environment you can use the `npm` script that will `ssh` into the box and run a single command like so:
    	
		npm run vagrant -- npm run test:php
	
	To run the same command directly with your Docker host:

		npm run docker -- npm run test:php

### Scripts

We use `npm` as the canonical task runner for the project. Some of the PHP related scripts are defined in `composer.json`.

- `npm run build` to build the plugin JS and CSS assets. Use `npm run dev` to watch and re-build as you work.

- `npm run lint:js` to lint JavaScript files with [eslint](https://eslint.org/).

- `npm run lint:php` to lint PHP files with [phpcs](https://github.com/squizlabs/PHP_CodeSniffer).

- `npm run test:php` to run PHPUnit tests without generating a coverage report.

- `npm run test:php:coverage` to run PHPUnit tests and generate a coverage report in both XML Clover and HTML format.
