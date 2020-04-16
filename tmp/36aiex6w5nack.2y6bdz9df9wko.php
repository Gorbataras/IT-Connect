

<!-- modal-->
<div id="resetPasswordModal" class="modal fade">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h3 class="modal-title">Reset Your Password</h3>
            </div>
            <form id="reset-password-form">
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-12">
                            <h4>Required Information</h4>
                            <p id="email-error" class="hide">Error: Email does not exist.</p>
                            <div class="input-group">
                                <label class="input-group-addon" for="email-reset">Email</label>
                                <input required="required" type="email" class="form-control"
                                       id="email-reset" name="email"/>
                            </div>
                        </div>
                    </div>  <!-- /.End Internship Information-->

                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-secondary">Cancel</button>
                    <button type="submit" value="SUBMIT" class="btn btn-success">Reset Password</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->