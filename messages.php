<?php
header('Content-Type: application/json');
?>
<?php include "include/db_connect_oo.php" ?>
<?php
  $sql = "SELECT m.id, m.message, m.lat, m.lng, u.name
          FROM messages m INNER JOIN users u ON m.user_id = u.id";
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
      $one['user']['name'] = $row["name"];

      $arr[] = $one;
    }
    // $json_result['messages'] = $arr;
  }

  $conn->close();

  echo json_encode($arr);
?>
