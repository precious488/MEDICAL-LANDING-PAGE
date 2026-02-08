                                                                                                                                                               
                                                                                                                                                               <?php
include '../config/config.php';

if (isset($_POST['upload'])) {
    
    $name = htmlspecialchars($_POST['name']);
    $specialty = htmlspecialchars($_POST['specialty']);

    
    if (isset($_FILES["image"]) && $_FILES["image"]["error"] === 0) {

        
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];

        
        if (getimagesize($_FILES["image"]["tmp_name"]) === false) {
            die("File is not an image.");
        }

        
        if (!in_array($imageFileType, $allowed_types)) {
            die("Only JPG, JPEG, PNG & GIF files are allowed.");
        }

       
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
           
            $sql = "INSERT INTO doctor (doctor_name, doctor_specialty, image) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sss", $name, $specialty, $target_file);

            if ($stmt->execute()) {
               
                header("Location: dashboard.php");
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
