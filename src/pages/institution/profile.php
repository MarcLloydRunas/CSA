<?php
require "navbarInstitution.php";

try {

    $user_profile="SELECT * FROM institution WHERE (institution_id = '$acc_id_number')";

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
                <h2><?php echo $user_row['institution_name']; ?></h2>
                <h4><?php echo $user_row['institution_id']?></h4>
            </div>
        </div>
        <br/>
        <div class="row lower-profile">
            <div class="col">
                <h6>Address: <?php echo $user_row['institution_address'];?></h6>
                <h6>Institution Code: <?php echo $user_row['institution_code'];?></h6>
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