<?php
  $dbServername = "localhost";
  $dbUsername = "root";
  $dbPassword = "";
  $dbName = "bscs_forum";

  // connect to database
  $conn = new mysqli($dbServername, $dbUsername, $dbPassword, $dbName);

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
