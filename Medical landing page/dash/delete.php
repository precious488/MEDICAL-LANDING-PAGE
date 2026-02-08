<?php
include '../config/config.php';

if (isset($_GET['deleteid'])) {
    $id = intval($_GET['deleteid']); 

    $sql = "DELETE FROM doctor WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        
        $conn->query("SET @count = 0");
       $conn->query("UPDATE doctor SET id = @count := @count + 1");
       $conn->query("ALTER TABLE doctor AUTO_INCREMENT =1");


        header('Location: dashboard.php');
        exit();
    } else {
        die("Error deleting record: " . $stmt->error);
    }

    $stmt->close();
}

$conn->close();
?>

