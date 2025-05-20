
<?php
session_start();
require 'db.php';
if (!isset($_SESSION['user'])) { header("Location: login.php"); exit; }
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $user_id = $_SESSION['user']['id'];

    $stmt = $conn->prepare("INSERT INTO poems (user_id, title, content, created_at) VALUES (?,?,?, NOW())");
    $stmt->bind_param("iss", $user_id, $title, $content);
    $stmt->execute();
   
    echo "Poem submitted!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Submit Your Poem</title>
  <style>
 body {
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;
      background-image: url('https://images.unsplash.com/photo-1506748686214-e9df14d4d9d0?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=MnwzNjUyOXwwfDF8c2VhcmNofDJ8fHBvZW18ZW58MHx8fHwxNjg5NTY1NzA3&ixlib=rb-4.0.3&q=80&w=1080');}

    .form-container {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }
     h1{
            color: black;
            text-align: center;
            font-size: 35px;
           font-weight: bold;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            margin-bottom: 20px;
        }

    form {
      background: #ffffff;
      padding: 30px;
      
      width: 100%;
      max-width: 400px;
      border:2px solid black;
       background-color:#abbcb9;
      
border-radius: 20px;
    }
    
input,textarea {
      width: 100%;
      padding: 12px;
      margin-bottom: 15px;
    border-radius: 20px;
      font-size: 16px;
      box-sizing: border-box;
      border:2px solid black;
    }
    button {
      width: 100%;
      padding: 12px;
      background-color:rgb(40, 140, 167);
      color: white;
      border: none;
      font-size: 16px;
      cursor: pointer;
      border-radius: 20px;
 box-shadow: 5px 8px 5px rgba(10, 10, 10, 0.3);
    }
    .login-link {
  display: inline-block;
  margin-top: 15px;
  text-decoration: none;
  color:white;
  font-weight: bold;
  width: 97%;
  text-align:center;
  padding: 8px;
  background-color:rgb(40, 140, 167);
    border-radius: 20px;
    box-shadow: 5px 8px 5px rgba(10, 10, 10, 0.3);
  }

  </style>
</head>
<body>

  <div class="form-container">
    <form method="POST">
      <h1>Upload Poetry</h1>
      <input name="title" placeholder="Title" required><br>
      <textarea name="content" placeholder="Your poetry..." rows="6" required></textarea><br>
      <button type="submit">Submit Poetry</button>
      <a href= "my_poem.php" class="login-link">My Poems</a>  
      <a href="blog.php" class="login-link">Blog</a>  
     

    </form>


  </div>
  
</body>
</html>