<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="css/style.css">
<link href='https://fonts.googleapis.com/css?family=Noto+Sans' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Quicksand' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Ubuntu' rel='stylesheet' type='text/css'>
<meta charset="UTF-8">
<title>Webbshoppen</title>
</head>

<?php
session_start();

if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
    // last request was more than 30 minates ago
    session_destroy();   // destroy session data in storage
    session_unset();     // unset $_SESSION variable for the runtime
}
$_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp  

?> 
<body> 

    <header> 
        <h1 class="title">Välkommen till webbshoppen!</h1>
        <nav>
<a href="index.php">Startsidan</a>
<a href="products.php">Produkter</a>
 
</nav>

<?php 
if(array_key_exists('cart',$_SESSION) && !empty($_SESSION['cart'])) {
$sum =  array();
foreach ($_SESSION['cart'] as $result){
 $sum[] = $result['quantity'];
 $sum2[] = array_sum($sum);
}
$lastValue = end($sum2);
echo "<p class='items'>" . $lastValue . "</p>";
} 
?>
<div class="cart">
<a href="cart.php">
<img src="img/cart.png"/></a>
 </div>
    </header>
     <div class="content">       


