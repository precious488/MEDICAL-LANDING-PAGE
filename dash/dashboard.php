<?php
include 'fetch.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
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
        }

        .sidebar {
            width: 220px;
            background: #2c3e50;
            color: white;
            padding: 20px;
            box-shadow: 2px 0 5px rgba(0,0,0,0.3);
            
        }


        .sidebar h2 {
            margin: 0 0 20px;
            font-size: 24px;
            text-align: center;
        }
        .sidebar span{
            color: #3498db;
        }

        .sidebar a {
            color: white;
            text-decoration: none;
            display: block;
            margin: 15px 0;
            padding: 10px;
            border-radius: 5px;
            transition: background 0.3s;
        }

        .sidebar a:hover {
            background: #3498db;
        }

        .main {
            flex-grow: 1;
            padding: 20px;
            overflow-y: auto;
        }

        .header {
            background: #3498db;
            color: white;
            padding: 15px;
            text-align: center;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.3);
        }

        button {
            padding: 10px 15px;
            margin: 10px 0;
            cursor: pointer;
            background: #2980b9;
            border: none;
            color: white;
            border-radius: 5px;
            transition: background 0.3s;
        }

        button:hover {
            background: #3498db;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background: white;
            border-radius: 5px;
            overflow: hidden;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background: #2980b9;
            color: white;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .popup, .details-popup {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }

        .popup-content, .details-content {
            background-color: #fefefe;
            padding: 30px;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.3);
            text-align: center;
            width: 350px;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover {
            color: black;
        }

        img {
            max-width: 100px;
            max-height: 100px;
            border-radius: 5px;
        }

        .popup form{
    display: flex;
    flex-direction: column;
    margin-top: 20px;
}
.popup form label{
    text-align: left;
    margin: 15px 0 10px 0;
}
.popup form input{
    outline: none;
    padding: 10px 5px;
    border-radius: 5px;
    border: 1px solid #ccc;
}

        @media (max-width: 768px) {
            .container {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
            }

            .main {
                padding: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <h2>Tandu<span>Care</span></h2>
            <a href="dashboard.php" >Doctors</a>
            <a href="service.php" >Services</a>
            <a href="logout.php">Logout</a>
        </div>

        <div class="main">
            <div id="doctors" class="section">
                <div class="header">
                    <h1>Doctors</h1>
                    <button id="addDoctorBtn">Add Doctor +</button>
                </div>
                <table id="doctorTable">
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th>Picture</th>
                            <th>Full Name</th>
                            <th>Specialty</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <?php foreach($doctor as $doct): ?>
                    <tbody>
                    
                            <td><?php echo $doct['id'];?></td>
                
                            <td><?php echo "<img src='".$doct['image']."' ";?></td>
                            <td><?php echo $doct['doctor_name'];?></td>
                            <td><?php echo $doct['doctor_specialty'];?></td>
                            <td>
                            <a href="update.php?updateid=<?php echo $doct['id']; ?>">Update</a>
                       <a href="delete.php?deleteid=<?php echo $doct['id']; ?>">Delete</a>

                      
                    </td>
                          
                           

                    </tbody>
                    <?php endforeach?>
                </table>
            </div>

                       <div id="popupForm" class="popup">
                <div class="popup-content">
                    <span class="close" onclick="togglePopup('popupForm')">&times;</span>
                    <h2 id="formTitle">Add New Doctor</h2>
                    <form id="doctorForm" onsubmit="submitDoctorForm(event)" method="post" action="add_doctor.php" enctype="multipart/form-data">
                        <label for="doctorName">Full Name:</label>
                        <input type="text" id="doctorName" name="name" required>
                        <label for="doctorSpecialty">Specialty:</label>
                        <input type="text" id="doctorSpecialty" name="specialty" required>
                        <label for="doctorImage">Upload Image:</label>
                        <input type="file" id="doctorImage"  name="image" required>
                        <input type="hidden" id="editIndex" value="">
                        <button type="submit" name="upload">Submit</button>
                    </form>
                </div>
            </div>

           


        </div>
    </div>

    <script>
        const doctors = JSON.parse(localStorage.getItem('doctors')) || [];
        const services = JSON.parse(localStorage.getItem('services')) || [];

        function togglePopup(popupId) {
            const popup = document.getElementById(popupId);
            popup.style.display = (popup.style.display === "flex") ? "none" : "flex";
        }

        function showSection(section) {
            document.querySelectorAll('.section').forEach(s => s.style.display = 'none');
            document.getElementById(section).style.display = 'block';
            if (section === 'doctors') loadDoctors();
            else loadServices();
        }

        
        document.getElementById("addDoctorBtn").onclick = () => {
            document.getElementById("formTitle").textContent = "Add New Doctor";
            document.getElementById("editIndex").value = '';
            togglePopup('popupForm');
        };
        document.getElementById("addServiceBtn").onclick = () => {
            document.getElementById("editServiceIndex").value = '';
            document.getElementById("serviceName").value = '';
            document.getElementById("serviceDescription").value = '';
            togglePopup('popupServiceForm');
        };

        // Load initial data
        loadDoctors();
        loadServices();
    </script>

</body>
</html>

