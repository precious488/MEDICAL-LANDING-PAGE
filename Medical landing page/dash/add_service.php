<?php
include '../config/config.php';

if (isset($_POST['add_service'])) {
    
    $service_name = htmlspecialchars($_POST['service_name']);
    $description = htmlspecialchars($_POST['service_description']);

  
    if (isset($_FILES["service_image"]) && $_FILES["service_image"]["error"] === 0) {

        
        $target_dir = "uploadService/";
        $target_file = $target_dir . basename($_FILES["service_image"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];


        if (getimagesize($_FILES["service_image"]["tmp_name"]) === false) {
            die("File is not an image.");
        }


        if (!in_array($imageFileType, $allowed_types)) {
            die("Only JPG, JPEG, PNG & GIF files are allowed.");
        }


        if (move_uploaded_file($_FILES["service_image"]["tmp_name"], $target_file)) {
            
            $sql = "INSERT INTO services(service_name, service_image, description) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sss", $service_name, $target_file, $description);

            if ($stmt->execute()) {
               
                header("Location: service.php");
                exit();
            } else {
                echo "Error: " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "Failed to upload image.";
        }
    } else {
        echo "No file uploaded or there was an error with the file upload.";
    }
}
?>
