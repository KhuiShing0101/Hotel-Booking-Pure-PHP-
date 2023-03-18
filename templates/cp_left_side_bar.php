<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
        <a href="<?= $cp_base_url ?>index.php" class="site_title"><i class="fa fa-building"></i> <span>Hotel Booking</span></a>
        </div>

        <div class="clearfix"></div>

        <!-- menu profile quick info -->
        <div class="profile clearfix">
        <div class="profile_pic">
            <img src="<?= $base_url ?>assets/images/img.jpg" alt="profile image" class="img-circle profile_img">
        </div>
        <div class="profile_info">
            <span>Welcome,</span>
            <h2 class="text-capitalize">
                <?php 
                    if (isset($_COOKIE["user_name"])) {
                        echo $_COOKIE["user_name"];
                    } else if (isset($_SESSION["user_name"])) {
                        echo $_SESSION["user_name"];
                    }
                ?>
            </h2>
        </div>
        </div>
        <!-- /menu profile quick info -->

        <br />

        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <ul class="nav side-menu">
                    <li><a><i class="fa fa-building-o"></i> Room View <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="<?= $cp_base_url ?>create_room_view.php">Create</a></li>
                            <li><a href="<?= $cp_base_url ?>show_room_view.php">Listing</a></li>
                        </ul>
                    </li>

                    <li><a><i class="fa fa-bed"></i> Hotel Bed <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="<?= $cp_base_url ?>create_room_bed.php">Create</a></li>
                            <li><a href="<?= $cp_base_url ?>show_room_bed.php">Listing</a></li>
                        </ul>
                    </li>

                    <li><a><i class="fa fa-bicycle"></i> Special Features <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="<?= $cp_base_url ?>create_room_special_features.php">Create</a></li>
                            <li><a href="<?= $cp_base_url ?>show_room_special_features.php">Listing</a></li>
                        </ul>
                    </li>

                    <li><a><i class="fa fa-building-o"></i> Room <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="<?= $cp_base_url ?>create_room.php">Create</a></li>
                            <li><a href="<?= $cp_base_url ?>show_room.php">Listing</a></li>
                        </ul>
                    </li>

                    <li><a><i class="fa fa-spoon"></i> Amenities <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="<?= $cp_base_url ?>create_room_amenities.php">Create</a></li>
                            <li><a href="<?= $cp_base_url ?>show_room_amenities.php">Listing</a></li>
                        </ul>
                    </li>

                    <li><a href="<?= $cp_base_url ?>show_reservations.php"><i class="fa fa-ticket"></i> Reservations</a></li>
                </ul>
            </div>
        </div>
        <!-- /sidebar menu -->

    </div>
</div>
