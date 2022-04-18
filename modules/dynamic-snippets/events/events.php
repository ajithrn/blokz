<?php 
/**
 * Custom Function snippets to geenrate event meta
 * 
 * 
 */

global $post;

/**
 * Event Schedule Date and Time
 *
 * @return void
 */
function blokz_event_date () {
  if (get_post_type($post) == 'tribe_events') {
    if (tribe_event_is_all_day($post)) :
      return tribe_get_start_date($post->ID, false, 'l, M j, Y');
    else :
      return tribe_get_start_date($post->ID, false, 'l, M j, Y, g:i A');
    endif; 
  }
}

/**
 * Event Day Only
 *
 * @return void
 */
function blokz_event_day () {
  return tribe_get_start_date($post->ID, false, 'j');
}

/**
 * Event Month Only
 *
 * @return void
 */
function blokz_event_month () {
  return tribe_get_start_date($post->ID, false, 'M');
}

/**
 * Event Month Only
 *
 * @return void
 */
function blokz_event_venue () {
  return tribe_get_venue($post->ID);
}