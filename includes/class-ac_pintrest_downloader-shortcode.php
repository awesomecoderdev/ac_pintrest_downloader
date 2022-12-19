<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://awesomecoder.org/
 * @since      1.0.0
 *
 * @package    Ac_pintrest_downloader
 * @subpackage Ac_pintrest_downloader/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Ac_pintrest_downloader
 * @subpackage Ac_pintrest_downloader/admin
 * @author     Md. Ibrahim Kholil <awesomecoder.org@gmail.com>
 *                                                              _           
 *                                                             | |          
 *    __ ___      _____  ___  ___  _ __ ___   ___  ___ ___   __| | ___ _ __ 
 *   / _` \ \ /\ / / _ \/ __|/ _ \| '_ ` _ \ / _ \/ __/ _ \ / _` |/ _ \ '__|
 *  | (_| |\ V  V /  __/\__ \ (_) | | | | | |  __/ (_| (_) | (_| |  __/ |   
 *   \__,_| \_/\_/ \___||___/\___/|_| |_| |_|\___|\___\___/ \__,_|\___|_|   
 *
 */



class Asesomecoder_Pintrest_Shortcode
{

    /**
     *  It is the shortcode functions of the plugin
     * 
     *  By useing this shortcode user can show options on their
     * 	website, anywhere they want
     * 
     */


    public static function run()
    {
        function ac_pintrest_downloader_shortcode()
        {
            $output = "";
            $output .= '<div class="pinterest_container">';
            $output .= '<form action="javascript:void(0)" method="post" id="pinterest_form">';
            $output .= '<input type="text" name="url" id="pinterest_url" placeholder="https://www.pinterest.com/pin/368450813272492752/">';
            $output .= '<input type="submit" value="Download Now">';
            $output .= '</form>';
            $output .= '</div>';

            $output .= '<style>';
            $output .= '.pinterest_loader{
                background: url("' . AC_PINTREST_DOWNLOADER_PLUGIN_URL . "/assets/img/loader.gif" . '");
                height: 250px;
                max-width: 100% !important;
                background-size: contain;
                background-position: center center;
                background-repeat: no-repeat;
                display: none;
            }';
            $output .= '</style>';

            $output .= '<div id="pinterest_result">';
            $output .= '<div class="pinterest_loader">';
            $output .= '</div>';
            $output .= '</div>';




            return $output;
        };


        add_shortcode('ac_pintrest_downloader', 'ac_pintrest_downloader_shortcode');
    }
}
