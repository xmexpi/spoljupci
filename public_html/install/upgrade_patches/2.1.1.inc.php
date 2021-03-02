<?php

// Delete some files
  $deleted_files = array(
    FS_DIR_APP . 'ext/jquery/jquery-3.2.1.min.js',
    FS_DIR_APP . 'includes/templates/default.admin/less/framework/navigation.less',
    FS_DIR_APP . 'includes/templates/default.site/less/framework/navigation.less',
    FS_DIR_APP . 'includes/templates/default.site/less/framework/panels.less',
  );

  foreach ($deleted_files as $pattern) {
    if (!file_delete($pattern)) {
      die('<span class="error">[Error]</span></p>');
    }
  }
