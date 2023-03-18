<?php
    require("../require/check_auth.php");
    $header_title  = "Hotel Booking::Hotel View Listing";
    $proc_error    = false;
    $error_message = "";
    $table         = "bed";
    $table_no      = 1;

    $show_sql      = "SELECT id,name FROM $table WHERE deleted_at IS NULL";
    $res_show_sql  = $mysqli->query($show_sql);

    require("../templates/cp_header.php");
    require("../templates/cp_left_side_bar.php");
    require("../templates/cp_top_nav.php");
?>
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Show Beds</h3>
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
                                    </thead>
                                    <tbody>
                                        <?php
                                            while ($row = $res_show_sql->fetch_assoc()) { 
                                                $id     = $row["id"];
                                                $name   = htmlspecialchars($row["name"]);
                                        ?>
                                        <tr class="even pointer">
                                            <td class="a-center ">
                                                <input type="checkbox" class="flat" name="table_records">
                                            </td>
                                            <td class=" "><?= $table_no++ ?></td>
                                            <td class=" "><?= $name ?></td>
                                            <td class=" ">
                                                <a href="" class="btn btn-info btn-sm">
                                                    <i class="fa fa-pencil"></i> Edit
                                                </a>
                                            </td>
                                        </tr>
                                        <?php } ?>
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


