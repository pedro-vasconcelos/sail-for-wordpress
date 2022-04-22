<?php

use SternerStuff\WordPressSail\Console\InstallCommand;
use SternerStuff\WordPressSail\Console\PublishCommand;

if (defined('WP_CLI') && class_exists('WP_CLI', false)) {
	if (file_exists(__DIR__ . '/vendor/autoload.php')) {
		require_once __DIR__ . '/vendor/autoload.php';
	}

	WP_CLI::add_command('sail:install', InstallCommand::class);
	WP_CLI::add_command('sail:publish', PublishCommand::class);
}