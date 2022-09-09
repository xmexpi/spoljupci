<div id="slider_wrapper">
    <div id="slider" class="clearfix">
        <div id="camera_wrap">
            <?php
            foreach ($slides as $key => $slide) {
                echo '<div data-src="' . document::href_link($slide['image']) . '" alt="' . functions::escape_html($slide['name']) . '" style="width: 100%;" />' . PHP_EOL;

                if ($slide['link']) {
                    echo '<a href="' . functions::escape_html($slide['link']) . '">' . PHP_EOL;
                }


                if (!empty($slide['caption'])) {
                    echo '<div class="camera_caption fadeFromRight"><div class="txt1">' . $slide['caption'] . '</div></div>' . PHP_EOL;
                }

                if ($slide['link']) {
                    echo '</a>' . PHP_EOL;
                }

                echo '</div>' . PHP_EOL;
            }
            ?>
        </div>
    </div>
</div>