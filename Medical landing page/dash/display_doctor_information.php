<?php
include '../config/config.php';


$sql = "SELECT * FROM doctor";
$result = $conn->query($sql);

if ($result->num_rows > 0) {



    while ($row = $result->fetch_assoc()) {
        $imagePath = $row['image']; 
        $doctor_name= $row['doctor_name'];
        $doctor_specialty=$row['doctor_specialty'];
        
    }

    
} 
$conn->close();
?>
