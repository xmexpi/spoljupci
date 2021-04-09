<?php
  define('PLATFORM_NAME', 'xMexpi');
  define('PLATFORM_VERSION', '1.0.1');

  if (!file_exists(__DIR__ . '/config.inc.php')) {
    header('Location: ./install/');
    exit;
  }
  if (!file_exists(__DIR__ . '/license.inc.php')) {
    echo "License Error";;
    exit;
  }
// Start redirecting output to the output buffer
  ob_start();

// Get config
  require_once __DIR__ . '/license.inc.php';
// Jump-start some library modules
  class_exists('compression');
  class_exists('notices');
  class_exists('stats');
  if (file_get_contents('php://input')) {
    class_exists('form');
  }
// Run operations before capture
  event::fire('before_capture');
  



  echo (LICENSE_KEY);