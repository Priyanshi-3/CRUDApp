<?php
// Check if the form was submitted
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    // Check if file was uploaded without errors
    if(isset($_FILES["actfile"]) && $_FILES["actfile"]["error"] == 0)
	{
        //$allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
        $filename = $_FILES["actfile"]["name"];
        $filetype = $_FILES["actfile"]["type"];
        $filesize = $_FILES["actfile"]["size"];
    
        // Verify file extension
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $flag=0;
        //if(!array_key_exists($ext, $allowed)) die("Error: Please select a valid file format.");
    
        // Verify file size - 5MB maximum
        //$maxsize = 5 * 1024 * 1024;
        //if($filesize > $maxsize) die("Error: File size is larger than the allowed limit.");
		
        // Verify MYME type of the file
        //if(in_array($filetype, $allowed)){
            // Check whether file exists before uploading it
            if(file_exists("C:/xampp/htdocs/uploads/" . $filename))
			{
                echo $filename . " is already exists.";
                 $flag=1;        
            } 
			else
			{
                move_uploaded_file($_FILES["actfile"]["tmp_name"], "C:/xampp/htdocs/uploads/" . $filename);
                echo "Your file was uploaded successfully.";
            } 
        //} 
		//else{
          //  echo "Error: There was a problem uploading your file. Please try again."; 
        //}
		
		/* Attempt MySQL server connection. Assuming you are running MySQL
    server with default setting (user 'root' with no password) */
 if($flag==0){
    $link = mysqli_connect("localhost", "root", "", "file");

    // Check connection

    if($link === false){
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }

    // Escape user inputs for security
	$file_dbentry = mysqli_real_escape_string($link, $_POST['Filename']);
    $file_location = "C:/xampp/htdocs/uploads/" . $filename;
    // attempt insert query execution
    $sql = "INSERT INTO files(`File Name`, `File Location`) VALUES ('$file_dbentry', '$file_location')";
	//$sql = "INSERT INTO response (Username, `First Name`) VALUES ('$username', '$first_name')";

    if(mysqli_query($link, $sql)){
        echo "Records added successfully.";
    } else{
        echo "ERROR: Could not execute $sql. " . mysqli_error($link);
    }

    // close connection
    mysqli_close($link);
		
		
}	
    } 
	else
	{
        echo "Error: " . $_FILES["photo"]["error"];
    }
}

?>