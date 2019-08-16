# Block Extend

[![Build Status](https://travis-ci.com/xwp/block-extend.svg?branch=master)](https://travis-ci.com/xwp/block-extend)

[![Coverage Status](https://coveralls.io/repos/github/xwp/block-extend/badge.svg?branch=master)](https://coveralls.io/github/xwp/block-extend?branch=master)


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

	which will be available at [blockextend.local](http://blockextend.local) after provisioning (username: `admin`, password: `password`).

	Alternatively, run it on your local Docker host:

	   docker-compose up -d
	
	which will make it available at [locahost](http://locahost).


### Scripts

We use `npm` as the canonical task runner for the project. Some of the PHP related scripts are defined in `composer.json`.

- `npm run build` to build the plugin JS and CSS assets. Use `npm run dev` to watch and re-build as you work.

- `npm run lint:js` to lint JavaScript files with [eslint]().

- `npm run lint:php` to lint PHP files with [phpcs]().

- `npm run test:php -- --no-coverage` to tun PHPUnit tests, with the optional `--no-coverage` flag to avoid generating the Clover test coverage report.
