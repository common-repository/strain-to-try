<?php

/*
 *
 * @package StrainToTry
 * @version 1
 *
 */

/*
Plugin Name: Strain to try
Plugin URI:  
Description: This diplays a random medical marijuana strain to try in the footer.
Author: DankLife.us
Version: 1
Author URI: http://danklife.us
Licence: GPL2
*/

function getData($url){
    $ch=curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
    $returned = curl_exec ($ch);
    curl_close ($ch);
    return $returned;
}

function selectStrain(){
	$url = plugins_url('/strain.txt',__FILE__);
	$list = getData($url);
	$list = explode("\n",$list);
	return wptexturize( $list[ mt_rand( 0, count( $list ) - 1 ) ] );
}

function STT() {
	$chosen = selectStrain();
	echo "<div class='footer-width' style='padding-bottom:5px;'><strong>Strain to try:</strong> <u>$chosen</u></div>";
}

add_action( 'wp_footer', 'STT' );

?>
