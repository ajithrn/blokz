<?php 
/**
 * Wordpress Custom Utility functions to manipulate data
 *
 */

 /**
* enqueue theme style and js front end
*/
function blokz_frontend_scripts() {
  wp_enqueue_style(
    'blokz-css',
    get_stylesheet_directory_uri() . '/assets/css/main.css',
    array(), 
    '1.1', 
  );
  wp_enqueue_script(
    'blokz-js', 
    get_stylesheet_directory_uri() . '/assets/js/main.js',
    array(), 
    '1.1', 
  );
}
// add_action( 'wp_enqueue_scripts', 'blokz_frontend_scripts' );


/**
* Disable Wodpress Auto Scaling
*
*/
add_filter( 'big_image_size_threshold', '__return_false' );

/**
 * Check if its a events page/archive
 * @return boolean [description]
 */
function is_tribe_events()
{
  if (tribe_is_event() || tribe_is_month() || tribe_is_upcoming() || is_singular('tribe_events') || is_archive('tribe_events')) {
      return true;
  } else {
      return false;
  }
}

/**
 * ACF Map API
 */
function my_acf_init() {
  acf_update_setting('google_api_key', 'xxxxxxxxxxxxxxxxxxxxxxxxxx-XXX');
}
add_action('acf/init', 'my_acf_init');


/**
 * Check if its a woocommerce page/archive.
 *
 * @return bool [description]
 */
function is_woo_page()
{
  if (class_exists('WooCommerce') && (is_woocommerce() || is_cart() || is_checkout() || is_singular('product') || is_page('my-account'))) {
      return true;
  } else {
      return false;
  }
}

/**
 * Wistia OEmbed Support
*/
wp_oembed_add_provider('/https?:\/\/(.+)?(wistia.com|wi.st)\/(medias|embed)\/.*/', 'http://fast.wistia.com/oembed', true);

/**
 * inherit id finder
 */
function get_inherit_id()
{
  global $post;
  if (is_home() || is_archive()):
    $inh_id = 0; // blog page id / shop page id
  elseif (is_search()):
    $inh_id = 0; // blog page id
  elseif (is_tribe_events()):
    $inh_id = 0; // blog page id
  elseif (is_singular('post-type')):
    $inh_id = 0; // any post type parent page
  elseif (is_page() && $post->post_parent):
    $inh_id = $post->post_parent; 
  else:
    $inh_id = 'option';
  endif;
  return $inh_id;
}


/**
 * short_content generator
 * @param  string $mycontent content string
 * @param  string $after
 * @param  int $length
 * @return string
 */

function short_content($mycontent, $after = '', $length)
{
  $mycontent = strip_tags($mycontent); //stripout tags first

  if ($mycontent):
    $mycontent = strip_shortcodes($mycontent);
  $mycontent = explode(' ', $mycontent, $length); else: //if no specified content string, automatically fetch content according to post id
    $mycontent = strip_tags(get_the_content());
  $mycontent = explode(' ', $mycontent, $length);
  endif;

  if (count($mycontent)>=$length) :
    array_pop($mycontent);
  $mycontent = implode(' ', $mycontent). $after; else:
    $mycontent = implode(' ', $mycontent);
  endif;

  return $mycontent;
}