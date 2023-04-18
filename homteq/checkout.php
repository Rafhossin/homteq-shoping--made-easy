<?php
//to access the session multiple ways
session_start();
//include db.php file to connect to DB
include ("db.php"); 
//Create and populate a variable called $pagename 
$pagename="check out";
//Call in stylesheet
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>";

echo "<title>".$pagename."</title>";

echo "<body>";

include ("headfile.html");

include("detectlogin.php");

echo "<h4>".$pagename."</h4>";
//used the date function to capture the system date and time and store it in the local variable $currentdatetime. mysql formate the date in this way to be able to insert it in the Orders table  
$currentdatetime = date('Y-m-d H:i:s');

$SQLNewOrder = 
"INSERT INTO
Orders 
(signupId, orderDateTime, orderStatus,  shippingDate)
VALUES
(".$_SESSION['userid'].",'".$currentdatetime."','Placed', '".$currentdatetime."')";

// only placing the order if inserting the order is successful or the order exist and basket session is set and basket element counter is greater than 0 or have atleast one product 
if(mysqli_query($conn,$SQLNewOrder) && isset($_SESSION['basket']) && count($_SESSION['basket']) > 0 )
{
    echo "<p class='updateInfo'>Order Successful</p>";
    //aggregation function to get the maximum order number from the Orders table and named the column as orderNo 
    $maxSQL = "SELECT max(orderNo) AS orderNo  
              FROM Orders
              WHERE signupId =".$_SESSION['userid'];//that means it retrived  the highest order no for this user no currently logged in 

    $exemaxSQL = mysqli_query($conn, $maxSQL);
    $arrayorderno = mysqli_fetch_array($exemaxSQL);
    //store the value of the order no based on the Alias created before not the aggregation function as part of the array $arrayorderno which has only one cell, cause that won't work. Then store the value in a local variable called  $orderno 
    $orderno = $arrayorderno['orderNo'];
    echo "<p class='updateInfo'><b>Order No: ".$orderno ."</b></p>";

    $total = 0; 
    echo "<p><table id='baskettable' style='border: 0px'>
<tr>
  <th>Product Name</th>
  <th>Product Price</th>
  <th>Number of items</th>
  <th>Subtotal</th>
</tr>";
//then we need to iterate through the session and for every iteration we need to retrive the key(is the id number of every single product placed in the basket) and the value(is the number of items or the quantity the user has selected and stored in basket session)
foreach ($_SESSION['basket'] as $index => $value) {

    $sqlBasket = "SELECT prodId,prodName,prodPrice 
            FROM Product 
            WHERE prodId =".$index;

    $resultBasket = mysqli_query($conn,$sqlBasket);
    $arrayBasket = mysqli_fetch_array($resultBasket);

    $subtotal =  $arrayBasket['prodPrice'] * $value;

    $SQLorderline =
    "INSERT INTO
    Order_Line ( orderNo, prodid, quantityOrdered, subTotal)
    VALUES (".$orderno.", ".$index.", ".$value.", ".$subtotal.")";

    $exeSQLorderline =  mysqli_query($conn,$SQLorderline);
    
    echo "<tr>";
    echo  "<td>".$arrayBasket['prodName']."</td>";
    echo   "<td>&pound".number_format($arrayBasket['prodPrice'],2)."</td>";
    echo   "<td>".$value."</td>";
  
    echo  "<td>&pound".number_format($subtotal,2)."</td>"; 
    echo "</tr>";
    $total += $subtotal;

}
echo "<tr>";
echo "<td colspan=3>TOTAL</td>";
echo "<td>&pound".number_format($total,2)."</td>"; 
echo "</tr>";


echo "</table>";

$SQLupdateorder
="UPDATE Orders
SET orderTotal =".$total."
WHERE orderNo = ".$orderno;
$exeSQLUpdateorderline =  mysqli_query($conn,$SQLupdateorder);
      
}
else{
    echo "<p class='updateInfo'>Order Failed</p>";
}
unset($_SESSION['basket'] );

include("footfile.html"); //include head layout echo "</body>";
echo "</body>";
?>