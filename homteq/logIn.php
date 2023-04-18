<?php
session_start();
include("db.php");

//Create and populate a variable called $pagename 
$pagename = "log in"; 

//Call in stylesheet
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>"; 

//display name of the page as window title
echo "<title>".$pagename."</title>";
echo "<body>";

//include header layout file
include ("headfile.html");

//display name of the page on the web page
echo "<h4>".$pagename."</h4>";
//The form tag specify two things the action and the method.The action gives the pathway to the file that going to be retrived from the server when the user clicks on the submit button of a form.The action also specify name of the file the user going to be directed to.Finally,The action spacify the page that going to be processed the data user inputing through the form. 
//The method specify how it sends the data either using  post method (it allows to capture information from the form and post them to the desired server and accessed them on the subsequent page without not being visible to the user) or get method(sending the data by URL or concatinating the parser to a URL to pass desired information to the next page)
echo "<form  action='login_process.php' method='post'>";

echo "<table  id='baskettable' style='border: 0px'>";


echo "<tr>";
echo "<td>Email:</td>";
echo "<td><input type='email' name='useremail' required></td>";
echo "</tr>";

echo "<tr>";
echo "<td>Password:</td>";
echo "<td><input type='password' name='userpass' required></td>";
echo "</tr>";

echo "<tr>";
echo "<td><input type='reset' value='Clear Form' id='submitbtn'></td>";
echo "<td><input type='submit' value='LogIn' id='submitbtn'></td>";
echo "</tr>";

echo "</table>";
echo "<p class='updateInfo'> Not a customer yet? <a href= 'signup.php'> Sign up<a/></p>";
echo "</form>";

include("footfile.html"); //include head layout
echo "</body>";
?>
