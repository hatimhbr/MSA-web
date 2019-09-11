<?php
$username = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$message = $_POST['message'];
if (!empty($username) || !empty($email) || !empty($phone) || !empty($message)) {
	 $host = "localhost";
	 $dbUsername = "root";
	 $dbPassword = "Welcome01";
	 $dbname = "youtube";
	     //create connection
	 $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);
	 if (mysqli_connect_error()) {
	 die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
	 } else {
	 $SELECT = "SELECT email From register Where email = ? Limit 1";
	 $INSERT = "INSERT Into register (username, email, phone, message) values(?, ?, ?, ?)";
	 ////Prepare statement
	 $stmt = $conn->prepare($SELECT);
	 $stmt->bind_param("s", $email);
	 $stmt->execute();
	 $stmt->bind_result($email);
	 $stmt->store_result();
	 $rnum = $stmt->num_rows;
	 if ($rnum==0) {
	 $stmt->close();
	 $stmt = $conn->prepare($INSERT);
	 $stmt->bind_param("ssis", $username, $email, $phone, $message);
	 $stmt->execute();
	 echo "New record inserted sucessfully";
	 } else {
	 echo "Someone already register using this email";
	 }
	 $stmt->close();
	 $conn->close();
	     }
	     } else {
	     echo "All field are required";
	      die();
	      }
	      ?>
