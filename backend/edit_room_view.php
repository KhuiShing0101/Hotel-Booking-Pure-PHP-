<?php
    require("../require/check_auth.php");
    require("../require/include_functions.php");
    
    $header_title    = "Hotel Booking::Edit Room View";
    $proc_error      = false;
    $error_message   = "";
    $table           = "view";
    $success         = false;
    $success_message = "";

    if (isset($_POST["form-sub"]) && $_POST["form-sub"] == 1)
    {
            $table                    = "view";
            $name                     = $mysqli->real_escape_string($_POST["name"]);
            $id                       = (int)$_POST['id'];
            $id                       = $mysqli->real_escape_string('id');


            // Query //

            if ($proc_error == false) {
                $data            = [
                    "name"       => $name
                ];

                $update    = updateQuery($mysqli, $table, $data, $id);

            if($update){
                $url  = $cp_base_url."show_room_view.php?msg=update";
                header('location:' . $url);
                exit();
             }
            } 
    }
            else{
                $id         = (int) ($_GET['id']);
                $id         = $mysqli->real_escape_string($id); 
                $sql        = "SELECT id,name FROM `view` WHERE id ='". $id. " ' AND deleted_at IS NULL";
                $result     = $mysqli->query($sql);
                $res_row    = $result->num_rows;
                if($res_row<=0){
                    $url    = $cp_base_url."show_room_view.php";
                    header('location:'.$url);
                    exit();
                }   else {
                    while($row=$result->fetch_array()){
                        $name = htmlspecialchars($row['name']);
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
                            <form class="" action="<?php echo$cp_base_url; ?>edit_room_view.php" method="post" novalidate>
                                <span class="section">Edit Room View</span>
                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3  label-align">Name<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                        <input class="form-control" name="name" placeholder="eg. Lake View" required="required" value="<?php echo $name;?>" type="text"/>
                                    </div>
                                </div>
                                <div class="ln_solid">
                                    <div class="form-group">
                                        <div class="col-md-6 offset-md-3 mt-2">
                                            <button type='submit' class="btn btn-primary">Cancel</button>
                                            <button id='send' class="btn btn-success" type="submit">Update</button>
                                            <input type="hidden" name="form-sub" value="1">
                                            <input type="hidden" name="id" value="<?php echo $id; ?>">
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


