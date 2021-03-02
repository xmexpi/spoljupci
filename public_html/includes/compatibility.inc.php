<?php

// Check version
  if (version_compare(phpversion(), '5.4.0', '<') == true) {
    die('This application requires at minimum PHP 5.4 (Detected '. phpversion() .')');
  }

  if (version_compare(phpversion(), '5.5.0', '<') == true) {

  // Emulate array_column() as of PHP 5.5
    if (!function_exists('array_column')) {
      function array_column(array $array, $column_key, $index_key=null) {
        $result = array();
        foreach ($array as $arr) {
          if(!is_array($arr)) continue;
          if (is_null($column_key)) {
            $value = $arr;
          } else {
            $value = $arr[$column_key];
          }
          if (!is_null($index_key)) {
            $key = $arr[$index_key];
            $result[$key] = $value;
          } else{
            $result[] = $value;
          }
        }
        return $result;
      }
    }
  }

  if (version_compare(phpversion(), '7.1', '>=') == true) {

  // Fix JSON serialize float precision issue in PHP 7.1+
    ini_set('serialize_precision', -1);
  }

// Emulate getallheaders() on non-Apache machines
  if (!function_exists('getallheaders')) {
    function getallheaders() {
      $headers = array();
      foreach ($_SERVER as $name => $value) {
        if (substr($name, 0, 5) == 'HTTP_') {
          $headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value;
        }
      }
      return $headers;
    }
  }

// Fix Windows paths
  $_SERVER['SCRIPT_FILENAME'] = str_replace('\\', '/', $_SERVER['SCRIPT_FILENAME']);

// Emulate some $_SERVER variables
  if (empty($_SERVER['HTTP_HOST'])) $_SERVER['HTTP_HOST'] = $_SERVER['SERVER_NAME'];
  if (empty($_SERVER['HTTP_HTTPS'])) $_SERVER['HTTP_HTTPS'] = 'off';

// Redefine some $_SERVER variables
  if (!empty($_SERVER['HTTP_X_FORWARDED_HOST'])) $_SERVER['HTTP_HOST'] = $_SERVER['HTTP_X_FORWARDED_HOST'];
  if (!empty($_SERVER['HTTP_X_FORWARDED_PORT'])) $_SERVER['SERVER_PORT'] = $_SERVER['HTTP_X_FORWARDED_PORT'];
  if (!empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') $_SERVER['HTTPS'] = 'on';

/*
// Redefine $_SERVER['REMOTE_ADDR'] (Can easily be spoofed by clients - Do not enable unless necessary)
  foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'HTTP_X_REAL_IP', 'HTTP_CF_CONNECTING_IP') as $key) {
    if (!empty($_SERVER[$key])) {
      foreach (array_reverse(explode(',', $_SERVER[$key])) as $ip) {
        $ip = trim($ip);
        if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 | FILTER_FLAG_IPV6 | FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false) {
          $_SERVER['REMOTE_ADDR'] = $ip;
        }
      }
    }
  }
*/
