<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://awesomecoderdev.github.io/
 * @since             1.0.0
 * @package           Ac_pintrest_downloader
 *
 * @wordpress-plugin
 * Plugin Name:       Pinterest  Video Downloader
 * Plugin URI:        https://awesomecoder.dev/
 * Description:       This is a custom plugin, You can use it for give access to user to download Pinterest Video :)
 * Version:           1.0.1
 * Author:            Mohammad Ibrahim
 * Author URI:        https://awesomecoder.dev/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       ac_pintrest_downloader
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define('AC_PINTREST_DOWNLOADER_VERSION', '1.0.0');
define('AC_PINTREST_DOWNLOADER_PLUGIN_URL', plugin_dir_url(__FILE__));
define('AC_PINTREST_DOWNLOADER_PLUGIN_PATH', plugin_dir_path(__FILE__));
define('AC_PINTREST_DOWNLOADER_BLOG_URL', get_bloginfo('url'));

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-ac_pintrest_downloader-activator.php
 */
function activate_ac_pintrest_downloader()
{
	require_once plugin_dir_path(__FILE__) . 'includes/class-ac_pintrest_downloader-activator.php';
	Ac_pintrest_downloader_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-ac_pintrest_downloader-deactivator.php
 */
function deactivate_ac_pintrest_downloader()
{
	require_once plugin_dir_path(__FILE__) . 'includes/class-ac_pintrest_downloader-deactivator.php';
	Ac_pintrest_downloader_Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'activate_ac_pintrest_downloader');
register_deactivation_hook(__FILE__, 'deactivate_ac_pintrest_downloader');

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path(__FILE__) . 'includes/class-ac_pintrest_downloader.php';


/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_ac_pintrest_downloader()
{

	$plugin = new Ac_pintrest_downloader();
	$plugin->run();
}
run_ac_pintrest_downloader();
