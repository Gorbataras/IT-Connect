<div class="tab-pane fade" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
    <h2>Home</h2>
    <br>

    <div class="form-group">
        <div class="custom-control custom-switch float-right">
            <input type="checkbox" class="custom-control-input" id="alert-is-shown"
            <check if="{{ @homeContent['alert']['isShown'] == 1 }}">
                checked
            </check>
            >
            <label class="custom-control-label" for="alert-is-shown">Show Alert</label>
        </div>
        <label for="home-alert">Alert Message</label>
        <textarea class="form-control wysiwyg" name="home-alert" id="home-alert"
                  cols="30" rows="3">{{ @homeContent['alert']['html'] }}</textarea>
    </div>
    <br>
    
    <div class="form-group">
        <div class="custom-control custom-switch float-right">
            <input type="checkbox" class="custom-control-input" id="intro-is-shown"
            <check if="{{ @homeContent['intro']['isShown'] == 1 }}">
                checked
            </check>
            >
            <label class="custom-control-label" for="intro-is-shown">Show Intro</label>
        </div>
        <label for="home-intro">Introduction</label>
        <textarea class="form-control wysiwyg" id="home-intro" name="home-intro"
                  cols="30" rows="3">{{ @homeContent['intro']['html'] }}</textarea>
    </div>

    <div class="form-group">
        <label for="medium-blog-link">Medium Blog Link</label>
        <input class="form-control" id="medium-blog-link" name="medium-blog-link" type="text">
    </div>

    <div class="text-center">
        <button id="home-submit" type="submit" value="" class="btn btn-success">Submit</button>
    </div>
</div>
