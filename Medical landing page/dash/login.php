 
<?php
session_start();
include "../config/config.php";

if (isset($_POST['login'])) {
    $email = htmlspecialchars($_POST['email']);
    $pass = $_POST['password'];

    
    $stmt = $conn->prepare("SELECT * FROM user WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        
        if (password_verify($pass, $user['password'])) {
            $_SESSION['username'] = $user['username']; 
            $_SESSION['authenticated'] = true;
            $_SESSION['id'] = $user['id'];
            header('location:dashboard.php');
            exit();
        } else {
            $_SESSION['login_error'] = "Incorrect password.";
        }
    } else {
        $_SESSION['login_error'] = "User not found. Please register.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link rel="stylesheet" href="css\all.min.css">
    <link rel="stylesheet" href="css\fontawesome.min.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="wrap">
        <div class="login">
            <h2>login</h2>
             
            <?php
            if (isset($_SESSION['error'])) {
                echo "<p style='color:red; font-size:15px;'>".$_SESSION['error']."</p>";
                unset($_SESSION['error']); 
            }

            if (isset($_SESSION['unauthorized'])) 
                
                echo "<p style='color:red; font-size:15px;'>".$_SESSION['unauthorized']."</p> ";
                unset($_SESSION['unauthorized']);
         
            ?>
      
            <form action="" method="post">
                <div>
                    <label for="">Email:</label>
                    <input type="email" name="email">
                </div>
                <div>
                    <label for="">password:</label>
                    <input type="password" name="password">
                </div>

                

                <div>
                    <button type="submit" name="login">Login</button>
                </div>
                <div>
                <!-- <a  href="">forgot password ?</a> -->

                </div>
                <div>
        
        </div>
            </form>
        </div>
    </div>
</body>
</html> 


