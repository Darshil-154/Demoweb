 
<?php
  require_once 'db_connect.php';
// sql to create table
$sql = "CREATE TABLE info (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
firstname VARCHAR(30) NOT NULL,
lastname VARCHAR(30) NOT NULL,
username VARCHAR(30),
email VARCHAR(50) NOT NULL,
password VARCHAR(500),
DOB date,
image VARCHAR(400),
reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

if (mysqli_query($conn, $sql)) {
  echo "Table MyGuests created successfully";
} else {
  echo "Error creating table: " . mysqli_error($conn);
}
$sql = "UPDATE info SET password = MD5(password)";
if (mysqli_query($conn, $sql)) {
  echo "password is now secure by MD5";
} 
mysqli_close($conn);
?>
