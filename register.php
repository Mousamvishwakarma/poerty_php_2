<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $photo = $_FILES['profile_photo'];
    $photo_name = time() . '_' . basename($photo['name']);
    $target = 'uploads/' . $photo_name;
    move_uploaded_file($photo['tmp_name'], $target);
    $stmt = $conn->prepare("INSERT INTO users (username, email, password, profile_photo) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $username, $email, $password, $photo_name);
    $stmt->execute();
    header("Location: login.php");
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>User Registration</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      background: #11b4ba;
    }

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
           
            font-family: 'Arial', sans-serif;
            font-weight: bold;
            text-shadow: 12px 12px 14px rgba(5, 5, 5, 0.5);
        }

    form {
      background: #e80d0d;
      padding: 30px;
      
      width: 100%;
      max-width: 400px;
      border:2px solid black;
      background-color:#abbcb9;
      border-radius: 20px;
      box-shadow: 15px 18px 15px rgba(10, 10, 10, 0.3);

    }
    

    input[type="text"],
    input[type="email"],
    input[type="password"]
    {
      width: 100%;
      padding: 12px;
      margin-bottom: 15px;
    border: 2px solid black;
      background-color: #fff;
      font-size: 16px;
      box-sizing: border-box;
      
      border-radius: 20px;
      box-shadow: 5px 8px 5px rgba(10, 10, 10, 0.2);
    }
    input[type="file"]{
       width: 100%;
      padding: 12px;
      margin-bottom: 15px;
      font-size: 16px;
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
      box-shadow: 5px 8px 5px rgba(10, 10, 10, 0.2);
      
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
      box-shadow: 5px 8px 5px rgba(10, 10, 10, 0.2);
}   
  </style>
</head>
<body>

  <div class="form-container">
    <form method="POST" enctype="multipart/form-data">
      <h1>Registration Form </h1>
      <input type="text" name="username" placeholder="Username" required><br>
      <input type="email" name="email" placeholder="Email" required><br>
      <input type="password" name="password" placeholder="Password" required><br>
      <input type="file" name="profile_photo" required><br>
      <button type="submit">Register</button>
       <a href='login.php' class="login-link">Login here</a>
    </form>
  </div>

</body>
</html>



