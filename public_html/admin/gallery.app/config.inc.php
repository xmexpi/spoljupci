<?php

return $app_config = [
  'name' => language::translate('title_gallery', 'Galerija Radija'),
  'default' => 'gallery',
  'priority' => 0,
  'theme' => [
    'color' => '#a880d8',
    'icon' => 'fa-picture-o',
  ],
  'menu' => [],
  'docs' => [
    'gallery' => 'gallery.inc.php',
    'edit_photo' => 'edit_photo.inc.php',
  ],
];
