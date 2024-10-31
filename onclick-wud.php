<?php
/*
=== OnClick WUD ===
Contributors: wistudat.be
Plugin Name: OnClick WUD
Donate Reason: Stand together to help those in need!
Donate link: https://www.icrc.org/eng/donations/
Description: Enable OnClick events in Posts and Pages with Customizable Buttons or URL's
Author: Danny WUD
Author URI: http://wud-plugins.com
Plugin URI: http://wud-plugins.com
Tags: OnClick, popup, pop up, pop-up, java, JavaScript, jquery, onclick, button, buttons,, popups, pop ups, pop-ups, href, url, link
Requires at least: 3.6
Tested up to: 4.6
Stable tag: 1.1.1
Version: 1.1.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Text Domain: onclick-wud
Domain Path: /languages
*/
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
//==============================================================================//
$version ='1.1.1';
if (get_option('onclick_wud_version')!=$version) {update_option('onclick_wud_version', $version);}
//==============================================================================//
	define( 'onclick_WUD_DIR', plugin_dir_path( __FILE__ ) );
	define( 'onclick_onclick_URL', plugin_dir_url( __FILE__ ) );
	add_shortcode('jqwud', 'jquery_wud');
	add_action('plugins_loaded', 'onclick_wud_languages');
	add_action( 'plugins_loaded', 'onclick_wud_base' );
	add_action( 'wp_enqueue_scripts', 'onclick_wud_styles' );
	add_action('admin_enqueue_scripts', 'onclick_wud_style_more');
	add_action( 'plugins_loaded', 'onclick_wud_admin' );
	add_action('admin_menu', 'onclick_wud_submenu_page');
	add_filter( 'plugin_action_links', 'onclick_wud_action_links', 10, 5 );
	add_action( 'init', 'onclick_wud_funcs' );
	add_action( 'init', 'onclick_wud_update' );
	register_activation_hook( __FILE__, 'onclick_wud_activate' );
	
// OnClick-wud languages
function onclick_wud_languages() {
	load_plugin_textdomain( 'onclick-wud', false, dirname(plugin_basename( __FILE__ ) ) . '/languages' );
	}

// OnClick-wud Styles
function onclick_wud_styles() {
	//CSS for Mobile devices
	wp_register_style( 'onclick_wud_basic', plugins_url('css/onclick-wud.css', __FILE__ ), false, '1.0.0' );
	wp_enqueue_style( 'onclick_wud_basic' );
	wp_register_style( 'onclick_wud_fonts', plugins_url('css/icon-wud.css', __FILE__ ), false, '1.0.0' );
	wp_enqueue_style( 'onclick_wud_fonts' );
	wp_register_style( 'onclick_wud_animate', plugins_url('css/animate.css', __FILE__ ), false, '1.0.0' );
	wp_enqueue_style( 'onclick_wud_animate' );	
	// Javascript to test OnClick.
	wp_enqueue_script('jquery');
	wp_enqueue_script( 'onclick_wud_scroll', plugins_url( 'js/scrollwud.js', __FILE__ ), array('jquery'), '1.0', true );
	
	wp_enqueue_script('onclick_wud_scroll');	
	wp_register_script( 'onclick_wud_script', plugins_url( 'js/java-test.js', __FILE__ ) , '', '', true );
	wp_enqueue_script('onclick_wud_script');	
	wp_register_script( 'onclick_wud_script_cone', plugins_url( 'js/custom/custom-java-01.js', __FILE__ ) , '', '', true );
	wp_enqueue_script('onclick_wud_script_cone');
	wp_register_script( 'onclick_wud_script_ctwo', plugins_url( 'js/custom/custom-java-02.js', __FILE__ ) , '', '', true );
	wp_enqueue_script('onclick_wud_script_ctwo');
	wp_register_script( 'onclick_wud_script_cthree', plugins_url( 'js/custom/custom-java-03.js', __FILE__ ) , '', '', true );
	wp_enqueue_script('onclick_wud_script_cthree');		
	}

//Load extra Admin page  
function onclick_wud_admin() {
	require_once( onclick_WUD_DIR . '/pages/onclick-wud-admin.php' );
	}
//Load main page	
	function onclick_wud_base() {require_once( onclick_WUD_DIR . '/pages/onclick-wud-base.php' );}
	
// Color picker and media uploader for admin
function onclick_wud_style_more($hook) {
	if   ( $hook == "toplevel_page_onclick-wud" ) {
		wp_enqueue_style( 'wp-color-picker' ); 
		wp_enqueue_style( 'cs-wp-color-picker', plugins_url( 'css/cs-wp-color-picker.css', __FILE__ ), array( 'wp-color-picker' ), '1.0.1', 'all' );
		wp_enqueue_style( 'onclick_wud_style' );
		wp_enqueue_style( 'onclick_wud_style', plugins_url('css/admin.css', __FILE__ ), false, '1.0.3' );
		wp_enqueue_script( 'wp-color-picker' );
		wp_enqueue_script( 'cs-wp-color-picker', plugins_url( 'js/cs-wp-color-picker.js', __FILE__ ), array( 'wp-color-picker' ), '1.0.1', true );	
		wp_enqueue_media();	
		wp_register_script( 'onclick_wud_script_sample', plugins_url( 'js/java-sample.js', __FILE__ ) , '', '', true );
		wp_enqueue_script('onclick_wud_script_sample');	
     }
	}

	// OnClick-wud options page (settings menu option)
function onclick_wud_submenu_page() {
		add_menu_page( 'OnClick WUD', 'OnClick WUD', 'manage_options', 'onclick-wud', 'onclick_wud_options_notice', plugins_url('images/wud_icon.png', __FILE__ ) );
	}

// OnClick-wud options page (menu options by plugins)
function onclick_wud_action_links( $actions, $onclick_wud_set ) 
	{
		static $plugin;
		if (!isset($plugin))
			$plugin = plugin_basename(__FILE__);
		if ($plugin == $onclick_wud_set) {
				$settings_page = array('settings' => '<a href="options-general.php?page=onclick-wud">' . __('Settings', 'General') . '</a>');
				$support_link = array('support' => '<a href="https://wordpress.org/support/plugin/onclick-wud" target="_blank">Support</a>');				
					$actions = array_merge($support_link, $actions);
					$actions = array_merge($settings_page, $actions);
			}			
			return $actions;
	}

		

//Declare once all OnClick WUD settings 	
function onclick_wud_funcs(){
		//Set it global
		global $jqwfuncs;
		//Remember the settings (output=$jqwfuncs['onclick_wud_but_color'];)
		$jqwfuncs = array(
			'onclick_wud_but_bcolor' => get_option('onclick_wud_but_bcolor'),
			'onclick_wud_but_fcolor' => get_option('onclick_wud_but_fcolor'),
			'onclick_wud_but_font_size' => get_option('onclick_wud_but_font_size'),
			'onclick_wud_round_button' => get_option('onclick_wud_round_button'),
			'onclick_wud_font_button' => get_option('onclick_wud_font_button'),
			'onclick_wud_border_size' => get_option('onclick_wud_border_size'),
			'onclick_wud_border_color' => get_option('onclick_wud_border_color'),
			'onclick_wud_hover_bcolor' => get_option('onclick_wud_hover_bcolor'),
			'onclick_wud_version' => get_option('onclick_wud_version'),
			'onclick_wud_padding' => get_option('onclick_wud_padding'),
			'onclick_wud_animate' => get_option('onclick_wud_animate'),
			'onclick_wud_animate_speed' => get_option('onclick_wud_animate_speed')
			);
			return $jqwfuncs;
	}	

//Standard values only inserted on activation.
function onclick_wud_activate() {		
		if (get_option('onclick_wud_but_bcolor')=='') {update_option('onclick_wud_but_bcolor', '#e81e00');}
		if (get_option('onclick_wud_but_fcolor')=='') {update_option('onclick_wud_but_fcolor', '#ffffff');}
		if (get_option('onclick_wud_but_font_size')=='') {update_option('onclick_wud_but_font_size', '1.4');}
		if (get_option('onclick_wud_round_button')=='') {update_option('onclick_wud_round_button', 10);}
		if (get_option('onclick_wud_border_size')=='') {update_option('onclick_wud_border_size', 3);}
		if (get_option('onclick_wud_border_color')=='') {update_option('onclick_wud_border_color', '#878787');}
		if (get_option('onclick_wud_hover_bcolor')=='') {update_option('onclick_wud_hover_bcolor', '#666666');}
		if (get_option('onclick_wud_font_button')=='') {update_option('onclick_wud_font_button', 'inherit');}
		if (get_option('onclick_wud_padding')=='') {update_option('onclick_wud_padding', '1.4');}
		if (get_option('onclick_wud_animate')=='') {update_option('onclick_wud_animate', 'zoomIn');}
		if (get_option('onclick_wud_animate_speed')=='') {update_option('onclick_wud_animate_speed', 'animDelay04');}
	}

// New fields
function onclick_wud_update(){
		if (get_option('onclick_wud_padding')=='') {update_option('onclick_wud_padding', '1.5');}
		if (get_option('onclick_wud_animate')=='') {update_option('onclick_wud_animate', 'zoomIn');}
		if (get_option('onclick_wud_animate_speed')=='') {update_option('onclick_wud_animate_speed', 'animDelay04');}
	}

// Return animation string
function animated_icon($number){
		if($number==0){$ani='NULL';}
	elseif($number==1){$ani='bounce';}
	elseif($number==2){$ani='flash';}
	elseif($number==3){$ani='pulse';}
	elseif($number==4){$ani='rubberBand';}
	elseif($number==5){$ani='shake';}
	elseif($number==6){$ani='swing';}
	elseif($number==7){$ani='tada';}
	elseif($number==8){$ani='wobble';}
	elseif($number==9){$ani='bounceIn';}
	elseif($number==10){$ani='bounceInDown';}
	elseif($number==11){$ani='bounceInLeft';}
	elseif($number==12){$ani='bounceInRight';}
	elseif($number==13){$ani='bounceInUp';}
	elseif($number==14){$ani='fadeIn';}
	elseif($number==15){$ani='fadeInDown';}
	elseif($number==16){$ani='fadeInDownBig';}
	elseif($number==17){$ani='fadeInLeft';}
	elseif($number==18){$ani='fadeInLeftBig';}
	elseif($number==19){$ani='fadeInRight';}
	elseif($number==20){$ani='fadeInRightBig';}
	elseif($number==21){$ani='fadeInUp';}
	elseif($number==22){$ani='fadeInUpBig';}
	elseif($number==23){$ani='animated.flip';}
	elseif($number==24){$ani='flipInX';}
	elseif($number==25){$ani='flipInY';}
	elseif($number==26){$ani='lightSpeedIn';}
	elseif($number==27){$ani='rotateIn';}
	elseif($number==28){$ani='rotateInDownLeft';}
	elseif($number==29){$ani='rotateInDownRight';}
	elseif($number==30){$ani='rotateInUpLeft';}
	elseif($number==31){$ani='rotateInUpRight';}
	elseif($number==32){$ani='hinge';}
	elseif($number==33){$ani='rollIn';}
	elseif($number==34){$ani='zoomIn';}
	elseif($number==35){$ani='zoomInDown';}
	elseif($number==36){$ani='zoomInLeft';}
	elseif($number==37){$ani='zoomInRight';}
	elseif($number==38){$ani='zoomInUp';}
	elseif($number==39){$ani='slideInDown';}
	elseif($number==40){$ani='slideInLeft';}
	elseif($number==41){$ani='slideInRight';}
	elseif($number==42){$ani='slideInUp';}
	return($ani);
	}

function animation_speed($number){
		if($number==0){$speed='animDelay00';}
	elseif($number==1){$speed='animDelay01';}
	elseif($number==2){$speed='animDelay02';}
	elseif($number==3){$speed='animDelay03';}
	elseif($number==4){$speed='animDelay04';}
	elseif($number==5){$speed='animDelay05';}
	elseif($number==6){$speed='animDelay06';}
	elseif($number==7){$speed='animDelay07';}
	elseif($number==8){$speed='animDelay08';}
	return($speed);
	}			
?>
