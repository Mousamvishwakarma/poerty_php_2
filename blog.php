<?php
require 'db.php';
$result = $conn->query("
    SELECT   poems.title, poems.content,users.profile_photo,users.username,poems.created_at
                        FROM poems JOIN users ON poems.user_id = users.id 
                        ORDER BY poems.created_at DESC
");

while ($row = $result->fetch_assoc()) {
echo "<div class='poem-card'>";
echo "<h3>{$row['title']}</h3>";
echo "<p>" . substr($row['content'], 0, 150) . "...</p>";
echo "<div class='poem-footer'>";
echo "<img src='uploads/{$row['profile_photo']}' class='profile-pic'>";
echo "<strong>{$row['username']}</strong> &nbsp; <small>{$row['created_at']}</small>";
echo "</div>";
echo "</div>";

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
.poem-card {
  border: 1px solid #ddd;
  padding: 16px;
  margin: 20px auto;
  max-width: 600px;
  background-color: #E6E6FA;
}
.poem-card h3 {
  margin-top: 0;
  color: #333;
  font-weight:bold;
}
.poem-card p {
  color: #333;
  line-height: 1.5;
  font-weight:bold;
}
.poem-footer {
  margin-top: 15px;
  display: flex;
  align-items: center;
  gap: 10px;
  font-size: 14px;
  color: #333;
  font-weight:bold;
}

.profile-pic {
  width: 32px;
  height: 32px;
  border-radius: 50%;
  object-fit: cover;
  vertical-align: middle;
}
</style>
</head>
<body>
</body>
</html>