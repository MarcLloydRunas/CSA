<?php 
require "../../../db/config.php";
if(!isset($_GET['id'])){
    echo "<script> alert('Undefined Schedule ID.'); location.replace('appointment.php') </script>";
    $pdo->close();
    exit;
}

$delete = $pdo->query("DELETE FROM `schedule_list` where id = '{$_GET['id']}'");
if($delete){
    echo "<script> alert('Event has deleted successfully.'); location.replace('appointment.php') </script>";
}else{
    echo "<pre>";
    echo "An Error occured.<br>";
    echo "Error: ".$pdo->error."<br>";
    echo "SQL: ".$sql."<br>";
    echo "</pre>";
}
$pdo->close();

?>