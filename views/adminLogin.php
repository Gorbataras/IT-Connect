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
 * The page where the site administrator can login to edit internship and resources content
 */
?>
<body>
<div>
    <!--header fot the page-->
    <include href="views/parts/header.php"></include>
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
    <include href="views/modals/resetPasswordModal.php"></include>
    <!--footer for the page-->
    <include href="views/parts/footer.php"></include>
</div>
</body>
<!--old bootstrap for page (do not delete. will break table. Used for the alerts)-->
<link rel="stylesheet" type="text/css" media="all" href="css/bootstrap.css">
<!--jquery needed for login (DO NOT DELETE)-->
<<script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
<!--admin page javascript-->
<script src="js/adminLogin.js"></script>
