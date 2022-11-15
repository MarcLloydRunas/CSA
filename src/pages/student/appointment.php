<?php
require "navbarStudent.php";
?>
    <div class="appointmentBody">
        <div class="container" id="page-container">
            <div class="row">
                <h2>Set Appointment</h2>
            </div>
            <div class="row">
                <div class="col-md-9">
                    <div id="calendar"></div>
                </div>
                <div class="schedForm container-fluid col-md-3">
                    <div class="cardt shadow">
                        <div class="text-light">
                            <h5 class="text-center">Schedule Form</h5>
                        </div>
                        <div class="card-body">
                            <div class="container-fluid">
                                <form action="./php/save_schedule.php" method="post" id="schedule-form">
                                    <input type="hidden" name="id" value="">
                                    <div class="form-group mb-2">
                                        <label for="title" class="control-label">Title</label>
                                        <input type="text" class="form-control form-control-sm" name="title" id="title" required>
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="description" class="control-label">Description</label>
                                        <textarea rows="3" class="form-control form-control-sm" name="description" id="description" required></textarea>
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="date_sched" class="control-label">Date</label>
                                        <input type="date" class="form-control form-control-sm" name="date_sched" id="date_sched" required>
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="time_sched" class="control-label">Time</label>
                                        <select class="form-control form-control-sm" name="time_sched" id="time_sched" required>
                                            <option value="">Choose prefered time</option>
                                            <option value="8:00:00&10:00:00">8:00am-10:00am</option>
                                            <option value="10:00:00&12:00:00">10:00-12:00am</option>
                                            <option value="13:00:00&15:00:00">1:00pm-3:00pm</option>
                                            <option value="15:00:00&17:00:00">3:00pm-5:00pm</option>
                                        </select>
                                        <span class="invalid-feedback"><?php echo $sched_err; ?></span>
                                    </div>
                                    <div class="form-group mb-2">
                                        <div class="row">
                                            <div class="col">
                                                <label for="meeting_link" class="control-label">Meeting Link</label>
                                            </div>
                                            <div class="col d-flex flex-row-reverse">
                                                <a class="meeting_link_tag" href="https://meet.google.com/" target="_blank">Get link</a>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control form-control-sm" name="meeting_link" id="meeting_link" placeholder="Paste link here" required>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="text-center">
                                <button class="btn btn-primary btn-sm" type="submit" form="schedule-form"><i class="fa fa-save"></i> Save</button>
                                <button class="btn btn-primary btn-sm" type="reset" form="schedule-form"><i class="fa fa-reset"></i> Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Event Details Modal -->

    <?php 
    $schedules = $pdo->query("SELECT * FROM `schedule_list`");
    $sched_res = [];
    foreach($schedules->fetchAll() as $row){
        $row['sdate'] = date("F d, Y h:i A",strtotime($row['start_datetime']));
        $row['edate'] = date("F d, Y h:i A",strtotime($row['end_datetime']));
        $_SESSION["pass_student_id"] = $row['student_id'];
        $sched_res[$row['id']] = $row;
    }

    unset($pdo);
    ?>
    </div>
</div>
<!-- Event Details Modal -->
    <div class="modal fade" data-bs-backdrop="static" id="event-details-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header rounded-0">
                    <h5 class="modal-title">Schedule Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <dl>
                            <dt class="text-muted">ID Number</dt>
                            <dd id="id_number" class=""></dd>
                            <dt class="text-muted">Title</dt>
                            <dd id="title" class="fw-bold fs-4"></dd>
                            <dt class="text-muted">Description</dt>
                            <dd id="description" class=""></dd>
                            <dt class="text-muted">Start</dt>
                            <dd id="start" class=""></dd>
                            <dt class="text-muted">End</dt>
                            <dd id="end" class=""></dd>
                            <dt class="text-muted">Meeting Link</dt>
                            <a id="meeting_link" class="" href="#" target="_blank"></a>
                        </dl>
                    </div>
                </div>
                <div class="modal-footer rounded-0">
                    <div class="text-end">
                        <button type="button" class="btn btn-primary btn-sm" id="edit" data-id="">Edit</button>
                        <button type="button" class="btn btn-danger btn-sm" id="delete" data-id="">Delete</button>
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
require "./components/footer.php";
?>
<script type="text/javascript">
    var scheds = $.parseJSON('<?= json_encode($sched_res) ?>');
    var userid = "<?php echo $acc_id_number ?>";
</script>
<script src="./js/script.js"></script>