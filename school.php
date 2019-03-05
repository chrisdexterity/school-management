<?php 		
ob_start();
require'includes/connection.php' ?>
<!DOCTYPE html>
<html>
<head>
	<title>php/msql school management system</title>
	<!-- bootstrap.css -->
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
	<style type="text/css">
		#delete{
			background-color: blue;
			#update{
			background-color: green;
		}

	</style>

</head>
<body>
	<!-- A grey horizontal navbar that becomes vertical on small screens -->
	<nav class="navbar navbar-expand-sm bg-light">
		<a class="navbar-brand" href="#">School Management(CRUD)</a>

		<!-- Links -->
		<ul class="navbar-nav">
			<li class="nav-item">
				<a class="nav-link " href="#"><h3>Create</h3></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#"><h3>Read</h3></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#"><h3>Update</h3></a>          
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#"><h3>Delete</h3></a>          
			</li>
		</ul>

	</nav>
	<div class="container fluid">
		<div class="jumbotron text-center">
			<h2>School Management System</h2>
			<h3 class="text-primary">Using mysql/php CRUD <br>Create,Read,Update,Delete</h3>
			<a href="#register" class="btn btn-danger btn-lg">Register</a>
			
		</div>
		
	</div>
	<br>
	<div class="container text-center" id="register">
		<h2 class="text-success">Register(Create)</h2>
		<form action="school.php" method="post">
			<div class="row">
				<div class="col-6">
					<div class="form-group">
						<label>Name:
							<input type="text" name="name" class="form-control" required>

						</label>
						</div> 
						<div class="form-group">
							<label>Parent's Name:
								<input type="text" name="parent" class="form-control" required>

							</label>
						</div>
							<div class="form-group">
								<label>Email:
									<input type="text" name="mail" class="form-control" required>

								</label>
							</div>
						</div>
						<div class="col-6">
							<div class="form-group">
								<label>contact details:
									<input type="text" name="details" class="form-control" required>
								</label>
							</div>
								<div class="form-group">
									<label>Course:
										<input type="text" name="course" class="form-control" required>
									</label>
								</div>
									<div class="form-group">
										<label>Reg date:
											<input type="text" name="date" class="form-control" required>
										</label>
									</div>
								</div>
							</div>
							<input type="submit" name="submit" value="Register" class="btn btn-warning	 btn-block">
						</form>
					</div>


<br>
<?php
//read from DB table
$query="SELECT * FROM registration2";
$result=mysqli_query($conn, $query);
//test for a query run
if (!$result) {
	die("query failed:".mysqli_error($conn));
	# code...
}
echo "<h3>Query success</h3>";
 ?>
<div class="container fluid text-center">
	<h2 class="text-center text-primary "> View (Read)</h2>
	<table class="table table-stripped table-bordered table-hover">
		<thead>
			<tr>
				<th>Id</th>
				<th>Name</th>
				<th>Email</th>
				<th>Parent</th>
				<th>Contact Details</th>
				<th>Course</th>
				<th>Registration Date</th>
				<th class="btn btn-success"> <br>UPDATE</th>
				<th class="btn btn-danger"> <br>DELETE</th>
			</tr>
		</thead>
		<tbody>
			<?php
			//use returned data
			while ($row=mysqli_fetch_assoc($result)) {
				echo "<tr>
				<td>$row[id]</td>
				<td>$row[name]</td>
				<td>$row[parent]</td>
				<td>$row[email]</td>
				<td>$row[contact]</td>
				<td>$row[course]</td>
				<td>$row[registration]</td>
				<td><a href='#' class='btn btn-success btn-small'>Update<a/></td>
				<td><a href='school.php?delete_id=$row[id]' class='btn btn-danger btn-small'>Delete<a/></td>
				</tr>";
			 } 

			 ?>
		</tbody>
	</table>
	
</div>



</body>
</html>
<?php 
if (isset($_POST['submit'])) {
	//grab user input
	$name=$_POST['name'];
	$parent=$_POST['parent'];
	$Email=$_POST['mail'];
	$contact=$_POST['details'];
	$course=$_POST['course'];
	$reg=$_POST['date'];
	//register users to db
$query="INSERT INTO registration2(name,parent,email,contact,course,registration)VALUES('$name','$parent','$Email','$contact','$course','$reg')";
$run=mysqli_query($conn,$query);
if (!$run) {
	die("query error:".msqli_error($conn));
}else{
	echo "<h3>query success</h3>";
	header("location:school.php");
	//refresh browser
	
}


	# code...
}

 ?>
 <?php
 //delete
 //DELETE FROM table n
 if (isset($_GET['delete_id'])) { 
 	$query_del="DELETE FROM registration2 WHERE id= '$_GET[delete_id]'";
 	if (mysqli_query($conn,$query_del)) {
 		//query sucess
 		echo "Record deleted";
 		//reload page
 		header('location: school.php');
 	}else{
 		die("Delete failed:" .mysqli_error($conn));
 	}
 	
 }

  ?>