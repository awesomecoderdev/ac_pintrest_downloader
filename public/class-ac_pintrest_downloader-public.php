<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://awesomecoders.org/
 * @since      1.0.0
 *
 * @package    Ac_pintrest_downloader
 * @subpackage Ac_pintrest_downloader/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Ac_pintrest_downloader
 * @subpackage Ac_pintrest_downloader/public
 * @author     Md. Ibrahim Kholil <awesomecoder.org@gmail.com>
 */
class Ac_pintrest_downloader_Public
{

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct($plugin_name, $version)
	{

		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles()
	{

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Ac_pintrest_downloader_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Ac_pintrest_downloader_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/ac_pintrest_downloader-public.css', array(), $this->version, 'all');
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts()
	{

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Ac_pintrest_downloader_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Ac_pintrest_downloader_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		wp_enqueue_script($this->plugin_name . '-jQuery', AC_PINTREST_DOWNLOADER_PLUGIN_URL . 'assets/js/jquery.js', array('jquery'), '3.5.1', false);
		wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/ac_pintrest_downloader-public.js', array('jquery'), $this->version, false);

		// Some local vairable to get ajax url
		wp_localize_script($this->plugin_name, 'ac_pintrest_downloader', array(
			"name"	=> "awesomeCoder",
			"author" =>	"MD Ibrahim Kholil",
			"url" => get_bloginfo('url'),
			"ajaxurl"	=> admin_url("admin-ajax.php")
		));
	}



	public function handel_ac_pintrest_downloader_public_ajax_requests()
	{
		$printrest_url = trim($_REQUEST["url"]);

		$url = "https://www.expertstrick.com/download.php";
		$response = wp_remote_request(
			$url,
			array(
				'method'      => 'POST',
				'timeout'     => 45,
				'redirection' => 5,
				'httpversion' => '1.0',
				'blocking'    => true,
				'headers'     => array(),
				'body'        => array(
					'url' =>    $printrest_url,
				),
				'cookies'     => array()
			)
		);
		
		if (is_wp_error($response)) {
			$error_message = $response->get_error_message();
			// echo "Something went wrong: $error_message";
			$output = array(
				"success"     => false,
			);
			echo json_encode(
				$output,
				JSON_PRETTY_PRINT
			);
		} else {
			$response =  wp_remote_retrieve_body($response);
			
			$array = array();
			preg_match('/source src=\"([^\"]*)\" type=\"video\/mp4\">/i',  $response, $array);
			if(empty($array))
			{
			   preg_match('/<video.*?src="(.*?)"/',  $response, $array);
			}
		//preg_match('/<video.*?src="(.*?)"/',  $response, $array);
			if (empty($array)) {
				$url = "https://www.expertstrick.com/download.php";
				$response = wp_remote_request(
					$url,
					array(
						'method'      => 'POST',
						'timeout'     => 45,
						'redirection' => 5,
						'httpversion' => '1.0',
						'blocking'    => true,
						'headers'     => array(),
						'body'        => array(
							'url' =>    $printrest_url,
						),
						'cookies'     => array()
					)
				);
				if (is_wp_error($response)) {
					$error_message = $response->get_error_message();
					// echo "Something went wrong: $error_message";
					$output = array(
						"success"     => false,
					);
					echo json_encode(
						$output,
						JSON_PRETTY_PRINT
					);
				} else {
					$response =  wp_remote_retrieve_body($response);
					
					$url = "";
					$reImg = '/"(https:[^"]+gif)"/';
					if (preg_match_all($reImg, $response, $match, PREG_PATTERN_ORDER)) {
						$url .= str_replace('"', "", $match[0][0]);
					}

					if (empty($url)) {
						$reImg = '/"(https:[^"]+jpeg)"/';
						if (preg_match_all($reImg, $response, $match, PREG_PATTERN_ORDER)) {
							$url .= str_replace('"', "", $match[0][0]);
						}
					}

					if (empty($url)) {
						$reImg = '/"(https:[^"]+jpg)"/';
						if (preg_match_all($reImg, $response, $match, PREG_PATTERN_ORDER)) {
							$url .= str_replace('"', "", $match[0][0]);
						}
					}


					$output = array(
						"success"     => true,
						"type"     => "gif",
						"url"        => $url,
					);
					echo json_encode(
						$output,
						JSON_PRETTY_PRINT
					);
				}
			} else {
				$response_urls = $array[1];
				$output = array(
					"success"     => true,
					"type"     => "video",
					"url"        => $response_urls,
				);
				echo json_encode(
					$output,
					JSON_PRETTY_PRINT
				);
			}
		}

		// end ajax
		wp_die();
	}
}
