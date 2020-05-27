<div class="tab-pane fade" id="nav-internships" role="tabpanel" aria-labelledby="nav-internships-tab">
    <h2>Internships</h2>
    <div class="card">
        <div class="card-header">
            <h3>Add Internship</h3>
        </div>
        <div class="card-body">
            <form>
                <div class="row">
                    <div class="col-md-12">
                        <h4>Required Information</h4>
                        <!-- error message here-->
                        <div id="validation-error"></div>
                        <!-- post ID-->
                        <input type="hidden" id="post_id" name="id" value="0">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <label class="input-group-addon" for="title">Position Title</label>
                                    <input required="required" type="text" class="form-control"
                                           id="title" name="title"/>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="input-group">
                                    <label class="input-group-addon" for="company">Company</label>
                                    <input required="required" type="text" class="form-control"
                                           id="company" name="company"/>
                                </div>
                            </div>

                            <br><br>

                            <div class="col-md-12">
                                <div class="input-group ">
                                    <label class="input-group-addon" for="Application_Type">Application Type:
                                        &nbsp
                                        <input type="radio" name="Application_Type" id="url_checkbox" value="url" checked=""/>&nbsp URL &nbsp
                                        &nbsp
                                        <input type="radio" name="Application_Type" id="email_checkbox" value="email"/>&nbsp Email
                                    </label>
                                    <input required="required" type="text" id="contact_text" class="form-control" name="Application_Type_Text">
                                </div>
                            </div>

                            <br><br>

                            <div class="col-md-12 for-email-post hidden">
                                <div class="input-group">
                                    <label class="input-group-addon" for="description">Description</label>
                                    <textarea class="form-control" name="description" id="description"
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

                            <!-- <div class="col-md-6">
                                 <div class="input-group">
                                     <label class="input-group-addon" for="hours">Hours Per Week</label>
                                     <input type="number" name="hours" id="hours"
                                            class="form-control">
                                 </div>
                             </div>-->

                            <div class="col-md-6">
                                <div class="input-group">
                                    <label class="input-group-addon" for="location">Location</label>
                                    <input type="text" name="location" id="location" class="form-control">
                                </div>
                            </div>

                            <br><br>

                            <div class="col-md-6">
                                <div class="input-group">
                                    <label class="input-group-addon" for="category">Category</label>
                                    <select class="form-control" name="category" id="category">
                                        <option value="0" disabled="disabled" selected="selected">Select an
                                            option
                                        </option>
                                        <!--<option value="IT Operations">IT Operations</option>-->
                                        <option value="Software Development">Software Development</option>
                                        <option value="Networking & Security">Networking & Security</option>
                                    </select>
                                </div>
                            </div>

                            <br><br>

                            <div class="col-md-12 for-email-post hidden">
                                <div class="input-group">
                                    <label class="input-group-addon" for="qualifications">Qualifications</label>
                                    <textarea name="qualifications" id="qualifications" rows="4"
                                              class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" value="SUBMIT" class="btn btn-success">Submit</button>
                </div>
            </form>
        </div>
    </div>
    <br>

    <h3>All Internships</h3>
    <hr>

    <div class="internships-table">

        <div id="toolbar">
            <button id="delete-btn" class="btn btn-danger"><i class="fas fa-minus-circle"></i> Delete Selected Posts</button>
        </div>
        <!--where admin table is generated-->
        <table id="adminTable"> </table>
    </div>
</div>