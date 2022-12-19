<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://awesomecoder.org/
 * @since      1.0.0
 *
 * @package    Ac_pintrest_downloader
 * @subpackage Ac_pintrest_downloader/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Ac_pintrest_downloader
 * @subpackage Ac_pintrest_downloader/includes
 * @author     Md. Ibrahim Kholil <awesomecoder.org@gmail.com>
 */
class Ac_pintrest_downloader_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'ac_pintrest_downloader',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
