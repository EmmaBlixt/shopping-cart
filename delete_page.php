<?php
require 'header.php';
require 'includes/connect_db.php';

        $id=intval($_GET['id']); 
          // sql to delete a record
$sql = "DELETE FROM products WHERE id= {$id}";

if (mysqli_query($con, $sql)) {
    echo "<p>Produkten är borttagen. Gå tillbaka till <a href='index.php'>startsidan</a></p>";
} else {
    echo "<p>Bortagningen gick fel. Gå tillbaka till <a href='index.php'>startsidan</a> </p>" . mysqli_error($conn);
}
   
$sql2 = "DELETE FROM images WHERE img_id= {$id}";

if (mysqli_query($con, $sql2)) {
    echo "<p>Bilden är borttagen.</p>";
} else {
    echo "<p>Bilden kunde inte tas bort. Gå tillbaka till <a href='index.php'>startsidan</a> </p>" . mysqli_error($conn);
}   

require 'footer.php';