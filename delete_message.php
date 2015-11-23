<?php
header('Content-Type: application/json');

include "include/db_connect_oo.php";

// read post data
$post_data->user_id = $_GET["user_id"];
$post_data->message_id = $_GET["message_id"];

// 1. delete to database

$sql = "DELETE FROM messages
        WHERE user_id=$post_data->user_id AND id=$post_data->message_id";
if ($conn->query($sql) === TRUE) {
  $temp = array();
} else {
  $temp = $conn->error;
}
// close connection
$conn->close();

// print result
echo json_encode($temp);
?>
