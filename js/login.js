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
                alert("Error Login In")
            }
        }
    });
});