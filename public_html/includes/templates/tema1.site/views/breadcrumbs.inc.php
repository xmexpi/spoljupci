
    <?php
    foreach ($breadcrumbs as $breadcrumb) {
      if (!empty($breadcrumb['link'])) {
        echo '>> <a href="' . htmlspecialchars($breadcrumb['link']) . '">' . $breadcrumb['title'] . '</a>  ';
      } else {
        echo '>> ' . $breadcrumb['title'] . '';
      }
    }
    ?>
