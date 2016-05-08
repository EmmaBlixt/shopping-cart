<?php require 'header.php';
require 'includes/connect_db.php'; 

if(isset($_GET['action']) && $_GET['action']=="update"){
if($_POST['name']!="" && $_POST['description']!="" && $_POST['price']!=""){

$id=intval($_GET['id']);

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


$sql = "UPDATE products SET name = '" . $_POST['name'] . "', description = '" . $_POST['description'] . "', price = '" . $_POST['price'] . "' WHERE id={$id}";

if(mysqli_query($con, $sql)){
    echo "<h2>Produkten är nu uppdaterad.</h2>"; print_r($POST['content']);
} else {
    echo "<h2>FEL: kunde inte utföra $sql. </h2>" . mysqli_error($link);
}


$sql2 = "UPDATE images SET img_name='$filename', size='$fileSize', type='$fileType', content='$content' WHERE img_id={$id}";
/*
$sql2 = "INSERT INTO images (img_name, size, type, content ) ".
"VALUES ('$fileName', '$fileSize', '$fileType', '$content') WHERE img_id={$id}"; */

if(mysqli_query($con, $sql2)){
    echo "<h2>Bilden är nu upplaggd.</h2>"; print_r($POST['imageData']);
} else {
    echo "<h2>FEL: kunde inte ladda upp bilden </h2>" . mysqli_error($link);
}
 

}
}

	$id=intval($_GET['id']); 

    $sql = "SELECT * FROM products LEFT JOIN images on id = img_id WHERE id={$id}";
            $query = mysqli_query($con, $sql);
if(empty($query)) {
  echo "<h2>Något gick fel</h2>";
}
 else {
while($row = mysqli_fetch_array($query)){?>
<div class="product-item">
<div class="product-image"><img src="data:image/jpeg;base64,<?php echo base64_encode($row['content']);?>"/> </div>    

  
        <div><h4><?php echo $row['name']; ?><h4></div>
        <div><?php echo $row['description']; ?></div>
        <div><?php echo $row['price']; ?> kr</div>     
    
</div> 
               <form enctype="multipart/form-data" action="update.php?action=update&id=<?php echo $row['id'] ?>" method="post">
                  <table class="add-table">
                  
                     <tr>
                        <td><input placeholder="Namn" name="name" type="text" 
                           id="name"></td>
                     </tr>
                  
                     <tr>
                        <td><input placeholder="Beskrivning" name="description" type="text" 
                           id="description"></td>
                     </tr>
                  
                     <tr>
                        <td><input placeholder="Pris" min="1" name="price" type="number" id="price"></td>
                     </tr>
                  
<tr>
<td>
  <input type="hidden" name="MAX_FILE_SIZE" value="2000000">
  <input type="file" name="image" />
</td></tr>
<tr>
                        <td>
                           <input type="submit"  name='submit' value="Uppdatera"/>
                        </td>
                     </tr>
                  
                  </table>
               </form>
<?php
}

}
$con->close();
 require 'footer.php'; ?>