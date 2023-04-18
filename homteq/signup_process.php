<?php
// Start the session
session_start();

// Connect to the database
include("db.php");
//Call in stylesheet
echo "<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css' integrity='sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65' crossorigin='anonymous'>";
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>";


if(isset($_POST['register'])){
// Get the form data
    $fname = $_POST['userfname'];
    $lname = $_POST['userlname'];
    $address = $_POST['useraddress'];
    $postCode = $_POST['userpostcode'];
    $email = $_POST['useremail'];
    $telNo = $_POST['usertelno'];
    $password = $_POST['userpassword'];
    $password_1 = $_POST['userpassword1'];

    $errors = array();
//ensure that form fields are filled properly
   
    if(empty($fname) OR empty( $lname) OR empty( $address) OR empty( $postCode) OR empty($email) OR empty($telNo) OR empty($password) OR empty($password_1)){
          array_push($errors,"All fields are required");
    }

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
      array_push($errors,"Email is not valid");
    }

    if(strlen($password) < 8){
      array_push($errors,"Password must be at least 8 characters long");
    }

    if($password != $password_1){
      array_push($errors,"The two passwords do not match");
    }

    //if there are no errors, save user to database
    if(count($errors)> 0){

        foreach($errors as $error){
          echo "<div class='alert alert-danger'>$error</div>";
        }
      }
        else{

        // Hash the password for security
        $hash = password_hash($password, PASSWORD_ARGON2ID);


      // Create the SQL query to insert the data into the database
        $sql = "INSERT INTO Signup (fname, lname,userAddress,postCode, email,telNo, userPassword) VALUES ('$fname', '$lname','$address', '$postCode', '$email','$telNo', '$hash')";
      // Execute the query
        mysqli_query($conn, $sql);

        // Redirect the user to the homepage
        header("Location: logIn.php");

    } 

// else {
//   // If the query was not successful, display an error message
//   //echo "Error: " . $sql . "<br>" . mysqli_error($conn);
//   echo 'Sign up failed. Please try again.';
// }
}




// Execute the query
// if (mysqli_query($conn, $sql)) {
//   // If the query was successful, store the user's email in a session variable
//   $_SESSION['useremail'] = $email;

//   // Redirect the user to the homepage
//   header("Location: index.php");
// } else {
//   // If the query was not successful, display an error message
//   //echo "Error: " . $sql . "<br>" . mysqli_error($conn);
//   echo 'Sign up failed. Please try again.';
// }

// Close the database connection
mysqli_close($conn);
?>
