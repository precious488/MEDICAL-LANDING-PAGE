<?php
include '../config/config.php'; 

if (isset($_GET['updateid'])) {
    $id = $_GET['updateid'];


    $sql = "SELECT * FROM services WHERE service_id = ?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Prepare statement failed: " . $conn->error); 
    }

    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $service = $result->fetch_assoc();
    } else {
        die("Service not found!");
    }
} else {
    die("Invalid request!");
}


if (isset($_POST['update_service'])) {
    $service_name = $_POST['service_name'];
    $service_description = $_POST['service_description'];

   
    if (!empty($_FILES['service_image']['name'])) {
        $image_name = $_FILES['service_image']['name'];
        $image_tmp = $_FILES['service_image']['tmp_name'];
        $upload_dir = "uploadService/" . $image_name;
        move_uploaded_file($image_tmp, $upload_dir);
    } else {
        $upload_dir = $service['service_image']; 
    }

  
    $sql = "UPDATE services SET service_name=?, service_image=?, description=? WHERE service_id=?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Prepare statement failed: " . $conn->error); 
    }

    $stmt->bind_param("sssi", $service_name, $upload_dir, $service_description, $id);

    if ($stmt->execute()) {
        header("Location: service.php"); 
        exit();
    } else {
        die("Error updating service: " . $stmt->error);
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Service</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background-color: #f4f4f4;
            color: #333;
        }

        .container {
            display: flex;
            height: 100vh;
            width: 100%;
            margin: auto;
            justify-content: center;
            align-items: center;
        }

        .popup {
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .popup-content {
            background-color: #fefefe;
            padding: 30px;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.3);
            text-align: center;
            width: 350px;
        }

        button {
            padding: 10px 15px;
            margin: 10px 0;
            cursor: pointer;
            background: #178066;
            border: none;
            color: white;
            border-radius: 5px;
            transition: background 0.3s;
        }

        button:hover {
            background: #62d2a2;
        }

        .popup form {
            display: flex;
            flex-direction: column;
            margin-top: 20px;
        }

        .popup form label {
            text-align: left;
            margin: 15px 0 10px 0;
        }

        .popup form input {
            outline: none;
            padding: 10px 5px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
    </style>
</head>
<body>
    <div class="container">
        <div id="popupServiceForm" class="popup">
            <div class="popup-content">
                <h2>Edit Service</h2>
                <form id="serviceForm" method="post" action="" enctype="multipart/form-data">
                    <label for="serviceName">Service Name:</label>
                    <input type="text" id="serviceName" name="service_name" value="<?php echo $service['service_name']; ?>" required>

                    <label for="serviceDescription">Description:</label>
                    <input type="text" id="serviceDescription" name="service_description" value="<?php echo $service['description']; ?>" required>

                    <label for="serviceImage">Upload Image:</label>
                    <input type="file" id="serviceImage" name="service_image" required>
                    <img src="<?php echo $service['service_image']; ?>" width="100">

                    <button type="submit" name="update_service">Update</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
