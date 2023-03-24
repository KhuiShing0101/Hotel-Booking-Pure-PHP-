<?php
    require("../require/check_auth.php");
    require("../require/include_functions.php");
    
    $header_title   = "Hotel Booking::Edit Room ";
    $error          = false;
    $error_message  = '';
    $process_error     = false;
    if(isset ($_POST ['form-sub']) && $_POST['form-sub']==1)
    {

        $id                     = $mysqli->real_escape_string($POST['id']);
        $name                   = $mysqli->real_escape_string($_POST['name']);
        $room_type              = $mysqli->real_escape_string($_POST['type']);
        $occupancy              = $mysqli->real_escape_string($_POST['occupancy']);
        $bed                    = $mysqli->real_escape_string($_POST['bed']);
        $size                   = $mysqli->real_escape_string($_POST['size']);
        $view                   = $mysqli->real_escape_string($_POST['view']);
        $extra_bed_price        = $mysqli->real_escape_string($_POST['extra_bed_price_per_day']);
        $price_per_day          = $mysqli->real_escape_string($_POST['price_per_day']);
        $feature                = $_POST['features'];
        $amenties               = $_POST['amenity'];
        $description            = $mysqli->real_escape_string($_POST['description']);
        $detail                 = $mysqli->real_escape_string($_POST['detail']);

        $table                  = 'room';

        //check viladation

        $check_empty_data       =[
            'Room Name'       => $name,
            'Room Type'       => $room_type,
            'Room Occupancy'  => $occupancy,
            'Room Bed'        => $bed,
            'Room size'       => $size,
            'Room View'       => $view,
            'Extra Bed Price' => $extra_bed_price,
            'Price Per Day'   => $price_per_day,
            'Room Description'=> $description,
            'Room Detail'     => $detail,

        ];
        
        $empty_validate = validateEmpty($check_empty_data);

        if 
            ($empty_validate['error'] == true) {
            $error           = true;
            $process_error      = true;
            $error_message   = $empty_validate['error_message'];
        };

        if
            ($process_error==false)
        {

                $data                   = 
                [
                    'name'                   => $name,
                    'type'                   => $type,
                    'occupancy'              => $occupancy,
                    'bed_id'                 => $bed,
                    'size'                   => $size,
                    'view_id'                => $view,
                    'extra_bed_price_per_day'=> $extra_bed_price,
                    'price_per_day'          => $price_per_day, 
                    'description'            => $description,
                    'detail'                 => $detail,
                ];

            // Special Feature Query Insert;

            $update     = updateQuery($mysqli,$table,$data,$id);
            $feature_tbl    = 'room_special_features_id';
            $delete         = hardDelete($mysqli,$table,$id);

            if($update)
            {
                $room_id    = $mysqli->insert_id;

                foreach ($features as $feature)
                {
                    
                    $data           =[
                            'room_id'    => $id,
                    'special_features_id'=> $feature,
                    ];
                    $insert_feature = insertQuery($mysqli,$feature_tbl,$data);
                }

                // Amenity Insert

                $amenity_tbl    =   'room_amenities';
                $delete         =    hardDelete($mysqli,$amenity_tbl,$id);

                foreach ($amenities as $amenity)
                {

                    $amenity_tbl    = 'room_amenities';
                    $data           = [
                    'room_id'            => $id,
                    'amenities_id'       => $amenity,
                    ];
                    $insert_feature = insertQuery($mysqli,$amenity_tbl,$data);
                } 

            }
        }
    }

    else
    { 

        $id             = (int) ($_GET['id']);
        $id             =  $mysqli->real_escape_string($id);
        $result         = getRoomDetailById($mysqli,$id);
        $res_row        = $result->num_rows;
        if($res_row<= 0 )
        {
            $url        =$cp_base_url ."show_room.php" ;
            header('location:' .$url);
            exit();
        }
        while ($row = $result->fetch_array()) 
        {
            $name           = htmlspecialchars ($row['name']);
            $room_type      = (int)($row['type']); 
            $occupancy      = (int)($row['occupancy']);
            $bed            = (int)($row['bed_id']);
            $size           = (int)($row['size']);
            $view           = (int)($row['view_id']);
            $extra_bed_price= (int)($row['price_per_day']);
            $price_per_day  = (int)($row['extra_bed_price_per_day']);
            $description    = htmlspecialchars($row['description']);
            $detail         = htmlspecialchars($row['detail']);
            $feature        = getRoomSpecialFeaturesByRoomId($mysqli,$id);
            $amenities      = getRoomAmenitiesByRoomId($mysqli,$id);
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
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_content">

                            <form class="form-horizontal form-label-left" action="<?php echo $cp_base_url;?>update_room.php" method="POST" novalidate>
                                <span class="section">Update Room </span>

                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Room Name<span class="required">*</span></label>
                                    
                                    <div class="col-md-6 col-sm-6 col-xs-12 ">
                                        <input id="name" class="form-control col-md-12 col-sm-3 col-xs-12" name="name" placeholder="Enter Room Name"/>
                                    </div>
                                </div>

                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="room-type">Room Type<span class="nubmer">*</span></label>
                                    
                                    <div class="col-md-6 col-sm-6 col-xs-12 ">
                                        <select id="room-type" class="form-control" name="type">
													<option value="">  Choose option</option>

													<option value="1" 
                                                        <?php if ( $room_type == '1') 
                                                                    {
                                                                        echo"selected";
                                                                    }?>
                                                    > Standard
                                                    </option>

													<option value="2" 
                                                    <?php if ($room_type == '2') 
                                                                {
                                                                    echo"selected";
                                                                }?>
                                                    > Club Floor</option>

													<option value="3"
                                                    <?php if($room_type == '3') 
                                                                {
                                                                    echo"selected";
                                                                }?>
                                                    > Suite</option>
									    </select>
                                    </div>
                                </div> 
                                    
                                <div class="item form-group"> 
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="occupancy">Room Occupancy<span class="required">*</span></label>
                                    
                                    <div class="col-md-6 col-sm-6 col-xs-12 ">
                                        <input id="occupancy" type="number" class="form-control " name="occupancy" placeholder="Enter Room Occupancy" value= "<?php echo $occupancy; ?>" />
                                    </div>
                                </div>
                                <div class="item form-group"> 
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="size">Room size<span class="required">*</span></label>
                                    
                                    <div class="col-md-6 col-sm-6 col-xs-12 ">
                                        <input id="size" type = "nubmer" class="form-control" name="size" placeholder="Enter Room size" value="<?php echo $size; ?>" />
                                    </div>
                                </div>

                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="room-bed">Room Bed<span class="required">*</span></label>
                                    
                                    <div class="col-md-6 col-sm-6 col-xs-12 ">
                                        <select id="room-bed" class="form-control" name="bed">
                                            <option value="">  Choose option</option>
                                                <?php
                                                    foreach( getRoomBed($mysqli) as $room_bed){
                                                    ?>
                                                    <option value=" <?php echo $room_bed['id'] ?> "
                                                    <?php if($bed == $room_bed['id'] ) {
                                                        echo "selected";
                                                        } ?>>
                                                <?php echo $room_bed['name']; ?>
                                            </option>
                                                <?php
                                                }
                                            ?>
									    </select>
                                    </div>
                                </div>

                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="room-view">Room View<span class="required">*</span></label>
                                    
                                    <div class="col-md-6 col-sm-6 col-xs-12 ">
                                        <select id="room-view" class="form-control" name="view">
                                        <option value="">  Choose option</option>
                                            <?php
                                                foreach ( getRoomView($mysqli) as $room_view){
                                            ?>
                                                <option value = "<?php echo $room_view['id'] ?>"
                                                 <?php
                                                 if( $view == $room_view['id']){
                                                    echo "selected";
                                                 }?>>
                                                     <?php echo $room_view['name']?>
                                                </option>
                                            <?php
                                                }
                                            ?>
									    </select>
                                    </div>
                                </div>

                                <div class="item form-group"> 
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Price-Per-Day">Room Price Per Day<span class="required">*</span></label>
                                    
                                    <div class="col-md-6 col-sm-6 col-xs-12 ">
                                        <input id="price-per-day" type = "nubmer" class="form-control" name="Price-Per-Day" value="<?php echo $price_per_day ?>"/>
                                    </div>
                                </div>

                                <div class="item form-group"> 
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Extra-Bed-Price-Per-Day">Extra Bed Price Per Day<span class="required">*</span></label>
                                    
                                    <div class="col-md-6 col-sm-6 col-xs-12 ">
                                        <input id="Extra-Bed-Price-Per-Day" type = "nubmer" class="form-control" name="Extra-Bed-Price-Per-Day" value= " <?php echo $extra_bed_price ?> "/>
                                    </div>
                                </div>
                                
                               
                                <div class="item form-group"> 
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="special-features">Special Features<span class="required">*</span></label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <?php
                                            foreach(getSpecialFeatures($mysqli) as $feature ){
                                            ?>
                                            <div class="checkbox">
										        <label>
										        	<input type="checkbox" value="<?php echo $feature['id']?>"> <?php if (in_array($feature['id'],$features))
                                                    echo $feature['name']?>
										        </label>
                                            </div>
                                            <?php
                                        }
                                            ?>
                                    </div>
                                    
                                </div>
                               
                                <div class="item form-group"> 
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="room-amenities">Room Amenities<span class="required">*</span></label>
                                    
                                    <div class="col-md-3 col-sm-3 col-xs-3">
                                        <p><strong>General</strong> </p>
                                        <?php
                                            foreach (getRoomAmenities($mysqli,1)as $g_amenity){
                                        ?>
                                                <div class="checkbox">
										            <label>
										            	<input type="checkbox" value="<?php echo $g_amenity['id']?>" 
                                                        <?php if(in_array($feature['id'],$feature)) {echo "checked";} ?>>
										            </label>
                                                </div>
                                        <?php
                                            }
                                        ?>

                                    </div>

                                    <div class="col-md-3 col-sm-4 col-xs-4">
                                        <p><strong>BathRoom</strong> </p>

                                        <?php
                                            foreach (getRoomAmenities($mysqli,2)as $b_amenity){
                                        ?>
                                                <div class="checkbox">
										            <label>
										            	<input type="checkbox" value="<?php echo $b_amenity['id']?>">
                                                        <?php echo $b_amenity['name']?>
										            </label>
                                                </div>
                                        <?php
                                            }
                                        ?>

                                    </div>

                                    <div class="col-md-3 col-sm-4 col-xs-4">
                                        <p><strong>Others</strong> </p>

                                        <?php
                                            foreach (getRoomAmenities($mysqli,3)as $o_amenity){
                                        ?>
                                                <div class="checkbox">
										            <label>
										            	<input type="checkbox" value="<?php echo $o_amenity['id']?>"
                                                       >
                                                        <?php echo $o_amenity['name']?>
										            </label>
                                                </div>
                                        <?php
                                            }
                                        ?>

                                    </div>
                                    
                                </div>

                                <div class="item form-group"> 
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">Room Description<span class="required">*</span></label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <textarea name="description" id="description" style="width:480px;" rows="4"><?php echo $description ?></textarea>
                                        </div>
                                </div>

                                <div class="item form-group"> 
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="detail">Room Detail<span class="required">*</span></label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <textarea name="detail" id="detail" style="width:480px;" rows="4"> <?php echo $description ?></textarea>
                                        </div>
                                </div>

                                <div class="ln_solid">
                                    <div class="form-group">
                                        <div class="col-md-6 offset-md-3 mt-2">
                                            <button type='submit' name="submit" class="btn btn-primary">Submit</button>
                                            <button type='reset' class="btn btn-success">Reset</button>
                                            <input type="hidden" name="form-submit" value="1">
                                            <input type="hidden" name="id" value ="<?php echo $id;?>"
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


