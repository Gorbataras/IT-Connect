
<body>
<div id="site-container">
    <!--header fot the page-->
    <?php echo $this->render('views/parts/header.php',NULL,get_defined_vars(),0); ?>
        <div id="reset-alert-success" role="alert" class="alert hide">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Success!</strong> Check your email for your new password.
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="wrapper">
                    <form id="login-form" class="form-signin">
                        <h1>Admin Login</h1>
                        <p id="login-error" class="hide">Error: Email or password incorrect.</p>
                        <h4><i class="fas fa-user-tie"></i> Email:</h4>
                        <input type="text" id="user-email" class="form-control" name="username" placeholder="Enter Email" required="" autofocus=""/>
                        <br>
                        <h4><i class="fas fa-unlock-alt"></i> Password:</h4>
                        <input type="password" id="user-password" class="form-control" name="password" placeholder="Enter Password" required=""/>

                        <p id="reset-password-link">Reset Your Password</p>
                        <button class="btn btn-lg btn-success btn-block btn-theme" id="login-button" type="submit">Log in</button>
                    </form>
                </div>
            </div>
        </div>
    <!--password reset modal-->
    <?php echo $this->render('views/modals/resetPasswordModal.php',NULL,get_defined_vars(),0); ?>
    <!--footer for the page-->
    <?php echo $this->render('views/parts/footer.php',NULL,get_defined_vars(),0); ?>
</div>
</body>
<!--old bootstrap for page (do not delete. will break table. Used for the alerts)-->
<link rel="stylesheet" type="text/css" media="all" href="css/bootstrap.css">
<!--jquery needed for login (DO NOT DELETE)-->
<<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
<!--admin page javascript-->
<script src="js/adminLogin.js"></script>
