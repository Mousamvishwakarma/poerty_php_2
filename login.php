<?php include 'db.php'; session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $identifier = $_POST['identifier'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
    $stmt->bind_param("ss", $identifier, $identifier);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $user = $result->fetch_assoc();
     $_SESSION['user'] = $user;
    header("Location: submit_poem.php");

    // Always use password_verify to prevent user enumeration
   /* if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user'] = $user;
        header("Location: submit_poem.php");
        exit;
    } else {
        echo "<script>alert('Incorrect password');</script>";
    }*/
}

?>   




<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <style>
   body {
       background: #11b4ba;
      margin: 0;
      padding: 0;
    }

    .form-container {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      

      
    }
     h1{
            color:bold black;
            text-align: center;
            font-size: 35px;
           font-family: 'Arial', sans-serif;
            font-weight: bold;
            text-shadow: 12px 12px 14px rgba(5, 5, 5, 0.5);
            
        }

    form {
      background: #ffffff;
      padding: 30px;
      
      width: 100%;
      max-width: 400px;
      border:2px solid black;
       background-color:#abbcb9;
border-radius: 20px;
      box-shadow: 10px 10px 10px rgba(10, 10, 10, 0.5);
    }
    

    input[type="text"],
    input[type="password"],
    input[type="identifier"]
    {
      width: 100%;
      padding: 12px;
      margin-bottom: 15px;
    
      font-size: 16px;
      box-sizing: border-box;
      border:2px solid black;
       border-radius: 20px;
      box-shadow: 5px 8px 5px rgba(10, 10, 10, 0.2);
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
    background-color:rgb(136, 165, 173); 
    }  
  </style>
</head>
<body>

  <div class="form-container">
    <form method="POST">
        <h1>Login Form</h1>
      <input type="text" name="identifier" placeholder="Email or Username" required><br>
      <input type="password" name="password" placeholder="Password" required><br>
      <button type="submit">login</button>
    </form>
  </div>

</body>
</html>