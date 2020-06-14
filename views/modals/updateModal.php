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
 * The modal for an admin to edit a post.
 */
?>

<!-- modal-->
<div id="updateModal" class="modal fade">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Update Internship</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
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
                                    <div class="form-group">
                                        <label for="title">Position Title</label>
                                        <input required="required" type="text" class="form-control"
                                               id="title_update" name="title"/>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="company">Company</label>
                                        <input required="required" type="text" class="form-control"
                                               id="company_update" name="company"/>
                                    </div>
                                </div>

                                <br><br>

                                <div class="col-md-12">
                                    <div class="form-group ">
                                        <label for="Application_Type">Application Type:
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
                                    <div class="form-group">
                                        <label for="description">Description</label>
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
                                    <div class="form-group">
                                        <label for="location">Location</label>
                                        <input type="text" name="location" id="location_update" class="form-control">
                                    </div>
                                </div>

                                <br><br>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="category">Category</label>
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
                                    <div class="form-group">
                                        <label for="qualifications">Qualifications</label>
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