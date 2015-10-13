<?php
header('Content-Type: application/json');
?>
<?php include "include/db_connect_oo.php" ?>
<?php
  $sql = "SELECT m.id, m.message, m.lat, m.lng, m.created_at, u.name, u.facebook_id
          FROM messages m INNER JOIN users u ON m.user_id = u.id
          ORDER BY m.id DESC";
  if ( isset($_GET['lat']) || isset($_GET['lng']) ) {
    $sql .= "";
  }
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      $one = null;
      $one['id'] = $row["id"];
      $one['message'] = $row["message"];
      $one['lat'] = $row["lat"];
      $one['lng'] = $row["lng"];
      $one['created_at'] = $row["created_at"];
      $one['user']['name'] = $row["name"];
      $one['user']['facebook_id'] = $row["facebook_id"];

      $arr[] = $one;
    }
    // $json_result['messages'] = $arr;
  }

  $conn->close();

  echo json_encode($arr);
?>
