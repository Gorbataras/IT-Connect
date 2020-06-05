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
 * The is the header which contains the navbar, and all the css files for each page
 */
?>
<!DOCTYPE html>
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

    <!-- Responsive design -->
    <meta name="viewport" content="width=device-width, initial-scale=1 , maximum-scale=1">
    <meta charset="utf-8">
    <meta name="description" content="IT Connect helps students discover technical internships in the Seattle-Tacoma region,
                                            and provides curated career preparation resources for improving resumes and LinkedIn profiles.">
    <meta name="keyword" content="ITconnect, IT Connect, Green River College, GRC, GRC IT Connect, GRC ITconnect,
                                        Internships, Internship, Student, College, Software, Software Development, IT,
                                        Information Technology">

    <!--icon image-->
    <link rel="shortcut icon" type="image/x-icon" href="../../assets/img/logo.png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>{{ @siteTabTitle }}: A resource for technology students.</title>

    <!--header css-->
    <link rel="stylesheet" type="text/css" media="all" href="css/header.css">
    <!--footer css-->
    <link rel="stylesheet" type="text/css" media="all" href="css/footer.css">
    <!--introduction page css-->
    <link rel="stylesheet" type="text/css" media="all" href="css/introduction.css">
    <!--internship page css-->
    <link rel="stylesheet" type="text/css" media="all" href="css/internships.css">
    <!--student resources page css-->
    <link rel="stylesheet" type="text/css" media="all" href="css/resources.css">
    <!--admin login css-->
    <link rel="stylesheet" type="text/css" media="all" href="gatorLock/gatorLockStyles.css">
    <!-- upcoming events css-->
    <link rel="stylesheet" href="css/upcomingEvents.css">
    <!--bootstrap table-->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.10.1/bootstrap-table.min.css">
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
    <!-- Fontawesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
</head>
