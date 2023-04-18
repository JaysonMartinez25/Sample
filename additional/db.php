<?php
// Connect to database
$host = "localhost";
$username = "root";
$password = "";
$dbname = "profiles";

$conn = mysqli_connect($host, $username, $password, $dbname);

if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}

// Handle form submission
if (isset($_POST['submit'])) {
	$name = $_POST['name'];
	$email = $_POST['email'];
	$description = $_POST['description'];
	$interests = $_POST['interests'];
	$skills = $_POST['skills'];
	
	// Upload photo
	$target_dir = "uploads/";
	$target_file = $target_dir . basename($_FILES["photo"]["name"]);
	move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file);

	// Save data to database
	$sql = "INSERT INTO profiles (name, email, photo, description, interests, skills) VALUES ('$name', '$email', '$target_file', '$description', '$interests', '$skills')";
	
	if (mysqli_query($conn, $sql)) {
		echo "Data saved successfully.";
	} else {
		echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	
