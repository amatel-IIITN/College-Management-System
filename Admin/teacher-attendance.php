<!---------------- Session starts form here ----------------------->
<?php
session_start();
if (!$_SESSION["LoginAdmin"]) {
	header('location:../login/login.php');
}
require_once "../connection/connection.php";
?>
<!---------------- Session Ends form here ------------------------>

<?php
if (isset($_POST['sub'])) {
	$teacher_id = $_POST['teacher_id'];
	$attendance = $_POST['attendance'];
	$date = date("d-m-y");

	$que = "insert into teacher_attendance(teacher_id,attendance,attendance_date)values('$teacher_id','$attendance','$date')";
	$run = mysqli_query($con, $que);
	if ($run) { ?>
		<script type="text/javascript">
			alert("Insert Successfully");
		</script>
<?php
	} else {
		echo " Insert Not Successfully";
	}
}
?>



<title>Admin - Teacher Attendance</title>


<?php include('../common/common-header.php') ?>

<div class="content-wrapper">
	<div class="sub-main">
		<div class="bar-margin text-center d-flex flex-wrap flex-md-nowrap pt-3 pb-2 mb-3 text-white bg-primary admin-dashboard pl-3">
			<h3>Teacher Attendance Management System </h3>
		</div>
		<div class="row">
			<div class="col-md-12">
				<form action="teacher-attendance.php" method="post">
					<div class="row mt-3">
						<div class="col-md-6">
							<div class="form-group">
								<label>Enter Teacher Id:</label>
								<div class="d-flex">
									<input type="text" class="form-control" name="teacher_id" placeholder="Enter Teacher I'd">
									<input type="submit" name="submit" class="btn btn-info px-4 ml-4" value="Search">
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
		<div class="row w-100">
			<div class="col-md-12 ml-2">
				<section class="border mt-3">
					<div class="card">
						<div class="card-body">
							<div class="table-responsive pt-3">
								<table class="w-100 table-bordered table-hover table-elements  table-three-tr" cellpadding="3">
									<tr class="table-tr-head table-three text-white bg-dark">
										<!-- Default checked -->
										<th>Sr.No</th>
										<th>Teacher ID</th>
										<th>Teacher Name</th>
										<th>Present</th>
										<th>Absent</th>
										<th>Working Days</th>
										<th>Attendance Per</th>
										<th>Add Attendance</th>
									</tr>
									<?php
									$i = 1;
									$conn = mysqli_connect("localhost", "root", "", "college");

									if (isset($_POST['submit'])) {
										$teacher_id = $_POST['teacher_id'];

										$que = "select teacher_id,first_name,middle_name,last_name from teacher_info where teacher_id='$teacher_id' ";
										$run = mysqli_query($con, $que);
										while ($row = mysqli_fetch_array($run)) {
									?>
											<form action="teacher-attendance.php" method="post">
												<tr>
													<td><?php echo $i++ ?></td>
													<td><?php echo $row['teacher_id'] ?></td>
													<input type="hidden" name="teacher_id" value=<?php echo $row['teacher_id'] ?>>
													<td><?php echo $row["first_name"] . " " . $row["middle_name"] . " " . $row["last_name"] ?></td>
													<td><?php echo 1 ?></td>
													<td><?php echo 1 ?></td>
													<td class="text-center"><?php echo "1/1" ?></td>
													<td><?php echo "50% of 100%" ?></td>
													<td>Present<input type="checkbox" name="attendance" value="1">Absent<input type="checkbox" name="attendance" value="0"></td>
												</tr>

										<?php
										}
									}
										?>
										<input class="btn btn-info mr-2" type="submit" name="sub">

											</form>
								</table>
							</div>
						</div>
					</div>
				</section>
			</div>
		</div>
	</div>
</div>


<?php include('../common/common-footer.php') ?>