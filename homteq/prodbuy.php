<?php
session_start();
include("db.php");
//Create and populate a variable called $pagename 
$pagename = "a smart buy for a smart home"; 
//This code is a PHP script that generates a HTML link tag for a stylesheet called "mystylesheet.css". The link tag is used to link a HTML document to an external CSS stylesheet, which defines the visual styles for the document.
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>"; 
//display name of the page as window title
echo "<title>".$pagename."</title>";
echo "<body>";

//include header layout file
include ("headfile.html");
include("detectlogin.php");

//display name of the page on the web page
echo "<h4>".$pagename."</h4>";


// A local variable called $prodid of type Integer has been created. Assigned to this variable a one dimensional array $_GET['u_prod_id'] is going to be storing a value(product id), which is passed from the previous page using the GET method.In order to retrive that value, name of the URL parser in square bracket has been used and the super global variable called $_GET infront of it.
$prodid=$_GET['u_prod_id'];
//display the value of the product id, for debugging purposes 
//echo "<p>Selected product Id: ".$prodid."</p>";

//created a local variable called $SQL of type String and populate it with a SQL statement that retrieves all the column from the product table where product id matches the value of the local variable $prodid to restrict the product the user selected.
$SQL="select prodId, prodName, prodPicNameLarge,prodDescripLong,prodPrice, prodQuantity from Product WHERE prodId =".$prodid;
// we then used it as a parameter in themysqli_query function with other parameter called $conn(connection variable) which is created in db.php file that connect the database and assigned the output to a variable called $exeSQL or exit and display error message if fails to connect with the database.
$exeSQL=mysqli_query($conn, $SQL) or die (mysqli_error($conn));

echo "<table id='indextable' style='border: 0px'>";

//we have created an array of records (2 dimensional variable) or associative array called $arrayp. Populate it with the records retrieved by the SQL query previously executed, by the function called mysqli_fetch_array with parameter $exeSQL.

// so it grabs the output of the execution of the SQL query stored in the variable called $exeSQL and from that it fetched those result using the function called mysqli_fetch_array and stored them in an array of records (2 dimensional variable) or associative array called $arrayp.
$arrayp=mysqli_fetch_array($exeSQL);

echo "<tr>";
echo "<td style='border: 0px'>";

// displaying the large image whose name is contained in the array by indicating the source, the pathway to the images folder closing the static,entering the dynamic, using the name of the array,using the name of the original column of the table Product where name of the image file is contained and then closing the dynamic and re-entering the static and closing the image tag.
echo "<img src=images/".$arrayp['prodPicNameLarge']." height=400 width=400>";
echo "</td>";
echo "<td style='border: 0px'>";
// displaying the product name in a html header 5 tag contained in the array.
echo "<h5>".$arrayp['prodName']."</h5>";
echo "<p>".$arrayp['prodDescripLong']."</p>";
echo "<br><p><b>&pound".$arrayp['prodPrice']."</b></p>";
//compare and contrast line 52 and line 64
//Line 52 displays a dynamic value,the number of products available in stocks contained in the array for this particular product.
//As opposed to line 60,is used as upper limit of a loop in order to provide the user the ability to select as many product as they want upto the available stocks stored in the product table but not beyond.

echo "<br><p>Left in Stock: ".$arrayp['prodQuantity']."</p>";


echo "<p><br>Number to be purchased: <p/>";

//Line 56 creates a form. This form has an action.The action specifies the pathway to the file(basket.php)that going to be retrived from the server when the user clicks on the submit button of that form. basket.php is also the file that will process the data entered in the form by the user.This form passes only one value,the value of the iteration selected by the user and it passed through the parser p_quantity.

//The form tag specify two things the action and the method.The action gives the pathway to the file that going to be retrived from the server when the user clicks on the submit button of a form.The action also specify name of the file the user going to be directed to.Finally,The action spacify the page that going to be processed the data user inputing through the form. 
//The method specify how it sends the data either using  post method (it allows to capture information from the form and post them to the desired server and accessed them on the subsequent page without not being visible to the user) or get method(sending the data by URL or concatinating the parser to a URL to pass desired information to the next page)
echo "<form action='basket.php' method='post'>";
echo "<select name=p_quantity>";
//create a drop down list to iterate  all the way until the product left in the stock
for($i=1; $i<=$arrayp['prodQuantity']; $i++)
{
//for every iteration it displays a value which the user sees and it also captures a value which will be passed as part of p_quantity. p_quantity then contained what ever value the user selected.
echo "<option value=".$i.">".$i. "</option>";
}
echo "</select>";
//A form has been been created and it needs to pass the number of items the user wants as well as the id number of that product that has been selected. So the form has been created in line 61 to line 75, only capture one value, the number of items the user selects. In addition to that it needs to pass an id number. That id number is captured through the hidden field, a hidden form element that is invisible to the user that is called 'h_prodid' which captures the value of the current product id for the current selected product.

echo "<input type='hidden' name='h_prodid' value=".$prodid.">";
echo "<input type='submit' name='submitbtn' value='ADD TO BASKET' id='submitbtn'>"; 

echo "</form>";
//echo "</p>";

echo "</td>";
echo "</tr>";
echo "</table>";

include("footfile.html"); //include head layout echo "</body>";
?>