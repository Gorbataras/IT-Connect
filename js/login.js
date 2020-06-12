/**
 * The function that handles the submit from the login form
 */
$("#login-button").on("click", function () {

    var username = $("#user-email").val();
    var password = $("#user-password").val();
    if((username.length) === 0){
        $('#email_err').show();
        return;
    }

    if((password.length) === 0){
        $('#password_err').show();
        return;
    }

        $.post('/login', {email: username,password: password}, function(result) {
            // result will be false if the call failed and true otherwise.
            if(!result){
                //Redirect
                window.location = "adminPage";
            } else {
                alert("Error Login In")
            }
        });
});