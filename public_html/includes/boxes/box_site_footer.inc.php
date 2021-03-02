<?php
  $box_site_footer_cache_token = cache::token('box_site_footer', array('language', 'login', 'region'), 'file');
  if (cache::capture($box_site_footer_cache_token)) {

    $box_site_footer = new ent_view();
    $box_site_footer->snippets = array(
      'pages' => array(),
    );
    $pages_query = database::query(
      "select p.id, pi.title from ". DB_TABLE_PAGES ." p
      left join ". DB_TABLE_PAGES_INFO ." pi on (p.id = pi.page_id and pi.language_code = '". database::input(language::$selected['code']) ."')
      where status
      and find_in_set('information', dock)
      order by p.priority, pi.title;"
    );
    while ($page = database::fetch($pages_query)) {
      $box_site_footer->snippets['pages'][$page['id']] = array(
        'id' => $page['id'],
        'title' => $page['title'],
        'link' => document::href_ilink('information', array('page_id' => $page['id'])),
      );
    }
    
    $pages_query = database::query(
      "select p.id, pi.title from ". DB_TABLE_PAGES ." p
      left join ". DB_TABLE_PAGES_INFO ." pi on (p.id = pi.page_id and pi.language_code = '". database::input(language::$selected['code']) ."')
      where status
      and find_in_set('customer_service', dock)
      order by p.priority, pi.title;"
    );
    while ($page = database::fetch($pages_query)) {
      $box_site_footer->snippets['customer_service_pages'][$page['id']] = array(
        'id' => $page['id'],
        'title' => $page['title'],
        'link' => document::href_ilink('customer_service', array('page_id' => $page['id'])),
      );
    }

    echo $box_site_footer->stitch('views/box_site_footer');

    cache::end_capture($box_site_footer_cache_token);
  }
