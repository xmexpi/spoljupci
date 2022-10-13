<?php

$box_vip_cache_token = cache::token('box_vip', ['language'], 'file');
if (cache::capture($box_vip_cache_token)) {
    $vip_query = database::query(
        "select * from " . DB_TABLE_PREFIX . "team WHERE type='2' order by priority, name;"
    );

    if (database::num_rows($vip_query)) {
        $box_vip = new ent_view();
        $box_vip->snippets['vip'] = [];
        while ($dj = database::fetch($vip_query)) {
            $box_vip->snippets['vip'][] = [
                'id' => $dj['id'],
                'name' => $dj['name'],
                'image' => 'images/' . $dj['image'],
                'caption' => $dj['caption'],
            ];
        }
        echo $box_vip->stitch('views/box_site_vip');
    } else {
        echo 'error box vip';
    }

    cache::end_capture($box_vip_cache_token);
}
