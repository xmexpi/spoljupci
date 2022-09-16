<div class="span3">

    <div class="kv1">

        <h3><?php echo language::translate('xmexpi_vip_clanovi', 'VIP CLANOVI'); ?></h3>
        <?php
        foreach ($team as $key => $dj) {
            echo '<div class="kv1_pad"><div class="thumb2"><div class="thumbnail clearfix"><a href="#">' . PHP_EOL;
            echo '<figure><img src="' . document::href_link($dj['image']) . '" style="width:71px;"></figure>' . PHP_EOL;
            echo '<div class="caption"><div class="txt1">' . $dj['name'] . '</div><div class="txt2">'  . language::translate('xmexpi_vip_clan', 'VIP Clan') . '</div></div>' . PHP_EOL;

            echo '</a></div></div></div><div class="line1"></div>' . PHP_EOL;
        }
        ?>
    </div>
</div>