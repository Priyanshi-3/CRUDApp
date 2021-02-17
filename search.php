<?php

	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "file";
	
	$conn = new mysqli($servername, $username, $password, $dbname);

	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	
	// $link = mysqli_connect("localhost", "username", "password", "lab");
	// if($link === false){
        // die("ERROR: Could not connect. " . mysqli_connect_error());
    // }
	$text=$_POST['search'];
    // echo $_POST['search'];
    $sql = "SELECT * FROM files WHERE `File Name`='$text'";
	$result = $conn->query($sql);
	// echo $result->num_rows;
	echo"
		<html><head>
		<style>
			table, th, td{
			border: 1px solid black;
			border-collapse: collapse;
		}
		</style></head><body>
		<table>
			<tr><th>File Name</th><th>Action</th></tr>
	";
	
	if($result->num_rows > 0){
		// output data of each row
		while($row = $result->fetch_assoc()){
			echo
			"<tr><td>".$row['File Name']."</td><td><a href=\"edit.php?\">Edit</a> | <p><a href='download.php?file=".$row['File Location']."' target='_blank '>Download</a></p></td></tr>";
			}
	}
	else{
		echo "No results to display";
	}
	// }
	
    // close connection
	$conn->close();
	?>