<?php
session_start();
require "../../../../db/config.php";

if (isset($_SESSION['pass_id_number'])) {
    $acc_id_number = $_SESSION['pass_id_number'];
}else{
    $acc_id_number = "no id number found";
}

    // if(ISSET($_POST['file'])){
        $file_name = $_FILES['file']['name'];
        $file_temp = $_FILES['file']['tmp_name'];
        $file_size = $_FILES['file']['size'];
        $file_type = $_FILES['file']['type'];
        $date_uploaded=date("Y-m-d");
        $location="../upload/".$file_name;
        if($file_size < 5242880){
            if(move_uploaded_file($file_temp, $location)){
                $col_sel = "SELECT id_number FROM profile_image WHERE(id_number = '$acc_id_number')";

                if($stmt1 = $pdo->prepare($col_sel)){         
                    // Attempt to execute the prepared statement
                    if($stmt1->execute()){
                        if($stmt1->rowCount() == 1){
                            try{
                                $del_row = "DELETE FROM profile_image WHERE(id_number = '$acc_id_number')";

                                $sql = "INSERT INTO profile_image (id_number, file_name, file_type, date_uploaded, location)  VALUES ('$acc_id_number' ,'$file_name', '$file_type', '$date_uploaded', '$location')";

                                $pdo->exec($del_row);
                                $pdo->exec($sql);
                            }catch(PDOException $e){
                                echo $e->getMessage();
                            }
                        }else{
                            
                            try{
                                $sql = "INSERT INTO profile_image (id_number, file_name, file_type, date_uploaded, location)  VALUES ('$acc_id_number' ,'$file_name', '$file_type', '$date_uploaded', '$location')";
                                $pdo->exec($sql);
                            }catch(PDOException $e){
                                echo $e->getMessage();
                            }
                        }
                    }
                }                          
                unset($stmt1);
                $pdo = null;
                header('location: ../profile.php');
            }
        }else{
            echo "<center><h3 class='text-danger'>File too large to upload!</h3></center>";
        }
    // }
?>