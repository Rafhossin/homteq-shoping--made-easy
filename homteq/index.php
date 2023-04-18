<?php
session_start();
//include db.php file to connect to DB
include ("db.php"); 
//Create and populate a variable called $pagename 
$pagename="make your home smart";
//Call in stylesheet
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>";
echo "<title>".$pagename."</title>";
echo "<body>";
include ("headfile.html");
include("detectlogin.php");
echo "<h4>".$pagename."</h4>";

//created a local variable called $SQL of type String and populate it with a SQL statement that retrieves all the column from the product table
$SQL="select prodId, prodName, prodPicNameSmall,prodDescripShort,prodPrice from Product";
// we then used it as a parameter in themysqli_query function with other parameter called $conn which is a connection variable created in db.php file that connect the database and assigned the output to a variable called $exeSQL or exit and display error message if fails to connect with the database.
$exeSQL=mysqli_query($conn, $SQL) or die (mysqli_error($conn));

echo "<table id='indextable' style='border: 0px'>";

//we have then created an array of records (2 dimensional variable) called $arrayp and populate it with the records retrieved by the SQL query previously executed, by the function called mysqli_fetch_array with parameter $exeSQL

// so it grabs the output of the execution of the SQL query stored in the variable called $exeSQL and from that it fetched those result using the function called mysqli_fetch_array and stored them in an array of records (2 dimensional variable) or associative array called $arrayp.
//Iterate through the array until the end of the array has not been reached.
while ($arrayp=mysqli_fetch_array($exeSQL))
{
    echo "<tr>";
    echo "<td style='border: 0px'>";
  // An anchor tag is created in line 31 and the anchor specify the html reference that indicates the file on the server(prodbuy.php) that needs to be retrived when the user clicks on the anchor. Attached to this URL, is a URL parser which dynamically carries through the value(product id) to the next page  using the Get method. 
    echo "<a href=prodbuy.php?u_prod_id=" . $arrayp['prodId']. ">";
//An image tag has been created.For every iteration displaying the small image whose name is contained in the array by indicating the source, the pathway to the images folder closing the static,entering the dynamic, using the name of the array,using the name of the column where name of the image file is contained and then closing the dynamic and re-entering the static and closing the image tag.
    echo "<img src=images/".$arrayp['prodPicNameSmall']." height=200 width=200>";
//close the anchor
    echo "</a>";
    echo "</td>";
    echo "<td style='border: 0px'>";
    // An anchor tag is created in line 38 and the anchor specify the html reference that indicates the file on the server that needs to be retrived when the user clicks on the anchor in this case the product name. Attached to this URL, is a URL parser which dynamically carries through the product id as retrived from the array which was actually populated by the SQL query, to the next page  using the Get method. 
    echo "<a href=prodbuy.php?u_prod_id=" . $arrayp['prodId'].">";
    echo "<p><h5>".$arrayp['prodName']."</h5></p>";
    //close the anchor
    echo "</a>";
    echo "<p>".$arrayp['prodDescripShort']."</p>";
    echo "<p><b>£".$arrayp['prodPrice']."</b></p>";
    echo "</td>";
//display product name as contained in the array
    echo "</tr>";
}
echo "</table>";

include("footfile.html"); //include head layout echo "</body>";
?>