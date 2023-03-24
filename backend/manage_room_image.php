<?php
    require("../require/check_auth.php");
    require("../require/include_functions.php");
    
    $header_title   = "Hotel Booking::Manage Room Image ";

    require("../templates/cp_header.php");
    require("../templates/cp_left_side_bar.php");
    require("../templates/cp_top_nav.php");
?>
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_content">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /page content -->
    
    <?php 
         if ($process_error == true) : 
         ?>
    <script>
        $(document).ready(function () {
            new PNotify({
                title   : 'Successfully!',
                text    : '<?= $error_message ?>',
                type    : 'error',
                styling : 'bootstrap3'
            });
        })
    </script>
    <?php endif ?> 

    <?php if ($success == true) : ?>
        <script>
            $(document).ready(function () 
            {
                new PNotify
                ({
                    title:   'Regular Success',
                    text:    '<?= $success_message ?>',
                    type:    'success',
                    styling: 'bootstrap3'
                });
            })
        </script>
    <?php endif ?>

<?php 
    require("../templates/cp_footer.php");
?>


