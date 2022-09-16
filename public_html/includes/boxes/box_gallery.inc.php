<?php

$box_gallery_cache_token = cache::token('box_gallery', ['language'], 'file');
if (cache::capture($box_gallery_cache_token)) {

    $photos_query = database::query(
        "select * from " . DB_TABLE_PREFIX . "gallery order by priority, name;"
    );

    if (database::num_rows($photos_query)) {

        $box_gallery = new ent_view();

        $box_gallery->snippets['photos'] = [];

        while ($dj = database::fetch($photos_query)) {
            $box_gallery->snippets['photos'][] = [
                'id' => $dj['id'],
                'name' => $dj['name'],
                'image' => 'images/' . $dj['image'],
                'caption' => $dj['caption'],
            ];
        }

        echo $box_gallery->stitch('views/box_gallery');
    }

    cache::end_capture($box_gallery_cache_token);
}
