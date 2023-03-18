<?php
    require("../require/check_auth.php");
    require("../require/include_functions.php");
 
    $header_title  = "Hotel Booking Show Room ";
    $success       = false;
    $success_msg   ='';

    if(isset ($_GET['msg']))
    {
        $message   =$_GET ['msg'];
        switch($message){
            case "success":
                $success     = true;
                $success_msg = "Room Created Successfully.";
            break;
            case "update":
                $success     = true;
                $success_msg = "Room Updated Successfully.";
            break;
        }
    }
    $sql           = "SELECT id, name FROM `view` WHERE deleted_at is NULL";
    $result        = $mysqli->query($sql);
    $res_row       = $result->num_rows;


    require("../templates/cp_header.php");
    require("../templates/cp_left_side_bar.php");
    require("../templates/cp_top_nav.php");
?>
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Show Room</h3>
                </div>
            </div>

            <div class="row" style="display: block;">
                <div class="col-md-12 col-sm-12  ">
                    <div class="x_panel">
                        <div class="x_content">
                            <div class="table-responsive">
                                <table class="table table-striped jambo_table bulk_action">
                                    <thead>
                                        <tr class="headings">
                                            <th>
                                                <input type="checkbox" id="check-all" class="flat">
                                            </th>
                                            <th class="column-title">Id </th>
                                            <th class="column-title">Name </th>
                                            <th class="column-title">Action </th>
                                        </tr>
                                        <th class="bulk-actions" colspan="7">
                                                <a class="antoo" style="color:#fff; font-weight:500;">table records ( <span class="action-cnt"> </span> )</a>
                                        </th>
                                    </thead>

                                    <tbody>

                                    <?php
                                        if ($res_row>=1) {
                                            while ($row=$result->fetch_array()){
                                                $id     =   (int)($row['id']);
                                                $name   =   htmlspecialchars($row['name']);
                                                $edit_url = $cp_base_url . "edit_room_view.php?id=" . $id;
                                    ?>
                                                <tr class="even pointer">
                                                    <td class="a-center ">
                                                        <input type="checkbox" class="flat" name="table_records">
                                                    </td>
                                                    <td class=" "><?php echo $id; ?></td>
                                                    <td class=" "><?php echo $name; ?></td>
                                                    <td class=" ">
                                                        <a href="<?php echo $edit_url; ?>" class="btn btn-info btn-sm">
                                                            <i class="fa fa-pencil"></i> Edit
                                                        </a>
                                                    </td>
                                                </tr>
                                    <?php
                                            }
                                        }
                                    ?>
                                    </tbody>
                                </table>
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /page content -->
<?php if ($success == true) : ?>
    <script>
        $(document).ready(function () {
            new PNotify({
                title   : 'Oh No!',
                text    : '<?= $success_msg ?>',
                type    : 'success',
                styling : 'bootstrap3'
            });
        })
    </script>
<?php endif ?>

<?php 
    require("../templates/cp_footer.php");
?>


