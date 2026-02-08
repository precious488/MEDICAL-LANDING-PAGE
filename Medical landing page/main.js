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



let index = 0;
        const totalSlides = 3;

        function updateCarousel() {
            document.getElementById("carousel").style.transform = `translateX(-${index * 100}vw)`;
            document.querySelectorAll(".dot").forEach((dot, i) => {
                dot.classList.toggle("active", i === index);
            });
        }

        function nextSlide() {
            index = (index + 1) % totalSlides;
            updateCarousel();
        }

        function prevSlide() {
            index = (index - 1 + totalSlides) % totalSlides;
            updateCarousel();
        }

        function goToSlide(i) {
            index = i;
            updateCarousel();
        }

        document.addEventListener("DOMContentLoaded", () => {
            const dotsContainer = document.getElementById("dots");
            for (let i = 0; i < totalSlides; i++) {
                const dot = document.createElement("div");
                dot.classList.add("dot");
                dot.addEventListener("click", () => goToSlide(i));
                dotsContainer.appendChild(dot);
            }
            updateCarousel();
        });

        setInterval(nextSlide, 7000);


        // ##### contact form validation####


        const myMessage = document.getElementById("myMessage");
        const myEmail = document.getElementById("myEmail");
        const myName = document.getElementById("myName");


        const messMessage = document.getElementById("messMessage");
        const messEmail = document.getElementById("messEmail");
        const messName = document.getElementById("messName");
        const myForm = document.getElementById("form-con");

        myName.addEventListener('click', checkName);
        myEmail.addEventListener('click', checkEmail);
        myMessage.addEventListener('click', checkMessage);

        myForm.addEventListener('submit', (e) =>{
            e.preventDefault();
            let isValid = true;

            if(!checkName()){
                isValid = false;
            }
            if(!checkEmail()){
                isValid = false;
            }
            if(!checkMessage()){
                isValid = false;
            }

            if(isValid){
                myForm.submit();
            }

            myForm.reset();
        })

       function checkName(){
            const nameValue = myName.value.trim();
            if(nameValue ===""){
                messName.innerHTML = "Please enter your name";
                return false;
            }
            else{
                messName.innerHTML = "";
                return true;
            }
        }

        function checkEmail(){
            const emailValue = myEmail.value.trim();
            if(emailValue === ""){
                messEmail.innerHTML = "Please enter your email";
                return false;
            }else if (!/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test(emailValue)){
                
                messEmail.innerHTML = "Enter a valid email";

                return false;
            }
            else{
                messEmail.innerHTML = "";
                return true;
            }
        }

        function checkMessage(){
            const messageValue = myMessage.value.trim();
            if(messageValue ===""){
                messMessage.innerHTML = "Please enter your message";
                return false;
            }
            else{
                messMessage.innerHTML = "";
                return true;
            }
        }