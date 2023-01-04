<?php 
/**
 * This module is to generate custom php functions to make brick builder {echo:function_name} feature.
 * 
 * file includes
 *
 * The $module_includes array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 *
 * Please note that missing files will produce a fatal error.
 *
 */
$module_includes = [
  'modules/dynamic-snippets/global/global.php',    // function snippets to generate dynamic data
  'modules/dynamic-snippets/events/events.php',    // Event Block Custom functions.
];

foreach ($module_includes as $file) {
  if (!$filepath = locate_template($file)) {
    trigger_error(sprintf(__('Error locating %s for inclusion', 'blokz'), $file), E_USER_ERROR);
  }

  require_once $filepath;
}
unset($file, $filepath);
