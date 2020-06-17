/**
 MIT License

 Copyright (c) 2018 Michael Lant, Bogdan Pshonyak, Yegor Shemereko, Abdalla M. ABdalla

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
 * This file contains all the javascript written for the admin page
 */

/**
 * A function for ajax
 */
$(function() {

    // Add post --------------------------------------------------

    $('input[name="Application_Type"]').on('change', function(e) {
        $('.for-email-post').toggleClass('hidden');
    });

    $("#add-internship-form").on('submit', function(e) {
        e.preventDefault();

        $.ajax({
            url: "/api/posts.php",
            type: 'POST',
            data: $('#add-internship-form').serialize(),
            success: function(data) {
                // Refresh table to display new post

                if (data != '') {
                    var text = '';
                    for (var i = 0; i < data.length; i++) {
                        text += "<div class=\"alert alert-danger form-errors\" role=\"alert\"> <span class=\"glyphicon glyphicon-exclamation-sign\" aria-hidden=\"true\"></span> <span class=\"sr-only\">Error:</span>" + data[i] + "</div>"

                    }
                    $("#validation-error").html(text);
                    //console.log(data);

                    $('#addModal').modal('hide');

                } else {
                    //Clear form
                    $('#add-internship-form').trigger("reset");

                    $('#addModal').modal('hide');
                }

                $table.bootstrapTable('refresh', {
                    silent: true
                });
            }
        });



    });

    // Update post ------------------------------------------------

    $("#update-internship-form").on('submit', function(e) {
        e.preventDefault();

        //Server call to delete post
        $.ajax({
            url: '/api/posts.php',
            type: 'PUT',
            data: $('#update-internship-form').serialize(),
            contentType: 'application/json',
            dataType: 'text',
            success: function(result) {
                // Refresh table to display new post
                $table.bootstrapTable('refresh', {
                    silent: true
                });
            }
        });

        $('#updateModal').modal('hide');
    });

    // Change password --------------------------------------------

    $("#change-password-form").on('submit', function(e) {
        e.preventDefault();

        //Server call to update password
        $.ajax({
            url: '/api/user.php',
            type: 'PUT',
            data: $('#change-password-form').serialize(),
            contentType: 'application/json',
            dataType: 'text',
            success: function(result) {
                console.log(result);
                if (result == "true") {
                    $('#change-password-form').trigger("reset");
                    $('#changePasswordModal').modal('hide');
                    $('#change-alert-success').removeClass('hide');
                } else {
                    $('#current-password-error').removeClass('hide');
                }
            }
        });
    });

    // add new user ---------------------------------------------------

    $("#new-user-form").on('submit', function(e) {
        e.preventDefault();

        //Server call to update password
        $.ajax({
            url: '/api/user.php',
            type: 'ADD',
            data: $('#new-user-form').serialize(),
            contentType: 'application/json',
            dataType: 'text',
            success: function(result) {
                console.log(result);
                if (result == "true") {
                    /*$('#change-password-form').trigger("reset");*/
                    $('#addUserModal').modal('hide');
                    alert("New user added. Check entered email for password");
                } else {
                    alert("ERROR: user NOT ADDED");
                }
            }
        });
    });
});

// Admin table ------------------------------------------------

var $table = $('#adminTable');
var $delete = $('#delete-btn');
var $confirmDelete = $('#delete-confirm-btn');
var $changePWLink = $('#change-password-link');
var $closeAlertBtn = $('#close-change-alert');

/**
 * Fills in all the fields in the Update-Post modal
 * @type {{[click .edit]: Window.operateEvents.'click .edit'}}
 */
window.operateEvents = {
    'click .edit': function(e, value, row, index) {

        $("#updateModal").modal("show");

        //Populate from inputs with row data
        $("#post_id_update").val(row.post_id);
        $("#title_update").val(row.title);
        $("#company_update").val(row.company);

        if (row.url && row.url !== "") {
            $("#url_checkbox_update").prop("checked", true);
            $("#contact_text_update").val(row.url);
        } else {
            $("#email_checkbox_update").prop("checked", true);
            $("#contact_text_update").val(row.email);
        }

        if (row.description != null) {
            tinymce.get("description_update").setContent(row.description);
        }

        $("#hours_update").val(row.hours || 0);
        $("#location_update").val(row.location);
        $("#category_update").val(row.category);

        if (row.qualifications != null) {
            tinymce.get("qualifications_update").setContent(row.qualifications);
        }
    }
};

/**
 * The edit button in the Bootstrap table
 * @param value
 * @param row
 * @param index
 * @returns {string}
 */
function operateFormatter(value, row, index) {
    return [
        '<a class="edit" href="javascript:void(0)" title="Edit">',
        '<i class="fas fa-edit"></i>',
        '</a>  '
    ].join('');
}

/**
 * Bootstrap table configurations
 */
$table.bootstrapTable({
    url: '/api/posts.php',
    pagination: true,
    striped: true,
    toolbar: "#toolbar",
    sortName: 'post_date_primary',
    sortOrder: "desc",
    search: true,
    columns: [{
        field: "state",
        dataField: "selected",
        checkbox: true
    }, {
        field: 'title',
        title: 'Title',
        sortable: true
    }, {
        field: 'company',
        title: 'Company',
        sortable: true
    }, {
        field: 'category',
        title: 'Category',
        sortable: true
    }, {
        field: 'location',
        title: 'Location',
        sortable: true
    }, {
        field: 'post_date',
        title: 'Date Posted',
        sortable: true
    }, {
        // added for posting order
        // removes problem of january posting dates
        // column is hidden from table but is used for sorting i.e. sortNam: post_date_primary
        visible: false,
        field: 'post_date_primary',
         title: 'TEST Posted',
        sortable: true
    },{
        title: 'Actions',
        field: 'operate',
        align: 'center',
        events: operateEvents,
        formatter: operateFormatter
    }],
    onClickRow: function(row, elm) {
        //...
    }
});

// Delete table row(s) ---------------------------------------

/**
 * This function deletes table rows
 */
$delete.click(function() {
    // //Get the number of selected rows
    var numberOfSelections = $.map($table.bootstrapTable('getSelections'), function(row) {
        if (row) {
            return row;
        }

    }).length;

    //Prevent modal from showing if no rows are selected
    if (numberOfSelections > 0) {
        $("#deleteModal").modal("show");
    }
});

/**
 * This function makes sure that the user did not misclick and confirms the deletion
 */
$confirmDelete.click(function() {
    var ids = $.map($table.bootstrapTable('getSelections'), function(row) {

        var id = row.post_id;

        console.log(id);

        //Server call to delete post
        $.ajax({
            url: '/api/posts.php',
            type: 'DELETE',
            data: {
                id: id
            },
            contentType: 'application/json',
            dataType: 'text',
            success: function(result) {
                // Do something with the result
                console.log(result);
            }
        });

        return id;
    });
    $table.bootstrapTable('remove', {
        field: 'post_id',
        values: ids
    });

    $('#deleteModal').modal('hide');
});

/**
 * Show the change-password modal
 */
$changePWLink.click(function() {
    $("#changePasswordModal").modal("show");
});

$closeAlertBtn.click(function() {
    $('#change-alert-success').addClass('hide');
});


//region /****** WYSIWYG Editors ******/

// Common WYSIWYG plugins and toolbar items
const PLUGINS = [
    'advlist autolink lists link print preview searchreplace',
    'insertdatetime table contextmenu paste textcolor colorpicker image'
];

const TOOLBAR = 'undo redo | styleselect | fontsizeselect fontselect | forecolor backcolor | bold italic underline | alignleft aligncenter alignright alignjustify |'
        + ' indent outdent | bullist, numlist | link | image';


// Small height WYSIWYG initialization
tinymce.init({
    height: "100",
    selector: '.wysiwyg-sm',
    plugins: PLUGINS,
    toolbar: TOOLBAR,
    setup: function(editor) {
        editor.on('change', function() {
            tinymce.triggerSave();
        });
    }
});

// Medium height WYSIWYG initialization
tinymce.init({
    height: "200",
    selector: '.wysiwyg-md',
    plugins: PLUGINS,
    toolbar: TOOLBAR,
    setup: function(editor) {
        editor.on('change', function() {
            tinymce.triggerSave();
        });
    }
});

// Large height WYSIWYG initialization
tinymce.init({
    height: "400",
    selector: '.wysiwyg-lg',
    plugins: PLUGINS,
    toolbar: TOOLBAR,
    setup: function(editor) {
        editor.on('change', function() {
            tinymce.triggerSave();
        });
    }
});
//endregion

//region /****** Ajax ******/

// Logo Ajax
$('#logo-upload').on('submit',
    function(e) {
        e.preventDefault();
        let formData = new FormData(this);

        $.ajax({
            type:'POST',
            url: this.action,
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success:function(result){

                // Show confirmation
                if (result.length === 0) {
                    showSuccessAlert("Uploaded Successfully!!");
                }
                else {
                    $('#error-alert > span').html(result);
                    $('#error-alert').show();
                }
            },
            error: function(data){
                showErrorAlert("An error prevented the photo from uploading")
            }
        });
    }
);

// Medium blog source AJAX
$('#medium-blog-submit').on('click', function() {
    let blogSourceName = $('#medium-blog-link').val();

    $.post('/updateApiSource', {blogSourceName: blogSourceName},
        function(result) {

            // Show confirmation if no errors
            if (result.length === 0) {
                showSuccessAlert("Saved Successfully!!");
            }
            else {
                showErrorAlert(result);
            }
        }
    );
});

// Add user login
$('#add-user-form').on('submit',
    function(e) {
        e.preventDefault();

        $.post(this.action, $(this).serialize(),
            function(result) {
                // Show confirmation if no errors
                if (result.length === 0) {
                    showSuccessAlert("User Added Successfully!!");
                }
                else {
                    showErrorAlert(result);
                }
            }
        );
    }
);

// Add Meetup source AJAX
$('#add-meetup').on('submit',
    function(e) {
        e.preventDefault();

        let groupName = $(this).find('#new-group').first().val();

        $.post(this.action, $(this).serialize(),
            function(result) {

                // Show confirmation if no errors
                if (result.length === 0) {
                    addToMeetupList(groupName);
                }
                else {
                    showErrorAlert(result);
                }
            }
        );
    }
);


/**
 * Adds Meetup group item to the Meetup group list
 * @param meetupGroup Meetup group string to add
 */
function addToMeetupList(meetupGroup) {
    $('#meetup-group-list').append(
        `<li class="list-group-item">
                <form class="form-group delete-meetup" action="/deleteMeetupGroup" method="post">
                    <div class="row">
                        <div class="col">
                            <p class="h5">${meetupGroup}</p>
                        </div>
                        <div class="col text-right">
                            <button class="btn" type="submit">&#128465;</button>
                            <input name="entry" type="text" value="${meetupGroup}" hidden>
                        </div>
                    </div>
                </form>
            </li>`
    );

    // Add delete event handler to form
    $('#meetup-group-list li:last-child form').on('submit',
        function(e) {
            deleteMeetup(e, this);
        }
    );
}


// Delete Meetup source AJAX
$('.delete-meetup').on('submit',
    function(e) {
        deleteMeetup(e, this);
    }
);


/**
 * Deletes Meetup group from database and from the Meetup group list
 * @param e event object
 * @param form the form to submit
 */
function deleteMeetup(e, form) {
    e.preventDefault();

    $.post(form.action, $(form).serialize(),
        function(result) {

            // Remove list item if successful
            if (result.length === 0) {
                $(form).parent().remove();
            }
            else {
                showErrorAlert(result);
            }
        }
    );
}

// Homepage alert AJAX
$('#home-alert-submit').on('click', function() {
    let alertContent = $('#home-alert').val();
    let alertIsShown = $('#alert-is-shown').prop('checked');

    let htmlContent = {page: 'home', contentName: 'alert', html: alertContent, isShown: alertIsShown};
    postHtmlContent(htmlContent);
});

// Homepage intro AJAX
$('#home-intro-submit').on('click', function() {
    let introContent = $('#home-intro').val();
    let introIsShown = $('#intro-is-shown').prop('checked');

    let htmlContent = {page: 'home', contentName: 'intro', html: introContent, isShown: introIsShown};
    postHtmlContent(htmlContent);
});

// Resources page AJAX
$('#resources-submit').on('click', function() {
    let htmlContent = {page: 'resources', contentName: 'page', html: $('#resources-page').val(), isShown: 'true'};
    postHtmlContent(htmlContent);
});

// Website title AJAX
$('#site-title-submit').on('click', function() {
    let htmlContent = {page: 'header', contentName: 'title', html: $('#site-title').val(), isShown: 'true'};
    postHtmlContent(htmlContent);
});

//Website nav link AJAX
$('#site-nav-link-submit').on('click', function() {
    let htmlContent = {page: 'site', contentName: 'linkEdit', html: $('#nav-link').val(), isShown: $('#link-is-shown').prop('checked')};
    postHtmlContent(htmlContent);
});

// Events title AJAX
$('#events-submit').on('click', function() {
	let htmlContent = {page: 'events', contentName: 'events', html: $('#events-intro').val(), isShown: 'true'};
	postHtmlContent(htmlContent);
});

// Internships title AJAX
$('#internships-submit').on('click', function() {
	let htmlContent = {page: 'internships', contentName: 'internships', html: $('#internships-intro').val(), isShown: 'true'};
	postHtmlContent(htmlContent);
});

// Site's colors AJAX
$('#color_button').on('click', function() {
    let color1 = $('#color1').val();
    let color2 = $('#color2').val();
    let color3 = $('#color3').val();

    $.post('/setColor', {color1: color1,color2: color2,color3: color3 },
        function(result) {

            // Show confirmation if no errors
            if (result.length === 0) {
                showSuccessAlert("Saved Successfully!!");
            }
            else {
                showErrorAlert(result);
            }
        }
    );
});


/**
 * Posts to server html content to be saved
 * @param htmlContent object of content to be saved {pageName, contentName, html, isShown}
 */
function postHtmlContent(htmlContent) {
    $.post('/editHtmlContent', {htmlContent: htmlContent},
        function(result) {

            // Show confirmation if no errors
            if (result.length === 0) {
                showSuccessAlert("Saved Successfully!!");
            }
            else {
                showErrorAlert(result);
            }
        }
    );
}

//endregion


/**
 * Shows an error message as an alert
 * @param message error to be displayed
 */
function showErrorAlert(message) {
    $('#error-alert > span').html(message);
    $('#error-alert').fadeIn(250);
}


/**
 * Displays a confirmation message that briefly appears as an alert
 * @param message confirmation text to display
 */
function showSuccessAlert(message) {
    $('#success-alert').html(message);
    $('#success-alert').fadeIn(250).delay(1200).fadeOut(250);
}

// Hide alert with when cancel button is clicked
$('#error-alert button').on('click', function() {
    $(this).parent().fadeOut(250);
});


/**
 * The following script determines if any errors have been reported, if so then appropriate
 * messages will show on input fields that are missing content.
 */
$('#addInternshipForm').on('submit', function(e) {
    $(".error").hide();
    e.preventDefault();
    $.ajax({
        url: this.action,
        type: 'POST',
        data: $(this).serialize(),
        success: function(result) {
            if(result.length === 0) {
                showSuccessAlert("Success");
                $table.bootstrapTable('refresh', {
                    silent: true
                });
            }
            else {
                result = JSON.parse(result);
                for (let key in result) {
                    $('#' + key).html(result[key]);
                    $('#' + key).show();
                }
            }
        }
    });
});
