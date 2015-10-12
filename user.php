<?php
header('Content-Type: application/json');
?>
<?php include "include/db_connect_oo.php" ?>
<?php

  if ( !isset($_GET['id']) ) {
    echo json_encode($user);
    exit();
  }
  $user_id = $_GET['id'];

  $sql = "SELECT *
          FROM users
          WHERE id = $user_id";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      $user->id = $user_id;
      $user->firstname = $row["firstname"];
      $user->lastname = $row["lastname"];
      $user->name = $row["name"];
      $user->email = $row["email"];
      $user->facebook_id = $row["facebook_id"];
    }
  }

  $conn->close();

  echo json_encode($user);
?>
