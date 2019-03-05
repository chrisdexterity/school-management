<?php
$server="localhost" ;
$user="Gracy";
$password="149807576grasi";
$dbname="schoolmanagement";

$conn=mysqli_connect($server,$user,$password,$dbname);
if (!$conn) {
	die("connection not successful :" .msql_connect_error());
	# code...
}
echo "<h3> connection successful<h3>";

 ?>