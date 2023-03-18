<?php

function checkBlankInput($data) {
    $return        = [];
    $error         = false;
    $error_message = "";

    foreach ($data as $key => $val) {
        if (trim($val) == "") {
            $error          = true;
            $error_message .= $key . " cannot be Empty! <br/>";
        } 
    }

    if ($error == true) {
        $return["error"]         = $error;
        $return["error_message"] = $error_message;
    }

    return $return;
}

function checkDatabaseExistence ($mysqli, $table, $name) {

    $return        = [];
    $error         = false;
    $error_message = "";

    $sql           = "SELECT id FROM $table WHERE name = '" . $name . "' AND deleted_at IS NULL";
    $res_sql       = $mysqli->query($sql);
    $res_row       = $res_sql->num_rows;

    if ($res_row >= 1) {
        $error         = true;
        $error_message = $name ." is already exit!";
    }

    if ($error == true) {
        $return["error"]         = $error;
        $return["error_message"] = $error_message;
    }

    return $return;
}

function insertQuery ($mysqli, $table, $data) {
   
    $column      = "";
    $value       = "";
    $today_date  = date("Y-m-d H:i:s");
    $user_id     =$_SESSION['user_id'];

    foreach ($data as $key => $val) {
        $column .= $key . ",";
        $value  .= "'" . $val . "',";
    }

    $sql         = '';
    $sql        .= "INSERT INTO $table (";
    $sql        .= $column;
    $sql        .= "created_at,updated_at,created_by,updated_by";
    $sql        .= ")";
    $sql        .= " VALUES (";
    $sql        .= $value;
    $sql        .= "'$today_date','$today_date','$user_id','$user_id'";
    $sql        .= ")";

    $result     = $mysqli->query($sql);
    return $result;
}

function updateQuery($mysqli,$table,$data,$id){
    $today_date  = date("Y-m-d H:i:s");
    $user_id     =$_SESSION['user_id'];
    $update_syntax ='';
    foreach($data as $key=> $value){
        $update_syntax .= $key . " = " . $value . ",";
    }

    $sql          ='';
    $sql         .="UPDATE $table set "; 
    $sql         .= $update_syntax;
    $sql         .= "updated_at = '" .
                    $today_date .
                    "',updated_by= '".
                    $user_id ."'
                    WHERE id ='". $id . "'";  
                $result     =$mysqli->query($sql);
                return $result;
} 

    function validateEmpty($data)
    {
        $error_message  ='';
        $error          =false;
        
        foreach($data as $key=> $value) {
            if(trim($value) == ''){
                $error  = true;
                $error_message .= $key ."can not be empty <br>";
            }

        $result = [
                'error' => $error,
                'error_message'=> $error_message,
            ];
            
            return $result;
        }
    }

        function validateNameExit($mysqli,$name,$table,$id=null)
        { 
            $return= true;
            if(!$id){
                $sql    ="SELECT count(id) AS count FROM ".
                        $table." WHERE name= '".
                        $name."' AND deleted_at IS NULL ";
                    $result = $mysqli->query($sql);
                    while($row = $result-> fetch_array()){
                        $count      = $row['count'];
                    }   
                 }
            if ($count >= 1){
                    $return =false;
                }
                return $return;
        }

        function getRoomBed($mysqli){
            $sql           ="SELECT id,name FROM `bed` WHERE deleted_at IS NULL";
            $result        = $mysqli->query($sql);
            $data          =[];
            $return        =[];
            while($row = $result->fetch_array()){
                $data['id']  = $row['id'];
                $data['name']= $row['name'];
                array_push($return,$data);
            }
            return $return;
        }


        function getRoomView($mysqli){
            $sql        ="SELECT id,name FROM `view` WHERE deleted_at IS NULL";
            $result     = $mysqli->query($sql);
            $data       = [];
            $return     = [];
            while($row = $result->fetch_array()){

                $data['id'] = $row['id'];
                $data['name'] = $row['name'];

                array_push($return,$data);
            }
            return $return;

        }

        function getSpecialFeatures($mysqli){
            $sql        ="SELECT id,name FROM `special_features` WHERE deleted_at IS NULL";
            $result     =$mysqli->query($sql);
            $data       =[];
            $return     =[];
            while ($row= $result->fetch_array()){

                $data['id']= $row['id'];
                $data['name']=$row['name'];
                array_push($return,$data);
                
            }
            return $return;

        }
        
        function getRoomAmenities($mysqli,$type){
            $sql    ="SELECT id, name FROM `amenities` WHERE type ='". $type."'";
            $result = $mysqli->query($sql);
            $data   = [];
            $return = [];
            while($row= $result->fetch_array()){

                $data['id']= $row['id'];
                $data['name']=$row['name'];

                array_push($return,$data);
            }
            return $return;
        }
?>
