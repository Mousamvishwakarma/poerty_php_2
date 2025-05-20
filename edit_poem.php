<?php
session_start();
require 'db.php';
if (!isset($_SESSION['user'])) { header("Location: login.php"); exit; }
$user_id = $_SESSION['user']['id'];
$id = $_GET['id'];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $stmt = $conn->prepare("UPDATE poems SET title=?, content=? WHERE id=? AND user_id=?");
    $stmt->bind_param("ssii", $title, $content, $id, $user_id);
    $stmt->execute();
    header("Location: my_poems.php");
    exit;
}
$result = $conn->query("SELECT * FROM poems WHERE id=$id AND user_id=$user_id");
$poem = $result->fetch_assoc();
?>
<form method="POST">
  <input name="title" value="<?= $poem['title'] ?>" required><br>
  <textarea name="content" required><?= $poem['content'] ?></textarea><br>
  <button type="submit">Update</button>
</form>