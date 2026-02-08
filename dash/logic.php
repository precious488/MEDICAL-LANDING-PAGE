<?php
include "../config/config.php";
;
session_start();

// Function to safely execute SQL queries
function executeQuery($conn, $sql) {
    if (mysqli_query($conn, $sql)) {
        return true;
    } else {
        echo "Error: " . mysqli_error($conn);
        return false;
    }
}
    if (isset($_POST['submit'])) {
        $name = htmlspecialchars($_POST['first']);
        $email = htmlspecialchars($_POST['email']);
        $pass = $_POST['password'];
        $confirm = htmlspecialchars($_POST['confirm']);

        if ($pass === $confirm) {
            $hash = password_hash($pass, PASSWORD_DEFAULT);

            // function handleExistingUsernameOrEmailL($email) {
            //     $sql = "SELECT * FROM user WHERE email = '$email'";
            //     global $conn;
            //     $result = mysqli_query($conn, $sql);
            
            //     if (mysqli_num_rows($result) > 0) {
            //         header("location: signup.php?username__or_email_exist");
            //     }
            // }
            // handleExistingUsernameOrEmailL( $email);

            $sql = "INSERT INTO user(email, password) 
                    VALUES ('$email', '$hash')";
                if (mysqli_query($conn, $sql)) {
                    return true;
                } else {
                    echo "Error: " . mysqli_error($conn);
                    return false;
                }

            // header('location:dashboard.php');
    



    }

    }

// }

