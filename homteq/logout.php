<?php
session_start(); // Start the session

// Check if the user is logged in
if(isset($_SESSION['userid'])) {
  // User is logged in, destroy the session and redirect to the home page
  session_destroy();
  header("Location: index.php");
  exit();
} else {
  // User is not logged in, redirect to the home page
  header("Location: index.php");
  exit();
}
?>
