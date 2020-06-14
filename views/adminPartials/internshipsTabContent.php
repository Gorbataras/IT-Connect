<div class="tab-pane fade" id="nav-internships" role="tabpanel" aria-labelledby="nav-internships-tab">
    <h2>Internships</h2>

	<div class="form-group">
		<h4>Header</h4>

		<textarea class="form-control wysiwyg-md" id="internships-intro" name="internships-intro">
				{{ @internshipsHeader[0]['html'] }}
		</textarea>
		<div class="text-center mb-5 mt-4">
			<button id="internships-submit" class="btn btn-success">Save</button>
		</div>
	</div>
	<br>

    <div class="card">
        <div class="card-header">
            <h3>Add Internship</h3>
        </div>
        <div class="card-body">
            <form action="add_internships" id="addInternshipForm" method="post">
                <div class="row">
                    <div class="col-md-12">
                        <h4>Required Information</h4>
                        <!-- error message here-->
                        <div id="validation-error"></div>
                        <!-- post ID-->
                        <input type="hidden" id="post_id" name="id" value="0">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="title">*Position Title</label>
                                    <span class="error text-danger" id="titleError">{{ @titleError }}</span>
                                    <input type="text" class="form-control"
                                           id="title" name="title"/>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="company">*Company</label>
                                    <span class="error text-danger" id="companyError">{{ @companyError }}</span>
                                    <input type="text" class="form-control"
                                           id="company" name="company"/>
                                </div>
                            </div>

                            <br><br>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <span class="d-inline-block mb-2 mr-2">*Application Type:</span>

                                    <div class="form-check form-check-inline">
                                        <input type="radio" name="Application_Type" id="url_checkbox" class="form-check-input" value="url" checked/>
                                        <label for="url_checkbox" class="form-check-label">URL</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input type="radio" name="Application_Type" id="email_checkbox" class="form-check-input" value="email"/>
                                        <label for="email_checkbox" class="form-check-label">Email</label>
                                    </div>

                                    <span class="error text-danger" id="appTypeTextError">{{ @appTypeTextError }}</span>
                                    <input type="text" id="contact_text" class="form-control" name="appTypeText">
                                </div>
                            </div>

                            <br><br>

                            <div class="col-md-12 for-email-post hidden">
                                <div class="form-group">
                                    <label for="description">*Description</label>
                                    <span class="error text-danger" id="descriptionError">{{ @descriptionError }}</span>
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
                                 <div class="form-group">
                                     <label for="hours">Hours Per Week</label>
                                     <input type="number" name="hours" id="hours"
                                            class="form-control">
                                 </div>
                             </div>-->

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="location">*Location</label>
                                    <span class="error text-danger" id="locationError">{{ @locationError }}</span>
                                    <input type="text" name="location" id="location" class="form-control">
                                </div>
                            </div>

                            <br><br>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="category">*Category</label>
                                    <span class="error text-danger" id="categoryError">{{ @categoryError }}</span>
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
                                <div class="form-group">
                                    <label for="qualifications">*Qualifications</label>
                                    <span class="error text-danger" id="qualificationsError">{{ @qualificationsError }}</span>
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

<!--    <form action="deleteInternships" id="deleteInternship" method="post">-->
    <div class="internships-table">
        <div id="toolbar">
            <button type="submit" value="submit" id="delete-btn" class="btn btn-danger"><i class="fas fa-minus-circle"></i> Delete Selected Posts</button>
        </div>
        <!--where admin table is generated-->
        <table id="adminTable"> </table>
    </div>
<!--    </form>-->
</div>
