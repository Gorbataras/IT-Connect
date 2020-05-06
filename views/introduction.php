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
<div class="container">

    <!-- Site Introduction -->
    <p id="intro">
        hi Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris nisi ante, pellentesque sit amet mollis non,
        placerat euismod odio. In hac habitasse platea dictumst. Suspendisse quis neque vitae eros imperdiet
        consequat a ac tortor. Fusce augue sem, convallis et nulla
    </p>

    <h2>Recent Activity</h2>
    <hr class="mt-0">
    <br>

    <div class="accordion" id="home-accordion">
        <div id="most-recent" class="row justify-content-around">

            <!-- Internships -->
            <div class="col-lg">
                <div class="card">

                    <!-- Card heading -->
                    <a class="collapsed no-decoration expand-toggle" data-toggle="collapse" href="#internships-body"
                       role="button" aria-expanded="false" aria-controls="internships-body">
                        <div class="card-header text-center" id="internships-heading">
                            <h3>Internships</h3>
                        </div>
                    </a>

                    <div id="internships-body" class="collapse show" aria-labelledby="internships-heading"
                         data-parent="#home-accordion">
                        <div class="card-body">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris nisi ante, pellentesque sit amet mollis non,
                            placerat euismod odio. In hac habitasse platea dictumst. Suspendisse quis neque vitae eros imperdiet
                            consequat a ac tortor. Fusce augue sem, convallis et nulla malesuada, imperdiet molestie est. Pellentesque
                            vel varius ex, porttitor hendrerit justo. Vivamus nisl lectus, rutrum pulvinar venenatis id, fringilla ac
                            erat. Quisque venenatis risus turpis. Proin porta commodo libero vitae rhoncus. Mauris vestibulum magna ut
                            orci porta sollicitudin. Proin non est at sapien elementum cursus. Nulla ac maximus tellus. Vivamus feugiat
                            justo dolor, eget volutpat augue ullamcorper quis. Duis turpis massa, accumsan sit amet lacus et, commodo
                            ornare arcu. Vestibulum luctus pretium leo, eu iaculis ipsum pretium eget.
                        </div>
                    </div>

                </div><!-- card -->
            </div><!-- col -->

            <!-- Meetups -->
            <div class="col-lg">
                <div class="card">

                    <!-- Card heading -->
                    <a class="collapsed no-decoration expand-toggle" data-toggle="collapse" href="#meetups-body"
                       role="button" aria-expanded="false" aria-controls="meetups-body">
                        <div class="card-header text-center" id="meetups-heading">
                            <h3>Meetups</h3>
                        </div>
                    </a>

                    <div id="meetups-body" class="collapse" aria-labelledby="meetups-heading"
                         data-parent="#home-accordion">
                        <div class="card-body">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris nisi ante, pellentesque sit amet mollis non,
                            placerat euismod odio. In hac habitasse platea dictumst. Suspendisse quis neque vitae eros imperdiet
                            consequat a ac tortor. Fusce augue sem, convallis et nulla malesuada, imperdiet molestie est. Pellentesque
                            vel varius ex, porttitor hendrerit justo. Vivamus nisl lectus, rutrum pulvinar venenatis id, fringilla ac
                            erat. Quisque venenatis risus turpis. Proin porta commodo libero vitae rhoncus. Mauris vestibulum magna ut
                            orci porta sollicitudin. Proin non est at sapien elementum cursus. Nulla ac maximus tellus. Vivamus feugiat
                            justo dolor, eget volutpat augue ullamcorper quis. Duis turpis massa, accumsan sit amet lacus et, commodo
                            ornare arcu. Vestibulum luctus pretium leo, eu iaculis ipsum pretium eget.
                        </div>
                    </div>

                </div><!-- card -->
            </div><!-- col -->

            <!-- Posts -->
            <div class="col-lg">
                <div class="card">

                    <!-- Card heading -->
                    <a class="collapsed no-decoration expand-toggle" data-toggle="collapse" href="#posts-body"
                       role="button" aria-expanded="false" aria-controls="posts-body">
                        <div class="card-header text-center" id="posts-heading">
                            <h3>Posts</h3>
                        </div>
                    </a>
                    <div id="posts-body" class="collapse" aria-labelledby="posts-heading" data-parent="#home-accordion">
                        <ul id="latest-blogs" class="list-group list-group-flush">
                            No recent posts to show
                        </ul>
                    </div>

                </div><!-- card -->
            </div><!-- col -->
        </div><!-- row -->
    </div><!-- accordion -->
</div>
</body>

<!--footer for the page-->
<include href="views/parts/footer.php"></include>

