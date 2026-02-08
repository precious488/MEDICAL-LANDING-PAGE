<?php
include 'fetch.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="dash.css">
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

            <a href="dashboard.php" >Doctors</a>
            <a href="service.php" >Services</a>
            <a href="logout.php">Logout</a>
        </div>

        <div class="main">
           
            <div id="services" class="section" >
                <div class="header">
                <div class="top-bar">
                <input type="text" id="searchBar" placeholder="Search doctors..." onkeyup="searchDoctors()">
            </div>
                    <h1>Services</h1>
                    <button id="addServiceBtn">Add Service +</button>
                </div>
                <table id="serviceTable">
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th>Image</th>
                            <th>Service Name</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>


                    <tbody>
                    <?php foreach($services as $service): ?>

                        <tr class="doctor-row">

                            <td><?php echo $service['service_id'];?></td>
                
                            <td><?php echo "<img src='".$service['service_image']."' ";?></td>
                            <td class="service_name"><?php echo $service['service_name'];?></td>
                            <td><?php echo $service['description'];?></td>
                            <td>
    <a href="javascript:void(0);" onclick="confirmAction('update', 'update_service.php?updateid=<?php echo $service['service_id']; ?>')">Update</a>

    <a href="javascript:void(0);" onclick="confirmAction('delete', 'delete_service.php?deleteid=<?php echo $service['service_id']; ?>')">Delete</a>
</td>

                          
                    </tr>
                            <?php endforeach?>
                    </tbody>
                  
                </table>
            </div>

            <div id="popupServiceForm" class="popup">
                <div class="popup-content">
                    <span class="close" onclick="togglePopup('popupServiceForm')">&times;</span>
                    <h2>Add New Service</h2>
                    <form id="serviceForm" onsubmit="submitServiceForm(event)" method="post" action="add_service.php" enctype="multipart/form-data" >
                        <label for="serviceName">Service Name:</label>
                        <input type="text" id="serviceName" name="service_name" required>
                        <label for="serviceDescription">Description:</label>
                        <input type="text" id="serviceDescription" name="service_description" required>
                        <label for="serviceImage">Upload Image:</label>
                        <input type="file" id="serviceImage" name="service_image" required>
                        <input type="hidden" id="editServiceIndex" value="">
                        <button type="submit" name="add_service">Submit</button>
                    </form>
                </div>
            </div>

            
        </div>
    </div>

    <script>
        
        const services = JSON.parse(localStorage.getItem('services')) || [];

        function togglePopup(popupId) {
    const popup = document.getElementById(popupId);
    if (popup.style.display === "none" || popup.style.display === "") {
        popup.style.display = "flex"; // Show the popup
    } else {
        popup.style.display = "none"; // Hide the popup
    }
}

// Add event listener to open the popup when clicking "Add Service +"
document.getElementById("addServiceBtn").addEventListener("click", function() {
    togglePopup('popupServiceForm');
});


        // Load initial data
      
        loadServices();


        function searchDoctors() {
            let input = document.getElementById("searchBar").value.toLowerCase();
            let rows = document.querySelectorAll(".doctor-row");
            
            rows.forEach(row => {
                let name = row.querySelector(".service_name").textContent.toLowerCase();
                if (name.includes(input)) {
                    row.style.display = "";
                } else {
                    row.style.display = "none";
                }
            });
        }


        function confirmAction(action, url) {
    let message = action === 'delete' 
        ? 'Are you sure you want to delete this service?' 
        : 'Are you sure you want to update this service?';

    if (confirm(message)) {
        window.location.href = url;
    }
}

    </script>

</body>
</html>

