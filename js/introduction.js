/**
 * Controls features and events of the home page
 *
 * @author Chad Drennan
 * @author Rajpreet Dhaliwal
 * 2020-5-7
 */

// Closes the alert box
var close = document.getElementsByClassName("closebtn");
var i;

for (i = 0; i < close.length; i++) {
    close[i].onclick = function () {
        var div = this.parentElement;
        div.style.opacity = "0";
        setTimeout(function () {
            div.style.display = "none";
        }, 600);
    }
}

$('#postModal').on('shown.bs.modal', function () {
    $('#postModal #').trigger('focus')
})