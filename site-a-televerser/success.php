

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

<section class="service-w3ls">
    <div >
        <div class="container">

        </div>
    </div>


    <!-- contact -->
    <div class="w3_agile_services_grids w3_agile_contactwe_grids">
        <div class="alert alert-success hidden-xs-up" >
            Nous avons recu votre message, nous vous contacterons le plutot possible.
        </div>
        <script>
            setTimeout(function () {
                window.location.replace("index.php"); //will redirect to main page (index.html)
            }, 10000); //will call the function after 3 secs.
        </script>
    </div>
</section>

<?php require __DIR__ . '/includes/site-footer.php'; ?>
<a href="#0" class="cd-top">Top</a>
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



</body>
</html>