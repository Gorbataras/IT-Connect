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

<!--navbar-->
<include href="views/parts/navbar.php"></include>

<!-- Site Introduction -->
<div class="alert success">
    <span class="closebtn">&times;</span>
    <strong>Welcome!</strong> to the new IT Connect Page.
</div>

<div class="container">
    <p id="intro">
        Thanks for visiting IT Connect. The site where Green River College software development students can find
        upcoming events, current internships and other student resources.
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
                    <a class="no-decoration expand-toggle" data-toggle="collapse" href="#internships-body"
                       role="button" aria-expanded="false" aria-controls="internships-body">
                        <div class="card-header text-center" id="internships-heading">
                            <h3>Internships</h3>
                        </div>
                    </a>

                    <div id="internships-body" class="collapse show" aria-labelledby="internships-heading"
                         data-parent="#home-accordion">
                        <div class="card-body">
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
                                <a href="internships">Show More--></a>
                            </ul>
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
							<ul id="latest-meetups" class="list-group list-group-flush">
								<F3:repeat group="{{ @array }}" value="{{ @meetup }}">
									<li class="list-group-item">
                                        <a href="{{@meetup->link}}" target="_blank" class="no-decoration">
                                            <span class="card-title h5">{{@meetup->name}}</span>
                                            <br>
                                            <span class="card-subtitle mb-2 text-muted h6">
													{{@meetup->local_time}} -> {{@meetup->local_date}}</span>
                                            <span class="card-subtitle mb-2 text-muted h6">
													{{@meetup->venue->name}}</span>
                                        </a>
									</li>
								</F3:repeat>
							</ul>
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
                        </ul>
                    </div>

                </div><!-- card -->
            </div><!-- col -->
        </div><!-- row -->
    </div><!-- accordion -->
</div>

<!--footer for the page-->
<include href="views/parts/footer.php"></include>

