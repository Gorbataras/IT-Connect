/**
 MIT License

 Copyright (c) 2016 Michael Lant, Bogdan Pshonyak, Yegor Shemereko

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
 * This is all the javasript needed for Admin Login page to operate
 */

/**
 * Linking Password reset link to code
 * @type {*|jQuery|HTMLElement}
 */
$resetLink = $("#reset-password-link");

/**
 * Linking reset button to code.
 * @type {*|jQuery|HTMLElement}
 */
$resetBtn = $("#submit-reset");

/**
 * If reset-password-link clicked bring down a modal
 */
$resetLink.click(function () {
    $("#resetPasswordModal").modal("show");
});

/**
 * The function that handles the submit from the login form
 */
$("#login-form").on("submit", function (e) {

    e.preventDefault();

    var username = $("#user-email").val();
    var password = $("#user-password").val();

    $.ajax({
        url: '/api/user.php',
        type: 'POST',
        data: {
            username: username,
            password: password
        },
        success: function(result) {
            // result will be false if the call failed and true otherwise.
            if(result !== false){
                //Redirect
                window.location = "adminPage";
            } else {
                $("#login-error").removeClass("hide");
            }
        }
    });

});

/**
 * The function that handles the change password form
 */
$("#reset-password-form").on("submit", function (e) {

    e.preventDefault();

    var email = $("#email-reset").val();

    $.ajax({
        url: '/api/user.php',
        type: 'PUT',
        data: {
            email: email
        },
        contentType: 'application/json',
        dataType: 'text',
        success: function(result) {
            // result will be false if the call failed and true otherwise.
            console.log(result);
            if(result != "false"){
                $("#resetPasswordModal").modal("hide");
                $("#reset-alert-success").removeClass("hide");
            } else {
                $("#email-error").removeClass("hide");
            }
        }
    });

});
