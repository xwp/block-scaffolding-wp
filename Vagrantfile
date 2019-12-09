# Local dev environment https://github.com/wpsh/wpsh-local

load File.join(
	File.dirname(__FILE__),
	"vendor/wpsh/local/Vagrantfile"
)

Vagrant.configure(2) do |config|
	config.vm.hostname = "block-scaffolding"

	# Wait to ensure all containers are up.
	config.vm.provision "shell",
		inline: "sleep 10",
		run: "always"

	# Install dev dependencies.
	config.vm.provision "shell",
		inline: <<-SHELL
			apt-get install software-properties-common
			add-apt-repository ppa:ondrej/php
			apt-get update
			curl -sL https://deb.nodesource.com/setup_8.x | sudo bash -
			apt-get install -y php nodejs curl php-pear php-xdebug php-curl php-dev php-gd php-mbstring php-zip php-mysql php-xml
			apt-get upgrade
			curl -s https://getcomposer.org/installer | php
			mv composer.phar /usr/local/bin/composer
		SHELL

	# Setup the WP site.
	config.vm.provision "shell",
		inline: "docker-compose run wpcli wp core install --url=block-scaffolding.local",
		run: "always",
		env: {
			"COMPOSE_FILE" => "/vagrant/docker-compose.yml"
		}
end
