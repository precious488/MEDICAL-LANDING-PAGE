// const links = document.querySelectorAll(".links");
// const linkContents = document.querySelectorAll(".link-content");

// links.forEach(link => {
//     link.addEventListener("click", (e)=>{
//         e.preventDefault();
//         link.classList.remove("active");

//         linkContents.forEach(linkContent => linkContent.classList.remove("active"));
//         const contentID = link.getAttribute('tab-target');
//         document.getElementById(contentID).classList.add("active")

//         links.forEach(link => link.classList.remove("show"));
//         link.classList.add("show");

//         linkContents.forEach(linkContent => linkContent.classList.remove("show"))

//     })
// });

// let navBar = document.querySelector(".nav-links");
// let mobileMenu = document.querySelector(".mobile-menu");

// mobileMenu.addEventListener('click', () =>{
//     mobileMenu.classList.toggle("active")
//     navBar.classList.toggle("active")
// })

// navBar.addEventListener('click', () =>{
//     mobileMenu.classList.remove("active")
//     navBar.classList.remove("active")
// }) 


// side-bar code ######################################
function validateCv(){
    const field = document.getElementById('field').value.trim();
    const date = document.getElementById('date').value.trim();



    const titleError = document.getElementById('titleError');
    const dateError = document.getElementById('dateError');

    let isValid = true;

           
    if (field === "") {
        fieldError.style.display = "block";
        isValid = false;
    } else {
        fieldError.style.display = "none";
    }


    if (date === "") {
        dateError.style.display = "block";
        isValid = false;
    } else {
        fieldError.style.display = "none";
    }
    return isValid; 

    

}





