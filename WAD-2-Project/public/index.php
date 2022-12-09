<?php
// Includes all packages from Composer;
require_once "../vendor/autoload.php";

// Includes all self-written code from src/ folder
require_once "../src/common.php";

// use Firebase\JWT\JWT;

session_start();

if (isset($_SESSION["id"])) {
    header("Location: home.php");
    exit;
}
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css"></link>
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- External events_page.css -->
    <link rel="stylesheet" href="assets/css/events_page.css"><link>
    <!-- Custom Font -->
    <link rel="stylesheet" href="assets/css/fonts.css"><link>
    <!-- Index Custom -->
    <link rel="stylesheet" href="assets/css/index.css"><link>

    <!------------------------------ NOTE --------------------------------------------------------->
    <!---------------------- Design and codes referenced from www.sandboxsg.com ------------------->
    <!-- I hereby declare I do not own any of the codes and it belongs rightfully to the owner ---->
    <!------------------------------ NOTE --------------------------------------------------------->

    <title>Hackathons and Competitions in Singapore - RevFlair</title>
  </head>

  <!-- Navigation Bar -->




  <header id="top-bar" class="bg-white d-flex align-items-center">
    <img class="logo ms-3" src="images/logo.png" alt="Company Logo" />
    <ul class="nav justify-content-end fs-5 py-2 px-3 flex-grow-1">

        <li class="nav-item">
            <a class="nav-link text-primary" href="signup.php">Sign Up</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-primary btn ms-2" role="button" href="auth.php">Login</a>
        </li>
    </ul>
  </header>

  <body>
  <!-- Background Screen -->
  <div class = "after-header">
    <section id = "screen" style = "text-align: center"  >
      <div class="container">
        <p id="splash-title">RevFlair Singapore</p>
        <p class="splash-description">
            In 2013, Lyft came out of a <b> hackathon </b>
        </p>
        <p class="splash-description">
            In 2021, <b>you</b> take charge of your revolution
        </p>
    </div>
    </section>
  </div>

  <!-- Main body -->

  <main>
    <div class = "container px-3 py-3" >
      <div class = "row" >

        <!-- First column-->
        <div class = "col-md-6">
          <h2 class = "title_heading"> A Hackathon for Everyone </h2>
          <p class = "title_description" style = "font-size: 22px;">
            We collate competitions from both local and
            international scenes, ranging from the most beginner-friendly
            to expert-level. All competitions listed on
            RevFlair Singapore are free to participate!
            <br>
            <br>
            First time participating in one? Do not worry! Try out any of the beginner
            hackathons. All you need to do is to keep an open mind about it!
            You may also partner up with people of similar skill sets from our site!
          </p>
        </div>

        <!-- Second column for spacing -->
        <div class="col-md-1 py-3"></div>

        <!-- Third column for video -->
        <div class="col-md-5 py-3">
          <video playsinline="" autoplay="" muted="" loop="" width="100%">
              <source src="./Images/start_up_video.mp4" type="video/mp4">
          </video>
        </div>
      </div>
    </div>

    <div class = "container px-3 py-3">
      <!-- divider -->
      <hr>
      <!-- divider -->
      <h1 class = "title_heading text-center" id="hackathonlist"> Upcoming Hackathons </h1>
      <h5 class = "text-center"> More hackathons are available when you sign in !</h5>


      <!-- Event List -->
      <div id = "poggers">
        <div class = "row row-cols-sm-1 row-cols-md-2 row-cols-lg-3 g-4">

        <!-- ST Logistics -->
        <div class="col px-3 hackathon-card" data-value="ST Logistics ST Logistics Innovation Challenge 2021
        ">
        <div class="card h-100">
          <div class="card-header text-center text-bold" style="background-color: #868686!important;">Coming Soon!</div>
            <div class="row g-0 mx-3">
        <div class="mx-auto text-center" style="height:200px;">
          <img id="ST Logistics Innovation Challenge 2021_image" src="images/stl2021.png" alt="Hackathon Image" style="height: 100%; width: 100%; object-fit: contain">
        </div>
        <div class="card-body">
          <div class="chaeyoung">
            <div class="mb-3" style="background-color:#379683;border-radius:10px;text-align:center">
              <b>ST Logistics</b> </div>
            <h5 class="card-title">ST Logistics Innovation Challenge 2022</h5>
            <p class="card-text my-2" id="ST Logistics Innovation Challenge 2021_description">We are inviting university students to participate in this challenge not only for the chance to
              collaborate with a major supply chain and logistics company, test-bed
              and gain funding to develop solutions, but also to play a critical role in building a more technologically-enabled Singapore.*</p>
          </div>

          <h6 class = "text-center text-danger">Registrations Opening in January 2022</h6>
          <div class="row-cols-1">
            <div class="mb-3" id="ST Logistics Innovation Challenge 2021_color_exp" title="Experience" style="background-color:#7395AE;border-radius:10px;text-align:left;text-indent: 1em;">   Difficulty: Intermediate </div>
            <div class="mb-3" id="ST Logistics Innovation Challenge 2021_color_type" title="Type" style="background-color:#557A95;border-radius:10px;text-align:left;text-indent: 1em;">   Type: Solution Development </div>
            <div class="mb-3" id="ST Logistics Innovation Challenge 2021_color_team" title="Number of Team Members" style="background-color:#B1A296;border-radius:10px;text-align:left;text-indent: 1em;">   Team: 1-5 </div>
          </div>

          <button type="button" class="btn" style="background-color:#7395AE" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-hackathonname="ST Logistics Innovation Challenge 2021" data-bs-link="https://innovatewithstl.com/">Learn More</button>
              </div>
            </div>
          </div>
        </div>

        <!-- JP Morgan -->

        <div class="col px-3 hackathon-card" data-value="JP Morgan Code for Good 2022">
          <div class="card h-100">
            <div class="card-header text-center text-bold" style="background-color: #868686!important;">Coming Soon!</div>
            <div class="row g-0 mx-3">
              <div class="mx-auto text-center" style="height:200px;">
                <img id="Code for Good 2021_image" src="images/jpm2021.png" alt="Hackathon Image" style="height: 100%; width: 100%; object-fit: contain">
              </div>
              <div class="card-body">

                <div class="chaeyoung">
                  <div class="mb-3" style="background-color:#379683;border-radius:10px;text-align:center">
                    <b>JP Morgan</b> </div>

                  <h5 class="card-title">Code for Good 2022</h5>
                  <p class="card-text my-2" id="Code for Good 2021_description">At our Code for Good event, we bring coders and non-profit organizations together to solve real-world technical problems. You will experience firsthand how we use technology to inspire change, foster inclusion and make a difference in our communities. Work alongside our tech experts.
                    Meet our recruiting teams and experience what it’s like to work as an engineer at J.P. Morgan.</p>
                </div>

                <h6 class = "text-center text-danger">Registrations Opening in January 2022</h6>
                <div class="row-cols-1">
                  <div class="mb-3" id="Code for Good 2021_color_exp" title="Experience" style="background-color:#7395AE;border-radius:10px;text-align:left;text-indent: 1em;">   Difficulty: Intermediate </div>
                  <div class="mb-3" id="Code for Good 2021_color_type" title="Type" style="background-color:#557A95;border-radius:10px;text-align:left;text-indent: 1em;">   Type: Social Solution </div>
                  <div class="mb-3" id="Code for Good 2021_color_team" title="Number of Team Members" style="background-color:#B1A296;border-radius:10px;text-align:left;text-indent: 1em;">   Team: 1 </div>
                </div>

                <button type="button" class="btn" style="background-color:#7395AE" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-hackathonname="Code for Good 2021" data-bs-link="https://jpmc.fa.oraclecloud.com/hcmUI/CandidateExperience/en/sites/CX_1001/job/210164222/?utm_medium=SandboxSG&amp;src=SandboxSG">Learn More</button>
              </div>
            </div>
          </div>
        </div>

        <!-- Singapore Airlines App Challenge -->
        <div class="col px-3 hackathon-card" data-value="Singapore Airlines Singapore Airlines AppChallenge 2022">
          <div class="card h-100">
            <div class="card-header text-center text-bold" style="background-color: #868686!important;">Coming Soon!</div>
            <div class="row g-0 mx-3">
              <div class="mx-auto text-center" style="height:200px;">
                <img id="Singapore Airlines AppChallenge 2021_image" src="images/sia2021.png" alt="Hackathon Image" style="height: 100%; width: 100%; object-fit: contain">
              </div>
              <div class="card-body">

                <div class="chaeyoung">
                  <div class="mb-3" style="background-color:#379683;border-radius:10px;text-align:center">
                    <b>Singapore Airlines</b> </div>

                  <h5 class="card-title">Singapore Airlines AppChallenge 2022</h5>
                  <p class="card-text my-2" id="Singapore Airlines AppChallenge 2021_description">Shortlisted teams will receive dedicated mentoring sessions from aviation experts, business coaches and a chance to pitch their ideas to Singapore Airlines senior management who will be part of the judging panel.
                    Up to 500,000 KrisFlyer Miles and Singapore Airlines Merchandise to be won.</p>
                </div>

                <h6 class = "text-center text-danger">Registrations Opening in January 2022</h6>
                <div class="row-cols-1">
                  <div class="mb-3" id="Singapore Airlines AppChallenge 2021_color_exp" title="Experience" style="background-color:#7395AE;border-radius:10px;text-align:left;text-indent: 1em;">   Difficulty: Intermediate </div>
                  <div class="mb-3" id="Singapore Airlines AppChallenge 2021_color_type" title="Type" style="background-color:#557A95;border-radius:10px;text-align:left;text-indent: 1em;">   Type: Solution Development </div>
                  <div class="mb-3" id="Singapore Airlines AppChallenge 2021_color_team" title="Number of Team Members" style="background-color:#B1A296;border-radius:10px;text-align:left;text-indent: 1em;">   Team: 1-3 </div>
                </div>

                <button type="button" class="btn" style="background-color:#7395AE" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-hackathonname="Singapore Airlines AppChallenge 2021" data-bs-link="https://appchallenge.singaporeair.com/en/challenges/students-2021">Learn More</button>
              </div>
            </div>
          </div>
        </div>

        <!-- Modal Section -->
      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">
                          HackathonName
                      </h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                      <div class="text-center my-3">
                          <img id="modal_image" src="" alt="Hackathon Image" style="height: 100%; width: 50%; object-fit: contain">
                      </div>

                      <div id="modal_description" class="mb-3"></div>

                      <div class="mb-3" id="modal_color_exp" title="Experience" style="
                        background-color: #7395AE;
                        border-radius: 10px;
                        text-align: left;
                        text-indent: 1em;
                        ">
                          Difficulty:
                      </div>
                      <div class="mb-3" id="modal_color_type" title="Type" style="
                        background-color: #557A95;
                        border-radius: 10px;
                        text-align: left;
                        text-indent: 1em;
                        ">
                          Type:
                      </div>
                      <div class="mb-3" id="modal_color_team" title="Number of Team Members" style="
                        background-color: #B1A296;
                        border-radius: 10px;
                        text-align: left;
                        text-indent: 1em;
                        ">
                          Team:
                    </div>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                          Close
                      </button>
                      <a href="" target="_blank" class="btn btn-primary" id="modal_link">View
                          Website</a>
                  </div>
              </div>
          </div>
      </div>
    </div>
  </div>

  </main>

  <!-- About Us Section -->
  <div class = "container px-3 mt-4">
    <!-- Divider -->
    <hr>
    <!-- Divider -->
    <div class = "row after-header px-3">
        <div class = "col-md-7">
            <h2 class = "title_heading text-center " id = "about"> About Us </h2>
            <p class = "title_description text-start mt-4" style = "font-size: 20px;"> At RevFlair Singapore, we want to bring people of similar skillsets together to participate in hackathons.
            We feel that a normal academic journey in Singapore stifles creativity, passion and growth, due to the risk of grades. Have you ever had a function
            or a creative idea, but is too afraid to use it in your class project? <br><br>
            Hackathons promote and encourage a risk-free way of building your very own ideas, while getting assistance and feedback from industry mentors.
            <br><br>
            Our team is still new and we are still in the midsts of collating more hackathons for you. So stay tuned!</p>
        </div>
        <div class="col-md-5 my-4 py-4">
            <img src="Images//laptop_background.jpg" width="100%" alt="Laptop_background">
        </div>
    </div>
    <!-- Divider -->
    <hr>
    <!-- Divider -->
    <div class = "row after-header pt-1">
        <div class = "row text-center">
            <p class = "title_heading my-4"> The Team </p>
            <div class = "col-lg-3 col-md-6">
                <img src="Images/Ming_Rong.jpg" width="160" height="160" style = "border-radius: 100%;" alt="Ming Rong">
                <h3 class="pt-2"> Kwek Ming Rong </h3>
            </div>

            <div class = "col-lg-3 col-md-6">
                <img src="Images/Xin_Yee.jpg" width="160" height="160" style = "border-radius: 50%;" alt="Xin Yee">
                <h3 class="pt-2"> How Xin Yee </h3>
            </div>
            <div class = "col-lg-3 col-md-6">
                <img src="Images/Kai_Wei.jpg" width="160" height="160" style = "border-radius: 50%;" alt="Kai Wei">
                <h3 class="pt-2"> Hoon Kai Wei </h3>
            </div>
            <div class = "col-lg-3 col-md-6">
                <img src="Images/Zhe_Hai.jpg" width="160" height="160" style = "border-radius: 50%;" alt="Zhe Hai">
                <h3 class="pt-2"> Xu Zhe Hai </h3>
            </div>
        </div>
        <div class = "row my-4"></div>
    </div>
  <hr>
  </div>

  <div class = 'container'>
    <div class = "row after-header">
      <div class="col-md-6 mx-4 my-4 py-4">
        <img src="./images/laptop2_background.jpg" width="90%" alt="Laptop_background">
      </div>
<<<<<<< HEAD
      <div class = "col-md-2 mx-3 px-3">
          <h1 class = "after-header text-start my-4 text-dark">
            Address
          </h1>
          <p class = "text-dark" style = 'font-size: 20px'>
          80 Stamford Road, <br> Singapore 178902
=======
      <div class = "col-md-2 mx-3 px-3 my-4 d-flex flex-column justify-content-end">
          <h1 class = "after-header text-start my-4 text-dark">
            Address
          </h1>
          <p class = "text-dark ps-1" style = 'font-size: 15px'>
          80 Stamford Road, <br> Singapore 178902
>>>>>>> 7b82ad4664658cd4d2e934ef61512981ca18c6ab
          <br>
          www.scis.edu.sg
          </p>
      </div>
<<<<<<< HEAD
      <div class = "col-md-2">
      <h1 class = "after-header text-start my-4 text-dark">
        Contact
      </h1>
      <p class = "text-dark" style = 'font-size: 20px'>
        Tel: 6808 7960 <br>
        Fax: 6808 7960
      </p>
=======
      <div class = "col-md-2 my-4 d-flex flex-column justify-content-end">
          <h1 class = "after-header text-start my-4 text-dark">
            Contact
          </h1>
          <p class = "text-dark ps-1" style = 'font-size: 15px'>
            Tel: 6808 7960 <br>
            Fax: 6808 7960
          </p>
>>>>>>> 7b82ad4664658cd4d2e934ef61512981ca18c6ab
      </div>
    </div>
  </div>

    <!-- Javascript Functions-->
    <script>

    // Modal
    var exampleModal = document.getElementById("exampleModal");
    exampleModal.addEventListener("show.bs.modal", function (event) {
    // Button that triggered the modal
    var button = event.relatedTarget;
    // Extract info from data-bs-* attributes
    var hackathonName = button.getAttribute("data-bs-hackathonName");
    var link = button.getAttribute("data-bs-link");
    var modalTitle = exampleModal.querySelector(".modal-title");
    var hackathon_telegram_id = 13;
    modalTitle.textContent = `${hackathonName}`;
    document.getElementById(`modal_description`).innerText = document.getElementById(`${hackathonName}_description`).innerText;
    document.getElementById(`modal_image`).src = document.getElementById(`${hackathonName}_image`).src;

    document.getElementById(`modal_link`).href = link;
    document.getElementById(`modal_link`).rel = "nofollow";

    document.getElementById(`modal_color_exp`).innerText = document.getElementById(`${hackathonName}_color_exp`).innerText;
    document.getElementById(`modal_color_type`).innerText = document.getElementById(`${hackathonName}_color_type`).innerText;
    document.getElementById(`modal_color_team`).innerText = document.getElementById(`${hackathonName}_color_team`).innerText;
    });

    </script>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-kQtW33rZJAHjgefvhyyzcGF3C5TFyBQBA13V1RKPf4uH+bwyzQxZ6CmMZHmNBEfJ" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.min.js" integrity="sha384-PsUw7Xwds7x08Ew3exXhqzbhuEYmA2xnwc8BuD6SEr+UmEHlX8/MCltYEodzWA4u" crossorigin="anonymous"></script>
    -->
  </body>
</html>
