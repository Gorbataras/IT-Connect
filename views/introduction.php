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
 *
 * @author Chad Drennan
 * @author Taras Gorbachevskiy
 * @author Marcos Rivera
 * @author Rajpreet Dhaliwal
 * 2020-5-7
 * @version 1.0
 */
?>

<!--header for the page-->
<include href="views/parts/header.php"></include>

<body>
<div id="site-container">
    <!--navbar-->
    <include href="views/parts/navbar.php"></include>

    <!-- Alert -->
    <check if="{{ @content['alert']['isShown'] == 1 }}">
        <div class="alert success">
            <span class="closebtn">&times;</span>
            {{ @content['alert']['html'] | raw }}
        </div>
    </check>


    <div class="container">
        <!-- Site Introduction -->
        <check if="{{ @content['intro']['isShown'] == 1 }}">
            <div id="intro">
                {{ @content['intro']['html'] | raw }}
            </div>
        </check>
        <h2 id="page-title">Recent Activity</h2>
        <hr class="mt-0">
        <br>

        <div class="accordion" id="home-accordion">
            <div id="most-recent" class="row justify-content-around">

                <!-- Internships -->
                <div class="col-lg">
                    <div class="card">

                        <!-- Card heading -->
                        <a class="no-decoration expand-toggle" data-toggle="collapse" href="#internships-body"
                           role="button" aria-expanded="false" aria-controls="internships-body">
                            <div class="card-header text-center" id="internships-heading">
                                <h3>Internships</h3>
                            </div>
                        </a>

                        <!-- Card content -->
                        <div id="internships-body" class="collapse show" aria-labelledby="internships-heading"
                             data-parent="#home-accordion">

                                <ul id="internships" class="list-group list-group-flush">
                                    <F3:repeat group="{{ @posts }}" value="{{ @post }}">
                                        <li class="list-group-item">
                                            <a href="{{@post->url}}" target="_blank" class="no-decoration"> <!-- Url column-->
                                                <span class="company-name h4">{{@post->company}}</span> <!-- Company column -->
                                                <br>
                                                <span class="h6">{{@post->title}}</span>
                                                <br>
                                                <span>{{@post->location}}</span>
                                                <br>
                                                <span>Posted: {{@post->post_date}}</span>
                                                <br>
                                                <p class="card-subtitle mb-2 text-muted"> <!-- Description column -->
                                                    <check if="{{empty(@post->description)}}">
                                                        <true>No description available</true>
                                                        <false>{{substr(@post->description, 0, 150)}}...</false>
                                                    </check>
                                                    <small class="card-subtitle mb-2 text-muted">
                                                        <br><strong>Apply Now!</strong>
                                                    </small>
                                                </p>
                                            </a>
                                        </li>
                                    </F3:repeat>
                                </ul>

                            <!--Show more button -->
                            <a class="btn container-fluid" href="internships" role="button">
                                Show More
                            </a>
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

                        <!-- Card content -->
                        <div id="meetups-body" class="collapse" aria-labelledby="meetups-heading"
                             data-parent="#home-accordion">
                            <ul id="latest-meetups" class="list-group list-group-flush">
                                <F3:repeat group="{{ @array }}" value="{{ @meetup }}">
                                    <li class="list-group-item">
                                        <a href="{{@meetup.link}}" class="no-decoration">
                                            <span class="card-title h5">{{@meetup.name}}</span>
                                            <br>
                                            <span class="card-text mb-2 h6">
													{{date("g:i a", strtotime(@meetup.local_time))}} - {{date_format(date_create(@meetup.local_date), "D M d, Y")}}
											</span>
											<br>
                                            <span class="card-text mb-2">
													{{@meetup.venue.name}}</span>
                                            <br>
                                            <div class="card-text mb-2 h6">Hosted By:
												<span class="text-muted">{{@meetup.group.name}}</span>
											</div>
                                        </a>
                                    </li>
                                </F3:repeat>
                            </ul>
                            <!--Show more button -->
                            <a class="btn container-fluid"
                               href="{{@BASE}}/upcoming-events" role="button"
                               target="_blank">Show More</a>
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

                        <!-- Card content -->
                        <div id="posts-body" class="collapse" aria-labelledby="posts-heading"
                             data-parent="#home-accordion">
                            <check if="{{ empty(@blog) }}">
                                <true>
                                    <p>No content to show</p>
                                </true>
                                <false>
                                    <ul id="latest-blogs" class="list-group list-group-flush">

                                        <repeat group="{{ @blog }}" value="{{ @currPost }}">

                                            <li class="list-group-item">
                                                <a href="{{ @currPost.link }}" target="_blank" class="no-decoration">

                                                    <div class='photo-header'>
                                                        <img class="card-img-top" src="{{ @currPost.thumbnail }}"
                                                             alt="thumbnail for the post titled {{ @currPost.title }}">
                                                        <h4 class="card-title h5">{{ @currPost.title }}</h4>
                                                    </div>

                                                    <div class="card-body">
                                                        <div class="card-text"><p>{{ @currPost.content }}</p></div>
                                                        <small class="card-subtitle mb-2 text-muted">
                                                            {{ @currPost.author }}, {{ @currPost.pubDate }}
                                                        </small>
                                                    </div>
                                                </a>
                                            </li>

                                        </repeat>

                                    </ul>

                                    <!--Show more button -->
                                    <a class="btn container-fluid"
                                       href="https://medium.com/green-river-web-mobile-developers" role="button"
                                       target="_blank">Show More</a>
                                </false>
                            </check>
                        </div>
                    </div><!-- card -->
                </div><!-- col -->
            </div><!-- row -->
        </div><!-- accordion -->
    </div><!-- container -->
</div><!-- site container -->

<!--footer for the page-->
<include href="views/parts/footer.php"></include>

