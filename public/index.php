<?php
require "../src/components/header.php";
require "../src/components/homeNav.php";
?>
<div class="container-fluid">
  <div class="row">
    <div class="homeForms col-sm-5">
      <?php 
        require "../src/components/accountAccess.php";
      ?>
    </div>
    <div class="col text-center">
      <div class="row">
        <img id="animage" src="../img/frontDisplay_v2.png" class="img-fluid" alt="Display Image Communiucation">
      </div>
      <div class="row">
        <h1>CCS</h1>
        <h2>[--insert tagline here--]</h2>
      </div>
    </div>
  </div>
</div>
<?php
require "../src/components/footer.php";
?> 