<?php
include "../config/config.php";
session_start();
function fetchData($conn, $table) {
    
    $stmt = $conn->prepare("SELECT * FROM $table");

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    } else {
        return ["error" => "Query execution failed: " . $stmt->error];
    }
}
$doctor = fetchData($conn, 'doctor');
$services = fetchData($conn, 'services');
$user = fetchData($conn, 'user');
?>