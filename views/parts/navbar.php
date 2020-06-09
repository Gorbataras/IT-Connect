<?php
/**
 * Created by PhpStorm.
 * User: amazon
 * Date: 3/6/2019
 * Time: 7:14 PM
 */
?>

<!--navigation bar-->
<nav class="navbar navbar-expand-lg navbar-dark">
    <a class="navbar-brand d-flex align-items-center" href="/"><img src="../../assets/img/logo.{{@logoType}}" class="img-responsive" alt="Generic logo">{{ @siteTitle | raw }}</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="internships">Internships<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="studentResources">Student Resources<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="upcoming-events">Upcoming Events<span class="sr-only">(current)</span></a>
            </li>
        </ul>
        <ul class="navbar-nav navbar-right">
            <li class="nav-item">
                <a class="nav-link" id="education"
                   href="https://www.greenriver.edu/students/academics/degrees-programs/bachelor-of-applied-science/bachelors-in-software-development/"
                   target="_blank">
                    Earn your Bachelor’s at Green River </a>
            </li>
        </ul>
    </div>
</nav>