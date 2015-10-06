<?php
header('Content-Type: application/json');

include "include/db_connect_oo.php";

// read post data
$post_data->firstname = $_POST["firstname"];
$post_data->lastname = $_POST["lastname"];
$post_data->name = $_POST["name"];
$post_data->email = $_POST["email"];
$post_data->facebook_id = $_POST["facebook_id"];

// 1. check is facebook_id exit
// 2. if yes read database
// 3. if no write database

$sql = "SELECT * FROM users WHERE facebook_id='$post_data->facebook_id'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    $temp->id = $row["id"];
    $temp->firstname = $row["firstname"];
    $temp->lastname = $row["lastname"];
    $temp->name = $row["name"];
    $temp->email = $row["email"];
    $temp->facebook_id = $row["facebook_id"];
  }

  // update updated_at = now
  $sql2 = "UPDATE users SET updated_at=NOW() WHERE id=$temp->id";
  if ($conn->query($sql2) === TRUE) {
    // echo "Record updated successfully";
  } else {
    // echo "Error updating record: " . $conn->error;
  }
  // $json_result['messages'] = $arr;
} else {
  $sql2 = "INSERT INTO users (firstname, lastname, name, email, facebook_id, created_at, updated_at)
            VALUES ('$post_data->firstname',
              '$post_data->lastname',
              '$post_data->name',
              '$post_data->email',
              '$post_data->facebook_id',
              NOW(),
              NOW()
            ) ";
  if ($conn->query($sql2) === TRUE) {
    $last_id = $conn->insert_id;
    $temp = $post_data;
    $temp->id = $last_id;
  } else {
    $temp = $conn->error;
  }
}
// close connection
$conn->close();

// print result
echo json_encode($temp);
?>
