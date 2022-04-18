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

/**
 * Function to return acf field data. 
 *
 * @param [acf_field_name] $var
 * @return array
 * */
function blokz_acf_meta ( $var, $type = '' ) {
  $post_id = ($type == 'options') ? 'options' : blokz_get_post_id();
  $acf_object = get_field_object($var, $post_id);
  $acf_data = get_field($var, $post_id);  
  if ($acf_object['type'] == 'image') {
    return $acf_data['url'];
  } else {
    return $acf_data;
  }
}

/**
 * Function to return acf repeater field data. 
 *
 * @param [acf_field_name] $var
 * @return array
 * */
function blokz_acf_repeater_meta ( $field, $sub_field, $row, $type = '' ) {
  $post_id = ($type == 'options') ? 'options' : blokz_get_post_id();
  $acf_data = get_field($field, $post_id);  
  return $acf_data[$row][$sub_field];
}

/**
 * Function to return acf group field data. 
 *
 * @param [acf_field_name] $var
 * @return array
 * */
function blokz_acf_group_meta ( $field, $sub_field, $type = '' ) {
  $post_id = ($type == 'options') ? 'options' : blokz_get_post_id();
  $acf_data = get_field($field, $post_id);  
  return $acf_data[$sub_field];
}

/**
 * Page and Post Header section Code
 *
 * @return void
 */
function blokz_page_header() {

  $post_id  = blokz_get_post_id();
  $inh_id   = get_inherit_id();

  $type = get_field('hf_type', $post_id);

  switch ($type) {    
    case 'image':
      image:
      $_image = (get_field('hf_image', $post_id)) ? get_field('hf_image', $post_id) : get_field('hf_image', $inh_id);
      return  '<img src="'.$_image.'" alt="" class="full-width-image">';
    case 'slider':
      slider:
      $_slider = (get_field('hf_slider', $post_id)) ? get_field('hf_slider', $post_id) : get_field('hf_slider', $inh_id);
      return  $_slider;    
    case 'none':
      none:
      break;
    default:
      $default_type = get_field('hf_type', $inh_id );
      if ($default_type == 'image')  {
        goto image;
      } elseif ($default_type == 'slider') {
        goto slider;
      } else {
        goto none;
      }
    break;
  }
}