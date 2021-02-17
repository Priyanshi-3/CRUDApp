
	<?php

	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "file";
	
	$conn = new mysqli($servername, $username, $password, $dbname);

	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	$sql = "SELECT * FROM files";
	$result = $conn->query($sql);

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
		echo "NOTHING TO DISPLAY";
	}
	// }
	
    // close connection
    $conn->close();
?>
	<html>
	
		
		<body>
	<div class="d1">
	<form action="UploadForm.html" id="form" method="post">
		<input type="submit" id="upload" value="UPLOAD" ><br><br>
</form>
		<!-- <input type="submit" id="download" value="DOWNLOAD" formaction="down.html"> -->
		
        <form action="search.php" id="form" method="post">
		
		<label>SEARCH:</label>
		<input type="text" placeholder="Enter File Name" name="search" required></input>
		<br>
		
		<input type="submit" name="submit" value="SEARCH"><br><br>
</form>
	</div>
	
	</body>
</html>