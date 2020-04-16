<?php
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
 * The modal for an admin to change their password
 */
?>

<!-- modal-->
<div id="changePasswordModal" class="modal fade">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Change Your Password</h3>
            </div>
            <form id="change-password-form">
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-12">
                            <h4>Required Information</h4>
                            <br>
                            <p id="current-password-error" class="password-error hide">Error: Incorrect Current Password.</p>
                            <p id="password-mismatch-error" class="password-error hide">Error: New password does does not match confirm.</p>
                            <div class="input-group">
                                <label class="input-group-addon" for="old-password">Old Password</label>
                                <input required="required" type="password" class="form-control"
                                       id="old-password" name="oldPassword"/>
                            </div>
                            <br>
                            <div class="input-group">
                                <label class="input-group-addon" for="new-password">New Password</label>
                                <input required="required" type="password" class="form-control"
                                       id="new-password" name="newPassword"/>
                            </div>
                            <br>
                            <div class="input-group">
                                <label class="input-group-addon" for="new-password-confirm">Confirm</label>
                                <input required="required" type="password" class="form-control"
                                       id="new-password-confirm" name="newPasswordCR"/>
                            </div>
                        </div>
                    </div>  <!-- /.End Internship Information-->

                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-danger">Cancel</button>
                    <button type="submit" value="SUBMIT" class="btn btn-success">Change Password</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->