
<?php include_once 'top.php'?>

<h1>File Gallery</h1>

<div class="file-grid">
    <?php
    $fileDirectory = 'files/'; // Change this to the path of your files folder.
    $files = glob($fileDirectory . '*.{pdf,doc,docx,zip}', GLOB_BRACE);

    foreach ($files as $file) {
        $fileName = basename($file);
        echo '<div class="file-container">';
        echo '<a href="' . $file . '" target="_blank">' . $fileName . '</a>';
        echo '<br>';
        echo '<a href="' . $file . '" download>Download</a>';
        echo '</div>';
    }
    ?>
</div>

<?php include 'logout.php' ?>

<?php include 'footer.php' ?>