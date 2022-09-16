<?php

######################################################################
## Files and Directories #############################################
######################################################################
// Project Name
define('PROJECT_NAME', 'xm-default');
define('BACKEND_ALIAS', 'admin');

// File System
define('DOCUMENT_ROOT',      rtrim(str_replace('\\', '/', realpath($_SERVER['DOCUMENT_ROOT'])), '/'));

define('FS_DIR_APP',         DOCUMENT_ROOT . rtrim(str_replace(DOCUMENT_ROOT, '', str_replace('\\', '/', realpath(__DIR__ . '/..'))), '/') . '/');
define('FS_DIR_ADMIN',       FS_DIR_APP . BACKEND_ALIAS . '/');

// Web System
define('WS_DIR_APP',         rtrim(str_replace(DOCUMENT_ROOT, '', str_replace('\\', '/', realpath(__DIR__ . '/..'))), '/') . '/');
define('WS_DIR_ADMIN',       WS_DIR_APP . BACKEND_ALIAS . '/');

######################################################################
## Backwards Compatible Directory Definitions (xMexpi < v1.0) ########
######################################################################

// File System
define('FS_DIR_HTTP_ROOT', DOCUMENT_ROOT);

// Web System
define('WS_DIR_HTTP_HOME', rtrim(str_replace(DOCUMENT_ROOT, '', str_replace('\\', '/', realpath(__DIR__ . '/..'))), '/') . '/');

define('WS_DIR_CACHE',       WS_DIR_HTTP_HOME . 'cache/');
define('WS_DIR_DATA',        WS_DIR_HTTP_HOME . 'data/');
define('WS_DIR_EXT',         WS_DIR_HTTP_HOME . 'ext/');
define('WS_DIR_IMAGES',      WS_DIR_HTTP_HOME . 'images/');
define('WS_DIR_INCLUDES',    WS_DIR_HTTP_HOME . 'includes/');
define('WS_DIR_LOGS',        WS_DIR_HTTP_HOME . 'logs/');
define('WS_DIR_PAGES',       WS_DIR_HTTP_HOME . 'pages/');
define('WS_DIR_BOXES',       WS_DIR_INCLUDES  . 'boxes/');
define('WS_DIR_CLASSES',     WS_DIR_INCLUDES  . 'classes/');
define('WS_DIR_CONTROLLERS', WS_DIR_INCLUDES  . 'controllers/'); // Deprecated in favour of Entities
define('WS_DIR_FUNCTIONS',   WS_DIR_INCLUDES  . 'functions/');
define('WS_DIR_LIBRARY',     WS_DIR_INCLUDES  . 'library/');
define('WS_DIR_MODULES',     WS_DIR_INCLUDES  . 'modules/');
define('WS_DIR_REFERENCES',  WS_DIR_INCLUDES  . 'references/');
define('WS_DIR_ROUTES',      WS_DIR_INCLUDES  . 'routes/');
define('WS_DIR_TEMPLATES',   WS_DIR_INCLUDES  . 'templates/');

######################################################################
## Database ##########################################################
######################################################################

// Database
define('DB_TYPE', 'mysql');
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'root');
define('DB_DATABASE', 'radioproject');
define('DB_TABLE_PREFIX', 'xp_');
define('DB_CONNECTION_CHARSET', 'utf8');
define('DB_PERSISTENT_CONNECTIONS', 'false');

// Original Database tables
define('DB_TABLE_COUNTRIES',                         '`' . DB_DATABASE . '`.`' . DB_TABLE_PREFIX . 'countries`');
define('DB_TABLE_CURRENCIES',                        '`' . DB_DATABASE . '`.`' . DB_TABLE_PREFIX . 'currencies`');
define('DB_TABLE_CUSTOMERS',                         '`' . DB_DATABASE . '`.`' . DB_TABLE_PREFIX . 'customers`');
define('DB_TABLE_EMAILS',                            '`' . DB_DATABASE . '`.`' . DB_TABLE_PREFIX . 'emails`');
define('DB_TABLE_GEO_ZONES',                         '`' . DB_DATABASE . '`.`' . DB_TABLE_PREFIX . 'geo_zones`');
define('DB_TABLE_LANGUAGES',                         '`' . DB_DATABASE . '`.`' . DB_TABLE_PREFIX . 'languages`');
define('DB_TABLE_MODULES',                           '`' . DB_DATABASE . '`.`' . DB_TABLE_PREFIX . 'modules`');
define('DB_TABLE_PAGES',                             '`' . DB_DATABASE . '`.`' . DB_TABLE_PREFIX . 'pages`');
define('DB_TABLE_PAGES_INFO',                        '`' . DB_DATABASE . '`.`' . DB_TABLE_PREFIX . 'pages_info`');
define('DB_TABLE_SETTINGS',                          '`' . DB_DATABASE . '`.`' . DB_TABLE_PREFIX . 'settings`');
define('DB_TABLE_SETTINGS_GROUPS',                   '`' . DB_DATABASE . '`.`' . DB_TABLE_PREFIX . 'settings_groups`');
define('DB_TABLE_SLIDES',                            '`' . DB_DATABASE . '`.`' . DB_TABLE_PREFIX . 'slides`');
define('DB_TABLE_SLIDES_INFO',                       '`' . DB_DATABASE . '`.`' . DB_TABLE_PREFIX . 'slides_info`');
define('DB_TABLE_TRANSLATIONS',                      '`' . DB_DATABASE . '`.`' . DB_TABLE_PREFIX . 'translations`');
define('DB_TABLE_USERS',                             '`' . DB_DATABASE . '`.`' . DB_TABLE_PREFIX . 'users`');
define('DB_TABLE_ZONES',                             '`' . DB_DATABASE . '`.`' . DB_TABLE_PREFIX . 'zones`');
define('DB_TABLE_ZONES_TO_GEO_ZONES',                '`' . DB_DATABASE . '`.`' . DB_TABLE_PREFIX . 'zones_to_geo_zones`');

// Database tables (Additional)
/* Your added tables here ... */

######################################################################
## Application #######################################################
######################################################################

// Errors
error_reporting(version_compare(PHP_VERSION, '5.4.0', '<') ? E_ALL | E_STRICT : E_ALL);
ini_set('ignore_repeated_errors', 'On');
ini_set('log_errors', 'On');
ini_set('error_log', FS_DIR_APP . 'logs/errors.log');
ini_set('display_startup_errors', 'Off');
ini_set('display_errors', 'Off');
if (in_array($_SERVER['REMOTE_ADDR'], array('127.0.0.1', '::1'))) {
  ini_set('display_startup_errors', 'On');
  ini_set('display_errors', 'On');
}

// Password Encryption Salt
define('PASSWORD_SALT', 'toLBc255P6fG4QVI5HxQL4XVbm8jKMbdhmYPyNQUP2zK9m6ZXIxdwVWI0cleJaOFE35tCNaVhDKQYC1eAq6zkrCxZelueBCNDtBfa2CNG3wfd9DTrrmu89wHyRZEvcK0');
// License Key
define('LICENSE_KEY', 'XP-93hef9587i');