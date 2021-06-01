<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://www.neilarnold.com
 * @since             1.0.0
 * @package           Colby_Clubs
 *
 * @wordpress-plugin
 * Plugin Name:       Colby - Clubs
 * Plugin URI:        https://www.neilarnold.com
 * Description:       All front-end & back-end functionality for the Clubs @ Colby.
 * Version:           1.0.0
 * Author:            Neil P. Arnold
 * Author URI:        https://www.neilarnold.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       colby-clubs
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'COLBY_CLUBS_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-colby-clubs-activator.php
 */
function activate_colby_clubs() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-colby-clubs-activator.php';
	Colby_Clubs_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-colby-clubs-deactivator.php
 */
function deactivate_colby_clubs() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-colby-clubs-deactivator.php';
	Colby_Clubs_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_colby_clubs' );
register_deactivation_hook( __FILE__, 'deactivate_colby_clubs' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-colby-clubs.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_colby_clubs() {

	$plugin = new Colby_Clubs();
	$plugin->run();

}
run_colby_clubs();
