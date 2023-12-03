
    <?php include 'top.php' ?>
  
<h1>Image Gallery</h1>

<div class="image-grid">
    <?php
    require_once 'db_connect.php';

    $imageDirectory = 'images/'; // Change this to the path of your image folder.
    $images = glob($imageDirectory . '*.{jpg,png,gif}', GLOB_BRACE);

    foreach ($images as $image) {
        echo '<div class="image-container">';
        echo '<img src="' . $image . '" width="200" height="200" />';
        echo '<br>';
        echo '<a href="' . $image . '"  class="btn btn-primary btn-block mb-4 mt-3"  download>Download</a>';
        echo '</div>';
    }
    ?>
</div>
<?php include_once 'logout.php'?>

<?php include 'footer.php' ?>