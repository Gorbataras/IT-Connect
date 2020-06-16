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

// Show modal to apply for email type internships
$('#postModal').on('shown.bs.modal', function(event) {

    // Clicked internship that triggered the modal
    let internship = $(event.relatedTarget);

    $('#title').html($(internship).find('.title').html());
    $('#company').html($(internship).find('.company-name').html());
    $('#location').html($(internship).find('.location').html());
    $('#description').html($(internship).find('.description').data('description'));

    // Title tag used to hold other data
    let dataContainer = $(internship).find('.title');

    $('#hours').html(dataContainer.data('hours'));
    $('#qualifications').html(dataContainer.data('qualifications'));

    $("#apply_link").attr("href", "mailto:" + dataContainer.data('email'));
});