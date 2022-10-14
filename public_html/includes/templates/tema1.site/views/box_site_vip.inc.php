<div class="span3">

    <div class="kv1">

        <h3><?php echo language::translate('xmexpi_vip_clanovi', 'VIP CLANOVI'); ?></h3>
        <?php
        foreach ($vip as $key => $dj) {
            echo '<div class="kv1_pad"><div class="thumb2"><div class="thumbnail clearfix"><a href="#">' . PHP_EOL;
            echo '<figure><img src="' . document::href_link($dj['image']) . '" style="width:71px;"></figure>' . PHP_EOL;
            echo '<div class="caption"><div class="txt1">' . $dj['name'] . '</div><div class="txt2">'  . language::translate('xmexpi_vip_clan', 'VIP Clan') . '</div></div>' . PHP_EOL;

            echo '</a></div></div></div><div class="line1"></div>' . PHP_EOL;
        }
        ?>
    </div>
    <div class="kv1">
        <h3><?php echo language::translate('xmexpi_vrijeme7', 'VREME 7 DANA'); ?></h3>
        <a class="weatherwidget-io" href="https://forecast7.com/hr/44d0221d01/serbia/" data-label_1="SERBIA" data-label_2="VRIJEME" data-theme="gray">SERBIA VRIJEME</a>
        <script>
            ! function(d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (!d.getElementById(id)) {
                    js = d.createElement(s);
                    js.id = id;
                    js.src = 'https://weatherwidget.io/js/widget.min.js';
                    fjs.parentNode.insertBefore(js, fjs);
                }
            }(document, 'script', 'weatherwidget-io-js');
        </script>
    </div>

</div>