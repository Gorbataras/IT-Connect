

<!--header for the page-->
<?php echo $this->render('views/parts/header.php',NULL,get_defined_vars(),0); ?>

<!--navbar-->
<?php echo $this->render('views/parts/navbar.php',NULL,get_defined_vars(),0); ?>

<body>
<div id="site-container">
    <!--main carousel for the page-->
    <div class="carousel slide" data-ride="carousel" id="carouselExampleIndicators">
        <div class="carousel-inner text-center">
            <!--first carousel-->
            <div class="carousel-item active">
                <img src="<?= ($BASE) ?>/assets/img/coffee.jpg" class="img-fluid" alt="first image">
                <div class="carousel-caption d-flex h-100  flex-column align-items-center justify-content-center">
                    <h3>Looking for tech internships in Seattle-Tacoma?</h3>
                    <br>
                    <h5><a href="internships">Search Listings</a></h5>
                </div>
            </div>
            <!--end first carousel-->
            <!--second carousel-->
            <div class="carousel-item">
                <img src="<?= ($BASE) ?>/assets/img/resource.jpg" class="img-fluid" alt="second image">
                <div class="carousel-caption d-flex h-100  flex-column align-items-center justify-content-center">
                    <h3>Need help with your resume and LinkedIn profile?</h3>
                    <br>
                    <h5 class="button"><a href="studentResources">Browse Resources</a></h5>
                </div>
            </div>
            <!--end second carousel-->
            <!--third carousel-->
            <div class="carousel-item">
                <img src="<?= ($BASE) ?>/assets/img/session.jpg" class="img-fluid" alt="third image">
                <div class="carousel-caption d-flex h-100  flex-column align-items-center justify-content-center">
                    <h3>Seeking Career Development and Networking Opportunities?</h3>
                    <br>
                    <h5 class="button"><a href="https://www.meetup.com/South-King-Web-Mobile-Developers/events/" target="_blank">View events</a></h5>
                </div>
            </div>
            <!--end third carousel-->
        </div>
        <!--indicator previous-->
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span aria-hidden="true"><i class="fas fa-arrow-circle-left fa-2x"></i></span>
            <span class="sr-only">Previous</span>
        </a>
        <!--indicator next-->
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span aria-hidden="true"><i class="fas fa-arrow-circle-right fa-2x"></i></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div>
</body>

<!--footer for the page-->
<?php echo $this->render('views/parts/footer.php',NULL,get_defined_vars(),0); ?>

