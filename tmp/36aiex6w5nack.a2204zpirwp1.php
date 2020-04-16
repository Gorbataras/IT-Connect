
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

    <meta charset="utf-8" http-equiv="encoding">

    <title>IT Connect: A resource for technology students.</title>

    <!-- Responsive design -->
    <meta name="viewport" content="width=device-width, initial-scale=1 , maximum-scale=1">

    <meta name="description" content="IT Connect helps students discover technical internships in the Seattle-Tacoma region,
                                            and provides curated career preparation resources for improving resumes and LinkedIn profiles.">
    <meta name="keyword" content="ITconnect, IT Connect, Green River College, GRC, GRC IT Connect, GRC ITconnect,
                                        Internships, Internship, Student, College, Software, Software Development, IT,
                                        Information Technology">

    <!--icon image-->
    <link rel="shortcut icon" type="image/x-icon" href="http://itconnect.greenrivertech.net/assets/img/grtech.jpg">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">
    <!--header css-->
    <link rel="stylesheet" type="text/css" media="all" href="css/header.css">
    <!--admin page css-->
    <link rel="stylesheet" type="text/css" media="all" href="css/admin-page.css">

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>

    <!-- Fontawesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
</head>

<body>

<!--navigation bar for the admin page only-->
<nav class="navbar navbar-expand-lg navbar-dark bg-success">
    <a class="navbar-brand" href="/"><img src="http://itconnect.greenrivertech.net/assets/img/grtech.jpg" class="img-responsive" style="height: 50px; width: 50px;"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="#" id="post-submit" data-toggle="modal" data-target="#addModal"><i class="fas fa-plus-circle"></i> Add Internships<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" id="resources-edit" data-toggle="modal" data-target="#resourcesModal"><i class="fas fa-info-circle"></i> Edit Student Resources<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="http://gatorlock.greenrivertech.net/requestForReset" target="_blank"><i class="fab fa-stack-exchange"></i> Change Password<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="register"><i class="fas fa-user-tag"></i> Create User<span class="sr-only">(current)</span></a>
            </li>
        </ul>
        <ul class="navbar-nav navbar-right">
            <li class="nav-item">
                <a class="nav-link" href="Logout" id="logout"><i class="fas fa-sign-out-alt"></i> LogOut<span class="sr-only">(current)</span></a>
            </li>
        </ul>
    </div>
</nav>

<?php echo $this->render('gatorLock/gatorLockLogin.php',NULL,get_defined_vars(),0); ?>

    <div id="body-content">
        <div class="internships-table">
            <div id="toolbar">
                <button id="delete-btn" class="btn btn-danger"><i class="fas fa-minus-circle"></i> Delete Selected Posts</button>
            </div>
            <!--where admin table is generated-->
            <table id="adminTable"> </table>
        </div>
    </div>

    <!--modals for page-->
    <?php echo $this->render('views/modals/addModal.php',NULL,get_defined_vars(),0); ?>
    <?php echo $this->render('views/modals/updateModal.php',NULL,get_defined_vars(),0); ?>
    <?php echo $this->render('views/modals/deleteModal.php',NULL,get_defined_vars(),0); ?>
    <?php echo $this->render('views/modals/resourcesModal.php',NULL,get_defined_vars(),0); ?>


<!--old bootstrap for page (do not delete. will break table. Used for the alerts)-->
<link rel="stylesheet" type="text/css" media="all" href="css/bootstrap.css">
<!--needed for table-->
<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
<!--Needed for modals-->
<script src="js/bootstrap.min.js"></script>
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