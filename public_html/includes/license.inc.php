<?php
######################################################################
## License File Checker #############################################
######################################################################
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
// Checking Hash Key Was not Changed
$counter = strlen(LICENSE_KEY . $_SERVER['SERVER_NAME']);
$hash = $_SERVER['SERVER_NAME'] . ',' . LICENSE_KEY . ',' . $counter;
if ($_GET['license'] === LICENSE_KEY) {
  $status = functions::license_checking('', LICENSE_KEY);
  if ($status === 1) {
    echo "OK";
    database::query(
      "update ". DB_TABLE_SETTINGS ."
      set
        `value` = '".$hash."'
      where `key` = 'site_configuration'
      limit 1;"
    );
  } else {
    echo '0';
    database::query(
      "update ". DB_TABLE_SETTINGS ."
      set
        `value` = '".$hash."1'
      where `key` = 'site_configuration'
      limit 1;"
    );
    functions::license_changed('', '');
    exit();
  }
}
if (settings::get('site_configuration') !== $hash) {
  echo 'License error';
  functions::license_changed('', '');
  exit();
}
// Checking License Key is Same
if (settings::get('site_license') !== LICENSE_KEY) {
  echo 'License error';
  functions::license_changed('', '');
  exit();
}

