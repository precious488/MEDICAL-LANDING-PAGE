const navLinks = document.querySelector(".nav-links");
const navBar = document.querySelector(".mobile-menu");

navBar.addEventListener("click", ()=>{
    navBar.classList.toggle("active");
    navLinks.classList.toggle("show");
})
navLinks.addEventListener("click", ()=>{
    navBar.classList.remove("active");
    navLinks.classList.remove("show");
})

const departmentnames = document.getElementsByClassName("departmentname");
const departmentcontents = document.getElementsByClassName("departmentcontent");

function tabs(tabname) {
    for (const departmentname of departmentcontents) {
        departmentname.classList.remove("active-department");
    }

    for (const departmentcontent of departmentcontents) {
        departmentcontent.classList.remove("active-content");
    }
    event.currentTarget.classList.add("active-department")
    document.getElementById(tabname).classList.add("active-content");
}

