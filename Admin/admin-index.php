 <!---------------- Session starts form here ----------------------->
 <?php
	session_start();
	if (!$_SESSION["LoginAdmin"]) {
		header('location:../login/login.php');
	}
	require_once "../connection/connection.php";
	?>
 <!---------------- Session Ends form here ------------------------>
 <title>Admin - ICBS</title>
 <?php include('../common/common-header.php') ?>
 <div class="main-panel">
 	<div class="content-wrapper">
 		<div class="row">
 			<div class="col-md-12 grid-margin">
 				<div class="row">
 					<div class="col-12 col-xl-8 mb-4 mb-xl-0">
 						<h3 class="font-weight-bold">Welcome Admin</h3>
 						<h6 class="font-weight-normal mb-0">All systems are running smoothly! </h6>
 					</div>
 					<div class="col-12 col-xl-4">
 						<div class="justify-content-end d-flex">
 							<div class="dropdown flex-md-grow-1 flex-xl-grow-0">
 								<button class="btn btn-sm btn-light bg-white dropdown-toggle" type="button" id="dropdownMenuDate2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
 									<i class="mdi mdi-calendar"></i> Today (10 Jan 2021)
 								</button>
 								<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuDate2">
 									<a class="dropdown-item" href="#">January - March</a>
 									<a class="dropdown-item" href="#">March - June</a>
 									<a class="dropdown-item" href="#">June - August</a>
 									<a class="dropdown-item" href="#">August - November</a>
 								</div>
 							</div>
 						</div>
 					</div>
 				</div>
 			</div>
 		</div>
 		<div class="row">
 			<div class="col-lg-12 grid-margin stretch-card">
 				<div class="card">
 					<div class="card-body">
 						<h4 class="card-title">Time Table</h4>
 						<!-- <p class="card-description">
 							Add class <code>.table-hover</code>
 						</p> -->
 						<div class="table-responsive">
 							<table class="table table-bordered table-hover">
 								<thead>
 									<tr class="bg-dark text-light">
 										<th>Class Name</th>
 										<th>Time</th>
 										<th>Day</th>
 										<th>Subject</th>
 										<th>Room No</th>
 									</tr>
 								</thead>
 								<tbody>
 									<?php
										$query = "select * from time_table tt inner join weekdays wd on tt.day=wd.day_id";
										$run = mysqli_query($con, $query);
										while ($row = mysqli_fetch_array($run)) {
											echo "<tr>";
											echo "<td>" . $row["course_code"] . " " . $row["semester"] . "</td>";
											echo "<td>" . $row["timing_from"] . "<br>" . $row["timing_to"] . "</td>";
											echo "<td>" . $row["day_name"] . "</td>";
											echo "<td>" . $row["subject_code"] . "</td>";
											echo "<td>" . $row["room_no"] . "</td>";
											echo "</tr>";
										}
										?>
 								</tbody>
 							</table>
 						</div>
 					</div>
 				</div>
 			</div>
 			<div class="col-lg-12 grid-margin stretch-card">
 				<div class="card">
 					<div class="card-body">
 						<h4 class="card-title">Program List</h4>
 						<!-- <p class="card-description">
 							Add class <code>.table-bordered</code>
 						</p> -->
 						<div class="table-responsive pt-3">
 							<table class="table table-hover table-bordered">
 								<thead>
 									<tr class="bg-dark text-light">
 										<th>Course Code</th>
 										<th>Course Name</th>
 									</tr>
 								</thead>
 								<tbody>
 									<?php
										$query = "select course_name,course_code from courses";
										$run = mysqli_query($con, $query);
										while ($row = mysqli_fetch_array($run)) { ?>
 										<tr>
 											<td><?php echo $row['course_code'] ?></td>
 											<td><?php echo $row['course_name'] ?></td>
 										</tr>
 									<?php }
										?>
 								</tbody>
 							</table>
 						</div>
 					</div>
 				</div>
 			</div>
 			<div class="col-lg-12 stretch-card">
 				<div class="card">
 					<div class="card-body">
 						<h4 class="card-title">Department Subject Detail</h4>
 						<!-- <p class="card-description">
 							Add class <code>.table-{color}</code>
 						</p> -->
 						<div class="table-responsive pt-3">
 							<table class="table table-hover table-bordered">
 								<thead>
 									<tr class="bg-dark text-light">
									 <th>Course Code</th>
										<th>Course Title</th>
										<th>Semester</th>
										<th>Total Subjects</th>
										<th>Total Credit Hours</th>
 									</tr>
 								</thead>
 								<tbody>
								 <?php  
										$query="select course_code,course_name,semester,count(subject_code) as subject_code,sum(credit_hours) as credit_hours from course_subjects join courses using(course_code) group by course_code, semester";
										$run=mysqli_query($con,$query);
										while($row=mysqli_fetch_array($run)) {
											echo "<tr>";
											echo "<td>".$row["course_code"]."</td>";
											echo "<td>".$row["course_name"]."</td>";
											echo "<td>".$row["semester"]."</td>";
											echo "<td>".$row["subject_code"]."</td>";
											echo "<td>".$row["credit_hours"]."</td>";
											echo "</tr>";
										}
									?> 
 								</tbody>
 							</table>
 						</div>
 					</div>
 				</div>
 			</div>
 		</div>

 		<!-- content-wrapper ends -->
 		<!-- partial:partials/_footer.html -->
 	
 		<!-- partial -->
 	</div>
 	<?php include('../common/common-footer.php') ?>