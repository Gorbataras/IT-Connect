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
 * The modal that displays an internship for a regular user
 */
?>

<!-- modal-->
<div id="postModal" class="modal fade">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 id="title" class="modal-title"></h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-12">
                        <h4>Company</h4>
                        <p id="company"></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <h4>Location</h4>
                        <p id="location"></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <h4>Hours</h4>
                        <p id="hours"></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <h4 class="post-heading">Description</h4>
                        <p id="description"></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <h4 class="post-heading">Qualifications</h4>
                        <p id="qualifications"></p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-secondary">Close</button>
                <a href="#" id="apply_link" class="btn btn-success">Apply</a>
            </div>
        </div>
    </div>
</div>
<!-- /.modal Trigger the modal with a button -->



