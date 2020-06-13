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
<!--header for the page-->
<include href="views/parts/header.php"></include>
<body>
<div id="site-container">

        <div class="container-fluid col-lg-7 mt-5">
            <div class="col-xs-12">
                <div class="wrapper">
                    <form action="/login" id="login-form" class="form-signin" method="post">
                        <h1 class="d-inline-block">Admin Login</h1>

                        <check if="{{ isset(@email) }}">
                            <span class="text-danger">Invalid Login</span>

                        </check>
                        <br>

                        <label class="h4" for="user-email"><i class="fas fa-user-tie"></i> Email:</label>
                        <span class="alert-danger login-span" id="email_err">Enter an Email</span>
                        <input type="text" id="user-email" class="form-control" name="email" placeholder="Enter Email"
                               required autofocus="" value="{{ @email }}"/>
                        <br>

                        <label class="h4" for="user-password"><i class="fas fa-unlock-alt"></i> Password:</label>
                        <span class="alert-danger login-span" id="password_err">Enter an Password</span>
                        <input type="password" id="user-password" class="form-control" name="password"
                               placeholder="Enter Password" required value="{{ @password }}"/>

                        <br>
                        <button class="btn btn-lg btn-success btn-block btn-theme" id="login-button" type="submit">Log in</button>
                    </form>
                </div>
            </div>
        </div>
</div>

<!--footer for the page-->
<!--jquery needed for login (DO NOT DELETE)-->
<script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
<!--admin page javascript-->
<script src="js/login.js"></script>
<include href="views/parts/footer.php"></include>

