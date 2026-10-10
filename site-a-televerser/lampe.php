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
<section class="service-w3ls">

    <h3 class="text-center slideanim">Lampes Mobile à Recharge </h3>
    <p class="text-center slideanim">Lampes Mobile à Recharge de Schneider Electric SC5AEPLBSU12W <br>
        Avec un eclairage adapté en toutes circonstance portatif LED,
        puissance de leclairage 120 lumens luminiere blanche avec trois niveaux d'eclairage et autonomie.

    </p>

<!--    <div class="container">-->
<!---->
<!--        <div class="what-grids">-->
<!--            <div class="col-md-6 what-grid">-->
<!--                <img src="images/lampe.jpg" class="img-responsive" alt="" />-->
<!--            </div>-->
<!--            <div class="col-md-6 what-grid1">-->
<!--                <img src="images/lampe2.PNG" class="img-responsive" alt="" />-->
<!---->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!-- //services-page -->

    <br>
    <br>
    <div class="services-page py-5">
        <div class="container py-3 py-md-3">
            <div class="w3-head-all text-center mb-3">

            </div>
            <div class="agileinfo-top-grids row">

                <div class="col-lg-4 wthree-top-grid">
                    <img src="images/lampe2.jpg" class="img-responsive img-fluid" alt="" />
                    <br>

                    <h4 style="text-align: center">Lampe Schneider</h4>
                </div>


                <div class="col-lg-4 wthree-top-grid">
                    <img src="images/lampe3.jpg" class="img-responsive img-fluid" alt="" />
                    <br>
                    <br>

                    <h4 style="text-align: center">  Lampe Adaptable au téléphone</h4>
                </div>
                <div class="col-lg-4 wthree-top-grid">
                    <img src="images/lampe5.jpg" class="img-responsive img-fluid" alt="" />
                    <br>

                    <h4 style="text-align: center">Lampe Electrique Mobiya</h4>
                </div>

                <div class="clearfix"> </div>
            </div>
        </div>
    </div>


    <section class="service-w3ls">

        <div class="coupons">
            <div class="container">
                <div class="coupons-grids text-center">
                    <div class="col-md-3 coupons-gd">
                        <h4 style="color: #f9f9f9; font-size: 16px">L'AVANTAGE DES LAMPES A RECHARGE DE SCHNEIDER ELECTRIC</h4>
                    </div>
                    <div class="col-md-3 coupons-gd">
                        <span class="glyphicon  glyphicon-ok" aria-hidden="true"></span>
                        <h4 style="font-size: 16px"> 6 HEURES DU TEMPS NIVEAU: élevé</h4>
                        <p> </p>
                    </div>
                    <div class="col-md-3 coupons-gd">
                        <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                        <h4 style="font-size: 16px"> 12 HEURES DU TEMPS NIVEAU : moyen </h4>

                    </div>
                    <div class="col-md-3 coupons-gd">
                        <span class="glyphicon  glyphicon-ok" aria-hidden="true"></span>
                        <h4 style="font-size: 16px" >48 HEURES DU TEMPS NIVEAU : faible</h4>

                    </div>

                </div>
            </div>
        </div>

    </section>
</section>


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