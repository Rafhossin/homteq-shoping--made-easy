<?php
//a function need to be created in every page to be able to start the session.
session_start();
//include db.php file to connect to DB
include ("db.php"); 
//Create and populate a variable called $pagename 
$pagename="smart basket";
//Call in stylesheet
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>";
echo "<title>".$pagename."</title>";
echo "<body>";
include ("headfile.html");
include("detectlogin.php");
echo "<h4>".$pagename."</h4>";

//isset() is a built-in PHP function that checks if a variable is set and is not null.

//In the code snippet provided, isset() is used to check if the $_POST superglobal array has a key called del_prodid and if it has a non-null value.  If the user click on the remove button and  $_POST of the hidden field del_prodid posted a value by the HTTP Post method of the form then assigned that value to a local varible called  $del_prodid. Then unset the session of the value captured in the variable $del_prodid. 
if(isset($_POST['del_prodid']))
{
  $del_prodid = $_POST['del_prodid'];
  unset($_SESSION['basket'][ $del_prodid]);
  echo "<p>Basket updated:1 product removed from the basket</p>";
}

//In the code snippet provided, ISSET() is a built-in PHP function, that is used to check if the product id number has been posted through or  $_POST of the hidden field exist or the busket has been updated by the user then we need to update the session or need to add a product to the session array else read from the basket but do not add anything on to it.
if(isset($_POST['h_prodid']))
{
   //The form in the prodbuy.php page passes one value,the value of the iteration selected by the user and it passed through the parser p_quantity. That form also has a hidden form element which is called h_prodid through which pass the unique identifier, the product id.Both these values will be retrived by the $_POST super global variable (one dimensional array). $_POST of the form name will store the number of items the user wants and assigned to a local variable called  $prodqu.  $_POST of the hidden field will get the product id number and assigned to a local variable called $prodid.
 
   $prodqu= $_POST['p_quantity'];
   $prodid= $_POST['h_prodid'];
 
//echo "<p>Prod Id: ".$prodid."</p>";
//echo "<p>Prod Qt: ".$prodqu."</p>";

//session arrays: A particular type of array that exist in the session, that exist for the duration of the visit of the user in the web application and it can be accessed any time and we can drop number of items in this case the id number of the product the user has selected and no of items the user selected for that particular product so that we can recreate a shopping basket.

//created a new session array which is a key value pair array.For every cell of this new array,index this cell with the new product id as a key that identify the product the user wants and inside the cell store the required product quantity as value. 
   $_SESSION['basket'][$prodid]=$prodqu;
   echo "<p>Basket updated.1 product added to the basket</p>";
}
// else{
//   //read from the basket but do not add anything onto it
//   echo "<p class='updateInfo'> Basket unchangerd </p>";
// }

echo "<p><table id='baskettable' style='border: 0px'>
<tr>
  <th>Product Name</th>
  <th>Product Price</th>
  <th>Quantity</th>
  <th>Subtotal</th>
  <th>Remove Product</th>
</tr>";

$total = 0;
//reading the basket
//if the basket exist or contain products 
if (isset($_SESSION['basket'])) {

//for each loop: loop can be used to read from the session array, for every iteration through the session if it exist than split the session into it's key and it's index value to recreate the basket entirely.In another words retrive the id nubmer (key) and store inside the local variable called $index. Retrive the value(the number items the user wants to purchase) that is inside the session array and store it into the local variable $value. 

  foreach ($_SESSION['basket'] as $index => $value) {
    $sql = "SELECT prodId,prodName,prodPrice,     prodQuantity
            FROM Product 
            WHERE prodId =".$index;
    //echo "<p>sql query".$sql."</p>";
    $result = mysqli_query($conn, $sql);
    $arrayp = mysqli_fetch_array($result);

     echo "<tr>";
     echo  "<td>".$arrayp['prodName']."</td>";
     echo   "<td>&pound".number_format($arrayp['prodPrice'],2)."</td>";
     echo   "<td>".$value."</td>";
     $subtotal = $arrayp['prodPrice'] * $value;
     echo  "<td>&pound".number_format($subtotal,2)."</td>"; 
     echo "<td>";
     echo "<form action='basket.php' method='post'>";
     echo "<input type='submit' name='submitbtn' value='Remove' id='submitbtn'>"; 
     //to capture unique id of the product that needed to be removed by using the name of the array,using the name of the column of the original product table where unique id number of the product is contained. so when the user wants to click the remove button, the code going through the session array, find the index that matches the del_prodid and remove that particular cell from the session which will remove the desired product.
     echo "<input type='hidden' name='del_prodid' value=".$arrayp['prodId'].">";

     echo "</form>";
     echo "</td>";
     echo  "</tr>";
    $total += $subtotal;
  }
} 
else {
  echo "<p class='updateInfo'>The basket is empty.</p>";
}
echo "<tr>";
echo "<td colspan=4>TOTAL</td>";
echo "<td>&pound".number_format($total,2)."</td>"; 
echo "</tr>";

echo "</table>";

 // Check if basket session is set and basket element counter is greater than 0
 if(isset($_SESSION['basket']) && count($_SESSION['basket']) > 0){
  echo "<p class='updateInfo'><a href='clearbasket.php'>CLEAR BASKET</a></p>";
 }
  // Check if the user is logged in
  if(isset($_SESSION['userid'])){
    echo "<p class='updateInfo'>To finalise your order: <a href='checkout.php'>Check out</a>";
  }else{ // User not logged in
     echo "<p class='updateInfo'>New homteq customers: <a href='signup.php'>Sign Up</a></p>";
     echo "<p class='updateInfo'>Returning homteq customers: <a href='logIn.php'>Log In</a></p>";
  }


// echo "<p class='updateInfo'><a href='clearbasket.php'>CLEAR BASKET</a></p>";

// echo "<p class='updateInfo'>New homteq customers: <a href='signup.php'>Sign Up</a></p>";

// echo "<p class='updateInfo'>Returning homteq customers: <a href='logIn.php'>Log In</a></p>";

include("footfile.html"); //include head layout echo "</body>";
echo "</body>"
?>