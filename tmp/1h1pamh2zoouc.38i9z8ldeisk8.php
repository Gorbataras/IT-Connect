

<!-- modal-->
<div id="updateModal" class="modal fade">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h3 class="modal-title">Update Internship</h3>
            </div>
            <form id="update-internship-form">
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-12">
                            <h4>Required Information</h4>

                            <!-- post ID-->

                            <input type="hidden" id="post_id_update" name="id" value="0">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <label class="input-group-addon" for="title">Position Title</label>
                                        <input required="required" type="text" class="form-control"
                                               id="title_update" name="title"/>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="input-group">
                                        <label class="input-group-addon" for="company">Company</label>
                                        <input required="required" type="text" class="form-control"
                                               id="company_update" name="company"/>
                                    </div>
                                </div>

                                <br><br>

                                <div class="col-md-12">
                                    <div class="input-group ">
                                        <label class="input-group-addon" for="Application_Type">Application Type:
                                            &nbsp
                                            <input type="radio" name="Application_Type" id="url_checkbox_update" value="url"/>&nbsp URL &nbsp
                                            &nbsp
                                            <input type="radio" name="Application_Type" id="email_checkbox_update" value="email"/>&nbsp Email
                                        </label>
                                        <input required="required" id="contact_text_update" type="text" class="form-control" name="Application_Type_Text">
                                    </div>
                                </div>

                                <br><br>

                                <div class="col-md-12">
                                    <div class="input-group">
                                        <label class="input-group-addon" for="description">Description</label>
                                        <textarea class="form-control" name="description" id="description_update"
                                                          rows="5"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>  <!-- /.End Internship Information-->

                    <br>

                    <div class="row ">
                        <div class="col-md-12">
                            <h4>Additional Information</h4>

                            <div class="row">

                                <div class="col-md-6">
                                    <div class="input-group">
                                        <label class="input-group-addon" for="hours">Hours Per Week</label>
                                        <input type="number" name="hours" id="hours_update"
                                               class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="input-group">
                                        <label class="input-group-addon" for="location">Location</label>
                                        <input type="text" name="location" id="location_update" class="form-control">
                                    </div>
                                </div>

                                <br><br>

                                <div class="col-md-6">
                                    <div class="input-group">
                                        <label class="input-group-addon" for="category">Category</label>
                                        <select class="form-control" name="category" id="category_update">
                                            <option value="0" disabled="disabled" selected="selected">Select an
                                                option
                                            </option>
                                            <option value="IT Operations">IT Operations</option>
                                            <option value="Software Development">Software Development</option>
                                            <option value="Networking & Security">Networking & Security</option>
                                        </select>
                                    </div>
                                </div>

                                <br><br>

                                <div class="col-md-12">
                                    <div class="input-group">
                                        <label class="input-group-addon" for="qualifications">Qualifications</label>
                                            <textarea name="qualifications" id="qualifications_update" rows="4"
                                                      class="form-control"></textarea>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-secondary">Cancel</button>
                    <button type="submit" value="SUBMIT" class="btn btn-success">Update</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->