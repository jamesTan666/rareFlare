<?php
// Includes all packages from Composer;
require_once "../vendor/autoload.php";

// Includes all self-written code from src/ folder
require_once "../src/common.php";

// use Firebase\JWT\JWT;

session_start();

if (!isset($_SESSION["id"])) {
    header("Location: index.php");
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
    <!-- Custom Font -->
    <link rel="stylesheet" href="assets/css/fonts.css"><link>
    <!-- Home Page Custom -->
    <link rel="stylesheet" href="assets/css/home_page.css"><link>
    <!-- Using Vue.js CDN -->
    <script src="assets/js/vue.global.js"></script>
    <!-- Axios CDN -->
    <script src="assets/js/axios.min.js"></script>
    
    <!------------------------------ NOTE --------------------------------------------------------->
    <!---------------------- Design and codes referenced from www.sandboxsg.com ------------------->
    <!-- I hereby declare I do not own any of the codes and it belongs rightfully to the owner ---->
    <!------------------------------ NOTE --------------------------------------------------------->

    <title>Connections</title>
  </head>

  <body id = "app">
    <nav class="navbar navbar-light bg-light fixed-top" id="top-nav">
      <div class="container-fluid d-inline">
          <div class="row justify-content-between">
              <div class="col-4 col-md-3 text-start d-flex align-items-center">
                  <a id="logo-wrapper" class="d-inline-block ms-3 me-4" href="#">
                      <span id="logo" class="material-icons md-light md-24 d-inline-block d-flex justify-content-center align-items-center">logo_dev</span>
                  </a>
                  <a id="menu-icon-wrapper" class="d-inline-block ms-3 me-4" href="#" @click="toggleNav()">
                      <span id="menu-icon" class="material-icons md-light md-inactive md-24 d-inline-block d-flex justify-content-center align-items-center">widgets</span>
                  </a>
                  <a id="mobile-menu-icon-wrapper" class="d-inline-block ms-3 me-4" href="#" @click="toggleNavMobile()">
                      <span id="mobile-menu-icon" class="material-icons md-inactive md-24 d-inline-block d-flex justify-content-center align-items-center">menu</span>
                  </a>
              </div>
              <div id="top-nav-search" class="col-md-3">
                  <form class="d-flex">
                      <input class="form-control me-2 body-font search-bar" type="search" placeholder="Enter your search here ..." aria-label="Search">
                      <button class="btn btn-outline-light d-inline-flex align-items-center search-bar-btn" type="submit"><span class="material-icons md-24">search</span></button>
                  </form>
              </div>
              <div class="col-4 col-md-3 text-end d-flex align-items-center justify-content-end">
                  <a id="notif-wrapper" class="d-inline-block me-3 ms-4" href="#">
                      <span id="notif-icons" class="material-icons md-light md-24 d-inline-block d-flex justify-content-center align-items-center">notifications</span>
                  </a>
                  <a id="profile-wrapper" class="d-inline-block me-3 ms-4" href="#">
                      <span id="profile" class="material-icons md-light md-24 d-inline-block d-flex justify-content-center align-items-center">account_circle</span>
                  </a>
                  <a id="mobile-search-wrapper" class="d-inline-block me-3 ms-4" href="#" @click="mobileSearch()">
                      <span id="mobile-search" class="material-icons md-light md-24 d-inline-block d-flex justify-content-center align-items-center">{{mobileSearchIcon}}</span>
                  </a>
              </div>
          </div>
      </div>
      <div id="mobile-search-bar" class="container-fluid py-3">
          <div class="col-12">
              <form class="d-flex">
                  <input class="form-control me-2 body-font search-bar" type="search" placeholder="Enter your search here ..." aria-label="Search">
                  <button class="btn btn-outline-light d-inline-flex align-items-center search-bar-btn" type="submit"><span class="material-icons md-24">search</span></button>
              </form>
          </div>
      </div>
  </nav>

  <div id="side-nav-short" class="closed">
      <ul class="nav flex-column">
          <li class="nav-item">
              <a class="nav-link side-icon" aria-current="page" href="./home.php">
                  <span class="material-icons md-24 d-inline-flex justify-content-center align-items-center menu-option" 
                      data-bs-toggle="tooltip" data-bs-placement="right" data-bs-template='<div class="tooltip" role="tooltip"><div class="tooltip-inner body-font"></div></div>' title="Home">
                      home
                  </span>
              </a>
          </li>
          <li class="nav-item">
              <a class="nav-link side-icon" aria-current="page" href="./matches.php">
                  <span class="material-icons md-24 d-inline-flex justify-content-center align-items-center menu-option" 
                      data-bs-toggle="tooltip" data-bs-placement="right" data-bs-template='<div class="tooltip" role="tooltip"><div class="tooltip-inner body-font"></div></div>' title="Matches">
                      person_add
                  </span>
              </a>
          </li>
          <li class="nav-item">
              <a class="nav-link side-icon" aria-current="page" href="./connections.php">
                  <span class="material-icons md-24 d-inline-flex justify-content-center align-items-center menu-option" 
                      data-bs-toggle="tooltip" data-bs-placement="right" data-bs-template='<div class="tooltip" role="tooltip"><div class="tooltip-inner body-font"></div></div>' title="Connections">
                      person_search
                  </span>
              </a>
          </li>
          <li class="nav-item">
              <a class="nav-link active side-icon" aria-current="page" href="./events_page.php">
                  <span class="material-icons md-24 d-inline-flex justify-content-center align-items-center menu-option" 
                      data-bs-toggle="tooltip" data-bs-placement="right" data-bs-template='<div class="tooltip" role="tooltip"><div class="tooltip-inner body-font"></div></div>' title="Events">
                      emoji_events
                  </span>
              </a>
          </li>
          <li class="nav-item">
              <a class="nav-link side-icon" aria-current="page" href="./chats.php">
                  <span class="material-icons md-24 d-inline-flex justify-content-center align-items-center menu-option" 
                      data-bs-toggle="tooltip" data-bs-placement="right" data-bs-template='<div class="tooltip" role="tooltip"><div class="tooltip-inner body-font"></div></div>' title="Chats">
                      forum
                  </span>
              </a>
          </li>
          <li class="nav-item">
              <a class="nav-link side-icon" aria-current="page" href="./groups.php">
                  <span class="material-icons md-24 d-inline-flex justify-content-center align-items-center menu-option" 
                      data-bs-toggle="tooltip" data-bs-placement="right" data-bs-template='<div class="tooltip" role="tooltip"><div class="tooltip-inner body-font"></div></div>' title="Groups">
                      groups
                  </span>
              </a>
          </li>
      </ul>
  </div>

  <div id="side-nav" class="opened">
      <ul class="nav flex-column">
          <li class="nav-item">
              <a class="nav-link side-icon d-inline-block mx-3 my-2 d-inline-flex align-items-center" aria-current="page" href="./home.php">
                  <span class="material-icons md-24 d-inline-flex justify-content-center align-items-center pe-2">
                      home
                  </span>
                  <span class="d-inline-flex justify-content-center align-items-center body-font icon-label">
                      Home
                  </span>
              </a>
          </li>
          <li class="nav-item">
              <a class="nav-link side-icon d-inline-block mx-3 my-2 d-inline-flex align-items-center" aria-current="page" href="./matches.php">
                  <span class="material-icons md-24 d-inline-flex justify-content-center align-items-center pe-2">
                      person_add
                  </span>
                  <span class="d-inline-flex justify-content-center align-items-center body-font icon-label">
                      Matches
                  </span>
              </a>
          </li>
          <li class="nav-item">
              <a class="nav-link active side-icon d-inline-block mx-3 my-2 d-inline-flex align-items-center" aria-current="page" href="./connections.php">
                  <span class="material-icons md-24 d-inline-flex justify-content-center align-items-center pe-2">
                      person_search
                  </span>
                  <span class="d-inline-flex justify-content-center align-items-center body-font icon-label">
                      Connections
                  </span>
              </a>
          </li>
          <li class="nav-item">
              <a class="nav-link side-icon d-inline-block mx-3 my-2 d-inline-flex align-items-center" aria-current="page" href="./events_page.php">
                  <span class="material-icons md-24 d-inline-flex justify-content-center align-items-center pe-2">
                      emoji_events
                  </span>
                  <span class="d-inline-flex justify-content-center align-items-center body-font icon-label">
                      Events
                  </span>
              </a>
          </li>
          <li class="nav-item">
              <a class="nav-link side-icon d-inline-block mx-3 my-2 d-inline-flex align-items-center" aria-current="page" href="./chats.php">
                  <span class="material-icons md-24 d-inline-flex justify-content-center align-items-center pe-2">
                      forum
                  </span>
                  <span class="d-inline-flex justify-content-center align-items-center body-font icon-label">
                      Chats
                  </span>
              </a>
          </li>
          <li class="nav-item">
              <a class="nav-link side-icon d-inline-block mx-3 my-2 d-inline-flex align-items-center" aria-current="page" href="./groups.php">
                  <span class="material-icons md-24 d-inline-flex justify-content-center align-items-center pe-2">
                      groups
                  </span>
                  <span class="d-inline-flex justify-content-center align-items-center body-font icon-label">
                      Groups
                  </span>
              </a>
          </li>
      </ul>
  </div>

  <div id="side-nav-mobile">
      <div id="side-nav-mobile-top" class="d-flex flex-column justify-content-evenly align-items-center">
          <button type="button" class="btn-close btn-close-white align-self-end" aria-label="Close" @click="toggleNavMobile()"></button>
          <a class="btn btn-primary body-font" id="mobile-top-btn-profile" href="#" role="button">Profile</a>
          <a class="btn btn-primary body-font" id="mobile-top-btn-logout" href="#" role="button">Logout</a>
      </div>
      <div class="ps-4 body-font fs-5">Components</div>
      <ul class="nav flex-column">
          <li class="nav-item">
              <a class="nav-link side-icon d-inline-block mx-3 my-2 d-inline-flex align-items-center" aria-current="page" href="./home.php">
                  <span class="material-icons md-24 d-inline-flex justify-content-center align-items-center pe-2">
                      home
                  </span>
                  <span class="d-inline-flex justify-content-center align-items-center body-font icon-label">
                      Home
                  </span>
              </a>
          </li>
          <li class="nav-item">
              <a class="nav-link side-icon d-inline-block mx-3 my-2 d-inline-flex align-items-center" aria-current="page" href="./matches.php">
                  <span class="material-icons md-24 d-inline-flex justify-content-center align-items-center pe-2">
                      person_add
                  </span>
                  <span class="d-inline-flex justify-content-center align-items-center body-font icon-label">
                      Matches
                  </span>
              </a>
          </li>
          <li class="nav-item">
              <a class="nav-link active side-icon d-inline-block mx-3 my-2 d-inline-flex align-items-center" aria-current="page" href="./connections.php">
                  <span class="material-icons md-24 d-inline-flex justify-content-center align-items-center pe-2">
                      person_search
                  </span>
                  <span class="d-inline-flex justify-content-center align-items-center body-font icon-label">
                      Connections
                  </span>
              </a>
          </li>
          <li class="nav-item">
              <a class="nav-link side-icon d-inline-block mx-3 my-2 d-inline-flex align-items-center" aria-current="page" href="./events_page.php">
                  <span class="material-icons md-24 d-inline-flex justify-content-center align-items-center pe-2">
                      emoji_events
                  </span>
                  <span class="d-inline-flex justify-content-center align-items-center body-font icon-label">
                      Events
                  </span>
              </a>
          </li>
          <li class="nav-item">
              <a class="nav-link side-icon d-inline-block mx-3 my-2 d-inline-flex align-items-center" aria-current="page" href="./chats.php">
                  <span class="material-icons md-24 d-inline-flex justify-content-center align-items-center pe-2">
                      forum
                  </span>
                  <span class="d-inline-flex justify-content-center align-items-center body-font icon-label">
                      Chats
                  </span>
              </a>
          </li>
          <li class="nav-item">
              <a class="nav-link side-icon d-inline-block mx-3 my-2 d-inline-flex align-items-center" aria-current="page" href="./groups.php">
                  <span class="material-icons md-24 d-inline-flex justify-content-center align-items-center pe-2">
                      groups
                  </span>
                  <span class="d-inline-flex justify-content-center align-items-center body-font icon-label">
                      Groups
                  </span>
              </a>
          </li>
      </ul>
  </div>

  <div id="mobile-modal-bg"></div>

  <!-- Main Content -->
  <div id = "main-content"> 


    <div class = "container px-3 py-3">
      <!-- divider -->
      <h1 class = "title_heading text-center" id="connection_list"> Connections </h1>
      <div class = "title_description text-center"> Last Updated: <span id='date-time'></span></div>
      
      <!-- Search -->
      <div class="input-group mb-3 mx-auto">
        <input class="form-control py-2 border-right-0 border" type="search" placeholder="Search by skills" id="skills-search-input" onClick="searchSkills()">
      </div>

        <!-- People List -->
        <div id = "skills" v-for="user in users" :key="user.skill">
          <div class = "row row-cols-sm-1 row-cols-md-2 row-cols-lg-3 g-4">
            <div class="col px-3 hackathon-card" style="display: block;">
              <div class="card h-100">
                <div class="row g-0 mx-3">
                  <div class="mx-auto text-center" style="height:200px;">
                    <img id="user_image" src="v-bind:href=./Images/user.picture" alt="User Image" style="height: 100%; width: 100%; object-fit: contain">
                    </div>

                  <div class="card-body" id = "skills" v-for="user in users" :key="user.skill">
                      <h5 class="card-title"> {{user.name}} </h5>
                      <ul class="profile-info-list">
                            <li class="title">User Information</li>
                            <li>
                                <div class="field">School</div>
                                <!-- To retrieve school of user -->
                                <div class="value">{{ user.school }}</div>
                            </li>
                            <li>
                                <div class="field">Course Name</div>
                                <!-- To retrieve course of user -->
                                <div class="value">{{ user.course }}</div>
                            </li>
                            <li>
                                <div class="field">Year of Study</div>
                                <!-- To retrieve year_of_study of user -->
                                <div class="value"> {{ user.year_of_study }}</div>
            
                            </li>
                            <li>
                                <div class="field">Course Information</div>
                                <!-- To retrieve date_start of user -->
                                <div class="value">Date Start: {{ user.date_start }}</div>
                                <!-- To retrieve date_end of user -->
                                <div class="value">Date End: {{ user.date_end }} </div>
        
                            </li>
                            <li>
                                <div class="field">Skills</div>
                                <!-- To retrieve skills of user from different table -->
                                <div class="value"><div class="value"> {{ user.skill }} </div></div>
                            </li>
                            
                            
                            
                        </ul>
                    </div>
                    <button type="button" class="btn btn-primary" id="inviteuser" onclick="inviteUser();">Invite to your team</button>
                  </div>
                </div>
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>
  </div>
    

  
    
    <!-- Javascript Function -->
    <script>

      //get current date/time
      var datetime = new Date();
      document.getElementById("date-time").innerHTML=datetime;

      // Modal
      var exampleModal = document.getElementById("exampleModal");
      exampleModal.addEventListener("show.bs.modal", function (event) {
      // Button that triggered the modal
      var button = event.relatedTarget;
    });


    //Vue.js codes
        const app = Vue.createApp({
            el: "skills",
            data() {
                return {
                    users: []
                };
            },
            created() {
                
                let url = './api/user.php';
                
                // Use Axios
                axios.get(url)
                .then((response) => {
                    this.users = response.data.data;
                    
                })
                .catch((error) => {
                    this.users = {
                        entry : 'There was an error: '
                    };
                });
            },
            methods: {
                searchSkills: function() {
                    let url2 = "./api/connection.php";

                    axios.get(url2, {
                        skills:skills-search-input
                        .then((response) => {
                            this.skills = response.data.data;
                    
                })
            })
        }).mount("#main-content");

        const app = Vue.createApp({
            data() {
                return {
                    users: []
                };
            },
            methods: {
                inviteUser: function() {
                let url = './api/addMember.php';
                
                // Use Axios
                axios.get(url)
                .then((response) => {
                    this.users = response.data.data;
                    
                })
                .catch((error) => {
                    this.users = {
                        entry : 'There was an error: '
                    };
                });
            }
        }).mount("#main-content");
    </script>


    <!-- Bootstrap  -->
    <script src="assets/js/bootstrap.bundle.min.js"></script>

    <!-- Vue -->
    <!--<script src="assets/js/vue.global.js"></script>-->
    
    <!-- Axios -->
    <script src="assets/js/axios.min.js"></script>
    
    <!-- Home Page Custom -->
    <script src="assets/js/home_page.js"></script>

  </body>
</html>