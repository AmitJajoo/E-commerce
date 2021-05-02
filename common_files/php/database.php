<?php
// Create connection
    $db = new mysqli("localhost","root","","shop");
    // Check connection
if ($db->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
?>