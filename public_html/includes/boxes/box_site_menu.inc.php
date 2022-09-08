<?php

  $box_site_menu = new ent_view();

  $box_site_menu_cache_token = cache::token('box_site_menu', array('language'), 'file');
  if (!$box_site_menu->snippets = cache::get($box_site_menu_cache_token)) {

    $box_site_menu->snippets = array(
      'pages' => array(),
    );
    
  // Information pages

    $pages_query = database::query(
      "select p.id, p.priority, pi.title from ". DB_TABLE_PAGES ." p
      left join ". DB_TABLE_PAGES_INFO ." pi on (p.id = pi.page_id and pi.language_code = '". database::input(language::$selected['code']) ."')
      where status
      and find_in_set('menu', dock)
      order by p.priority, pi.title;"
    );

    while ($page = database::fetch($pages_query)) {
      $box_site_menu->snippets['pages'][$page['id']] = array(
        'type' => 'page',
        'id' => $page['id'],
        'title' => $page['title'],
        'link' => document::ilink('information', array('page_id' => $page['id'])),
        'priority' => $page['priority'],
      );
    }

    cache::set($box_site_menu_cache_token, $box_site_menu->snippets);
  }

  echo $box_site_menu->stitch('views/box_site_menu');
