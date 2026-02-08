<?php
include '../config/config.php';

if (isset($_GET['deleteid'])) {
    $id = intval($_GET['deleteid']); 
    
    $sql = "DELETE FROM services WHERE service_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
       $conn->query("SET @count = 0");
       $conn->query("UPDATE services SET service_id = @count := @count + 1");
       $conn->query("ALTER TABLE services AUTO_INCREMENT =1");


        header('Location: service.php');
        exit();
    } else {
        die("Error deleting record: " . $stmt->error);
    }

    $stmt->close();
}

$conn->close();
?>
