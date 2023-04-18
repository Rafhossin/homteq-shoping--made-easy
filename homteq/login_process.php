<?php
//a function need to be created in every page to be able to start the session.
session_start();
include("db.php");

//Create and populate a variable called $pagename 
$pagename = "login outcome"; 

////This code is a PHP script that generates a HTML link tag for a stylesheet called "mystylesheet.css". The link tag is used to link a HTML document to an external CSS stylesheet, which defines the visual styles for the document.
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>"; 

//display name of the page as window title
echo "<title>".$pagename."</title>";
echo "<body>";

//include header layout file
include ("headfile.html");

//display name of the page on the web page
echo "<h4>".$pagename."</h4>";
//The form in the logIn.php page passes two values through Post method.Both these values will be retrived by the $_POST super global variable (one dimensional array). $_POST of the 'useremail'field will store the user email address  and assigned to a local variable called  $email. $_POST of the 'userpass' field will store the user password and assigned to a local variable called $password.
$email = $_POST['useremail'];
$password =  $_POST['userpass'];

//echo "<p class='updateInfo'> Email:".$email." </p>";
//echo "<p class='updateInfo'> Password:".$password." </p>";

//created a local variable called $SQL of type String and populate it with a SQL statement that retrieves all the column from the Signup table where email  matches the value of the local variable $email to restrict the required user's informations.
 $sql = "SELECT * 
         FROM Signup
         WHERE email = '".$email."'";
 // // we then used it as a parameter in the mysqli_query function with other parameter called $conn which is a connection variable created in db.php file that connect the database and assigned the output to a variable called $exeSQL or exit and display error message if fails to connect with the database.
  $exeSQL =  mysqli_query($conn, $sql) or die(mysqli_error($conn));

  //mysqli_num_rows function fetched the no of rows that the previous query retrive when executed and assigned the value to a local variable called $nbrecs
  $nbrecs = mysqli_num_rows($exeSQL);
//if local variable contains the value 0 than the email address entered by the user does not exist in the signup table
  if($nbrecs == 0)
  {       echo "<p class= 'updateInfo'><b>Login failed! </p>"; 
          echo "<p class='updateInfo'>Email not recognised.</p>";
          echo "<p class= 'updateInfo'>Go back to <a href='logIn.php'>Login</a> </p>"; 
  }
  //if local variable contains the value 1 than the email address entered by the user does exist in the signup table
  else
  // so it grabs the output of the execution of the SQL query stored in the variable called $exeSQL and from that it fetched those result using the function called mysqli_fetch_array and stored them in an array of records (2 dimensional variable) or associative array called $arrayu.
  {  $arrayu = mysqli_fetch_array($exeSQL);

        if($arrayu){
                //Line 49 comparing two values. On the one hand,comparing the value stored in the local variable called $password that was populated in line 22. In it we posted the value from a text field that was created in line 34 of the logIn.php page. we comparing this with on the other hand the password, that is currently stored in the array that was created on line 45. Because the value existed and that was the result of the execution of the SQL query that retrive the user for which the email address matched the email address entering the form.     
                if(password_verify( $password,$arrayu["userPassword"])){
                        
                        
                         // Display login success message and store user id, user type, name into 4 session variables
                        $_SESSION['userid'] = $arrayu["signupId"];
                        $_SESSION['usertype'] = $arrayu["userType"];
                        $_SESSION['fname'] = $arrayu["fName"];
                        $_SESSION['sname'] = $arrayu["lName"];
                        
                        echo "<p class= 'updateInfo'>Welcome, ".$_SESSION['fname']." ".$_SESSION['sname'].". You have successfully logged in</p>";
                       
                        echo "<p class= 'updateInfo'>Continue shopping for <a href='index.php'>Home Tech</a> </p>"; 

                        echo "<p class= 'updateInfo'>View your <a href='basket.php'>Smart Basket</a> </p>"; 
                        
                }else{
                        echo "<p class= 'updateInfo'><b>Login failed!</p>"; 
                        
                        echo "<p class= 'updateInfo'>Password not recognised.</p>"; 

                        echo "<p class= 'updateInfo'>Go back to <a href='logIn.php'>Login</a> </p>"; 
                        
                }
        
        }

        //   if( $arrayu['userPassword'] <> $password ){
        //             echo "<p class= 'updateInfo'>Password not recognised</p>";
        //   }else{
        //             echo "<p class= 'updateInfo'>Welcome</p>"; 
        //   }
  

}





include("footfile.html"); //include head layout
echo "</body>";
?>
