<?php
require "navbarCounselor.php";
try {
  $view_log = "SELECT * FROM activity_log WHERE (log_id = '$acc_id_number') OR (receiver = '$acc_id_number')";

  $log_state = $pdo->prepare($view_log);
  $log_state->execute();

  $log_result = $log_state->fetchAll();

}catch(PDOException $error) {
  echo $view_log . "<br>" . $error->getMessage();
}
?>
	<div class="logBody"> 
		<div class="row g-0">
			<div class="col-9"><h2 class="tophead">Activity Logs</h2></div>
			<div class="col-3"><button onclick="window.open('./php/generatedPDF.php','_blank')" class="btn btn-primary bttnhead"> <i class='bx bx-printer' id="icon-bttn"></i> PDF</button>
			</div>
		</div>
		<br/>	
		<div class="table-responsive table-hover row">
			<table class="table table-stripped table-responsive" id="tablelogs">
			  <thead class="table-dark text-center">
			    <tr>
			      <th>ID Number</th>
			      <th>Activity</th>
			      <th>Student ID</th>
			      <th>Date</th>
			    </tr>
			  </thead>
			  <tbody>
			  <?php foreach ($log_result as $row) : ?>
			    <tr class="text-center">
			      <td><?php echo ($row["log_id"]); ?></td>    
			      <td><?php echo ($row["appointment"]); ?></td>
			      <td><?php echo ($row["receiver"]); ?></td>
			      <td><?php echo date("F j, Y, g:i a",strtotime($row["date"])); ?></td>
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