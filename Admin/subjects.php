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
	$subject_code = $_POST['subject_code'];
	$subject_name = $_POST['subject_name'];
	$semester = $_POST['semester'];
	$course_code = $_POST['course_code'];
	$credit_hours = $_POST['credit_hours'];

	$query = "insert into course_subjects(subject_code,subject_name,course_code,semester,credit_hours)values('$subject_code','$subject_name','$course_code','$semester','$credit_hours')";
	$run = mysqli_query($con, $query);
	if ($run) {
		echo "successfully";
	} else {
		echo "not";
	}
}
?>



	<title>Admin - Subjects</title>

	<?php include('../common/common-header.php') ?>

	<div class="content-wrapper">
		<div class="sub-main">
			<div style="align-items: center;" class="text-center bg-primary d-flex flex-wrap flex-md-nowrap pt-3 pb-2 mb-3 text-white admin-dashboard pl-3">
				<div class="d-flex">
					<h3 class="mr-5">Subject Management System </h4>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<form action="subjects.php" method="post">
						<div class="row mt-3">
							<div class="col-md-6">
								<div class="form-group">
									<label for="exampleInputEmail1">Subject Code: </label>
									<input type="text" name="subject_code" class="form-control" required placeholder="Enter Subject Code" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="exampleInputPassword1">Subject Name:</label>
									<input type="text" name="subject_name" class="form-control" required placeholder="Enter Subject Name" required>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="exampleInputPassword1">Semester:</label>
									<input type="text" name="semester" class="form-control" required placeholder="Enter Semester" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="exampleInputEmail1">Course Code:</label>
									<select class="browser-default custom-select" name="course_code">
										<option>Select Course</option>
										<?php
										$query = "select course_code from courses";
										$run = mysqli_query($con, $query);
										while ($row = mysqli_fetch_array($run)) {
											echo	"<option value=" . $row['course_code'] . ">" . $row['course_code'] . "</option>";
										}
										?>
									</select>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="exampleInputPassword1">Credit Hours:</label>
									<input type="number" name="credit_hours" class="form-control" placeholder="Enter Subject Credit Hours" required>
								</div>
							</div>
							<div class="col-md-6 mt-4">
								<div class="form-group pt-2">
									<input type="submit" name="sub" value="Add Subject" class="btn btn-info">
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12 grid-margin stretch-card">
					<div class="card">
						<div class="card-body">
							<h4 class="card-title"></h4>
							<!-- <p class="card-description">
								Add class <code>.table-bordered</code>
							</p> -->
							<div class="table-responsive pt-3">
								<table class="table table-hover table-bordered">
									<thead>
										<tr class="bg-dark text-white">
											<th>Sr.No</th>
											<th>Subject Code</th>
											<th>Subject Name</th>
											<th>Course Code</th>
											<th>Semester</th>
											<th>Credit Hours</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$sr = 1;
										$query = "select subject_code,subject_name,course_code,semester,credit_hours from course_subjects";
										$run = mysqli_query($con, $query);
										while ($row = mysqli_fetch_array($run)) {
											echo	"<tr>";
											echo	"<td>" . $sr++ . "</td>";
											echo	"<td>" . $row['subject_code'] . "</td>";
											echo	"<td>" . $row['subject_name'] . "</td>";
											echo	"<td>" . $row['course_code'] . "</td>";
											echo	"<td>" . $row['semester'] . "</td>";
											echo	"<td>" . $row['credit_hours'] . "</td>";
											echo	"<td width='20'><a class='btn btn-danger' href=delete-function.php?subject_code=" . $row['subject_code'] . ">Delete</a></td>";
											echo	"</tr>";
										}
										?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
									</div>
									 		<!-- partial -->
 	</div>
 	<?php include('../common/common-footer.php') ?>