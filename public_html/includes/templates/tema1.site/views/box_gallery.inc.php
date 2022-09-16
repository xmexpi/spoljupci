<!-- <div id="isotope-options">
    <ul id="isotope-filters" class="clearfix">
        <li><a href="#" class="selected" data-filter="*">Show All</a></li>
        <li><a href="#" data-filter=".isotope-filter1">Category 1</a></li>
        <li><a href="#" data-filter=".isotope-filter2">Category 2</a></li>
        <li><a href="#" data-filter=".isotope-filter3">Category 3</a></li>
    </ul>
</div> -->

<ul class="thumbnails" id="isotope-items">
    <?php
    foreach ($photos as $key => $photo) {
        echo '<li class="span2 isotope-element isotope-filter1"><div class="thumb-isotope"><div class="thumbnail clearfix">' . PHP_EOL;
        echo '<a href="' . document::href_link($photo['image']) . '"><figure><img src="' . document::href_link($photo['image']) . '"></figure>' . PHP_EOL;
        echo '<div class="caption">' . $photo['name'] . '</div>' . PHP_EOL;

        echo '</a></div></div></li>' . PHP_EOL;
    }
    ?>
</ul>