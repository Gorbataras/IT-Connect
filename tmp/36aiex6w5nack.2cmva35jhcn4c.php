

<!--header for the page-->
<?php echo $this->render('views/parts/header.php',NULL,get_defined_vars(),0); ?>

<!--navbar-->
<?php echo $this->render('views/parts/navbar.php',NULL,get_defined_vars(),0); ?>

<body>
<div id="site-container">
    <div>
        <div class="internships-table">
            <h1>Internships</h1>
            <!--where internship table is generated-->
            <table id="internshipsTable"></table>
        </div>
    </div>
    <!--information about the table columns-->
    <?php echo $this->render('views/modals/postModal.php',NULL,get_defined_vars(),0); ?>
</div>

<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<!--  Latest compiled and minified CSS-->
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.10.1/bootstrap-table.min.css">
<!-- Latest compiled and minified JavaScript -->
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.10.1/bootstrap-table.min.js"></script>
<!--table made here-->
<script src="js/internshipsPage.js"></script>
</body>

<!--footer for the page-->
<?php echo $this->render('views/parts/footer.php',NULL,get_defined_vars(),0); ?>