<?php
/**
 * @package w_a_p_l
 * @version 1.6
 */
/*
Plugin Name: Woocommerce Advanced Product Layout
Plugin URI: #
Description: Discription goes here
Version: 1.0
Author URI: #
*/


define(WOOURL, plugins_url('/woocommerce-advanced-product/'));
define(WOOASSETS, plugins_url('/woocommerce-advanced-product/assets/'));

// Shortcode
require_once 'shortcode.php';

// add scripts and stylesheet into admin page
if( isset($_GET['page']) ) {
	if($_GET['page']=='settingPage') {
		add_action('admin_enqueue_scripts', 'woo_admin_enqueue' );
	}
}
function woo_admin_enqueue() {
	// wp_register_script('woo_js', WOOURL . 'css', array(), '1.0' );
	wp_register_style('Woobootrap', WOOASSETS . 'css/ui-bootstrap.css', false, '1.0');
}




function dolly_css() {
echo "
<style type='text/css'>
.woo_fieldset {border: 1px solid #ebebeb;padding: 5px 20px;background: #fff;margin-bottom: 40px;-webkit-box-shadow: 4px 4px 10px 0px rgba(50, 50, 50, 0.1);-moz-box-shadow: 4px 4px 10px 0px rgba(50, 50, 50, 0.1);box-shadow: 4px 4px 10px 0px rgba(50, 50, 50, 0.1);}
.woo_fieldset .sec-title {border: 1px solid #ebebeb;background: #fff;color: #d54e21;padding: 2px 4px;}
</style>";
}
add_action( 'admin_head', 'dolly_css' );



add_action( 'admin_init', 'woo_register_woo_settings' );
function woo_register_woo_settings() {
	register_setting( 'woo-settings-group', 'text-count' );
	register_setting( 'woo-settings-group', 'popupbtn' );
	register_setting( 'woo-settings-group', 'productcolm' );
}

add_action( 'admin_init', 'woo_pop_register_woo_settings' );
function woo_pop_register_woo_settings() {
	register_setting( 'woo-pop-up-settings-group', 'woo-popup' );
}





function woocommerce_shortcode_popup() {
//add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position );
add_menu_page('Woocommerce Advanced Product Setting', 'Woocommerce Advanced Product', 'manage_options', 'settingPage', 'settingPage', 'dashicons-screenoptions' );
// add_menu_page('Easy Social Icons', 'Easy Social Icons', 'manage_options', 'woo_social_icon_page', 'woo_social_icon_page_fn', 'dashicons-share' );

}
add_action('admin_menu', 'woocommerce_shortcode_popup');

function settingPage($value='')
{
	require_once 'pages/settingpage.php';
}


function woo_get_option($key='') {
	if ($key == '') {
		return;
	}
	$woo_settings = array(
		'text-count' => 75,
		'productcolm' => 'col-md-6',
		'popupbtn' => '[...]',
		'woo-popup' => 'red'
	);
	if ( get_option($key) != '' ) {
		return get_option($key);
	} else {
		return $woo_settings[$key];
	}
}


add_filter( 'intermediate_image_sizes_advanced','woo_set_thumbnail_size_by_post_type', 10);
function woo_set_thumbnail_size_by_post_type( $sizes ) {
    $post_type = get_post_type($_REQUEST['post_id']);
    switch ($post_type) :
        case 'product' :
            $sizes['woothumb'] = array( 
                'width' => 150,
                'height' => 90,
                'crop' => true
            );    
        break;
    endswitch;
    return $sizes;
}
?>