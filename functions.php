<?php 
/**
 * file includes
 *
 * The $module_includes array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 *
 * Please note that missing files will produce a fatal error.
 *
 */
$module_includes = [
  
  'modules/utility-functions/utility-functions.php',    // Scripts for global utility
  'modules/dynamic-snippets/dynamic-snippets.php',    // Scripts for additional bricks dynamic function.
  'modules/bricks/bricks.php',    // Scripts for additional bricks features.

];

foreach ($module_includes as $file) {
  if (!$filepath = locate_template($file)) {
    trigger_error(sprintf(__('Error locating %s for inclusion', 'blokz'), $file), E_USER_ERROR);
  }

  require_once $filepath;
}
unset($file, $filepath);