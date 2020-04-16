
<!--header for the page-->
<?php echo $this->render('views/parts/header.php',NULL,get_defined_vars(),0); ?>

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
                <a class="nav-link" href="adminPage"><i class="fas fa-hand-point-left"></i> Back<span class="sr-only">(current)</span></a>
            </li>
        </ul>
        <ul class="navbar-nav navbar-right">
            <li class="nav-item">
                <a class="nav-link" href="Logout" id="logout"><i class="fas fa-sign-out-alt"></i> LogOut<span class="sr-only">(current)</span></a>
            </li>
        </ul>
    </div>
</nav>

<div id="site-container">
    <form method="post" name="register" class="main-form">
        <h1>Admin Registration</h1>
        <div class="container">
            <div class="alert alert-info" role="alert">
                Create a new admin user
            </div>
        </div>
        <div class="container">

            <!--gatorlock registration php inserted here-->
            <?php echo $this->render('gatorLock/gatorLockRegister.php',NULL,get_defined_vars(),0); ?>
            <div class="form-group">
                <label for="email-id">Email address</label>
                <input type="email" class="form-control" name="email-id" id="email-id" aria-describedby="emailHelp" placeholder="Enter Email" required>
            </div>
            <div class="form-group">
                <label for="password-id">Password</label>
                <input type="password" class="form-control" name="password-id" id="password-id" placeholder="Enter Password" required>
           </div>
            <div class="form-group">
                <label for="firstName-id">First Name</label>
                <input type="text" class="form-control" name="firstName-id" id="firstName-id" placeholder="Enter First Name" required>
            </div>
            <div class="form-group">
                <label for="lastName-id">Last Name</label>
                <input type="text" class="form-control" name="lastName-id" id="lastName-id" placeholder="Enter Last Name" required>
           </div>
            <button type="submit" id="register" name="register" class="btn btn-lg btn-primary">Submit</button>
        </div>
    </form>

</div>

</body>

