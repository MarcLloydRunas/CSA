<?php
session_start();
if(isset($_SESSION["loggedin"]) != true){
    header("location: ../../../public/index.php");
    exit;
}
$acc_id_number = "";

if (isset($_SESSION['pass_id_number'])) {
    $acc_id_number = $_SESSION['pass_id_number'];
}else{
    $acc_id_number = "no id number found";
    header("location: ../../../public/index.php");
    exit;
}
if (isset($_SESSION['account_type'])) {
    $account_type = $_SESSION['account_type'];
}else{
     echo "account_type not passed";
}
if (isset($_SESSION['institution_code'])) {
    $institution_code = $_SESSION['institution_code'];
}else{
    $institution_code = "no id number found";
    header("location: ../../../public/index.php");
    exit;
}
require "../../../db/config.php";

try {
    $delete_past = "DELETE FROM schedule_list
        WHERE end_datetime < DATE_ADD(NOW(),INTERVAL - 1 HOUR)";

    $statement_del = $pdo->prepare($delete_past);
    $statement_del->execute();

} catch(PDOException $error) {
    echo $delete_past . "<br>" . $error->getMessage();
}

try {

    $profile_pic="SELECT file_name FROM profile_image WHERE (id_number = '$acc_id_number')";

    $prof_stmt = $pdo->prepare($profile_pic);
    $prof_stmt->execute();
    $img_result = $prof_stmt->fetchAll();

} catch(PDOException $error){
    echo $profile_pic . "<br>" . $error->getMessage();
}

require "./components/header.php";
?>
<div id="body-pd" class="navbarBody">
    <header class="sidebarHead header" id="header">
        <div class="header_toggle"> <i class='bx bx-menu' id="header-toggle"></i> </div>
        <?php foreach ($img_result as $img_row) : ?>
            <div class="header_img"> <img class="navprof" src="<?php echo './upload/'.$img_row['file_name']?>" alt=""> </div>
        <?php endforeach;?>
    </header>
    <div class="l-navbar" id="nav-bar">
        <nav class="nav">
            <div> 
                <a href="#" class="nav_logo"> 
                    <img src="../../../img/logo_v4.png" class="logo img-fluid" alt="Display Image Communiucation"><span class="nav_logo-name">CCS</span> 
                </a>
                <div class="nav_list"> 
                    <a href="../counselor/appointment.php" class="nav_link"> 
                        <i class='bx bx-calendar nav_icon'></i> <span class="nav_name">Calendar</span> 
                    </a> 
                    <a href="../counselor/profile.php" class="nav_link"> 
                        <i class='bx bx-user nav_icon'></i> <span class="nav_name">Profile</span> 
                    </a> 
                    <a href="../counselor/appointmentList.php" class="nav_link"> 
                        <i class='bx bx-calendar-event nav_icon'></i> <span class="nav_name">Appointments List</span> 
                    </a> 
                    <a href="../counselor/activity_logs.php" class="nav_link"> 
                        <i class='bx bx-history nav_icon'></i> <span class="nav_name">Activity logs</span> 
                    </a> 
                </div>
            </div> 
            <a href="./php/logout.php" class="nav_link"> 
                <i class='bx bx-log-out nav_icon'></i> <span class="nav_name">SignOut</span> 
            </a>
        </nav>
    </div>
<script type="text/javascript">
    $(function(){
        $('a').each(function(){
            if ($(this).prop('href') == window.location.href) {
                $(this).addClass('active_nav'); 
            }
        });
    });
</script>
<!--Container Main end-->
