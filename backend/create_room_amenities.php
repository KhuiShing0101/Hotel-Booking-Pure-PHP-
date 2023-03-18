<?php
    require("../require/check_auth.php");
    $header_title  = "Hotel Booking::Create Room Amenities";
    $proc_error    = false;
    $error_message = "";
    $table         = "amenities";

    if (isset($_POST["submit"]) && $_POST["form-submit"] == 1) {
        $name                     = $mysqli->real_escape_string($_POST["name"]);

        $check_blank_data         = [
            "Amenities"           => $name
        ];
        /** Check Blank Input */
        $check_blank_input        =     ($check_blank_data);
        if (isset($check_blank_input["error"]) == true) {
            $proc_error           = true;
            $error_message        = $check_blank_input["error_message"];
        }

        /** Check Database Existence */
        $check_database_existence = checkDatabaseExistence($mysqli, $table, $name);
        if (isset($check_database_existence["error"]) == true) {
            $proc_error           = true;
            $error_message        = $check_database_existence["error_message"];
        }

        if ($proc_error == false) {
            $data   = [
                "name" => "$name"
            ];
            $insert_query = insertQuery($mysqli, $table, $data); 
        } 
    }
    require("../templates/cp_header.php");
    require("../templates/cp_left_side_bar.php");
    require("../templates/cp_top_nav.php");
?>

    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="x_panel">
                        <div class="x_content">
                            <form class="" action="" method="post" novalidate>
                                <span class="section">Create Room Amenities</span>
                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3  label-align">Name<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                        <input class="form-control" name="name" placeholder="eg. Amenities" required="required" />
                                    </div>
                                </div>
                                <div class="ln_solid">
                                    <div class="form-group">
                                        <div class="col-md-6 offset-md-3 mt-2">
                                            <button type='submit' name="submit" class="btn btn-primary">Submit</button>
                                            <button type='reset' class="btn btn-success">Reset</button>
                                            <input type="hidden" name="form-submit" value="1">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /page content -->
<?php if ($proc_error == true) : ?>
    <script>
        $(document).ready(function () {
            new PNotify({
                title   : 'Oh No!',
                text    : '<?= $error_message ?>',
                type    : 'error',
                styling : 'bootstrap3'
            });
        })
    </script>
<?php endif ?>

<?php 
    require("../templates/cp_footer.php");
?>


