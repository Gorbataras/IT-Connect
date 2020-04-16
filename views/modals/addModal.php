<?php
/**
MIT License

Copyright (c) 2018 Michael Lant, Bogdan Pshonyak, Yegor Shemereko, Abdalla M. Abdalla

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
 * The modal for an admin to add a new post into the internships table
 */
?>

<!-- modal-->
<div id="addModal" class="modal fade">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h3 class="modal-title">Adding Internship</h3>
            </div>
            <form id="add-internship-form">
                <div class="modal-body">

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
                </div>

                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-secondary">Cancel</button>
                    <button type="submit" value="SUBMIT" class="btn btn-success">Submit</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->