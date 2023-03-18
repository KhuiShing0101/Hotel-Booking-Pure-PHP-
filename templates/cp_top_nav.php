<!-- top navigation -->
<div class="top_nav">
    <div class="nav_menu">
        <div class="nav toggle">
            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
        </div>
        <nav class="nav navbar-nav">
            <ul class=" navbar-right">
                <li class="nav-item dropdown open" style="padding-left: 15px;">
                    <a href="javascript:;" class="user-profile dropdown-toggle text-capitalize" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                        <img src="<?= $base_url ?>assets/images/img.jpg" alt="">
                        <?php 
                            if (isset($_COOKIE["user_name"])) {
                                echo $_COOKIE["user_name"];
                            } else if (isset($_SESSION["user_name"])) {
                                echo $_SESSION["user_name"];
                            }
                        ?>
                    </a>
                    <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item"  href="javascript:;">
                            <span>Settings</span>
                        </a>
                        <a class="dropdown-item"  href="<?= $cp_base_url ?>logout.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                    </div>
                </li>
            </ul>
        </nav>
    </div>
</div>
<!-- /top navigation -->