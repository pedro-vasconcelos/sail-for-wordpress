## Introduction

Sail provides a Docker powered local development experience for Laravel that is compatible with macOS, Windows (WSL2), and Linux.

This library has taken that work and tailored it for a WordPress environment.

Other than Docker, no software or libraries are required to be installed on your local computer before using Sail. Sail's simple CLI means you can start building your Laravel application without any previous Docker experience.

#### Inspiration

WordPress Sail is inspired by and derived from [Laravel Sail](https://github.com/laravel/sail), which is inspired by and derived from [Vessel](https://github.com/shipping-docker/vessel) by [Chris Fidao](https://github.com/fideloper). If you're looking for a thorough introduction to Docker, check out Chris' course: [Shipping Docker](https://serversforhackers.com/shipping-docker).

## Installation

From a Bedrock project, require WordPress Sail:

```
composer require wp-cli/wp-cli sterner-stuff/wordpress-sail`
```

Note that we're requiring WP-CLI as a local dependency. Some of WP Sail's WP-CLI commands depend on loading before WordPress. If you use a globally-installed version of WP-CLI and try to run commands required at the local level, they won't load early enough and you'll get errors about database connections.

With that in mind, use the bundled WP-CLI command to scaffold your `docker-composer.yml` file. Remember, we need to use our local version of WP-CLI:

```
vendor/bin/wp sail:install [--with=]
```

By default, MySQL and Mailhog containers will be attached, but you can also use, for example, Redis:

```
vendor/bin/wp sail:install --with=mysql,mailhog,redis
```

At this point, you may want to change the version of PHP used in the `docker-compose.yml` file.

```
version: '3'
services:
    wordpress.test:
        build:
            context: ./vendor/sterner-stuff/wordpress-sail/runtimes/8.1 <-- Supports 7.4, 8.0, and 8.1
            dockerfile: Dockerfile
            args:
                WWWGROUP: '${WWWGROUP}'
        image: wordpress-sail-8.1/app <-- Update here as well.
        extra_hosts:
            - 'host.docker.internal:host-gateway'
        # ...
```

Finally, build your containers:

```
vendor/bin/sail build
```

## Usage

WordPress Sail tries to match Laravel Sail as closely as possible. So you might:

```
vendor/bin/sail up -d
vendor/bin/sail down
vendor/bin/sail build --no-cache
vendor/bin/sail wp info
```

If you want to customize the Dockerfile used:

```
vendor/bin/wp sail:publish
```

After customizing your Sail installation, change the image name for the application container in your application's docker-compose.yml file so it doesn't conflict with other projects using the default Dockerfile.

## Starting on a project with Sail already installed

```
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/var/www/html \
    -w /var/www/html \
    laravelsail/php81-composer:latest \
    composer install --ignore-platform-reqs
```

When using the laravelsail/phpXX-composer image, you should use the same version of PHP that you're using for your application (74, 80, or 81).

## Official Documentation

WordPress Sail should be considered unstable and does not currently have docs. Documentation for Sail can be found on the [Laravel website](https://laravel.com/docs/sail).

## Contributing

Thank you for considering contributing to Sail! You can read the contribution guide [here](.github/CONTRIBUTING.md).

## License

Laravel Sail is open-sourced software licensed under the [MIT license](LICENSE.md).
