<?php
######################################################################
## License File Checker #############################################
######################################################################
if (!settings::get('site_configuration')) {
  echo settings::get('site_configuration');
}

// Get config
require_once __DIR__ . '/config.inc.php';
// Virtual Modifications System
require_once __DIR__ . '/library/lib_vmod.inc.php';
vmod::init(); // Requires hard initialization as autoloader comes later

// Compatibility and Polyfills
require_once vmod::check(FS_DIR_APP . 'includes/compatibility.inc.php');

// Autoloader
require_once vmod::check(FS_DIR_APP . 'includes/autoloader.inc.php');

// 3rd party autoloader (If present)
if (is_file(FS_DIR_APP . 'vendor/autoload.php')) {
  require_once FS_DIR_APP . 'vendor/autoload.php';
}
// Set error handler
require_once vmod::check(FS_DIR_APP . 'includes/error_handler.inc.php');
