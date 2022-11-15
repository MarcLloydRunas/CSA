<?php
require "navbarInstitution.php";
try {
  $view_log = "SELECT * FROM counselor WHERE (institution_code = '$institution_code')";

  $log_state = $pdo->prepare($view_log);
  $log_state->execute();

  $log_result = $log_state->fetchAll();

}catch(PDOException $error) {
  echo $view_log . "<br>" . $error->getMessage();
}
?>
    <div class="logBody"> 
        <div class="row g-0">
            <div class="col-9"><h2 class="tophead">Counselor List</h2></div>
        </div>
        <br/>   
        <div class="table-responsive table-hover row">
            <table class="table table-stripped table-responsive" id="tablelogs">
              <thead class="table-dark text-center">
                <tr>
                  <th>ID Number</th>
                  <th>Name</th>
                  <th>Date Registered</th>
                </tr>
              </thead>
              <tbody>
              <?php foreach ($log_result as $row) : ?>
                <tr class="text-center">
                  <td><?php echo ($row["counselor_id"]); ?></td>    
                  <td><?php echo ($row['first_name'] . " ". $row['middle_name'] ." ". $row['last_name'] ." ". $row['suffixes']); ?></td>
                  <td><?php echo date("F j, Y, g:i a",strtotime($row["date_added"])); ?></td>
                </tr>
              <?php endforeach; ?>
              </tbody>
            </table>    
        </div>
    </div>
</div>

<script type="text/javascript">

    $(document).ready(function () {
      $('#tablelogs').DataTable();
      $('.dataTables_length').addClass('bs-select');
    });

    
</script>
<?php
require "./components/footer.php";
?>