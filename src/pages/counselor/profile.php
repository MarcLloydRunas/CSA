<?php
require "navbarCounselor.php";

try {

    $user_profile="SELECT * FROM counselor WHERE (counselor_id = '$acc_id_number')";

    $statement_prof = $pdo->prepare($user_profile);
    $statement_prof->execute();
    $user_result = $statement_prof->fetchAll();

} catch(PDOException $error){
    echo $user_profile . "<br>" . $error->getMessage();
}
?>
    <div class="profileBody">
        <h1>Profile</h1>
        <div class="row topper-profile">
        <?php foreach ($user_result as $user_row) : ?>
            <div class="col-md-1">
                <img src="../../../img/profile.jpg" class="profilePic" alt="Profile Picture">
            </div>
            <div class="col-md-9 profpad">
                <h2><?php echo $user_row['first_name'] . " ". $user_row['middle_name'] ." ". $user_row['last_name'] ." ". $user_row['suffixes']; ?></h2>
                <h4><?php echo $user_row['counselor_id']?></h4>
            </div>
        </div>
        <br/>
        <div class="row lower-profile">
            <div class="col">
                <h6>Sex: <?php echo $user_row['sex'];?></h6>
                <h6>Date of Birth: <?php echo date("F j, Y",strtotime($user_row["birth_date"]));?></h6>
                <h6>Institution: 
                <?php
                $in_code = $user_row['institution_code'];
                try {
                    $user_institution = "SELECT * FROM institution WHERE (institution_code = '$in_code')";
                    $statement_ins = $pdo->prepare($user_institution);
                    $statement_ins->execute();
                    $ins_result = $statement_ins->fetchAll();
                } catch(PDOException $error){
                    echo $user_institution . "<br>" . $error->getMessage();
                }
                foreach($ins_result as $ins_row){
                    echo $ins_row['institution_name'];
                }
                ?>
                </h6>
            </div>
            <div class="col">
                
            </div>
        </div>
        <?php endforeach;?>
    </div>
</div>
<?php
require "./components/footer.php";
?>