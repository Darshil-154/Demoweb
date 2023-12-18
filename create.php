 
<?php
  require_once 'db_connect.php';
// sql to create table
$sql = "CREATE TABLE info (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(30) NOT NULL,
username VARCHAR(30),
email VARCHAR(50) NOT NULL,
password VARCHAR(50),
image VARCHAR(400),
reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

if (mysqli_query($conn, $sql)) {
  echo "Table MyGuests created successfully";
} else {
  echo "Error creating table: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
