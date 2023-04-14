<?php 
/**
 * 
 * Global Custom snippets to provide dynamic date for bricks
 * 
 */
/**
 * Get Post ID in Blocks
 *
 * @return void
 */
function blokz_get_post_id() {
	if (is_admin()) :    
		return $_GET['post'];
	else :
		global $post;
		return $post->ID;
	endif;
}

/**
 * Get Post type
 *
 * @return void
 */
function blokz_get_post_type() {
	global $post;
  $post_type = get_post_type($post);
  $post_type_obj = get_post_type_object($post_type);
  return $post_type_obj->labels->singular_name;
}

/**
 * Get blokz file path url for block reg
 *
 * @return void
 */
function blokz_block_url() {
	return get_stylesheet_directory_uri() . '/blokz-blocks';
}
