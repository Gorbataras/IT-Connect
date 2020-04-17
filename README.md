# IT Connect Website

## Table of Contents

  * [General Information](#GI)
  * [Documentation](#DOCS)
  * [Folder Structure](#FS)


###  General Information <a id="GI"></a>

#### Authors

- Bogdan Pshonyak (bpshonyak@mail.greenriver.edu)
- Yegor Shemereko (yegorshem@gmail.com)
- Michael Lant    (michael.lant@ymail.com)

#### Access Credentials
- Name of Database: 		itconnec_kremlin
- Database admin user: 		itconnec_admin
- CPanel Login Username:	itconnect
- Cpanel Login Password:	boggybogbogz123!

#### Live Website

http://itconnect.greenrivertech.net/

#### TODO List

- Add email subscription feature
- Add ability for admins to create other admins

### Documentation <a id="DOCS"></a>

- Google Drive Files (https://drive.google.com/drive/folders/0BxI3bCQHWRBTTTJpRjNDV3oxcGc)
<details>
  
	<summary>Definition of Done</summary>

  - Code updates are regularly checked into GitHub with a meaningful comment
  - All code has been pair-programmed or reviewed by at least one other team member, before being committed to the repository
  - Code follows Pear Standards
  - All functionality has been usability tested
  - All functionality has been reviewed and approved by the client
  - HTML is valid and responsive, and web pages have been tested across browsers
  - Files are in a well-organized directory structure and file naming conventions are consistent
  - Code follows the DRY (Don't repeat yourself) principle
  - Code is thoroughly commented
  - Code is secure
    -  Database config files are not stored in a web accessible directory
    - Variables are initialized
    - Passwords are encrypted
    - PDO prepared statements are used to prevent SQL injection
    - All inputs are validated
  - OOP is practiced
  - MVC is practiced
  - Any relevant user documentation has been created
</details>

### Tools Used

- PHPStorm          (https://www.jetbrains.com/phpstorm/)
- Composer          (https://getcomposer.org/)
- PHPUnit           (https://phpunit.de/)
- Bootstrap-table   (https://github.com/wenzhixin/bootstrap-table)
- TinyMCE           (https://www.tinymce.com/)

### Folder Structure <a id="FS"></a>

##### models

```
Modeles are responsible for providing a class that interacts with the database.
```

- PostingsModel.php

    ```
    Interacts with the posting database table.
    ```

- Post.php

    ```
    Class that represents a post
    ```

- UserModel.php

    ```
    Interacts with the users database table.
    ```

- resourcesModel.php

    ```
    Interacts with the resources database table.
    ```

##### views

```
Contains the html rendered on the page.
```

- adminLogin.php

    ```
    HTML for admin login page.
    ```

- adminPage.php

    ```
    HTML for admin dashboard page.
    ```

- internships.php

    ```
    HTML for internships page.
    ```

- studentResources.php

    ```
    HTML for student resources page.
    ```

- modals

    - addModal.php

        ```
        HTML for add internship modal.
        ```

    - changePasswordModal.php

        ```
        HTML for change password modal.
        ```

    - deleteModal.php

        ```
        HTML for delete internship modal.
        ```

    - postModal.php

        ```
        HTML for internship post modal.
        ```

    - resetPasswordModal.php

        ```
        HTML for reset password modal.
        ```

    - resourcesModal.php

        ```
        HTML for update resources modal.
        ```

    - updateModal.php

        ```
        HTML for update internship post modal.
        ```

##### controllers

```
Contains PHP files that run code that executes before a view is rendered.
```

- adminController.php

    ```
    Executes PHP code and loads admin dashboard view.
    ```

- internshipsController.php

    ```
    Executes PHP code and loads internships view.
    ```

- resourcesController.php

    ```
    Executes PHP code and loads student resources view.
    ```

- logoutScript.php

    ```
    Logs out current user when called.
    ```

##### api

```
Restful API that interact with models based on HTTP requests.
```

- posts.php

    ```
    API that interacts with the postings model.
    ```

- resources.php

    ```
    API that interacts with the resources model.
    ```

- user.php

    ```
    API that interacts with the user model.
    ```

##### db

```
Contains database related files.
```

- config.php

    ```
    Database credentials.
    ```

- cronDelete.php

    ```
    Script used to delete expired internships (over 90 days old).
    ```

- database-code.sql

    ```
    SQL create and insert statements.
    ```

##### js

```
Contains all javascript files.
```

- adminLogin.js

    ```
    Calls user api to authenticate user.
    ```

- adminPage.js
    ```
    Calls posts api to retrieve internships posts.
    Calls posts api to add internships posts.
    Calls posts api to edit internships posts.
    Calls posts api to delete internships posts.
    Calls user api to change password.
    Initailized WYSIWYG editors
    ```

- internshipPage.js

    ```
    Calls posts api to retrieve internships posts.
    ```

- bootstrap.js / bootstrap.min.js

    ```
    Boostrap Javascript.
    ```

##### css

```
Contains all css files.
```

- index.css

    ```
    Base styling.
    ```

- navbar.css
    ```
    Styling for navigation bar.
    ```

- footer.css

    ```
    Styling for footer.
    ```

- internships.css

    ```
    Styling for internships page.
    ```

- admin-page.css

    ```
    Styling for admin dashboard.
    ```

- resources.css

    ```
    Styling for resources page.
    ```

- login-form.css

    ```
    Styling for admin login form.
    ```

- icons.css

    ```
    Styling for icons.
    ```

- bootstrap* files

    ```
    Bootstrap css.
    ```

##### assets

```
Website assets.
```

- img

    - GR-logo-Wht.png

        ```
        GRC logo.
        ```

    - grctech.jpg

        ```
        GRC TECH logo.
        ```

    - home_banner.jpg

        ```
        Homepage background image.
        ```

##### fonts

```
Font files.
```

##### tests

```
Website tests.
```

- PostingModelTest.php

    ```
    Test for the postings model.
    ```

##### docs

```
Documentation files.
```
