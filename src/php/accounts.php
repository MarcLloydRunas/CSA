<?php
session_start();
require('../db/config.php');

try {
    $delete_past = "DELETE FROM schedule_list
        WHERE end_datetime < DATE_ADD(NOW(),INTERVAL - 1 HOUR)";

    $statement_del = $pdo->prepare($delete_past);
    $statement_del->execute();

} catch(PDOException $error) {
    echo $delete_past . "<br>" . $error->getMessage();
}

// declare variables
$id_number = "";
$password = "";
$password_err = "";
$confirm_password = "";
$confirm_password_err = "";
$login_err = "";


$first_name = "";
$middle_name = "";
$last_name = "";
$suffixes = "";
$birth_date = "";
$sex = "";
$institution_code = "";
$student_pass = "";
$confirm_student_pass = "";
$student_pass_err = "";
$confirm_student_pass_err = "";
$code_err = "";
$initial_code = "";

$counselor_id = "";
$counselor_pass = "";
$counselor_pass_err = "";
$confirm_counselor_pass = "";
$confirm_counselor_pass_err = "";

$institution_name = "";
$institution_address = "";
$institution_pass = "";
$institution_pass_err = "";
$confirm_institution_pass = "";
$confirm_institution_pass_err = "";
 
// // Process user log in
if (isset($_POST['loginUser'])) {
     
    $id_number = trim($_POST["id_number"]);        
    $password = trim($_POST["password"]);
        
    // Validate credentials
    if(empty($login_err)){
        // Prepare a select statement
        $sql_login = "SELECT student_id as id_number, student_pass as password, account_type, institution_code
                        FROM student_account 
                        WHERE (student_id = '$id_number')
                        UNION
                        SELECT counselor_id as id_number, counselor_pass as password, account_type, institution_code
                        FROM counselor 
                        WHERE (counselor_id = '$id_number')
                        UNION 
                        SELECT institution_id as id_number, institution_pass as password, account_type, institution_code
                        FROM institution
                        WHERE (institution_id = '$id_number')";

        if($stmt = $pdo->prepare($sql_login)){         
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Check if account exists, if yes then verify password
                if($stmt->rowCount() == 1){
                    while($row = $stmt->fetch()){
                        $account_type = $row["account_type"];
                        if($account_type == "student"){
                            $id_number = $row["id_number"];
                            $hashed_password = $row["password"];
                            $institution_code = $row["institution_code"];

                            if(password_verify($password, $hashed_password)){
                                // Store data in session variables
                                $_SESSION["loggedin"] = true;
                                $_SESSION["pass_id_number"] = $id_number;
                                $_SESSION["account_type"] = $account_type;
                                $_SESSION["institution_code"] = $institution_code;
                                header("location: ../src/pages/student/appointment.php");
                                exit;
                            }
                        }elseif($account_type == "counselor"){
                            $id_number = $row["id_number"];
                            $hashed_password = $row["password"];
                            $institution_code = $row["institution_code"];
                            if(password_verify($password, $hashed_password)){
                                // Store data in session variables
                                $_SESSION["loggedin"] = true;
                                $_SESSION["pass_id_number"] = $id_number;
                                $_SESSION["account_type"] = $account_type;
                                $_SESSION["institution_code"] = $institution_code;
                                header("location: ../src/pages/counselor/appointment.php");
                                exit;
                            }
                        }elseif($account_type == "institution"){
                            $id_number = $row["id_number"];
                            $hashed_password = $row["password"];
                            $institution_code = $row["institution_code"];
                            if(password_verify($password, $hashed_password)){
                                // Store data in session variables
                                $_SESSION["loggedin"] = true;
                                $_SESSION["pass_id_number"] = $id_number;
                                $_SESSION["account_type"] = $account_type;
                                $_SESSION["institution_code"] = $institution_code;
                                header("location: ../src/pages/institution/profile.php");
                                exit;
                            }else{
                                $login_err = "hoy mali";
                            }
                        }else{
                            echo "Something went wrong";
                        }
                    }
                } else{
                    // Username doesn't exist, display a generic error message
                    $login_err = "Invalid id_number or password.";
                    echo "<script> alert('Error: Invalid ID Number or Password.'); location.replace('../public/index.php') </script>";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            unset($stmt);
        }
    }
}

// Processing form data for student registration
if (isset($_POST['studentRegister'])) {

    //Personal Information
    $student_id = abs( crc32( uniqid() ) );
    $first_name = trim($_POST["first_name"]);
    $middle_name = trim($_POST["first_name"]);
    $last_name = trim($_POST["last_name"]);
    $suffixes = trim($_POST["suffixes"]);
    $birth_date = trim($_POST["birth_date"]);
    $sex = trim($_POST["sex"]);
    $account_type = "student";
    $initial_code = trim($_POST["institution_code"]);

    $verify_code = "SELECT institution_code FROM institution WHERE institution_code = '$initial_code'";

    if($stmt = $pdo->prepare($verify_code)){
        
        // Attempt to execute the prepared statement
        if($stmt->execute()){
            // Check if code exists, if yes then verify password
            if($stmt->rowCount() == 1){
                $institution_code = $initial_code;
            } else{
                // code doesn't exist, display a generic error message
                $code_err = "Invalid code.";
                echo "<script> alert('Error: Invalid institution code.'); location.replace('../public/index.php') </script>";
            }
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
        // Close statement
        unset($stmt);
    }

    // Validate password
    if(empty(trim($_POST["student_pass"]))){
        $student_pass_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["student_pass"])) < 6){
        $student_pass_err = "Password must have atleast 6 characters.";
    } else{
        $student_pass = trim($_POST["student_pass"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_student_pass"]))){
        $confirm_student_pass_err = "Please confirm password.";     
    } else{
        $confirm_student_pass = trim($_POST["confirm_student_pass"]);
        if(empty($confirm_student_pass_err) && ($student_pass != $confirm_student_pass)){
            $confirm_student_pass_err = "Password did not match.";
        }
    }
    
    // Check input errors before inserting in database
    if(empty($confirm_student_pass_err) && empty($student_pass_err) && empty($code_err)){
        
        // Prepare an insert statement
        $add_student = "INSERT INTO student_account (
            student_id, 
            first_name,
            middle_name,   
            last_name,
            suffixes,
            birth_date,
            sex,
            institution_code, 
            student_pass,
            account_type) 
        VALUES (
            :student_id, 
            :first_name,
            :middle_name,   
            :last_name,
            :suffixes,
            :birth_date,
            :sex,
            :institution_code, 
            :student_pass,
            :account_type)";
         
        if($stmt = $pdo->prepare($add_student)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":student_id", $param_student_id, PDO::PARAM_STR);
            $stmt->bindParam(":first_name", $param_first_name, PDO::PARAM_STR);
            $stmt->bindParam(":middle_name", $param_middle_name, PDO::PARAM_STR);
            $stmt->bindParam(":last_name", $param_last_name, PDO::PARAM_STR);
            $stmt->bindParam(":suffixes", $param_suffixes, PDO::PARAM_STR);
            $stmt->bindParam(":birth_date", $param_birth_date, PDO::PARAM_STR);
            $stmt->bindParam(":sex", $param_sex, PDO::PARAM_STR);
            $stmt->bindParam(":institution_code", $param_institution_code, PDO::PARAM_STR);
            $stmt->bindParam(":student_pass", $param_student_pass, PDO::PARAM_STR);
            $stmt->bindParam(":account_type", $param_account_type, PDO::PARAM_STR);
            
            // Set parameters
            $param_student_id = $student_id;
            $param_first_name = $first_name;
            $param_middle_name = $middle_name;
            $param_last_name = $last_name;
            $param_suffixes = $suffixes;
            $param_birth_date = $birth_date;
            $param_sex = $sex;
            $param_institution_code = $institution_code;
            $param_student_pass = password_hash($student_pass, PASSWORD_DEFAULT); // Creates a password hash
            $param_account_type = $account_type;
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Redirect to login page
                header("location: ../src/pages/student/appointment.php");
                exit;
            } else{
                echo "<div class='container aligns-items-center justify-content-center' style='width:500px; position:absolute; top:-20px; left: 40%'>
                            <div class='container alert alert-danger alert-dismissible d-flex align-items-center fade show' style='margin:-50px;'>
                                    <i class='bi-exclamation-octagon-fill'></i>
                                    <strong class='mx-1'>Error!</strong> Something went wrong. Please try again later.
                                    <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
                            </div>
                      </div>";
            }

            // Close statement
            unset($stmt);
        }
    }
    
    // Close connection
    unset($pdo);
}

// Processing form data for counselor registration
if (isset($_POST['counselorRegister'])) {

    //Personal Information
    $counselor_id = abs( crc32( uniqid() ) );
    $first_name = trim($_POST["first_name"]);
    $middle_name = trim($_POST["middle_name"]);
    $last_name = trim($_POST["last_name"]);
    $suffixes = trim($_POST["suffixes"]);
    $birth_date = trim($_POST["birth_date"]);
    $sex = trim($_POST["sex"]);
    $account_type = "counselor";
    $initial_code = trim($_POST["institution_code"]);

    $verify_code = "SELECT institution_code FROM institution WHERE institution_code = '$initial_code'";

    if($stmt = $pdo->prepare($verify_code)){
        
        // Attempt to execute the prepared statement
        if($stmt->execute()){
            // Check if code exists, if yes then verify password
            if($stmt->rowCount() == 1){
                $institution_code = $initial_code;
            } else{
                // code doesn't exist, display a generic error message
                $code_err = "Invalid code.";
                echo "<script> alert('Error: Invalid institution code.'); location.replace('../public/index.php') </script>";
            }
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
        // Close statement
        unset($stmt);
    }

    // Validate password
    if(empty(trim($_POST["counselor_pass"]))){
        $counselor_pass_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["counselor_pass"])) < 6){
        $counselor_pass_err = "Password must have atleast 6 characters.";
    } else{
        $counselor_pass = trim($_POST["counselor_pass"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_counselor_pass"]))){
        $confirm_counselor_pass_err = "Please confirm password.";     
    } else{
        $confirm_counselor_pass = trim($_POST["confirm_counselor_pass"]);
        if(empty($confirm_counselor_pass_err) && ($counselor_pass != $confirm_counselor_pass)){
            $confirm_counselor_pass_err = "Password did not match.";
        }
    }
    
    // Check input errors before inserting in database
    if(empty($confirm_counselor_pass_err) && empty($counselor_pass_err) && empty($code_err)){
        
        // Prepare an insert statement
        $add_counselor = "INSERT INTO counselor (
            counselor_id, 
            first_name,
            middle_name,   
            last_name,
            suffixes,
            birth_date,
            sex,
            institution_code, 
            counselor_pass,
            account_type) 
        VALUES (
            :counselor_id, 
            :first_name,
            :middle_name,   
            :last_name,
            :suffixes,
            :birth_date,
            :sex,
            :institution_code, 
            :counselor_pass,
            :account_type)";
         
        if($stmt = $pdo->prepare($add_counselor)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":counselor_id", $param_counselor_id, PDO::PARAM_STR);
            $stmt->bindParam(":first_name", $param_first_name, PDO::PARAM_STR);
            $stmt->bindParam(":middle_name", $param_middle_name, PDO::PARAM_STR);
            $stmt->bindParam(":last_name", $param_last_name, PDO::PARAM_STR);
            $stmt->bindParam(":suffixes", $param_suffixes, PDO::PARAM_STR);
            $stmt->bindParam(":birth_date", $param_birth_date, PDO::PARAM_STR);
            $stmt->bindParam(":sex", $param_sex, PDO::PARAM_STR);
            $stmt->bindParam(":institution_code", $param_institution_code, PDO::PARAM_STR);
            $stmt->bindParam(":counselor_pass", $param_counselor_pass, PDO::PARAM_STR);
            $stmt->bindParam(":account_type", $param_account_type, PDO::PARAM_STR);
            
            // Set parameters
            $param_counselor_id = $counselor_id;
            $param_first_name = $first_name;
            $param_middle_name = $middle_name;
            $param_last_name = $last_name;
            $param_suffixes = $suffixes;
            $param_birth_date = $birth_date;
            $param_sex = $sex;
            $param_institution_code = $institution_code;
            $param_counselor_pass = password_hash($counselor_pass, PASSWORD_DEFAULT); // Creates a password hash
            $param_account_type = $account_type;
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Redirect to login page
                header("location: ../src/pages/counselor/appointment.php");
                exit;
            } else{
                echo "<div class='container aligns-items-center justify-content-center' style='width:500px; position:absolute; top:-20px; left: 40%'>
                            <div class='container alert alert-danger alert-dismissible d-flex align-items-center fade show' style='margin:-50px;'>
                                    <i class='bi-exclamation-octagon-fill'></i>
                                    <strong class='mx-1'>Error!</strong> Something went wrong. Please try again later.
                                    <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
                            </div>
                      </div>";
            }

            // Close statement
            unset($stmt);
        }
    }
    
    // Close connection
    unset($pdo);
}

// Processing form data for institution registration
if (isset($_POST['institutionRegister'])) {

    $institution_id = abs( crc32( uniqid() ) );
    $institution_name = trim($_POST["institution_name"]);
    $institution_address = trim($_POST["institution_address"]);
    $institution_code = uniqid();
    $account_type = "institution";

    // Validate password
    if(empty(trim($_POST["institution_pass"]))){
        $institution_pass_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["institution_pass"])) < 6){
        $institution_pass_err = "Password must have atleast 6 characters.";
    } else{
        $institution_pass = trim($_POST["institution_pass"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_institution_pass"]))){
        $confirm_institution_pass_err = "Please confirm password.";     
    } else{
        $confirm_institution_pass = trim($_POST["confirm_institution_pass"]);
        if(empty($institution_pass_err) && ($institution_pass != $confirm_institution_pass)){
            $confirm_institution_pass_err = "Password did not match.";
        }
    }
    
    if(empty($institution_pass_err) && empty($confirm_institution_pass_err)) {
    // Prepare an insert statement
        $add_institution = "INSERT INTO institution (
            institution_id, 
            institution_name, 
            institution_address, 
            institution_code, 
            institution_pass,
            account_type) 
        VALUES (
            :institution_id, 
            :institution_name, 
            :institution_address, 
            :institution_code, 
            :institution_pass,
            :account_type)";
         
        if($stmt = $pdo->prepare($add_institution)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":institution_id", $param_institution_id, PDO::PARAM_STR);
            $stmt->bindParam(":institution_name", $param_institution_name, PDO::PARAM_STR);
            $stmt->bindParam(":institution_address", $param_institution_address, PDO::PARAM_STR);
            $stmt->bindParam(":institution_code", $param_institution_code, PDO::PARAM_STR);
            $stmt->bindParam(":institution_pass", $param_institution_pass, PDO::PARAM_STR);
            $stmt->bindParam(":account_type", $param_account_type, PDO::PARAM_STR);
            
            // Set parameters
            $param_institution_id = $institution_id;
            $param_institution_name = $institution_name;
            $param_institution_address = $institution_address;
            $param_institution_code = $institution_code;
            $param_institution_pass = password_hash($institution_pass, PASSWORD_DEFAULT); // Creates a password hash;
            $param_account_type = $account_type;
            
            // Attempt to execute the prepared statement
            
            if($stmt->execute()){
                // Redirect to login page
                header("location: ../src/pages/institution/profile.php");
                exit;
            } else{
                echo "<div class='container aligns-items-center justify-content-center' style='width:500px; position:absolute; top:-20px; left: 40%'>
                            <div class='container alert alert-danger alert-dismissible d-flex align-items-center fade show' style='margin:-50px;'>
                                    <i class='bi-exclamation-octagon-fill'></i>
                                    <strong class='mx-1'>Error!</strong> Something went wrong. Please try again later.
                                    <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
                            </div>
                      </div>";
            }

            // Close statement
            unset($stmt);
        }
    }
    
    // Close connection
    unset($pdo);
}?>  