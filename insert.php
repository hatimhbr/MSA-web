<?php
$name = $_POST['name'];
$email = $_POST['email'];
$subject = $_POST['subject'];
$message = $_POST['message'];

if(!empty($name) || !empty($email) || !empty($subject) || !empty($message))
{
    $host = "localhost";
    $dbUsername = "hatimhr";
    $dbPassword = "hatimhr8704";
    $dbname = "contact_form";

    //creating connection
    $conn = new mysqli($host,$dbUsername,$dbPassword,$dbname);

    if(mysqli_connect_error()) {
        die('Connect Error('.mysqli_connect_errno().')'. mysqli_connect_error());
    } else {
       $SELECT = "SELECT email From contact_form Where email = ? Limit 1";
       $INSERT = "INSERT Into contact_form (name, email, subject, message) values (?, ?, ?, ?,)";
       
       //prepare statement
       $stmt = $conn->prepare($SELECT);
       $stmt ->bind_param("s", $email);
       $stmt->execute();
       $stmt->bind_result($email);
       $stmt->store_result();
       $rnum = $stmt->num_rows;

       if($rnum==0) {
           $stmt->close();

           $stmt = $conn->prepare($INSERT);
           $stmt->bind_param("ssss",$name,$email,$subject,$message);
           $stmt->execute();
           echo "New record inserted successfully";
       } else {
           echo "Someone already register using this email";
       }
       $stmt->close();
       $conn->close();
       }
    }
 {
    echo "All fields are required";
    die();
}
?>