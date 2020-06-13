<div class="tab-pane fade show active" id="nav-settings" role="tabpanel" aria-labelledby="nav-settings-tab">

    <h2>Site Settings</h2>

    <!-- Page Content WYSIWYG-->
    <div class="form-group">
        <label for="site-title">Website Title</label>
        <textarea class="form-control wysiwyg-sm" id="site-title" name="site-title">
            {{ @siteTitle | raw }}
        </textarea>
    </div>

    <!-- Submit -->
    <div class="text-center mb-5 mt-4">
        <button id="site-title-submit" class="btn btn-success">Save</button>
    </div>

    <!-- Prompt upload of image -->
    <form id="logo-upload" action="/uploadPhoto" method="post" enctype="multipart/form-data">
        <div class="card">
            <div class="card-header">
                <h3>Upload Site Logo</h3>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <input type="file" id="logo" name="photo">
                    <br>
                    <input class="btn btn-primary mt-2" id="logo-submit" type="submit" value="Upload" name="photo-submit">
                </div>
            </div>
        </div>
    </form>
    <br>

    <!-- Color Theme -->
    <div class="card">
        <div class="card-header">
            <h3>Site Color</h3>
        </div>
        <div class="card-body">
                <!-- color 1 -->
                <div class="form-group">
                    <label for="color1">Select your color1:</label>
                    <input type="color" class="col-1" id="color1" name="color1" value="{{@color1}}">
                </div>

                <!-- color 2 -->
                <div class="form-group">
                    <label for="color2">Select your color2:</label>
                    <input type="color" class="col-1" id="color2" name="color2" value="{{@color2}}">
                </div>

                <!-- color 3 -->
                <div class="form-group">
                    <label for="color3">Select your color3:</label>
                    <input type="color" class="col-1" id="color3" name="color4" value="{{@color3}}">
                </div>
                <button type="submit" id="color_button" class="btn btn-primary">Submit</button>
        </div>
    </div>
    <br>

    <!-- Add User -->
    <div class="card">
        <div class="card-header">
            <h3>Add User</h3>
        </div>
        <div class="card-body">
            <form id="add-user-form" action="/addUser" method="post" class="container">

                <div class="form-group">
                    <label for="email">Email address</label>
                    <span class="alert-danger" id="user_email"></span>
                    <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter email">
                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <span class="alert-danger" id="user_password"></span>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                </div>

                <button type="submit" id="user_add" class="btn btn-primary">Submit</button>
            </form>
        </div><!-- card body -->
    </div><!-- card -->
    <br>
</div><!-- tab pane -->

