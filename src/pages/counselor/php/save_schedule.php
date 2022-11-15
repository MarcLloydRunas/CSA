<?php
session_start();
require "../../../../db/config.php";

$link_err = "";
$execute_save = "";
$acc_id_number = "";
$meeting_link = "";

if (isset($_SESSION['pass_id_number'])) {
    $acc_id_number = $_SESSION['pass_id_number'];
}else{
    $acc_id_number = "no id number found";
}

if (isset($_SESSION['institution_code'])) {
    $institution_code = $_SESSION['institution_code'];
}else{
    $institution_code = "no id number found";
    header("location: ../../../public/index.php");
    exit;
}

$student_id = trim($_POST["student_id"]);

$date_sched = trim($_POST["date_sched"]);
$time_sched = trim($_POST["time_sched"]);

$meeting_link_ver = trim($_POST["meeting_link"]);

if (filter_var($meeting_link_ver, FILTER_VALIDATE_URL)) {
    $meeting_link = trim($_POST["meeting_link"]);
} else {
    $link_err = "invalid link";
    echo "<script> alert('Invalid URL.'); location.replace('../appointment.php') </script>";
}

list($start_time, $end_time) = explode("&", $time_sched);

$start_datetime = $date_sched . " " . $start_time;
$end_datetime = $date_sched . " " . $end_time;

$log_act = "set an appointment on ". $date_sched . " " . $start_time . " - " . $end_time;

$log_act_new = "updated an appointment on ". $date_sched . " " . $start_time . " - " . $end_time;

if($_SERVER['REQUEST_METHOD'] !='POST'){
    echo "<script> alert('Error: No data to save.'); location.replace('../appointment.php') </script>";
    $pdo->close();
    exit;
}
extract($_POST);
$allday = isset($allday);

$findstudent = "SELECT DISTINCT student_id FROM schedule_list
                    WHERE (student_id = '$student_id' AND  start_datetime = '$start_datetime') OR (counselor_id = '$acc_id_number' AND start_datetime = '$start_datetime')";

if(empty($link_err)) {
    if($stmt = $pdo->prepare($findstudent)){         
        // Attempt to execute the prepared statement
        if($stmt->execute()){
            if($stmt->rowCount() == 0){
                    if(empty($id)){
                        $sql_save = "INSERT INTO `schedule_list` (counselor_id,`title`,`description`,`start_datetime`,`end_datetime`, meeting_link, student_id, institution_code) VALUES ('$acc_id_number','$title','$description','$start_datetime','$end_datetime', '$meeting_link', '$student_id', '$institution_code')";

                        $log_save = "INSERT INTO activity_log (log_id, appointment, receiver, institution_code) VALUES ('$acc_id_number','$log_act','$student_id', '$institution_code')";
                    }elseif(!empty($id)){
                        $sql_save = "UPDATE `schedule_list` set `title` = '{$title}', `description` = '{$description}', `start_datetime` = '{$start_datetime}', `end_datetime` = '{$end_datetime}', meeting_link = {$meeting_link}, student_id = {$student_id} where `id` = '{$id}', institution_code = '{$institution_code}'";

                        $log_save = "UPDATE activity_log SET appointment = {$log_act_new}, student_id = {$student_id} where `id` = '{$id}', institution_code = '{$institution_code}'";
                    }else{
                        echo "yyyy";
                    }
                    $save = $pdo->prepare($sql_save);
                    $save_log = $pdo->prepare($log_save);
                    if($save->execute()){
                        $save_log->execute();
                        echo "<script> alert('Schedule Successfully Saved.'); location.replace('../appointment.php') </script>";
                    }else{
                        echo "<pre>";
                        echo "An Error occured.<br>";
                        echo "Error: ".$pdo->error."<br>";
                        echo "SQL: ".$sql."<br>";
                        echo "</pre>";
                    }
                    $pdo->close();
            }else{
                echo "<script> alert('Conflicting schedules with existing appointments.'); location.replace('../appointment.php') </script>";
                
            }
        }
        echo 'not executed stmt';
    }
    echo 'not prepared';
} else {
    echo "invalid";
}
?>