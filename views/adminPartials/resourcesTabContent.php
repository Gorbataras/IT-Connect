<div class="tab-pane fade" id="nav-resources" role="tabpanel" aria-labelledby="nav-resources-tab">
    <h2>Student Resources</h2>

    <!-- Page Content WYSIWYG-->
    <div class="form-group">
        <label for="resources-page">Page Content</label>
        <textarea class="form-control wysiwyg-lg" id="resources-page" name="resources-page">
            {{ @resourcesContent['page']['html'] }}
        </textarea>
    </div>

    <!-- Submit -->
    <div class="text-center mb-5 mt-4">
        <button id="resources-submit" class="btn btn-success">Save</button>
    </div>
</div>
