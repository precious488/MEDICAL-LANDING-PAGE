<?php
include 'fetch.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Tanducare medical landing page</title>
  <link rel="stylesheet" href="fontawesome/css/all.css" />
  <link rel="stylesheet" href="styles.css" />
  <script src="main.js" defer></script>
</head>

<body>
  <header style="background-color: #178066">
    <div class="container">
      <nav>
        <div class="logo">
          <img src="Images/logo.png" alt="Tanducare" />
          <div class="logo-nane">Tandu<span>Care</span></div>
        </div>
        <ul class="nav-links">
          <li><a href="">Home</a></li>
          <li><a href="#about">About</a></li>
          <li><a href="#services">Services</a></li>
          <li><a href="#departments">Department</a></li>
          <li><a href="#doctors">Doctors</a></li>
          <li><a href="#contact">Contact</a></li>
         </ul>
    
          <div class="mobile-menu">
            <span></span>
            <span></span>
            <span></span>
          </div>
   
      </nav>
    </div>
  </header>

  <!-- <div class="hero">
    <div class="hero-content container">
      <p>Let's make your life happier</p>
      <h1>Healthy Living</h1>
    
    </div>
  </div> -->


  <div class="hero">
        <div class="carousel" id="carousel">
            <div class="slide">
                <!-- <img src="./bg.jpg" alt="Hospital 1"> -->
                <div class="overlay">
                    <h1>Welcome to Our Hospital</h1>
                    <p>Providing Quality Healthcare</p>
                </div>
            </div>
            <div class="slide">
                <!-- <img src="./bg.jpg" alt="Hospital 2"> -->
                <div class="overlay">
                    <h1>Expert Medical Team</h1>
                    <p>Care with Compassion</p>
                </div>
            </div>
            <div class="slide">
                <!-- <img src="./bg.jpg" alt="Hospital 3"> -->
                <div class="overlay">
                    <h1>State-of-the-Art Facilities</h1>
                    <p>Innovative Treatments</p>
                </div>
            </div>
        </div>
        <div class="arrows">
            <button class="arrow" onclick="prevSlide()">&#10094;</button>
            <button class="arrow" onclick="nextSlide()">&#10095;</button>
        </div>
        <div class="dots" id="dots"></div>
    </div>





  <section class="about" id="about">
    <h1>About us</h1>
    <div class="about-content container">
      <div class="acl">
        <img src="Images/blog_5.jpg" alt="">
      </div>
      <div class="acr">
        <p>Welcome to Tanducare, a leading healthcare provider dedicated to delivering exceptional patient care. Our
          mission is to provide comprehensive, compassionate, and innovative healthcare solutions. We strive to create
          a warm environment, offer personalized care, and empower patients with knowledge and resources.</p>
      </div>
    </div>
  </section>

  <section class="services" id="services" style="background: #f8f8f8">
    <div class="container">
      <h1>Services</h1>
      <p>Our professional Services</p>
      <div class="service-cards">
        <?php foreach($services as $service):?>
        <div class="card" >
        <img src="./dash/<?php echo $service['service_image']?>" style="background: #1fab89; padding: 10px; width: 70px; height:70px; border-radius: 50%">
          <h3><?php echo $service['service_name'];?></h3>
          <p><?php echo $service['description'];?></p>
        </div>
        <?php endforeach?>

      </div>
    </div>
  </section>


  <section class="emergency">
    <div class="container">
      <div class="emergency-content">
        <h3>In an emergency? Need help now?</h3>
        <P>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Facilis, dolore magni hic similique incidunt et
          saepe aliquid? Iusto, dolorem amet.</P>
        <a href="#contact">contact us</a>
      </div>
    </div>
  </section>


  <section id="departments">
    <div class="container">
      <h1>Departments</h1>

      <div class="departmentlist">
        <p class="departmentname active-department" onclick="tabs('Pediatrice')">Pediatrice</p>
        <p class="departmentname" onclick="tabs( 'Neurology')">Neurology</p>
        <p class="departmentname" onclick="tabs('Ophthalmolist')">Ophthalmolist</p>
        <p class="departmentname" onclick="tabs('Hematology')">Hematology</p>
      </div>

      <div class="departmentcontent active-content" id="Pediatrice">
        <img src="./Images/pr.jpg" alt="">
        <h2>Pediatric Department</h2>
        <ul>
          <li>Expert care for infants, children and adolescents.</li>
          <li>Services: vaccinations, growth monitoring, developmental assessments.</li>
          <li>Treats common childhood illnesses like asthma, allergies and infections.</li>
          <li>Our pediatricians are board-certified and experienced.</li>
        </ul>
      </div>
      <div class="departmentcontent" id="Neurology">
        <img src="./Images/neu.jpg" alt="">
        <h2>Neurology Department</h2>
        <ul>
          <li>Diagnoses and treats brain, spinal cord and nervous system disorders.</li>
          <li>Services: EEG, EMG, nerve conduction studies and MRI.</li>
          <li>Treats conditions like epilepsy, Parkinson's disease, multiple sclerosis.</li>
          <li>Our neurologists are board-certified and up-to-date on the latest treatments.</li>
        </ul>
      </div>
      <div class="departmentcontent" id="Ophthalmolist">
        <h2>Ophthalmology Department</h2>
        <ul>
          <li>Provides comprehensive eye care for adults and children.</li>
          <li>Services: eye exams, cataract surgery, LASIK and glaucoma treatment.</li>
          <li>Treats conditions like macular degeneration, diabetic retinopathy.</li>
          <li>Our ophthalmologists are board-certified and skilled in the latest techniques.</li>
        </ul>
      </div>
      <div class="departmentcontent" id="Hematology">
        <h2>Hematology Department</h2>
        <ul>
          <li>Diagnoses and treats blood disorders like anemia, bleeding disorders.</li>
          <li>Services: blood transfusions, bone marrow biopsies and chemotherapy.</li>
          <li>Treats conditions like leukemia, lymphoma and blood cancers.</li>
          <li>Our hematologists are board-certified and experienced in innovative treatments.</li>
        </ul>
      </div>

    </div>
  </section>
  <section class="doctors" id="doctors">
    <h1>Our Doctors</h1>
    <div class="doc-contianer container">
      <?php foreach($doctor as $doct) :?>
      <div class="box">
        <img src="./dash/<?php echo $doct['image'];?>" alt="">

        <div>
          <h4><?php echo $doct['doctor_name']; ?></h4>
          <p><?php echo $doct['doctor_specialty']; ?></p>
        </div>
      </div>
      <?php endforeach ?>
      

    </div>
  </section>

  <section class="Whychooseus-section">
    <div class="container">
      <h3>Reasons <br>to choose our services.</h3>
      <div class="whychooseus">
        <article>
          <i class="fas fa-clock"></i>
          <h4>24/7 Services</h4>
          <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Asperiores, iusto?</p>
        </article>
        <article>
          <i class="fas fa-award"></i>
          <h4>Expertise and experience</h4>
          <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Asperiores, iusto?</p>
        </article>
        <article>
          <i class="fas fa-laugh"></i>

          <h4>Our patients are happy</h4>
          <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Asperiores, iusto?</p>

        </article>
      </div>
    </div>
  </section>


  
  </div>
  </section>

  <section id="contact">

    <h1>Contact</h1>

    <div class="container">
      <div class="contact-box">
        <div class="cbbl">
          <div class="address c">
            <i class="fas fa-map-marker-alt"></i>
            <h4>Address</h4>
            <p> Bamenda </p>
          </div>
          <div class="number c">
            <i class="fas fa-phone"></i>
            <h4>Call us</h4>
            <p>+237 681388519</p>
          </div>
          <div class="email c">
            <i class="fas fa-mail-bulk"></i>
            <h4>Email us</h4>
            <p>tanducare@gmail.com</p>
          </div>
        </div>
        <div class="cbbr">
          <div class="contact-form c">
            <h4>Get in Touch</h4>

            
<form class="form-con" id="form-con" action="https://formspree.io/f/xdkeklyn"
              method="POST">
              <input class="in" type="text" name="name" id="myName" placeholder="Your Name">
              <div class="message" id="messName"></div>
              <input class="in" type="email" name="email" id="myEmail" placeholder="Your Email">
              <div class="message" id="messEmail"></div>
              <textarea class="in" rows="4" cols="20" name="message" id="myMessage" placeholder="Message"></textarea>
              <div class="message" id="messMessage"></div>
              <input class="in" type="submit" value="Send Message">
            </form>
          </div>
        </div>
      </div>
    </div>

    <div class="google-map">
      <iframe
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3968.2899184774856!2d10.141373938038306!3d5.954735029539107!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x105f163f197297f1%3A0x3920351e593caf10!2sBamenda%20Regional%20Hospital!5e0!3m2!1sen!2sus!4v1733796031173!5m2!1sen!2sus"
        width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
        referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
  </section>


  <footer>
    <div class="container">
      <div class="footer-content">
        <div class="fl">
          <img src="./Images/logo.png" alt="">
          <p>Your Health Is Our <span>Priority</span></p>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Id, natus.</p>
        </div>
        <div class="fc">
          <p>Important <span>links</span></p>
          <ul class="footer-links">
            <li><a href="">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#services">Services</a></li>
            <li><a href="#departments">Department</a></li>
            <li><a href="#doctors">Doctors</a></li>
            <li><a href="">Contact</a></li>
          </ul>
        </div>
        <div class="fr">
          <p>Contact <span>Us</span>
          <div><i class="fas fa-phone"></i><span class="unb">+237 68138851</span></div>
          </p>
        </div>
      </div>

      <p>copyright &copy; Tandu<span>Care</span> 2024</p>
    </div>
  </footer>
</body>

</html>