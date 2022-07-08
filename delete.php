<?php

//This code is taken from: https://stackoverflow.com/questions/70714833/php-delete-button-for-every-row-change-value-in-table-for-this-row  
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "esa";


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT astronaut_id, astronaut_name, no_missions, nationality, gender FROM astronaut";
$result = $conn->query($sql);



if(isset($_GET['id'])) {
    $sql = "DELETE FROM astronaut WHERE astronaut_id= '" . $_GET['id'] . "'";

}


if ($conn->query($sql) === TRUE) {
      echo "Record deleted successfully";
  } else {
      echo "Error deleting record: " . $conn->error;
  }


$conn->close();
?>