<link rel="stylesheet" href="css/bootstrap.css" type="text/css" media="screen">
<link rel="stylesheet" href="css/bootstrap-responsive.css" type="text/css" media="screen">
<link rel="stylesheet" href="css/touchTouch.css" type="text/css" media="screen">
<link rel="stylesheet" href="css/isotope.css" type="text/css" media="screen">
<link rel="stylesheet" href="css/style.css" type="text/css" media="screen">

<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="js/superfish.js"></script>

<script type="text/javascript" src="js/jquery.ui.totop.js"></script>

<script type="text/javascript" src="js/touchTouch.jquery.js"></script>
<script type="text/javascript" src="js/jquery.isotope.min.js"></script>
<div class="box2">

    <h1><span><?php echo language::translate('xmexpi_gallery', 'Galerija'); ?></span></h1>
    <br>

    {snippet:notices}

    <section id="box-information" class="box">
        <?php echo $content; ?>
    </section>

    <script>
        $(document).ready(function() {
            //	

        }); //
        $(window).load(function() {
            // isotop
            var $container = $('#isotope-items'),
                $optionSet = $('#isotope-options'),
                $optionSets = $('#isotope-filters'),
                $optionLinks = $optionSets.find('a');
            $container.isotope({
                filter: '*',
                layoutMode: 'fitRows'
            });
            $optionLinks.click(function() {
                var $this = $(this);
                // don't proceed if already selected 
                if ($this.hasClass('selected')) {
                    return false;
                }
                $optionSet.find('.selected').removeClass('selected');
                $this.addClass('selected');

                var selector = $(this).attr('data-filter');
                $container.isotope({
                    filter: selector
                });
                return false;
            });
            $(window).on("resize", function(event) {
                $container.isotope('reLayout');
            });

            // touchTouch
            $('.thumb-isotope .thumbnail a').touchTouch();

        }); //
    </script>