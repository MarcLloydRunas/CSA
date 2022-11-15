<?php
require "navbarCounselor.php";
try {
  $view_log = "SELECT * FROM schedule_list WHERE (counselor_id = '$acc_id_number')";

  $log_state = $pdo->prepare($view_log);
  $log_state->execute();

  $log_result = $log_state->fetchAll();

}catch(PDOException $error) {
  echo $view_log . "<br>" . $error->getMessage();
}
?>
	<div class="logBody"> 
		<div class="row g-0">
			<div class="col-9"><h2 class="tophead">List of Upcoming Appointments</h2></div>
		</div>
		<br/>	
		<div class="table-responsive table-hover row">
			<table class="table table-stripped table-responsive" id="tablelogs">
			  <thead class="table-dark text-center">
			    <tr>
			      <th>Student ID</th>
			      <th>Title</th>
			      <th>Scheduled Date</th>
			      <th>Meeting Link</th>
			      <th>Date Added</th>
			    </tr>
			  </thead>
			  <tbody>
			  <?php foreach ($log_result as $row) : ?>
			    <tr class="text-center">
			      <td><?php echo ($row["student_id"]); ?></td>    
			      <td><?php echo ($row["title"]); ?></td>
			      <td><?php echo ($row["start_datetime"]. " - ".$row["start_datetime"]); ?></td>
			      <td><a href="<?php echo ($row["meeting_link"]); ?>"><?php echo ($row["meeting_link"]); ?></a></td>
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