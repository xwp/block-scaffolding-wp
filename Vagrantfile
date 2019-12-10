# Local dev environment https://github.com/wpsh/wpsh-local

load File.join(
	File.dirname(__FILE__),
	"vendor/wpsh/local/Vagrantfile"
)

Vagrant.configure(2) do |config|
	config.vm.hostname = "block-scaffolding-wp"

	# Wait to ensure all containers are up.
	config.vm.provision "shell",
		inline: "sleep 10",
		run: "always"

	# Setup the WP site.
	config.vm.provision "shell",
		inline: "docker-compose run wordpress wp core install --url=block-scaffolding-wp.local",
		run: "always",
		env: {
			"COMPOSE_FILE" => "/vagrant/docker-compose.yml"
		}
end
