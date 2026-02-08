<?php
include '../config/config.php';

if (isset($_GET['deleteid'])) {
    $id = intval($_GET['deleteid']); // Convert to integer to prevent SQL injection

    // Use prepared statements for security
    $sql = "DELETE FROM doctor WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        // Redirect after successful deletion
        header('Location: dashboard.php');
        exit();
    } else {
        die("Error deleting record: " . $stmt->error);
    }

    $stmt->close();
}

$conn->close();
?>
