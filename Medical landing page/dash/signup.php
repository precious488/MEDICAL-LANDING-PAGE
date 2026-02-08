<?php
include '../config/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $password = trim($_POST['password']);

    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format";
        exit();
    }

  
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);


    $sql = "INSERT INTO user (email, password) VALUES ('$email', '$hashedPassword')";

  
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="css\all.min.css">
    <link rel="stylesheet" href="css\fontawesome.min.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="wrap">
    <h2>Create Account</h2>
    <form action="signup.php" method="POST">
        <div>
            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email" required><br><br>
        </div>

        <div>
            <label for="password">Password:</label><br>
            <input type="password" id="password" name="password" required><br><br>
        </div>

        <div><button type="submit" value="Sign Up">Sign up</button></div>
    </form>
    </div>
   
</body>
</html>
