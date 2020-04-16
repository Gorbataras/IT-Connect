<?php
/**
MIT License

Copyright (c) 2018 Michael Lant, Bogdan Pshonyak, Yegor Shemereko, Abdalla M. Abdalla

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
 */

/**
 * The website's landing page, allowing the user to decide if they want to view internships
 *      or check out student resources
 */
?>

<!--header for the page-->
<include href="views/parts/header.php"></include>

<!--navbar-->
<include href="views/parts/navbar.php"></include>

<body>
<div id="site-container">
    <!--main carousel for the page-->
    <div class="carousel slide" data-ride="carousel" id="carouselExampleIndicators">
        <div class="carousel-inner text-center">
            <!--first carousel-->
            <div class="carousel-item active">
                <img src="{{ @BASE }}/assets/img/coffee.jpg" class="img-fluid" alt="first image">
                <div class="carousel-caption d-flex h-100  flex-column align-items-center justify-content-center">
                    <h3>Looking for tech internships in Seattle-Tacoma?</h3>
                    <br>
                    <h5><a href="internships">Search Listings</a></h5>
                </div>
            </div>
            <!--end first carousel-->
            <!--second carousel-->
            <div class="carousel-item">
                <img src="{{ @BASE }}/assets/img/resource.jpg" class="img-fluid" alt="second image">
                <div class="carousel-caption d-flex h-100  flex-column align-items-center justify-content-center">
                    <h3>Need help with your resume and LinkedIn profile?</h3>
                    <br>
                    <h5 class="button"><a href="studentResources">Browse Resources</a></h5>
                </div>
            </div>
            <!--end second carousel-->
            <!--third carousel-->
            <div class="carousel-item">
                <img src="{{ @BASE }}/assets/img/session.jpg" class="img-fluid" alt="third image">
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
<include href="views/parts/footer.php"></include>

