<!--Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html>
<head>
    <title>SEAT</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="Capitalist Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template,
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />

    <!-- Favicon -->
    <link rel="shortcut icon" href="images/logo.jpg">

    <!-- font files -->
    <link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>
    <!-- /font files -->
    <!-- css files -->
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" media="all" />
    <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" media="all" />
    <link href="css/jQuery.lightninBox.css" rel="stylesheet" type="text/css" media="all" />
    <link href="css/pogo-slider.min.css" rel="stylesheet" type="text/css" media="all" />
    <link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
    <link rel="stylesheet" href="css/site-header.css" type="text/css" media="all">
    <link rel="stylesheet" href="css/pages.css" type="text/css" media="all">
    <!-- /css files -->
    <!-- js files -->
    <script src="js/modernizr.custom.js"></script>
    <!-- /js files -->
<?php require __DIR__ . '/includes/site-fonts.php'; ?>
</head>
<body>
<?php require __DIR__ . '/includes/header.php'; ?>

<?php require __DIR__ . '/includes/page-intro.php'; ?>

<div class="agileinfo"></div>


<!-- /services-page -->
<section class="service-w3ls product-kit">

    <h3 class="text-center slideanim">KIT SOLAIRE AUTONOME </h3>
    <br>
    <br>
<div class="services-page py-5">
    <div class="container py-3 py-md-3">
        <div class="w3-head-all text-center mb-3">

        </div>
        <div class="agileinfo-top-grids row">
            <div class="container">

                <div class="what-grids">
                    <div class="col-md-6 what-grid">
                        <img src="images/Kit-solaire-50w-autonome-.jpg" class="img-responsive" alt="" />
                        <br>
                        <br>
                        <h4>Kit Solaire 50W</h4>
                        <p>
                            SEAT OPUS GLOBAL dispose des kits solaires autonome allant de 145W à 320W
                            pour une allimentation en 220volt ou plus.
                        </p>
                    </div>
                    <div class="col-md-6 what-grid">
                        <img src="images/kit1000w-z.jpg" class="img-responsive" alt="" />
                        <br>
                        <br>
                        <h4>Kit Solaire 1000W</h4>
                        <p>
                            Ce kit solaire se compose d'un panneau solaire et sa fixation,le regulateur,
                            la batterie et le convertisseur prêt a emploi, pour une allimention en courant alternative.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>




    <!-- //services-page -->

<!-- //services-page -->
</section>


<div class="wthree"></div>

<div class="w3layout"></div>
<?php require __DIR__ . '/includes/site-footer.php'; ?>
<a href="#" class="cd-top">Top</a>
<!-- js files -->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/top.js"></script>
<script src="js/jQuery.lightninBox.js"></script>
<script type="text/javascript">
    $(".lightninBox").lightninBox();
</script>
<script>
    $(document).ready(function(){
        // Add smooth scrolling to all links in navbar + footer link
        $(".navbar li a").on('click', function(event) {

            // Make sure this.hash has a value before overriding default behavior
            if (this.hash !== "") {

                // Store hash
                var hash = this.hash;

                // Using jQuery's animate() method to add smooth page scroll
                // The optional number (900) specifies the number of milliseconds it takes to scroll to the specified area
                $('html, body').animate({
                    scrollTop: $(hash).offset().top
                }, 900, function(){

                    // Add hash (#) to URL when done scrolling (default click behavior)
                    window.location.hash = hash;
                });
            } // End if
        });
    })
</script>
<script>
    $(window).scroll(function() {
        $(".slideanim").each(function(){
            var pos = $(this).offset().top;

            var winTop = $(window).scrollTop();
            if (pos < winTop + 600) {
                $(this).addClass("slide");
            }
        });
    });
</script>
<script src="js/jquery.pogo-slider.min.js"></script>
<script src="js/main.js"></script>
<!-- /js files -->
</body>
</html>