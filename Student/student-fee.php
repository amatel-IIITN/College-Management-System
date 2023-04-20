<!---------------- Session starts form here ----------------------->
<?php  
	session_start();
	if (!$_SESSION["LoginStudent"])
	{
		header('location:../login/login.php');
	}
		require_once "../connection/connection.php";
	?>
<!---------------- Session Ends form here ------------------------>



		<title>Student - Fees</title>
		<?php include('../common/common-studentheader.php') ?>  
		<div class="content-wrapper">
		<!--<main role="main" class="col-xl-10 col-lg-9 col-md-8 ml-sm-auto px-md-4 mb-2 w-100">-->
			<div class="sub-main ">
				<div class="text-center d-flex bg-primary flex-wrap flex-md-nowrap pt-3 pb-2 mb-3 text-white admin-dashboard pl-3">
					<h4 class="">Student Fee Summary</h4>
				</div>
				
				<div class="row">
					<div class="col-md-12">
						<section class="border mt-3">
							<table class="w-100 table-striped table-hover table-bordered" cellpadding="10">
								<tr class=" text-black">
									<th colspan="9"><h4 class="text-center">Student Fee Detail</h4 class="text-center bg-info"></th>
								</tr>
								<tr class="bg-dark text-white">
									<th>Voucher No.</th>
									<th>Roll No.</th>
									<th>Student Name</th>
									<th>Program</th>
									<th>Amount (Rs.)</th>
									<th>Posting Date</th>
									<th>Status</th>
								</tr>
								<?php 
								$roll_no=$_SESSION['LoginStudent'];
									$query="select fee_voucher,student_fee.roll_no,first_name,middle_name,last_name,course_code,amount,date(posting_date) as posting_date,status from student_fee inner join student_info on student_fee.roll_no=student_info.roll_no where student_fee.roll_no='$roll_no'";
									$run=mysqli_query($con,$query);
									while ($row=mysqli_fetch_array($run)) { ?>
									<tr>
										<td><?php echo $row['fee_voucher'] ?></td>
										<td><?php echo $row['roll_no'] ?></td>
										<td><?php echo $row['first_name']." ".$row['middle_name']." ".$row['last_name'] ?></td>
										<td><?php echo $row['course_code'] ?></td>
										<td><?php echo $row['amount'] ?></td>
										<td><?php echo date($row['posting_date']) ?></td>
										<td><?php echo $row['status'] ?></td>
									</tr>
									<?php	
									}
								?>
							</table>				
						</section>
					</div>
				</div>
			</div>
		</main>
		</div>
 	<?php include('../common/common-footer.php') ?>