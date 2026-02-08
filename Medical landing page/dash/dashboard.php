<?php
//include 'middle_ware.php';
include 'fetch.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="dash.css">
    <link rel="stylesheet" href="../fontawesome/css/all.css" />
    <script src="dash.js" defer></script>
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <h2>Tandu<span>Care</span></h2>
            <div class="profile">

                <div class="upload-container">
                
                     <label for="imageInput" class="profile-pic-container">
                       <span class="plus-icon">+</span>
                       <img id="imagePreview" alt="Profile Picture">
                     </label>
                     <input type="file" id="imageInput" class="input" accept="image/*">

                 </div>
                 <p class="username" style="colore: white"><?php echo $user[0]['name'];  ?></p>
             </div>
            <a  href="dashboard.php">Doctors</a>
            <a href="service.php" >Services</a>
            <a href="logout.php">Logout</a>
        </div>

        <div class="main">

            <div id="doctors" class="section">
                <div class="header">
                    
            <div class="top-bar">
                <input type="text" id="searchBar" placeholder="Search doctors..." onkeyup="searchDoctors()">
            </div>
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
                    <tbody>
                        <?php foreach($doctor as $doct): ?>
                        <tr class="doctor-row">
                            <td><?php echo $doct['id']; ?></td>
                            <td><img src="<?php echo $doct['image']; ?>" class="doctor-img"></td>
                            <td class="doctor-name"><?php echo $doct['doctor_name']; ?></td>
                            <td class="doctor_specialty"><?php echo $doct['doctor_specialty']; ?></td>
                            <td>
    <a href="javascript:void(0);" onclick="confirmAction('update', 'update.php?updateid=<?php echo $doct['id']; ?>')">Update</a>
    <a href="javascript:void(0);" onclick="confirmAction('delete', 'delete.php?deleteid=<?php echo $doct['id']; ?>')">Delete</a>
</td>

                        </tr>
                        <?php endforeach; ?>
                    </tbody>
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

        function searchDoctors() {
            let input = document.getElementById("searchBar").value.toLowerCase();
            let rows = document.querySelectorAll(".doctor-row");
            
            rows.forEach(row => {
                let name = row.querySelector(".doctor-name").textContent.toLowerCase();
                let specialty = row.querySelector(".doctor_specialty").textContent.toLowerCase();

                if (name.includes(input)  || specialty.includes(input) ) {
                    row.style.display = "";
                } else {
                    row.style.display = "none";
                }
            });
        }



        function confirmAction(action, url) {
    let message = action === 'delete' ? 'Are you sure you want to delete this doctor?' : 'Are you sure you want to update this doctor?';

    if (confirm(message)) {
        window.location.href = url;
    }
}

    </script>

</body>
</html>

