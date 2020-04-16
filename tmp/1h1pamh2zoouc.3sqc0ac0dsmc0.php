

<!--header for the page-->
<?php echo $this->render('views/parts/header.php',NULL,get_defined_vars(),0); ?>

<!--navbar-->
<?php echo $this->render('views/parts/navbar.php',NULL,get_defined_vars(),0); ?>

<body>
<div id="site-container">
    <div class="student-resources">
        <!--body is generated here-->
        <div id="resources_body"></div>
    </div>
</div>

<!--script needed to generate the page-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!--ajax script that gets the resource body-->
<script>
    $.ajax({
        url: 'api/resources.php',
        type: 'GET',
        success: function(result) {
            console.log(result);
            $("#resources_body").html(result.body);
        }
    });
</script>

</body>


<!--footer for the page-->
<?php echo $this->render('views/parts/footer.php',NULL,get_defined_vars(),0); ?>