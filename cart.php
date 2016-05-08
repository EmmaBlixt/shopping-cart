<?php include 'header.php'; 
 require 'includes/connect_db.php';

// ------------ Update cart ----------------- 
    if(isset($_POST['submit'])){
        if(!empty($_SESSION['cart'])){
        foreach($_POST['quantity'] as $key => $val){
            if($val==0){
                unset($_SESSION['cart'][$key]);
            }else{
                $_SESSION['cart'][$key]['quantity']=$val;
            }
        }
        }
    }

?> 


<h1>Varukorg</h1> 

<form method="post" action="cart.php">

    <?php
    $sql = "SELECT * FROM products WHERE id IN(";
            foreach($_SESSION['cart'] as $id => $value){
            $sql .=$id. ",";
            }
            $sql=substr($sql,0,-1) . ") ORDER BY id ASC";
            $query = mysqli_query($con, $sql);
            $totalprice=0;

// ------------- if the cart is empty, display this -----------------
if(empty($query)){
  echo "<p><i><a href='products.php'>Din kundvagn är tom, var god lägg till en produkt</a>.</i></p>"; 
            }

           else{
?>          
    <table>
 <tr>
        <th>Namn</th>
        <th>Antal</th>
        <th>Pris</th>
        <th>Summan</th>
    </tr> <?php

            // ----------- display cart products -------------
            while($row = mysqli_fetch_array($query)){
                $subtotal= $_SESSION['cart'][$row['id']]['quantity']*$row['price'];
                $totalprice += $subtotal;
    ?> 
   
    <tr>
        <td><?php echo $row['name']; ?></td>
        <td><input type="text" name="quantity[<?php echo $row['id']; ?>]" size="6" value="<?php echo $_SESSION['cart'][$row['id']]['quantity']; ?>"> </td>
        <td><?php echo $row['price']; ?></td>
        <td><?php echo $_SESSION['cart'][$row['id']]['quantity']*$row['price']. " kr"; ?></td>       
    </tr>
    <?php
            } ?>
                <tr>
        <td colspan="3"><h2>Totala priset: <?php echo "$totalprice". " kr"; ?></h2><td>
    </tr>
</table>

<p>
<button type="submit" class="btn" name="submit">Uppdatera kundvagnen</button></p>
</form> <?php
   }
    ?> 

<?php include 'footer.php';?>