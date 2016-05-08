<?php
/**
 *
 * the upload function
 * 
 * @access public
 *
 * @return void
 *
 */
function upload(){
/*** check if a file was uploaded ***/
if(is_uploaded_file($_FILES['userfile']['tmp_name']) && getimagesize($_FILES['userfile']['tmp_name']) != false)
    {
    /***  get the image info. ***/
    $size = getimagesize($_FILES['userfile']['tmp_name']);
    /*** assign our variables ***/
    $type = $size['mime'];
    $imgfp = fopen($_FILES['userfile']['tmp_name'], 'rb');
    $size = $size[3];
    $name = $_FILES['userfile']['name'];
    $maxsize = 99999999;


    /***  check the file is less than the maximum file size ***/
    if($_FILES['userfile']['size'] < $maxsize )
        {
        $sql = "INSERT INTO testblob (image_type ,image, image_size, image_name) VALUES (? ,?, ?, ?)");

if(mysqli_query($con, $sql)){
    echo "<h2>Produkten är nu uppdaterad.</h2>"; print_r($POST['image']);
} else {
    echo "<h2>FEL: kunde inte utföra $sql. </h2>" . mysqli_error($link);
}

?>