<?php
/*
Plugin Name: KMS Option Page
Plugin URI: http://www.kwirx.com/
Description: Custom options panel to manage logos, slider and default stuffs.
Version: 1.0.0
Author: Kwirx
Author URI: http://www.kwirx.com/
Copyright: Kwirx
Text Domain: kms-mod

*/

/**
 * Include Custom fields for options page
 */
/**
* Declare the main options page
*/

if (function_exists('acf_add_options_page')) {
    $settings_page = acf_add_options_page(array(
    'page_title'    => 'Site Settings : General',
    'menu_title'    => 'Site Settings',
    'menu_slug'     => 'site-settings',
    'capability'    => 'edit_posts',
    'icon_url'      => 'dashicons-desktop',
    'position'      =>  '1.1',
    'redirect'  => false
  ));

  acf_add_options_sub_page(array(
    'page_title'    => 'Site Settings : Home Page',
    'menu_title'    => 'Home Page',
    'menu_slug'     => 'site-settings-home',
    'parent_slug'   => 'site-settings',
  ));

  // acf_add_options_sub_page(array(
  //   'page_title'    => 'Site Settings : Events',
  //   'menu_title'    => 'Events Settings',
  //   'menu_slug'     => 'site-settings-events',
  //   'parent_slug'   => 'site-settings',
  // ));

  // acf_add_options_sub_page(array(
  //   'page_title'    => 'Site Settings : Header',
  //   'menu_title'    => 'Header Settings',
  //   'menu_slug'     => 'site-settings-header',
  //   'parent_slug'   => 'site-settings',
  // ));

  // acf_add_options_sub_page(array(
  //   'page_title'    => 'Site Settings : Footer',
  //   'menu_title'    => 'Footer Settings',
  //   'menu_slug'     => 'site-settings-footer',
  //   'parent_slug'   => 'site-settings',
  // ));

  // acf_add_options_sub_page(array(
  //   'page_title'    => 'Site Settings : Woocommerce Settings',
  //   'menu_title'    => 'Woocommerce Settings',
  //   'menu_slug'     => 'site-settings-woocommerce',
  //   'parent_slug'   => 'site-settings',
  // ));
}
