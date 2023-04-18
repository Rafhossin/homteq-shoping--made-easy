<?php
session_start();
//include db.php file to connect to DB
include ("db.php"); 
//Create and populate a variable called $pagename 
$pagename="clear basket";
//Call in stylesheet
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>";
echo "<title>".$pagename."</title>";
echo "<body>";
include ("headfile.html");
include("detectlogin.php");
echo "<h4>".$pagename."</h4>";
//so we can call the page when we need it and later we can anchor this page so allow us to clear the session completely
unset($_SESSION['basket']);
echo "<p class='updateInfo'>Your basket has been cleared</p>";

include("footfile.html"); //include head layout echo "</body>";
?>