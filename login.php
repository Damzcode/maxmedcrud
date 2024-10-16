<?php
session_start();
if (isset($_SESSION['email'])) {
    header("Location: dashboard.php"); // Ubah "dashboard.php" sesuai dengan nama file yang sesuai
    exit();
}
?>
<!DOCTYPE html> 

<html lang="en"> 

<head> 
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Login</title> 

    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('images/web.jpg'); 
            background-size: cover;
            background-position: center;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }


        .logo {
            margin-bottom: 20px;
            margin-right: 100px;
            width: 300px;
        
           
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: rgb(19, 7, 106);
          
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: rgb(243, 62, 62);
           
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: white;
        }

        input[type="text"], 
        input[type="password"] {
            background-color: white;
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid black;
            border-radius: 50px;
            font-size: 16px;
          
        }

        input[type="submit"] {
            width: 105%;
            padding: 10px;
            background-color: #ee2b0e;
            border: none;
            border-radius: 50px;
            color: white;
            font-size: 16px;
            cursor: pointer;
          
        }

        input[type="submit"]:hover {
            background-color: darkred;
        }

        .forgot-password {
            margin-top: 10px;
            text-align: right;
            
        }

        .forgot-password a {
            color: #007BFF;
            text-decoration: none;
            font-size: 14px;
           
        }

        .forgot-password a:hover {
            text-decoration: underline;
        }
    </style>
</head> 

<body>  
    
    <div class="login-container">
       <img src="1719976548428.png" alt="Maxmedia Logo" class="logo">
        <h1 class="section">Welcome</h1><h2>Maxmedia</h2>
        <?php if (isset($_GET['error'])) { ?>
     		<p class="error"><?php echo $_GET['error']; ?></p>
     	<?php } ?> 
        <form action="proses_login.php" method="post"> 
            <input type="text" Placeholder="Email" id="email" name="email" required><br> 

            <input type="password" Placeholder="Password" id="password" name="password" required><br> 

            <!-- <div class="forgot-password"> -->
                <!-- <a href="#">Forgot password?</a> -->
            <!-- </div> -->

            <input type="submit" value="Login"> 
        </form> 
    </div>
</body> 
</html>
