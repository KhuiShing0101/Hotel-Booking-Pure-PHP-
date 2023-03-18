<?php
    require("../require/check_auth.php");
    require("../require/include_functions.php");
    
    $header_title    = "Hotel Booking::Create Room View";
    $proc_error      = false;
    $error_message   = "";
    $table           = "view";
    $success         = false;
    $success_message = "";

    if (isset($_POST["submit"]) && $_POST["form-submit"] == 1) 
    {
       
        $table ="view";
        $name= $mysqli->real_escape_string($_POST["name"]);

        /***Check Empty Value ***/

        $check_empty_data =[
            'Room Name' => $name
        ];
        $empty_validate = validateEmpty($check_empty_data);
        if ($empty_validate['error'] == true) {
            $error           = true;
            $proc_error      = true;
            $error_message   = $empty_validate['error_message'];
        };

         /**** End Empty Data */

        /**Check Name Already Exists */

        $name_exit_validate = validateNameExit($mysqli,$name,$table);
        if ($name_exit_validate==false){
            $error           = true;
            $proc_error      = true;
            $error_message   = "This name is already exist in database";

        }

        if($proc_error == false){
            $data  =[
                'name' => $name,
            ];
            $insert_query    = insertQuery($mysqli, $table, $data);
            if($insert_query) {
                $url    = $cp_base_url ."show_room_view.php?msg=success";
                header('location:' . $url);
                exit();
            }
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
                            <form class="form-horizontal form-label-left" action="<?php echo $cp_base_url;?>create_room_view.php" method="POST" novalidate>
                                <span class="section">Create Room View</span>
                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3  label-align">Name<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                        <input class="form-control" name="name" placeholder="eg. Lake View" required="required" />
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
    <?php 
         if ($proc_error == true) : 
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
            $(document).ready(function () {
                new PNotify({
                    title: 'Regular Success',
                    text: '<?= $success_message ?>',
                    type: 'success',
                    styling: 'bootstrap3'
                });
            })
        </script>
    <?php endif ?>  

<?php 
    require("../templates/cp_footer.php");
?>


