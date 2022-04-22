<?php

namespace SternerStuff\WordPressSail\Console;

use Illuminate\Console\Command;

class PublishCommand extends Command
{
    /**
     * Publish the WordPress Sail Docker files
     *
     * ## EXAMPLES
     *
     *     wp sail:publish
     *
     */
    public function __invoke( $args, $assoc_args )
    {
        $from = __DIR__ . '/../runtimes';
        $to = WP_CLI\Utils\get_home_dir() . '/.docker';
        `cp -r $from $to`;

        file_put_contents(
            WP_CLI\Utils\get_home_dir() . '/docker-compose.yml',
            str_replace(
                [
                    './vendor/sterner-stuff/wordpress-sail/runtimes/8.1',
                    './vendor/sterner-stuff/wordpress-sail/runtimes/8.0',
                    './vendor/sterner-stuff/wordpress-sail/runtimes/7.4',
                ],
                [
                    './docker/8.1',
                    './docker/8.0',
                    './docker/7.4',
                ],
                file_get_contents(WP_CLI\Utils\get_home_dir() . '/docker-compose.yml')
            )
        );
    }
}
