<?php

return $app_config = [
  'name' => language::translate('title_team', 'Ekipa Radija'),
  'default' => 'team',
  'priority' => 0,
  'theme' => [
    'color' => '#a880d8',
    'icon' => 'fa-picture-o',
  ],
  'menu' => [],
  'docs' => [
    'team' => 'team.inc.php',
    'edit_dj' => 'edit_dj.inc.php',
  ],
];
