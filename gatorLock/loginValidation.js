$(document).ready(function() {
    // remove any old validation messages
    removeErrorDivs();

    $('button[type="submit"]').on("click", validate);
});

function validate(event) {
    // prevent the form from submitting to result.php
    event.preventDefault();

    // remove any old validation messages
    removeErrorDivs();

    // validate each field
    let isError = false;

    //employee id - must be exactly 10 characters
    let email = $("#email-id").val();
    // check to see if field is empty
    if (email === ''){
        reportError("email-id-error", "email address cannot be empty");
        isError = true;
    }

    // password validation

    // regex for paswword
    $passwordRegex = '/^(?=.*[0-9])(?=.*[a-z])(?=^.{8,16}$)(?=.*[!@#\\$%\\^&\\*])/';


    let password = $("#password-id").val();

    if (password === ''){
        reportError("password-id-error",
            "password cannot be empty");
        isError = true;
    }
    // check to see if field is empty
    if (!password.search($passwordRegex) || email === ''){
        reportError("general-id-error",
            "UserName or password not Found");
        isError = true;
    }

    // submit the form if appropriate
    if (!isError){
        $("#login").submit();
    }

}

function reportError(id, message) {
    let warningDiv = "#" + id;
    let warningText = "#" + id + " span";
    $(warningDiv).show();
    $(warningText).html(message);
}

function removeErrorDivs() {
    let divs = ["#email-id-error", "#password-id-error", "#general-id-error"];

    for (let i = 0; i < divs.length; i++){
        $(divs[i]).hide();
    }
}
