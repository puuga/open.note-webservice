<?php
header('Content-Type: application/json');

include "include/db_connect_oo.php";

// read post data
$post_data->user_id = $_POST["user_id"];
$post_data->message = $_POST["message"];
$post_data->lat = $_POST["lat"];
$post_data->lng = $_POST["lng"];

// 1. write database

$sql = "INSERT INTO messages (user_id, channel_id, message, lat, lng, created_at, updated_at)
          VALUES ('$post_data->user_id',
            2,
            '$post_data->message',
            $post_data->lat,
            $post_data->lng,
            NOW(),
            NOW()
          ) ";
if ($conn->query($sql) === TRUE) {
  $last_id = $conn->insert_id;
  $temp = $post_data;
  $temp->id = $last_id;
} else {
  $temp = $conn->error;
}
// close connection
$conn->close();

// print result
echo json_encode($temp);
?>
