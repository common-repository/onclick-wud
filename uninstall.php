<?php
 /*
 * === OnClick WUD ===
 * Contributors: wistudatbe
 * Author: Danny WUD
 */
if ( !defined( 'WP_UNINSTALL_PLUGIN' ) ) { 
exit(); 
} 
// Clean up the options table delete data starts with 'onclick_wud_'
global $wpdb;
	$wpdb->query( "DELETE FROM {$wpdb->options} WHERE LEFT(option_name, 12) = 'onclick_wud_'" );
?>
