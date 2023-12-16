<?php include 'top.php' ?>

<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
  <h3>Select image to upload:</h3>
  <div class="mb-3">
    
    
    <input type="file" name="fileToUpload" id="fileToUpload" class="form-control" style="margin-bottom: 13px;">
    
    <input type="submit" value="Upload" class="form-control" name="Upload">
  </div>

  
</form>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $targetImageDir = "images/"; // Directory for images
    $targetFileDir = "files/";   // Directory for other files

    if (!file_exists($targetImageDir)) {
        mkdir($targetImageDir, 0755, true);
    }
    if (!file_exists($targetFileDir)) {
        mkdir($targetFileDir, 0755, true);
    }

    $fileType = $_FILES["fileToUpload"]["type"];
    $fileName = basename($_FILES["fileToUpload"]["name"]);
    $targetImageFile = $targetImageDir . $fileName;
    $targetFile = $targetFileDir . $fileName;

    // Check the file type to determine the destination folder
    if (strpos($fileType, "image/") === 0) {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetImageFile)) {
            echo "Image uploaded .";
        } else {
            echo "Error uploading image.";
        }
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFile)) {
            echo "File uploaded .";
        } else {
            echo "Error uploading file.";
        }
    }
}
?>






<?php include 'logout.php' ?>

<?php include 'footer.php' ?>