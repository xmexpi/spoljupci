<!DOCTYPE html>
<html lang="{snippet:language}" dir="{snippet:text_direction}">

<head>
  <title>{snippet:title}</title>
  <meta charset="{snippet:charset}" />
  <meta name="description" content="{snippet:description}" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="images/favicon.ico" type="image/x-icon">
  <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" />
  <link rel="stylesheet" href="{snippet:template_path}css/bootstrap.css" type="text/css" media="screen" />
  <link rel="stylesheet" href="{snippet:template_path}css/bootstrap-responsive.css" type="text/css" media="screen" />
  <link rel="stylesheet" href="{snippet:template_path}css/camera.css" type="text/css" media="screen" />
  <link rel="stylesheet" href="{snippet:template_path}css/style.css" type="text/css" media="screen" />
  {snippet:head_tags}
  {snippet:style}
</head>

<body class="main">
  <div id="main">
    <div class="bg2"></div>
    <div class="bg3"></div>
    <div id="inner">
      <div class="container">
        <div class="row">
          <div class="span2">
            <div class="box1"></div>
          </div>
          <div class="span10">
            <div class="box0">
              <?php include vmod::check(FS_DIR_TEMPLATE . 'views/box_cookie_notice.inc.php'); ?>
              <header>
                <div class="logo_wrapper"><a href="<?php echo document::href_ilink(''); ?>" class="logo"><img src="<?php echo document::href_link('images/logotype.png'); ?>" alt="<?php echo settings::get('site_name'); ?>"></a></div>
              </header>
              <?php include vmod::check(FS_DIR_APP . 'includes/boxes/box_site_menu.inc.php'); ?>
              {snippet:content}
              <?php include vmod::check(FS_DIR_APP . 'includes/boxes/box_site_footer.inc.php'); ?>
            </div>

            <a id="scroll-up" class="hidden-print" href="#">
              <?php echo functions::draw_fonticon('fa-chevron-circle-up fa-3x', 'style="color: #000;"'); ?>
            </a>

            {snippet:foot_tags}
            <script type="text/javascript" src="{snippet:template_path}js/jquery.js"></script>
            <script type="text/javascript" src="{snippet:template_path}js/jquery.easing.1.3.js"></script>
            <script type="text/javascript" src="{snippet:template_path}js/superfish.js"></script>

            <script type="text/javascript" src="{snippet:template_path}js/jquery.ui.totop.js"></script>

            <script type="text/javascript" src="{snippet:template_path}js/camera.js"></script>
            <script type="text/javascript" src="{snippet:template_path}js/jquery.mobile.customized.min.js"></script>

            <script type="text/javascript" src="{snippet:template_path}js/jquery.caroufredsel.js"></script>
            <script type="text/javascript" src="{snippet:template_path}js/jquery.touchSwipe.min.js"></script>
            <script>
              $(document).ready(function() {
                // camera
                $('#camera_wrap').camera({
                  //thumbnails: true
                  autoAdvance: true,
                  mobileAutoAdvance: true,
                  //fx					: 'simpleFade',
                  height: '40%',
                  hover: false,
                  loader: 'none',
                  navigation: true,
                  navigationHover: true,
                  mobileNavHover: true,
                  playPause: false,
                  pauseOnClick: false,
                  pagination: false,
                  time: 7000,
                  transPeriod: 1000,
                  minHeight: '200px'
                });

                //	carouFredSel
                $('#slider3 .carousel.main ul').carouFredSel({
                  auto: {
                    timeoutDuration: 8000
                  },
                  responsive: true,
                  prev: '.prev3',
                  next: '.next3',
                  width: '100%',
                  scroll: {
                    items: 1,
                    duration: 1000,
                    easing: "easeOutExpo"
                  },
                  items: {
                    width: '200',
                    height: 'variable', //	optionally resize item-height			  
                    visible: {
                      min: 1,
                      max: 5
                    }
                  },
                  mousewheel: false,
                  swipe: {
                    onMouse: true,
                    onTouch: true
                  }
                });
                $(window).bind("resize", updateSizes_vat).bind("load", updateSizes_vat);

                function updateSizes_vat() {
                  $('#slider3 .carousel.main ul').trigger("updateSizes");
                }
                updateSizes_vat();

              }); //
              $(window).load(function() {
                //

              }); //
            </script>
            {snippet:javascript}
</body>

</html>