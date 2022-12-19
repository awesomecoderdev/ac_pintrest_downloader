<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://awesomecoder.org/
 * @since      1.0.0
 *
 * @package    Ac_pintrest_downloader
 * @subpackage Ac_pintrest_downloader/admin/partials
 */

// $url = "https://www.pinterest.com/pin/51101788/";
// $file_url = file_get_contents("https://pinterest-video-api.herokuapp.com/$url");
// $file_url = str_replace('"', '', $file_url);
// print_r($file_url);

// $url = "https://www.expertstrick.com/pinterest-video-downloader/";



// $printrest_url = "https://www.pinterest.com/pin/806285139530982383/";

// $file_url = "https://pinterest-video-api.herokuapp.com/$printrest_url";

// $response = wp_remote_request(
//     $file_url,
//     array(
//         'method'      => 'GET',
//         'timeout'     => 45,
//         'redirection' => 5,
//         'httpversion' => '1.0',
//         'blocking'    => true,
//         'headers'     => array(),
//         'body'        => array(),
//         'cookies'     => array()
//     )
// );

// if (is_wp_error($response)) {
//     $error_message = $response->get_error_message();
//     echo "Something went wrong: $error_message";
// } else {
//     $response =  wp_remote_retrieve_body($response);
//     echo $response;
// }


// // $url = get_bloginfo("url") . "/wp-json/awesomecoder/pintrest";
// // echo $url;
// // echo "<br>";
// // $url = "http://localhost/wordpress/wp-json/awesomecoder/pintrest";
// // echo $url;




// $url = "https://www.expertstrick.com/pinterest-video-downloader/";

// $response = wp_remote_request(
//     $url,
//     array(
//         'method'      => 'POST',
//         'timeout'     => 45,
//         'redirection' => 5,
//         'httpversion' => '1.0',
//         'blocking'    => true,
//         'headers'     => array(),
//         'body'        => array(
//             "url"   => "https://www.pinterest.com/pin/10203536642141488/"
//             // 'url' =>    $printrest_url,
//         ),
//         'cookies'     => array()
//     )
// );

// if (is_wp_error($response)) {
//     $error_message = $response->get_error_message();
//     // echo "Something went wrong: $error_message";
//     $output = array(
//         "success"     => false,
//     );
//     echo json_encode(
//         $output,
//         JSON_PRETTY_PRINT
//     );
// } else {
//     $response =  wp_remote_retrieve_body($response);
//     $reImg = '/"(https:[^"]+gif)"/';
//     if (preg_match_all($reImg, $response, $match, PREG_PATTERN_ORDER)) {

//         $gif = str_replace('"', "", $match[0][0]);
//         echo "<img src='" . $gif . "' >";

//         $output = array(
//             "success"     => true,
//             "url"        => $gif,
//         );
//         echo json_encode(
//             $output,
//             JSON_PRETTY_PRINT
//         );
//     }
// }


$printrest_url = 'https://www.pinterest.com/pin/612982199267828105/';
// $printrest_url = 'https://pin.it/3qeOsUh';
$printrest_url = "https://www.pinterest.com/pin/2744449763039023/";
// $printrest_url = trim($_REQUEST["url"]);

$url = "https://www.expertstrick.com/pinterest-video-downloader/";
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
    preg_match("/source src=\"([^\"]*)\" type=\"video\/mp4\">/i",  $response, $array);
    if (empty($array)) {
        $url = "https://www.expertstrick.com/pinterest-video-downloader/";
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

            // if (empty($url)) {
            //     $reImg = '/"(https:[^"]+png)"/';
            //     if (preg_match_all($reImg, $response, $match, PREG_PATTERN_ORDER)) {
            //         $url .= str_replace('"', "", $match[0][0]);
            //     }
            // }

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
