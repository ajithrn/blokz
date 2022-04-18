<?php 
/**
 * getting user id from urn
 *
 * @return int
 */
function user_id () {
  $usr_obj = (get_query_var('author_name')) ? get_user_by('slug', get_query_var('author_name')) : get_userdata(get_query_var('author')); // getting user id
  $usr_id = 'user_'.$usr_obj->ID; //prepare user id for acf custom fields
  return $usr_id;
}
/**
 * Return User Email
 *
 * @return void
 */
function user_email () {
  $usr_obj = (get_query_var('author_name')) ? get_user_by('slug', get_query_var('author_name')) : get_userdata(get_query_var('author')); // getting user id
  return $usr_obj->user_email;
}

/**
 * Function to return user address embed. 
 *
 * @param [acf_field_name] $var
 * @return array
 * */
function user_address_map () {
  $usr_id = user_id ();
  $_mapObj = get_field('mpd_location', $usr_id );
  return '<iframe width="100%" height="520px" frameBorder="0" src="https://maps.google.com/maps?q='.str_replace(" ", "+", $_mapObj["address"]).'&loc:'.$_mapObj["lat"].'+'.$_mapObj["lng"].'&z=12&output=embed"></iframe>';
}

/**
 * Function to return acf field data. 
 *
 * @param [acf_field_name] $var
 * @return array
 * */
function user_acf_meta ( $var ) {
  $usr_id = user_id ();
  $acf_object = get_field_object($var, $usr_id);
  $acf_data = get_field($var, $usr_id);  
  if ($acf_object['type'] == 'image') {
    return $acf_data['url'];
  } else {
    return $acf_data;
  }
}

/**
 * Function to return ministry address. 
 *
 * @param [acf_field_name] $var
 * @return array
 * */
function user_address () {
  $usr_id = user_id ();
  $_min_add1 = get_field('mpd_address', $usr_id);
  $_min_add2 = get_field('mpd_address_2', $usr_id);
  $_min_city = get_field('mpd_ministry_city', $usr_id);
  $_min_state = get_field('mpd_ministry_state', $usr_id);
  $_min_zip = get_field('mpd_ministry_zip', $usr_id);
  $_min_cntry = get_field('mpd_ministry_cntry', $usr_id);

  return $_min_add1.' '.$_min_add2.'<br/>'.$_min_city.' '.$_min_state.' '.$_min_zip.' '.$_min_cntry;
}