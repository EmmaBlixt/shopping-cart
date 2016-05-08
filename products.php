<?php 
require 'header.php';
require 'includes/connect_db.php';
?>
<head>
  <script type="text/javascript">

function show_confirm() {
    return confirm("Är du säker på att du vill radera?");
}
</script>
</head> 
<?php


// ---------- Add products to cart -------------------

if(isset($_GET['action']) && $_GET['action']=="add"){
    $id=intval($_GET['id']);

    // If products already are in cart, add to previous quantity
    if(isset($_SESSION['cart'][$id])){

         $_SESSION['cart'][$id]['quantity'] = $_SESSION['cart'][$id]['quantity'] + intval($_POST['quantity']); 

            $_SESSION['cart'][$id]['price'] = $_SESSION['cart'][$id]['price'] + $_SESSION['cart'][$id]['price'];
    }else{  

        $sql_p="SELECT * FROM products WHERE id={$id}";
        $query_p=mysqli_query($con, $sql_p);
        if(mysqli_num_rows($query_p)!=0){
            $row_p=mysqli_fetch_array($query_p);
            $_SESSION['cart'][$row_p['id']]=array("quantity" => 1, "price" => $row_p['price']);
        }else{
            $message="Produkt id är ogiltigt";
        }
    }
}


?>

<h1>Våra produkter</h1> 

<!--  Displays error message if product ID is invalid -->
<?php 
        if(isset($message)){ 
            echo "<h2>$message</h2>"; 
        } 

    ?> 
   
<?php 

$sql = "SELECT * FROM products LEFT JOIN images on id = img_id";
$result = $con->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) { ?>
    <div class="product-item">
    <div class="product-image"><img src="data:image/jpeg;base64,<?php echo base64_encode($row['content']);?>"/> </div>

    
    <!--<div class="product-image"><img src="data:image/jpeg;base64,<?php // echo base64_encode($row['img_content']);?>"/> </div>    -->   
	<div><h2> <?php echo $row['name'] ?> </h2></div>
	<div> <?php echo $row['description'] ?> </div>
	<div> <?php echo $row['price'] ?> kr </div>
	<div> 
        <!-- Add product to cart + quantity -->
        <form method="post" id="add" action="products.php?action=add&id=<?php echo $row['id'] ?>">
        <input type="number" name="quantity" value="1" /> </br>
        <input type="submit" value="Lägg till i varukorgen" class="btn" />
        </form>

 <!-- Update product -->
 <form method="post" id="update_id" action="update.php?action=update&id=<?php echo $row['id'] ?>">
<button type="submit" class="btn"/>Redigera produkten</button></a>
</form>

<!--- Remove product -->
    <a href="delete_page.php?action=update&id=<?php echo $row['id'] ?>" onclick='return show_confirm()'><button class="btn">Radera produkt</button></a>

   </div></div>


<?php
    } 
} else {
    echo "0 resultat";
}
$con->close();
?> 

 
<div class="add-btn">
<a href="add_products.php"><button class="btn">Lägg till produkt</button></a>
</div>

<?php include 'footer.php'; ?>