<?php
  require_once('includes/app_header.inc.php');

  if (settings::get('maintenance_mode')) {
    if (!empty(user::$data['id'])) {
      notices::add('notices', strtr('%message [<a href="%link">%preview</a>]', array(
        '%message' => language::translate('reminder_site_in_maintenance_mode', 'The store is in maintenance mode.'),
        '%preview' => language::translate('title_preview', 'Preview'),
        '%link' => document::href_ilink('maintenance_mode'),
      )), 'maintenance_mode');
    } else {
      http_response_code(503);
      include vmod::check(FS_DIR_APP . 'pages/maintenance_mode.inc.php');
      require_once vmod::check(FS_DIR_APP . 'includes/app_footer.inc.php');
      exit;
    }
  }

// Load routes
  route::load(FS_DIR_APP . 'includes/routes/url_*.inc.php');

// Append default route
  route::add('#^([0-9a-zA-Z_\-/\.]+?)(?:\.php)?/?$#', '$1');

// Go
  route::process();

  require_once vmod::check(FS_DIR_APP . 'includes/app_footer.inc.php');
