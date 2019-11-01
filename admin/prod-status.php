<?php
error_reporting(0);
session_start();

include_once("../config/config.php");

if(isset($_POST['id'])){

    $decision = $_POST['decision'];
    $id = $_POST['id'];
    $query = mysql_query("UPDATE products SET status='$decision' where id = '$id'")or die(mysql_error());
    if($query){
        echo 'Successfully status updated!!';
    }else{
        echo 'Retry!!';
    }
}
    ?>