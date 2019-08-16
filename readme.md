# Block Extend

[![Build Status](https://travis-ci.com/xwp/block-extend.svg?branch=master)](https://travis-ci.com/xwp/block-extend)


## Requirements

- WordPress 5.0+ or the [Gutenberg Plugin](https://wordpress.org/plugins/gutenberg/).
- [Composer](https://getcomposer.org) and [Node.js](https://nodejs.org) for dependency management.
- [Vagrant](https://www.vagrantup.com) and [VirtualBox](https://www.virtualbox.org) for local development environment.


## Development

1. Clone the plugin repository.

2. Setup the development environment and tools using [Node.js](https://nodejs.org) and [Composer](https://getcomposer.org):

	   npm install

3. Start a virtual testing environment using [Vagrant](https://www.vagrantup.com/) and [VirtualBox](https://www.virtualbox.org/):

	   vagrant up

	which will be available at [http://blockextend.local](http://blockextend.local) after provisioning (username: `admin`, password: `password`).

4. Build the plugin JS and CSS assets:

	   npm run build
	
	or use `npm run dev` to watch and re-build as you work.

5. Lint JavaScript files with ESLint:

	   npm run lint:js

6. Lint PHP files with phpcs:

	   npm run lint:php

6. Run PHPUnit tests, with the optional `--coverage` flag preceded by `--` to create a report:

	   npm run test:php -- --coverage-html tmp/report
