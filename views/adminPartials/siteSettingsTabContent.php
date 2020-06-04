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
    <form action="#" method="post" enctype="multipart/form-data">
        <div class="card">
            <div class="card-header">
                <h3 for="photo">Upload Site Logo</h3>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <input type="file" name="photo" id="photo">
                    <br>
                    <input class="btn btn-primary mt-2" type="submit" value="Upload" name="photo-submit">
                    <check if="{{ isset(@photoError) }}">
                        <br>
                        <span class="error text-danger">{{ @photoError }}</span>
                    </check>

                    <check if="{{ isset(@photoConfirm) }}">
                        <br>
                        <span class="text-success">{{ @photoConfirm }}</span>
                    </check>
                </div>
            </div>
        </div>
    </form>

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

    <!-- Add User -->
    <div class="card">
        <div class="card-header">
            <h3>Add User</h3>
        </div>
        <div class="card-body">
            <form class="container">
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                </div>
                <div class="form-group">
                    <label for="firstName">First Name</label>
                    <input type="text" class="form-control" id="firstName" placeholder="John">
                </div>
                <div class="form-group">
                    <label for="lastName">Password</label>
                    <input type="text" class="form-control" id="lastName" placeholder="Doe">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div><!-- card body -->
    </div><!-- card -->
</div><!-- tab pane -->

