<?php
include '../config/config.php';

if (isset($_POST['add_service'])) {
    // Sanitize and validate form inputs
    $service_name = htmlspecialchars($_POST['service_name']);
    $description = htmlspecialchars($_POST['service_description']);

    // Check if file was uploaded
    if (isset($_FILES["service_image"]) && $_FILES["service_image"]["error"] === 0) {

        // Get the uploaded file's information
        $target_dir = "uploadService/";
        $target_file = $target_dir . basename($_FILES["service_image"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];

        // Check if the file is an actual image
        if (getimagesize($_FILES["service_image"]["tmp_name"]) === false) {
            die("File is not an image.");
        }

        // Check if the file type is allowed
        if (!in_array($imageFileType, $allowed_types)) {
            die("Only JPG, JPEG, PNG & GIF files are allowed.");
        }

        // Move the uploaded file to the uploads folder
        if (move_uploaded_file($_FILES["service_image"]["tmp_name"], $target_file)) {
            // Use prepared statements to prevent SQL errors and injection
            $sql = "INSERT INTO services(service_name, service_image, description) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sss", $service_name, $target_file, $description);

            if ($stmt->execute()) {
                // Redirect to the dashboard page after a successful upload
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
