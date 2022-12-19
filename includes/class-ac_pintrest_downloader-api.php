<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://awesomecoder.org/
 * @since      1.0.0
 *
 * @package    Ac_pintrest_downloader
 * @subpackage Ac_pintrest_downloader/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Ac_pintrest_downloader
 * @subpackage Ac_pintrest_downloader/includes
 * @author     Md. Ibrahim Kholil <awesomecoder.org@gmail.com>

 *
 *                                                            _           
 *                                                           | |          
 *  __ ___      _____  ___  ___  _ __ ___   ___  ___ ___   __| | ___ _ __ 
 * / _` \ \ /\ / / _ \/ __|/ _ \| '_ ` _ \ / _ \/ __/ _ \ / _` |/ _ \ '__|
 *| (_| |\ V  V /  __/\__ \ (_) | | | | | |  __/ (_| (_) | (_| |  __/ |   
 * \__,_| \_/\_/ \___||___/\___/|_| |_| |_|\___|\___\___/ \__,_|\___|_|   
 * 
 */

/**
 * The class responsible for defining all actions that occur in the api area.
 */


function awesomecoder_pintrest_api($request)
{
	// $url = "https://www.pinterest.com/pin/511017888973448583/";
	$url = $request["url"];

	$file_url = file_get_contents("https://pinterest-video-api.herokuapp.com/$url");

	$file_url = str_replace('"', '', $file_url);
	// print_r($file_url);

	return array(
		"success" 	=> true,
		"url"		=> $file_url,
	);
}


add_action('rest_api_init', function () {
	register_rest_route('awesomecoder/', 'pintrest/', array(
		'methods' => 'POST',
		'callback' => 'awesomecoder_pintrest_api',
	));
});
