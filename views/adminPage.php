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
 * The page where the admin can add/delete/edit posts in the internship table
 *      and change password, edit resources page, and add new users
 */
?>
<!doctype html>

<html lang="en">

<head>
    <!--google analytics-->
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-82389817-1"></script>

    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag(){dataLayer.push(arguments);}

        gtag('js', new Date());

        gtag('config', 'UA-82389817-1');
    </script>

    <meta charset="utf-8">

    <title>{{ @siteTabTitle }}: A resource for technology students.</title>

    <!-- Responsive design -->
    <meta name="viewport" content="width=device-width, initial-scale=1 , maximum-scale=1">

    <meta name="description" content="IT Connect helps students discover technical internships in the Seattle-Tacoma region,
                                            and provides curated career preparation resources for improving resumes and LinkedIn profiles.">
    <meta name="keyword" content="ITconnect, IT Connect, Green River College, GRC, GRC IT Connect, GRC ITconnect,
                                        Internships, Internship, Student, College, Software, Software Development, IT,
                                        Information Technology">

    <!--icon image-->
    <link rel="shortcut icon" type="image/x-icon" href="../../assets/img/logo.{{@logoType}}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
          integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <!--header css-->
    <link rel="stylesheet" type="text/css" media="all" href="css/header.css">
    <!--admin page css-->
    <link rel="stylesheet" type="text/css" media="all" href="css/admin-page.css">

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>

    <!-- Update Color scheme -->
    <style>
        a.btn {
        background-color: {{@color1}} !important;
        }
        #button{
        background-color: {{@color1}} !important;
        }
        a.btn.container-fluid:hover  {
        background-color: {{@color1}};
        }

        .page-footer {
        background-color: {{@color2}};
        }

        .navbar{
        background-color: {{@color3}};
        }

        .div.alert{
        background-color: {{@color3}};
        }

    </style>

</head>

<body>

<!--navigation bar for the admin page only-->
<!--<nav class="navbar navbar-expand-lg navbar-dark bg-success">-->
<!--    <a class="navbar-brand" href="/"><img src="https://itconnect.greenrivertech.net/assets/img/grtech.jpg" class="img-responsive" style="height: 50px; width: 50px;"></a>-->
<!--    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">-->
<!--        <span class="navbar-toggler-icon"></span>-->
<!--    </button>-->
<!--    <div class="collapse navbar-collapse" id="navbarText">-->
<!--        <ul class="navbar-nav mr-auto">-->
<!--            <li class="nav-item">-->
<!--                <a class="nav-link" href="#" id="post-submit" data-toggle="modal" data-target="#addModal">Add Internships<span class="sr-only">(current)</span></a>-->
<!--            </li>-->
<!--            <li class="nav-item">-->
<!--                <a class="nav-link" href="#" id="resources-edit" data-toggle="modal" data-target="#resourcesModal">Edit Student Resources<span class="sr-only">(current)</span></a>-->
<!--            </li>-->
<!--            <li class="nav-item">-->
<!--                <a class="nav-link" href="https://gatorlock.greenrivertech.net/requestForReset" target="_blank">Change Password<span class="sr-only">(current)</span></a>-->
<!--            </li>-->
<!--            <li class="nav-item">-->
<!--                <a class="nav-link" href="register">Create User<span class="sr-only">(current)</span></a>-->
<!--            </li>-->
<!--        </ul>-->
<!--        <ul class="navbar-nav navbar-right">-->
<!--            <li class="nav-item">-->
<!--                <a class="nav-link" href="Logout" id="logout">LogOut<span class="sr-only">(current)</span></a>-->
<!--            </li>-->
<!--        </ul>-->
<!--    </div>-->
<!--</nav>-->
<!--navbar-->
<include href="views/parts/navbar.php"></include>

<!-- Content Management Tabs -->
<nav>
    <div class="nav nav-tabs justify-content-center" id="nav-tab" role="tablist">
        <!-- Site Settings -->
        <a class="nav-item nav-link active" id="nav-settings-tab" data-toggle="tab" href="#nav-settings" role="tab"
           aria-controls="nav-settings" aria-selected="true">Site Settings</a>
        <!-- Home -->
        <a class="nav-item nav-link" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab"
           aria-controls="nav-home" aria-selected="false">Home</a>
        <!-- Internships -->
        <a class="nav-item nav-link" id="nav-internships-tab" data-toggle="tab" href="#nav-internships" role="tab"
           aria-controls="nav-internships" aria-selected="false">Internships</a>
        <!-- Meetups -->
        <a class="nav-item nav-link" id="nav-meetups-tab" data-toggle="tab" href="#nav-meetups" role="tab"
           aria-controls="nav-meetups" aria-selected="false">Meetups</a>
        <!-- Student Resources -->
        <a class="nav-item nav-link" id="nav-resources-tab" data-toggle="tab" href="#nav-resources" role="tab"
           aria-controls="nav-resources" aria-selected="false">Student Resources</a>
        <form method="post" action="/Logout">
            <button type="submit" id="logout" class="nav-item nav-link">Logout</button>
        </form>
    </div>

</nav>

<include href="gatorLock/gatorLockLogin.php"></include>

<div class="tab-content container" id="nav-tab-content">
    <!-- Site Settings -->
    <include href="views/adminPartials/siteSettingsTabContent.php"></include>
    <!-- Home -->
    <include href="views/adminPartials/homeTabContent.php"></include>
    <!-- Internships -->
    <include href="views/adminPartials/internshipsTabContent.php"></include>
    <!-- Meetups -->
    <include href="views/adminPartials/meetupsTabContent.php"></include>
    <!-- Student Resources -->
    <include href="views/adminPartials/resourcesTabContent.php"></include>
</div>

<!-- Dismissable error alert -->
<div id="error-alert" class="confirm-alert alert alert-danger fade show mx-auto text-center" role="alert">
    <button type="button" class="close float-right" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <span>Error</span>
</div>

<!-- Success alert -->
<div id="success-alert" class="confirm-alert alert alert-success text-center" role="alert">
    Success!!
</div>


    <!--modals for page-->
<exclude>
    <include href="views/modals/addModal.php"></include>
    <include href="views/modals/updateModal.php"></include>
    <include href="views/modals/deleteModal.php"></include>
    <include href="views/modals/meetupsModal.php"></include>
</exclude>
<!-- Old bootstrap messes up styling of new bootstrap TODO see if we can get rid of this-->
<!--old bootstrap for page (do not delete. will break table. Used for the alerts)-->
<!--<link rel="stylesheet" type="text/css" media="all" href="css/bootstrap.css">-->
<!--needed for table-->
<script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
<!--Needed for modals-->
<!--<script src="js/bootstrap.min.js"></script>-->
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.10.1/bootstrap-table.min.css">
<!-- Latest compiled and minified JavaScript -->
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.10.1/bootstrap-table.min.js"></script>

<!-- WYSIWYG Editor -->
<script src='//cdn.tinymce.com/4/tinymce.min.js'></script>

<!--Admin page javascript-->
<script src="js/adminPage.js"></script>

<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-82389817-1', 'auto');
    ga('send', 'pageview');
</script>

</body>

</html>