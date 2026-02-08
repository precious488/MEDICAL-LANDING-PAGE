<?php
include "../config/config.php";
;
session_start();


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

           
            $sql = "INSERT INTO user(email, password) 
                    VALUES ('$email', '$hash')";
                if (mysqli_query($conn, $sql)) {
                    return true;
                } else {
                    echo "Error: " . mysqli_error($conn);
                    return false;
                }

          
    }

    }



