<?php
// Includes all packages from Composer;
require_once "../../vendor/autoload.php";

// Includes all self-written code from src/ folder
require_once "../../src/common.php";

// use Firebase\JWT\JWT;

session_start();

if (!isset($_SESSION["id"])) {
    header("Location: ../index.php");
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
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css"></link>
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- External events_page.css -->
    <link rel="stylesheet" href="../assets/css/events_page.css"><link>
    <!-- Custom Font -->
    <link rel="stylesheet" href="../assets/css/fonts.css"><link>
    <!-- Home Page Custom -->
    <link rel="stylesheet" href="../assets/css/home_page.css"><link>
    <!-- Using Vue.js CDN -->
    <script src="../assets/js/vue.global.js"></script>
    <!-- Axios CDN -->
    <script src="../assets/js/axios.min.js"></script>
    
    <!------------------------------ NOTE --------------------------------------------------------->
    <!---------------------- Design and codes referenced from www.sandboxsg.com ------------------->
    <!-- I hereby declare I do not own any of the codes and it belongs rightfully to the owner ---->
    <!------------------------------ NOTE --------------------------------------------------------->

    <title>Hackathons</title>
  </head>

  <body id = "app">
    <nav class="navbar navbar-light bg-light fixed-top" id="top-nav">
      <div class="container-fluid d-inline">
          <div class="row justify-content-between">
              <div class="col-4 col-md-3 text-start d-flex align-items-center">
                  <a id="logo-wrapper" class="d-inline-block ms-3 me-4" href="../home.php">
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
                  <a id="notif-wrapper" class="d-inline-block me-3 ms-4 position-relative disabled" href="#">
                      <span id="notif-icons" class="material-icons md-light md-24 d-inline-block d-flex justify-content-center align-items-center">
                        notifications
                      </span>
                      <span v-if="notifications.length !== 0" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.5rem;">
                          {{ notifications.length > 99 ? "99+" : notifications.length }}
                          <span class="visually-hidden">unread notifications</span>
                      </span>
                  </a>
                  <div class="d-flex align-items-center position-relative">
                      <a id="profile-wrapper" class="d-inline-block me-3 ms-4" href="#" data-bs-toggle="dropdown">
                          <span id="profile" class="material-icons md-light md-24 d-inline-block d-flex justify-content-center align-items-center">account_circle</span>
                      </a>
                      <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuLink">
                          <li><a class="dropdown-item" href="../user/profile_page.php">Profile</a></li>
                          <li><a class="dropdown-item" href="../payment/payment.php">Payment</a></li>
                          <li><hr class="dropdown-divider"></li>
                          <li><a class="dropdown-item" href="../logout.php">Log Out</a></li>
                      </ul>
                  </div>
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
              <a class="nav-link side-icon" aria-current="page" href="../home.php">
                  <span class="material-icons md-24 d-inline-flex justify-content-center align-items-center menu-option" 
                      data-bs-toggle="tooltip" data-bs-placement="right" data-bs-template='<div class="tooltip" role="tooltip"><div class="tooltip-inner body-font"></div></div>' title="Home">
                      home
                  </span>
              </a>
          </li>
          <li class="nav-item">
              <a class="nav-link side-icon" aria-current="page" href="../match/matches.php">
                  <span class="material-icons md-24 d-inline-flex justify-content-center align-items-center menu-option" 
                      data-bs-toggle="tooltip" data-bs-placement="right" data-bs-template='<div class="tooltip" role="tooltip"><div class="tooltip-inner body-font"></div></div>' title="Matches">
                      person_add
                  </span>
              </a>
          </li>
          <li class="nav-item">
              <a class="nav-link side-icon" aria-current="page" href="../connection/connections.php">
                  <span class="material-icons md-24 d-inline-flex justify-content-center align-items-center menu-option" 
                      data-bs-toggle="tooltip" data-bs-placement="right" data-bs-template='<div class="tooltip" role="tooltip"><div class="tooltip-inner body-font"></div></div>' title="Connections">
                      person_search
                  </span>
              </a>
          </li>
          <li class="nav-item">
              <a class="nav-link active side-icon" aria-current="page" href="../event/events_page.php">
                  <span class="material-icons md-24 d-inline-flex justify-content-center align-items-center menu-option" 
                      data-bs-toggle="tooltip" data-bs-placement="right" data-bs-template='<div class="tooltip" role="tooltip"><div class="tooltip-inner body-font"></div></div>' title="Events">
                      emoji_events
                  </span>
              </a>
          </li>
          <li class="nav-item">
              <a class="nav-link side-icon" aria-current="page" href="../chat/chats.php">
                  <span class="material-icons md-24 d-inline-flex justify-content-center align-items-center menu-option" 
                      data-bs-toggle="tooltip" data-bs-placement="right" data-bs-template='<div class="tooltip" role="tooltip"><div class="tooltip-inner body-font"></div></div>' title="Chats">
                      forum
                  </span>
              </a>
          </li>
          <li class="nav-item">
              <a class="nav-link side-icon" aria-current="page" href="../group/groups.php">
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
              <a class="nav-link side-icon d-inline-block mx-3 my-2 d-inline-flex align-items-center" aria-current="page" href="../home.php">
                  <span class="material-icons md-24 d-inline-flex justify-content-center align-items-center pe-2">
                      home
                  </span>
                  <span class="d-inline-flex justify-content-center align-items-center body-font icon-label">
                      Home
                  </span>
              </a>
          </li>
          <li class="nav-item">
              <a class="nav-link side-icon d-inline-block mx-3 my-2 d-inline-flex align-items-center" aria-current="page" href="../match/matches.php">
                  <span class="material-icons md-24 d-inline-flex justify-content-center align-items-center pe-2">
                      person_add
                  </span>
                  <span class="d-inline-flex justify-content-center align-items-center body-font icon-label">
                      Matches
                  </span>
              </a>
          </li>
          <li class="nav-item">
              <a class="nav-link side-icon d-inline-block mx-3 my-2 d-inline-flex align-items-center" aria-current="page" href="../connection/connections.php">
                  <span class="material-icons md-24 d-inline-flex justify-content-center align-items-center pe-2">
                      person_search
                  </span>
                  <span class="d-inline-flex justify-content-center align-items-center body-font icon-label">
                      Connections
                  </span>
              </a>
          </li>
          <li class="nav-item">
              <a class="nav-link active side-icon d-inline-block mx-3 my-2 d-inline-flex align-items-center" aria-current="page" href="../event/events_page.php">
                  <span class="material-icons md-24 d-inline-flex justify-content-center align-items-center pe-2">
                      emoji_events
                  </span>
                  <span class="d-inline-flex justify-content-center align-items-center body-font icon-label">
                      Events
                  </span>
              </a>
          </li>
          <li class="nav-item">
              <a class="nav-link side-icon d-inline-block mx-3 my-2 d-inline-flex align-items-center" aria-current="page" href="../chat/chats.php">
                  <span class="material-icons md-24 d-inline-flex justify-content-center align-items-center pe-2">
                      forum
                  </span>
                  <span class="d-inline-flex justify-content-center align-items-center body-font icon-label">
                      Chats
                  </span>
              </a>
          </li>
          <li class="nav-item">
              <a class="nav-link side-icon d-inline-block mx-3 my-2 d-inline-flex align-items-center" aria-current="page" href="../group/groups.php">
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
          <a class="btn btn-primary body-font" id="mobile-top-btn-profile" href="../user/profile_page.php" role="button">Profile</a>
          <a class="btn btn-primary body-font" id="mobile-top-btn-logout" href="../logout.php" role="button">Logout</a>
      </div>
      <div class="ps-4 body-font fs-5">Components</div>
      <ul class="nav flex-column">
          <li class="nav-item">
              <a class="nav-link side-icon d-inline-block mx-3 my-2 d-inline-flex align-items-center" aria-current="page" href="../home.php">
                  <span class="material-icons md-24 d-inline-flex justify-content-center align-items-center pe-2">
                      home
                  </span>
                  <span class="d-inline-flex justify-content-center align-items-center body-font icon-label">
                      Home
                  </span>
              </a>
          </li>
          <li class="nav-item">
              <a class="nav-link side-icon d-inline-block mx-3 my-2 d-inline-flex align-items-center" aria-current="page" href="../match/matches.php">
                  <span class="material-icons md-24 d-inline-flex justify-content-center align-items-center pe-2">
                      person_add
                  </span>
                  <span class="d-inline-flex justify-content-center align-items-center body-font icon-label">
                      Matches
                  </span>
              </a>
          </li>
          <li class="nav-item">
              <a class="nav-link side-icon d-inline-block mx-3 my-2 d-inline-flex align-items-center" aria-current="page" href="../connection/connections.php">
                  <span class="material-icons md-24 d-inline-flex justify-content-center align-items-center pe-2">
                      person_search
                  </span>
                  <span class="d-inline-flex justify-content-center align-items-center body-font icon-label">
                      Connections
                  </span>
              </a>
          </li>
          <li class="nav-item">
              <a class="nav-link active side-icon d-inline-block mx-3 my-2 d-inline-flex align-items-center" aria-current="page" href="../event/events_page.php">
                  <span class="material-icons md-24 d-inline-flex justify-content-center align-items-center pe-2">
                      emoji_events
                  </span>
                  <span class="d-inline-flex justify-content-center align-items-center body-font icon-label">
                      Events
                  </span>
              </a>
          </li>
          <li class="nav-item">
              <a class="nav-link side-icon d-inline-block mx-3 my-2 d-inline-flex align-items-center" aria-current="page" href="../chat/chats.php">
                  <span class="material-icons md-24 d-inline-flex justify-content-center align-items-center pe-2">
                      forum
                  </span>
                  <span class="d-inline-flex justify-content-center align-items-center body-font icon-label">
                      Chats
                  </span>
              </a>
          </li>
          <li class="nav-item">
              <a class="nav-link side-icon d-inline-block mx-3 my-2 d-inline-flex align-items-center" aria-current="page" href="../group/groups.php">
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
  <div id = "main-content" class="mb-5"> 


    <div class = "container px-3 py-3">
      <!-- divider -->
      <h1 class = "title_heading text-center" id="hackathonlist"> The Hackathon List </h1>
      <div class = "title_description text-center"> Last Updated: 30-10-2021 </div>
      
      <!-- Search -->
    <div class='container-fluid p-3 rounded-3' id="search-bar-container">
        <form class="form-inline my-2 my-lg-0">
            <div class="input-group mx-auto">
                <input class="form-control py-2 border-right-0 border" type="search" placeholder="Search for hackathons" id="keyword-search-input" @keyup="searchKeyword()">
                <button class="btn btn-outline-secondary my-3 my-sm-0 d-flex justify-content-center align-items-center" type="button" id="event-search-btn"><span class="material-icons md-24">search</span></button>
            </div>
        </form>
    </div>

        <!-- Event List -->
        <div v-if="competitions.length != 0" id = "poggers" class="mt-3">
            <div v-if="competitions.length !== 0">
                <div v-if="competitionsLength > 1" class="d-flex justify-content-center align-items-center">
                    <nav class="d-flex justify-content-center align-items-center" aria-label="Page navigation example">
                        <ul class="pagination my-3 pagination-colors">
                            <li v-if="competitionsPage == 1" class="page-item"><a class="page-link text-muted disabled" href="#">Previous</a></li>
                            <li v-else class="page-item"><a class="page-link" href="#" @click="updateCompetitions(competitionsPage - 1)">Previous</a></li>
                            <li v-for="num in competitionsLength" v-if="competitionsLength <= 21" :class="{ 'active': competitionsPage == num, 'text-muted': num == '...', 'disabled': num == '...', 'page-item': true }"><a class="page-link" href="#" @click="updateCompetitions(num)">{{ num }}</a></li>
                            <li v-for="num in getTruncPaginate(competitionsLength, competitionsPage)" v-else :class="{ 'active': competitionsPage == num, 'text-muted': num == '...', 'disabled': num == '...', 'page-item': true }"><a class="page-link" href="#" @click="updateCompetitions(num)">{{ num }}</a></li>
                            <li v-if="competitionsPage == competitionsLength" class="page-item"><a class="page-link text-muted disabled" href="#">Next</a></li>
                            <li v-else class="page-item"><a class="page-link" href="#" @click="updateCompetitions(competitionsPage + 1)">Next</a></li>
                        </ul>
                    </nav>
                </div>
            <div class = "row row-cols-sm-1 row-cols-md-2 row-cols-lg-3 g-4">

            <!-- Competitions -->
            <card v-for = "comp in competitions" 
                v-bind:title = "comp.name"
                v-bind:header = "comp.company"
                v-bind:description = "comp.description"
                v-bind:difficulty = "comp.difficulty"
                v-bind:type = "comp.type"
                v-bind:team = "comp.team"
                v-bind:status = "getStatus(comp.date_start, comp.date_end)"
                v-bind:link = "comp.url"
                v-bind:image = "comp.image_name"
                v-bind:register_by = "getDate(comp.date_register)"
                v-bind:start_by = "getDate(comp.date_start, true)"
                v-bind:submit_by = "getDate(comp.date_end)"
                v-bind:id = "comp.id"
            >
            </card>

            <!-- Modal -->
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

                        <div class="mb-3 text-white" id="modal_color_exp" title="Experience" style="
                            background-color: #7395AE;
                            border-radius: 10px;
                            text-align: left;
                            text-indent: 1em;
                            ">
                            Difficulty:
                        </div>
                        <div class="mb-3 text-white" id="modal_color_type" title="Type" style="
                            background-color: #557A95;
                            border-radius: 10px;
                            text-align: left;
                            text-indent: 1em;
                            ">
                            Type: 
                        </div>
                        <div class="mb-3 text-white" id="modal_color_team" title="Number of Team Members" style="
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
                        <button type="button" id="join-comp-btn" class="btn text-white" style="background-color:#379683" @click="joinCompetition" comp-id="" data-bs-dismiss="modal">
                            Marked as Joined
                        </button>
                        <a href="" target="_blank" class="btn text-white" style="background-color:#7395AE" id="modal_link">View
                            Website</a>
                    </div>
                </div>
            </div>
        </div>
        </div>
        </div>
      <div v-else class="d-flex flex-column justify-content-center align-items-center my-3">
        <span class="material-icons md-48 mb-3 text-muted">
            sentiment_dissatisfied
        </span>
        <p class="text-center text-muted">
            No upcoming competitions yet...
        </p>
      </div>
    </div>
  </div>
  </div>

</div>

<div class="toast-container position-fixed bottom-0 end-0 p-3" id="inform-user"></div>

    <!-- Bootstrap  -->
    <script src="../assets/js/bootstrap.bundle.min.js"></script>

    <!-- Vue -->
    <!--<script src="../assets/js/vue.global.js"></script>-->
    
    <!-- Axios -->
    <!-- <script src="../assets/js/axios.min.js"></script> -->
    
    <!-- Event Page Custom -->
    <script src="../assets/js/events_page.js"></script>

  </body>
</html>