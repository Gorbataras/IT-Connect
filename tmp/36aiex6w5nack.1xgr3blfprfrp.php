
<!--header for the page-->
<?php echo $this->render('views/parts/header.php',NULL,get_defined_vars(),0); ?>

<!--navbar-->
<?php echo $this->render('views/parts/navbar.php',NULL,get_defined_vars(),0); ?>

<body>
<div id="site-container">

    <form name="login" class="main-form" method="post">
        <h1>Admin Login</h1>
        <div class="container">
            <div class="alert alert-info" role="alert">
                This page is using Gatorlock
            </div>
        </div>
        <div class="container">
            <!--gator lock registration php inserted here for showing errors here-->
            <?php echo $this->render('gatorLock/gatorLockLogin.php',NULL,get_defined_vars(),0); ?>
            <div class="form-group">
                <label for="email-id">Email Address</label>
                <input type="email" class="form-control" name="email-id" id="email-id" aria-describedby="emailHelp"
                       placeholder="Enter Gatorlock Email" required>
            </div>
            <div class="form-group">
                <label for="password-id">Password</label>
                <input type="password" class="form-control" name="password-id" id="password-id"
                       placeholder="Enter Gatorlock Password" required>
            </div>
            <div class="form-group">
                <a href="http://gatorlock.greenrivertech.net/requestForReset" target="_blank">reset password</a>
            </div>
            <button type="submit" name="login" id="login" class="btn btn-lg btn-primary">Submit</button>
            <!--<a href="http://gatorlock.greenrivertech.net/register" class="btn btn-lg btn-secondary float-right">Create a GatorLock account</a>-->
        </div>
    </form>

</div>

<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

</body>

