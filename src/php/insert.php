<?php
require_once 'db.php';

if (isset($_POST['submit'])){
  if (!empty($_POST['username'] && $_POST['comment'])){
    $username = $conn->real_escape_string( $_POST['username'] );
    $comment = $conn->real_escape_string( $_POST['comment'] );

    // set the default time zone
    date_default_timezone_set('Asia/Manila');
    $date = date('Y-m-d G:i:s');

    $queryInsert = "INSERT INTO discussion (user_name, post, date) VALUES ('$username', '$comment', '$date');";
    $conn->query($queryInsert);
    $conn->close();
  }
}

header("Location: ../../main.php?posted");
