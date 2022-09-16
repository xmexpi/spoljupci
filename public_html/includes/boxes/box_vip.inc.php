<?php

$box_team_cache_token = cache::token('box_team', ['language'], 'file');
if (cache::capture($box_team_cache_token)) {

    $team_query = database::query(
        "select * from " . DB_TABLE_PREFIX . "team WHERE type='2' order by priority, name;"
    );

    if (database::num_rows($team_query)) {

        $box_team = new ent_view();

        $box_team->snippets['team'] = [];

        while ($dj = database::fetch($team_query)) {
            $box_team->snippets['team'][] = [
                'id' => $dj['id'],
                'name' => $dj['name'],
                'image' => 'images/' . $dj['image'],
                'caption' => $dj['caption'],
            ];
        }
        echo $box_team->stitch('views/box_site_vip');
    }

    cache::end_capture($box_team_cache_token);
}
