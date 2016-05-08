<?php
require 'includes/connect_db.php';
require 'header.php';

if(isset($_POST['add_product']))
{

if(!$con)
{
  die('<p>Kunde inte anknyta till databasen:</p><p>' . mysql_error() . '</p>');
}


if(! get_magic_quotes_gpc() )
{
   $name = addslashes ($_POST['name']);
   $description = addslashes ($_POST['description']);
   $price = addslashes($_POST['price']);
}
else
{
   $name = $_POST['name'];
   $description = $_POST['description'];
   $price = $_POST['price'];
}



$fileName = $_FILES['image']['name'];
$tmpName  = $_FILES['image']['tmp_name'];
$fileSize = $_FILES['image']['size'];
$fileType = $_FILES['image']['type'];

$fp      = fopen($tmpName, 'r');
$content = fread($fp, filesize($tmpName));
$content = addslashes($content);
fclose($fp);

if(!get_magic_quotes_gpc())
{
    $fileName = addslashes($fileName);
}

$sql = "INSERT INTO products (name,description,price) VALUES ('$name','$description','$price')";
$retval = mysqli_query( $con, $sql );
if(! $retval )
{
  die('<p>Kunde inte lägga till produkten:</p><p>' . mysqli_error() . '</p>');
}
echo "<p>Produkten är nu tillagd.</p>";
$last_id = $con->insert_id;


$sql2 = "INSERT INTO images (img_id,img_name, size, type, content ) ".
"VALUES ('$last_id','$fileName', '$fileSize', '$fileType', '$content')";

if(mysqli_query($con, $sql2)){
    echo "<p>Bilden är nu upplaggd.</p>";
} else {
    echo "<p>FEL: kunde inte ladda upp bilden </p>" . mysqli_error($link);
}
} 


else
{
?>



<h1>Add a product</h1>

<form method="post" form enctype="multipart/form-data" action="<?php $_PHP_SELF ?>">
	
<table class="add-table">
<tr>
<td>Namn:</td>
<td>
<input name="name" type="text" id="name">
</td>
</tr>
<tr>
<td>Beskrivning:</td>
<td>
<input name="description" type="text" id="description">
</td>
</tr>
<tr>
<td>Pris:</td>
<td>
<input name="price" type="number" min="1" id="price">
</td>
</tr>
<tr>
<td>Bild:</td>
<td>
  <input type="hidden" name="MAX_FILE_SIZE" value="2000000">
  <input type="file" name="image">
</td>
</tr>
<tr>
<td> </td>
<td> </td>
</tr>
<tr>
<td> </td>
<td>
<input name="add_product" type="submit" id="add_product" value="Lägg till produkt">
</td>
</tr>
</table>

</form>
<?php
} 
?>


<?php
mysqli_close($con);
require 'footer.php'; ?>