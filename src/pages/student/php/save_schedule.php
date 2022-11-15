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

$findcounselor = "SELECT DISTINCT counselor_id as con_id FROM counselor
                    WHERE counselor_id NOT IN (SELECT counselor_id FROM schedule_list)
                    UNION 
                    SELECT counselor_id as con_id FROM schedule_list
                    WHERE
                    (start_datetime <> '$start_datetime' AND ((SELECT COUNT(counselor_id) FROM schedule_list WHERE start_datetime = '$start_datetime') < 1))
                    AND 
                    (start_datetime <> '$start_datetime' AND ((SELECT COUNT(counselor_id) FROM schedule_list WHERE start_datetime = '$start_datetime') < 1))
                    ORDER BY con_id";

if(empty($link_err)) {
    if($stmt = $pdo->prepare($findcounselor)){         
        // Attempt to execute the prepared statement
        if($stmt->execute()){
            if($stmt->rowCount() >= 1){
                while($available = $stmt->fetch()){
                    $available_counselor = $available['con_id'];
                    echo $available_counselor;
                    if(empty($id)){
                        $sql_save = "INSERT INTO `schedule_list` (student_id,`title`,`description`,`start_datetime`,`end_datetime`, meeting_link, counselor_id) VALUES ('$acc_id_number','$title','$description','$start_datetime','$end_datetime', '$meeting_link', '$available_counselor')";

                        $log_save = "INSERT INTO activity_log (log_id, appointment, receiver) VALUES ('$acc_id_number','$log_act','$available_counselor')";
                    }elseif(!empty($id)){
                        $sql_save = "UPDATE `schedule_list` set `title` = '{$title}', `description` = '{$description}', `start_datetime` = '{$start_datetime}', `end_datetime` = '{$end_datetime}', meeting_link = {$meeting_link}, counselor_id = {$available_counselor} where `id` = '{$id}'";

                        $log_save = "UPDATE activity_log SET appointment = {$log_act_new}, counselor_id = {$available_counselor} where `id` = '{$id}'";
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
                }
            }else{
                echo "<script> alert('No available counselors for this prefered schedule.'); location.replace('../appointment.php') </script>";
                
            }
        }
    }
} else {
    echo "invalid";
}
?>