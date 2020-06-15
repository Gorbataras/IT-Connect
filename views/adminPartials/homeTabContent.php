<div class="tab-pane fade" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
    <h2>Home</h2>
    <br>

    <exclude>
    <!-- NavBar Link far right -->
    <div class="form-group">
        <!-- Alert Message WYSIWYG -->
        <label for="home-alert">Edit Link far right of navigation bar</label>
        <textarea class="form-control wysiwyg-sm" name="nav-link" id="home-nav-link">
            {{ @homeContent['link']['html'] }}
        </textarea>
    </div>
    <br>
    </exclude>

    <!-- Alert Message -->
    <div class="form-group">

        <!-- Show Alert Switch -->
        <div class="custom-control custom-switch float-right">
            <input type="checkbox" class="custom-control-input" id="alert-is-shown"
            <check if="{{ @homeContent['alert']['isShown'] == 1 }}">
                checked
            </check>
            >
            <label class="custom-control-label" for="alert-is-shown">Show Alert</label>
        </div>

        <!-- Alert Message WYSIWYG -->
        <label for="home-alert">Alert Message</label>
        <textarea class="form-control wysiwyg-sm" name="home-alert" id="home-alert">
            {{ @homeContent['alert']['html'] }}
        </textarea>
    </div>

    <!-- Home Alert Submit -->
    <div class="text-center mb-5 mt-4">
        <button id="home-alert-submit" class="btn btn-success">Save</button>
    </div>

    <!-- Introduction -->
    <div class="form-group">

        <!-- Show Intro Switch -->
        <div class="custom-control custom-switch float-right">
            <input type="checkbox" class="custom-control-input" id="intro-is-shown"
            <check if="{{ @homeContent['intro']['isShown'] == 1 }}">
                checked
            </check>
            >
            <label class="custom-control-label" for="intro-is-shown">Show Intro</label>
        </div>

        <!-- Introduction WYSIWYG -->
        <label for="home-intro">Introduction</label>
        <textarea class="form-control wysiwyg-sm" id="home-intro" name="home-intro">
            {{ @homeContent['intro']['html'] }}
        </textarea>
    </div>

    <!-- Home Intro Submit -->
    <div class="text-center mb-5 mt-4">
        <button id="home-intro-submit" class="btn btn-success">Save</button>
    </div>

    <!-- Medium Blog Link -->
    <div class="form-group">
        <label for="medium-blog-link">Medium Blog Link</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text" id="medium-url-pre">https://medium.com/</span>
            </div>
            <input class="form-control" id="medium-blog-link" name="medium-blog-link" type="text"
                   value="{{ @blogSourceName }}" aria-describedby="medium-url-pre">
        </div>
    </div>

    <!-- Medium Blog Link Submit -->
    <div class="text-center mb-5 mt-4">
        <button id="medium-blog-submit" class="btn btn-success">Save</button>
    </div>
</div>
