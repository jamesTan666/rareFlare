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
        <!-- External events_page.css -->
        <link rel="stylesheet" href="assets/css/events_page.css"><link>
        <!-- Custom Font -->
        <link rel="stylesheet" href="assets/css/fonts.css"><link>
        <!-- Home Page Custom -->
        <link rel="stylesheet" href="assets/css/home_page.css"><link>
        <!-- Brainstorm CSS -->
        <link rel="stylesheet" href="assets/css/brainstorm.css"><link>
        <!-- Using Vue.js CDN -->
        <script src="assets/js/vue.global.js"></script>
        <!-- Axios CDN -->
        <script src="assets/js/axios.min.js"></script>
        
        <!--Load the OrbiterMicro JavaScript library (non-minified version). Use during development.-->
        <script type="text/javascript" src="assets/js/OrbiterMicro_2.1.2.21_Release_min.js"></script>
        <!--Load the OrbiterMicro JavaScript library (minified version). Use for production.-->
        <!--<script type="text/javascript" src="http://cdn.unioncloud.io/OrbiterMicro_latest_min.js"></script>-->
        
        <!------------------------------ NOTE --------------------------------------------------------->
        <!---------------------- Design and codes referenced from www.sandboxsg.com ------------------->
        <!-- I hereby declare I do not own any of the codes and it belongs rightfully to the owner ---->
        <!------------------------------ NOTE --------------------------------------------------------->

        <title>Brainstorm</title>
    </head>

    <body id="app">
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
                <a class="nav-link side-icon" aria-current="page" href="../event/events_page.php">
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
                <a class="nav-link active side-icon" aria-current="page" href="../group/groups.php">
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
                <a class="nav-link side-icon d-inline-block mx-3 my-2 d-inline-flex align-items-center" aria-current="page" href="../event/events_page.php">
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
                <a class="nav-link active side-icon d-inline-block mx-3 my-2 d-inline-flex align-items-center" aria-current="page" href="../group/groups.php">
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
                <a class="nav-link side-icon d-inline-block mx-3 my-2 d-inline-flex align-items-center" aria-current="page" href="../event/events_page.php">
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
                <a class="nav-link active side-icon d-inline-block mx-3 my-2 d-inline-flex align-items-center" aria-current="page" href="../group/groups.php">
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
        <h1 class = "title_heading text-center" id="whiteboard"> Collaborative Whiteboard </h1>
        <h4 class = "text-center" id="brainstorm"> Brainstorm with Your Team </h4>
    </div>
    

    <!--Drop down menus for selecting line thickness and color-->
    <!-- <div class="container px-3 py-3"> -->
        <div class="controls">
            Size:
            <select id="thickness" class="fixed">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="10">10</option>
            <option value="20">20</option>
            </select>
        
            Color:
            <select id="color">
            <option value="#FFFFFF">#FFFFFF</option>
            <option value="#AAAAAA">#AAAAAA</option>
            <option value="#666666">#666666</option>
            <option value="#000000">#000000</option>
            <option value="#9BA16C">#9BA16C</option>
            <option value="#CC8F2B">#CC8F2B</option>
            <option value="#63631D">#63631D</option>
            </select>
        </div>
    <!-- </div> -->

  <!--The canvas where drawings will be displayed-->
<div id="status"></div>
<div class="dcanvas">                                                                                                                                              
        <canvas id="canvas"></canvas>
  <!--A status text field, for displaying connection information-->
</div>


<hr>
    <div id="app" class = "container mb-3 py-3">
        <h1 class = "title_heading text-center" id="ideation"> Ideation Board </h1>
        <h4 class = "text-center" id="brainstorm"> Note your team's to-dos </h4>
            <!-- idea text -->
            <div class="mb-3">
                <label for="desc" class="form-label">Ideation</label>
                <div class="input-group">
                    <input type="text" class="form-control" id="desc" v-model='desc' placeholder="Input your idea here">
                    <!-- Add button -->
                    <button type="button" @click="add" class="btn btn-primary" style="background-color: #379683!important; border-color: #379683!important;">Add New Idea</button>
                </div>
            </div>

            <!-- our component -->
            <idea-tracker 
                v-for='(idea, idx) in ideaList' 
                v-bind:key='idx' 
                v-bind:task='idea' 
                v-bind:idx='idx'
                v-on:delete='deleteTask'
            ></idea-tracker>
    </div>
</div>

    <!-- Bootstrap  -->
    <script src="assets/js/bootstrap.bundle.min.js"></script>

    <!-- Vue -->
    <!-- <script src="assets/js/vue.global.js"></script> -->
    
    <!-- Axios -->
    <!-- <script src="assets/js/axios.min.js"></script> -->
    
    <!-- Page Custom -->
    <script src="assets/js/brainstorm.js"></script>
    <script src="assets/js/brainstorm2.js"></script>

    </body>
</html>