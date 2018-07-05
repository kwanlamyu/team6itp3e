<?php
	if(isset($_POST["export"]))
	{
		$servername = "localhost";
		$username = "root";
		$password = "password";
		$dbname = "ecomplyc_itp";		
		
		$conn = mysqli_connect($servername,$username,$password,$dbname);
		header('Content-Type: text/csv; charset=utf-8');
		header ('Content-Disposition:attachment; filename=data.csv');
		$output = fopen("php://output","w");
		fputcsv($output, array('UEN','companyName','file number', 'date of creation', 'user_username'));
		$query = "SELECT * FROM account";
		$result = mysqli_query($conn,$query);
		while($row = mysqli_fetch_assoc($result)){
			fputcsv($output, $row);
		}
		fclose($output);
	}
?>