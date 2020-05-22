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

    // Update student resources --------------------------------------

    $("#edit-resources-form").on('submit', function(e) {
        e.preventDefault();

        //Server call to edit resources
        $.ajax({
            url: '/api/resources.php',
            type: 'PUT',
            data: {
                body: $('#resources_body').val()
            },
            contentType: 'application/json',
            dataType: 'text',
            success: function(result) {
                // console.log(result);
            }
        });

        $('#resourcesModal').modal('hide');
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
var $resoucesEdit = $('#resources-edit');

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

        tinymce.get('description_update').setContent(row.description);
        $("#hours_update").val(row.hours || 0);
        $("#location_update").val(row.location);
        $("#category_update").val(row.category);
        tinymce.get('qualifications_update').setContent(row.qualifications);

    }
};

/**
 * The edit button in the Bootsrap table
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
        field: 'operate',
        title: 'Actions',
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

    //Get the number of selected rows
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

/**
 * Function to edit resources page
 */
$resoucesEdit.click(function () {
    //Server call to update student resources html
    $.ajax({
        url: '/api/resources.php',
        type: 'GET',
        success: function(result) {
            tinymce.get('resources_body').setContent(result.body);
        }
    });
});


// WYSIWYG Editors -----------------------------------------

tinymce.init({
    selector: '#qualifications',
    plugins: [
        'advlist autolink lists link print preview searchreplace',
        'insertdatetime table contextmenu paste'
    ],
    toolbar: 'undo redo | styleselect | bold italic underline | alignleft aligncenter alignright alignjustify | bullist, numlist | link',
    setup: function(editor) {
        editor.on('change', function() {
            tinymce.triggerSave();
        });
    }
});

tinymce.init({
    selector: '#qualifications_update',
    plugins: [
        'advlist autolink lists link print preview searchreplace',
        'insertdatetime table contextmenu paste'
    ],
    toolbar: 'undo redo | styleselect | bold italic underline | alignleft aligncenter alignright alignjustify | bullist, numlist | link',
    setup: function(editor) {
        editor.on('change', function() {
            tinymce.triggerSave();
        });
    }
});

tinymce.init({
    selector: '#description',
    plugins: [
        'advlist autolink lists link print preview searchreplace',
        'insertdatetime table contextmenu paste'
    ],
    toolbar: 'undo redo | styleselect | bold italic underline | alignleft aligncenter alignright alignjustify | bullist, numlist | link',
    setup: function(editor) {
        editor.on('change', function() {
            tinymce.triggerSave();
        });
    }
});

tinymce.init({
    selector: '#description_update',
    plugins: [
        'advlist autolink lists link print preview searchreplace',
        'insertdatetime table contextmenu paste'
    ],
    toolbar: 'undo redo | styleselect | bold italic underline | alignleft aligncenter alignright alignjustify | bullist, numlist | link',
    setup: function(editor) {
        editor.on('change', function() {
            tinymce.triggerSave();
        });
    }
});

tinymce.init({
    height: "400",
    selector: '#resources_body',
    plugins: [
        'advlist autolink lists link print preview searchreplace',
        'insertdatetime table contextmenu paste'
    ],
    toolbar: 'undo redo | styleselect | bold italic underline | alignleft aligncenter alignright alignjustify | bullist, numlist | link',
    setup: function(editor) {
        editor.on('change', function() {
            tinymce.triggerSave();
        });
    }
});

// WYSIWYG editor configuration for html content
tinymce.init({
    height: "100",
    selector: '.wysiwyg',
    plugins: [
        'advlist autolink lists link print preview searchreplace',
        'insertdatetime table contextmenu paste'
    ],
    toolbar: 'undo redo | styleselect | bold italic underline | alignleft aligncenter alignright alignjustify | bullist, numlist | link',
    setup: function(editor) {
        editor.on('change', function() {
            tinymce.triggerSave();
        });
    }
});

// Makes a POST request for html content belonging to the home page
$('#home-submit').on('click', function () {

    // Gather data from controls
    let alertContent = $($.parseHTML($('#home-alert').val())).text();
    let alertIsShown = $('#alert-is-shown').prop('checked');

    let introContent = $($.parseHTML($('#home-intro').val())).text();
    let introIsShown = $('#intro-is-shown').prop('checked');

    // Collect into array as JSON
    let data = [];
    data.push({page: 'home', contentName: 'alert', html: alertContent, isShown: alertIsShown});
    data.push({page: 'home', contentName: 'intro', html: introContent, isShown: introIsShown});

    let isSaved = true;

    // Make post requests for data
    data.forEach(function(item) {
        $.post('/editContent', item, function(result) {
            if (!result) {
                isSaved = false;
            }
        });
    });

    // Show confirmation
    if (isSaved) {
        alert("Saved Successfully!!")
    }
    else {
        alert("There was an error");
    }
});


