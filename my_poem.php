<?php
session_start();
require 'db.php';
if (!isset($_SESSION['user'])) { header("Location: login.php"); exit; }

$user_id = $_SESSION['user']['id'];

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM poems WHERE id=$id AND user_id=$user_id");
}

$result = $conn->query("SELECT * FROM poems WHERE user_id=$user_id ORDER BY created_at DESC");




while ($row = $result->fetch_assoc()) {
   echo "<div class='poem-item'>";
echo "<h3>{$row['title']}</h3>";
echo "<p>" . substr($row['content'], 0, 100) . "...</p>";
echo "<div class='poem-actions'>";
echo "<a href='edit_poem.php?id={$row['id']}' class='edit-link'>Edit</a>";
echo " | ";
echo "<a href='?delete={$row['id']}' class='delete-link'>Delete</a>";
echo " | ";
echo "<a href='submit_poem.php' class='submit-link'>submit</a>";
echo " | ";
echo "<a href='blog.php' class='submit-link'>Blog</a>";


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
  .poem-item {
  background-color: #E6E6FA;
  padding: 20px;
  margin: 20px auto;
  max-width: 600px;
  border-radius: 10px;
  border: 1px solid #ddd;
  box-shadow: 0 4px 10px rgba(0,0,0,0.05);
}

.poem-item h3 {
  margin: 0 0 10px;
  color: #333;
}

.poem-item p {
  color: #555;
  line-height: 1.6;
}

.poem-actions {
  margin-top: 15px;
}

.edit-link, .delete-link, .submit-link {
  text-decoration: none;
  font-weight: bold;
  padding: 6px 12px;
  border-radius: 6px;
  transition: background-color 0.3s;

}

.edit-link {
  color: #fff;
  background-color: #007bff;
}


.delete-link {
  color: #fff;
  background-color: #dc3545;
  margin-left: 10px;
}
.submit-link{
  background-color:rgb(45, 180, 112);
   color: #fff;
  
}
</style>
</head>
<body>
   

</body>
</html>