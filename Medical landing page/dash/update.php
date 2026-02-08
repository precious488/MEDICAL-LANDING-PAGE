<?php
include '../config/config.php';
// include 'fetch.php';


if (isset($_GET['updateid'])) {
    $id = $_GET['updateid'];

    // Fetch current doctor details
    $sql = "SELECT * FROM doctor WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $doctor = $result->fetch_assoc();

    if (!$doctor) {
        die("Doctor not found!");
    }
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $specialty = $_POST['specialty'];


    $query = "SELECT image FROM doctor WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($currentImage);
    $stmt->fetch();
    $stmt->close();


    if (!empty($_FILES["image"]["name"])) {
        $targetDir = "uploads/";
        $newImage = $targetDir . basename($_FILES["image"]["name"]);
        move_uploaded_file($_FILES["image"]["tmp_name"], $newImage);
    } else {
        $newImage = $currentImage;
    }


    $query = "UPDATE doctor SET doctor_name=?, doctor_specialty=?, image=? WHERE id=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssi", $name, $specialty, $newImage, $id);

    if ($stmt->execute()) {
        echo "<script>alert('Doctor updated successfully!'); window.location.href='dashboard.php';</script>";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Doctor</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background-color: #f4f4f4;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .popup-content {
            background-color: #fff;
            padding: 30px;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.3);
            text-align: center;
            width: 350px;
        }

        input, button {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        button {
            background: #178066;
            color: white;
            cursor: pointer;
        }

        button:hover {
            background: #62d2a2;
        }
    </style>
</head>
<body>
    
    <div class="popup-content">
        <h2>Edit Doctor</h2>
        <form method="post" action="" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $doctor['id']; ?>">

            <label for="doctorName">Full Name:</label>
            <input type="text" name="name" value="<?php echo $doctor['doctor_name']; ?>" required>

            <label for="doctorSpecialty">Specialty:</label>
            <input type="text" name="specialty" value="<?php echo $doctor['doctor_specialty']; ?>" required>

            <label>Current Image:</label>
            <br>
            <img src="<?php echo $doctor['image']; ?>" alt="Doctor Image" width="100"><br><br>

            <label for="doctorImage">Upload New Image (optional):</label>
            <input type="file" name="image">

            <button type="submit" name="update">Update Doctor</button>
        </form>
    </div>
</body>
</html>
