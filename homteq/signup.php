<?php
session_start();
include("db.php");

//Create and populate a variable called $pagename 
$pagename = "sign up"; 

//Call in stylesheet
echo "<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css' integrity='sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65' crossorigin='anonymous'>";
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>";


//display name of the page as window title
echo "<title>".$pagename."</title>";
echo "<body>";

//include header layout file
include ("headfile.html");

//display name of the page on the web page
echo "<h4>".$pagename."</h4>";

echo "<form id= 'signupform' action='signup_process.php' method='post'>";

//display validation errors here
include("errors.php");     

echo "<table  id='baskettable' style='border: 0px'>";
echo "<tr>";
echo "<td>First Name:</td>";
echo "<td><input type='text' name='userfname' required></td>";
echo "</tr>";

echo "<tr>";
echo "<td>Last Name:</td>";
echo "<td><input type='text' name='userlname' required></td>";
echo "</tr>";

echo "<tr>";
echo "<td>Address:</td>";
echo "<td><input type='text' name='useraddress' required></td>";
echo "</tr>";

echo "<tr>";
echo "<td>Post Code:</td>";
echo "<td><input type='text' name='userpostcode' required></td>";
echo "</tr>";

echo "<tr>";
echo "<td>Tel No:</td>";
echo "<td><input type='text' name='usertelno' required></td>";
echo "</tr>";

echo "<tr>";
echo "<td>Email:</td>";
echo "<td><input type='email' name='useremail' required></td>";
echo "</tr>";

echo "<tr>";
echo "<td>Password:</td>";
echo "<td><input type='password' name='userpassword' required></td>";
echo "</tr>";

echo "<tr>";
echo "<td>Confirm Password:</td>";
echo "<td><input type='password' name='userpassword1' required></td>";
echo "</tr>";

echo "<tr>";
echo "<td><input type='reset' value='Clear Form' id='submitbtn'></td>";
echo "<td><input type='submit' name='register' value='Sign Up' id='submitbtn'></td>";
echo "</tr>";

echo "</table>";
echo "<p class='updateInfo'> Already a customer? <a href= 'logIn.php'> Login<a/></p>";
echo "</form>";

include("footfile.html"); //include head layout
echo "</body>";
?>
