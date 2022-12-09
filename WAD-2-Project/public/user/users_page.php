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
} elseif (!isset($_GET["id"])) {
    header("Location: ../home.php");
    exit;
} elseif ($_GET["id"] == $_SESSION["id"]) {
    header("Location: ./profile_page.php");
    exit;
}

$user_id = $_GET["id"];
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css"></link>
    <!-- Bootsrap icon CDN-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Custom Font -->
    <link rel="stylesheet" href="../assets/css/fonts.css"><link>
    <!-- Home Page Custom -->
    <link rel="stylesheet" href="../assets/css/home_page.css"><link>
    <!-- External Profile Page CSS -->
    <link rel="stylesheet" href="../assets/css/profile_page.css"><link>
    <!-- Using Vue.js CDN -->
    <!-- <script src="https://unpkg.com/vue@next"></script> -->
    <!-- Axios CDN -->
    <!-- <script src="https://unpkg.com/axios/dist/axios.min.js"></script> -->


    <!--------------------------------------------------------------- NOTE ------------------------------------------------------------------------------>
    <!---------------------- Design and codes referenced from https://www.bootdey.com/snippets/view/profile-about-info ---------------------------------->
    <!----------------------- I hereby declare I do not own any of the codes and it belongs rightfully to the owner ------------------------------------->
    <!--------------------------------------------------------------- NOTE ------------------------------------------------------------------------------>

    <title> About Me </title>
  </head>

  <body>
    <input id="target_user" type="hidden" value="<?=$user_id?>">
    <div id="app">
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
    <div id = "main-content">
        <div class="container">
        <div id="content" class="content">
            <div class="profile-header" style = 'border-radius:25px'>
                <div class="profile-header-cover"></div>

                <div class="profile-header-content">
                    <div class="profile-header-img">
                        <img v-if="users.image_name == null" src="../images/default_profile.jpg" alt="" id ='image_url' />
                        <img v-else :src="'../images/' + users.image_name" alt="" id ='image_url' />
                    </div>

                    <div class="profile-header-info">

                        <!-- To retrieve name of user -->
                        <h4 class="mt-sm"> {{ users.name }}</h4>


                        <a href="#" :class="{btn: true, 'btn-xs': true, 'mb-3': true, 'disabled': connectStatus == 'Pending'}" style = "background-color:#7395AE" @click="toggleConnect">{{ connectStatus }}</a>
                    </div>
                </div>

                <ul class="profile-header-tab nav nav-tabs mt-3">
                    <li class="nav-item"><a href="users_page.php?id=<?=$user_id?>" class="nav-link active show profile-link" style = "color:#7395AE" data-toggle="tab">ABOUT</a></li>
                    <li class="nav-item"><a href="users_friends.php?id=<?=$user_id?>" class="nav-link profile-link" data-toggle="tab">CONNECTIONS</a></li>
                </ul>
            </div>

            <div class="profile-container bg-white my-3" style="border-radius:25px;">
                <div class="row row-space-20">
                    <div class="col-md-8">
                        <div class="tab-content p-0">
                            <div class="tab-pane active show" id="profile-about">
                                <!-- Interests -->
                                <table class="table table-profile">
                                    <thead>
                                        <tr>
                                            <th colspan="2">INTERESTS </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="value">
                                                <div class="mb-3">
                                                    <span class="text-muted">
                                                        {{ users.interest }}
                                                    </span>
                                                    <br>
                                                </div>
                                                <br>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <!-- Portfolio -->
                                <div v-if="portfolios.length == 0" class="d-flex justify-content-center align-items-center mt-5">
                                    <span class="material-icons md-48 mb-3 text-muted">
                                        sentiment_dissatisfied
                                    </span>
                                    <p class="text-center text-muted">
                                        No portfolios write-ups yet...
                                        <br />
                                        <a href="profile_portfolio.php" id="add-portfolio-link" class="text-muted">Add a portfolio write-up here!</a>
                                    </p>
                                </div>
                                <table v-else class="table table-profile mt-3">
                                    <thead>
                                        <tr>
                                            <th colspan="2">PORTFOLIO </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="portfolio in portfolios">
                                            <td class="value rounded-3 bg-white">
                                                <b>{{ portfolio.title }}</b>
                                                <br>
                                                <span class="text-muted">{{ portfolio.summary }}</span>
                                                <br />
                                                <span>By {{ portfolio.authors.toString() }}</span>
                                                <br />
                                                <div class="mb-5" v-html="portfolio.doc"></div>
                                                <br>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 hidden-xs hidden-sm">
                        <ul class="profile-info-list">
                            <li class="title">PERSONAL INFORMATION</li>
                            <li>
                                <div class="field">School</div>
                                <!-- To retrieve school of user -->
                                <div class="value">{{ users.school }}</div>
                            </li>
                            <li>
                                <div class="field">Course Name</div>
                                <!-- To retrieve course of user -->
                                <div class="value">{{ users.course }}</div>
                            </li>
                            <li>
                                <div class="field">Year of Study</div>
                                <!-- To retrieve year_of_study of user -->
                                <div class="value"> {{ users.year_of_study }}</div>

                            </li>
                            <li>
                                <div class="field">Skills</div>
                                <!-- To retrieve skills of user from different table -->
                                <div class="value"><div class="value" v-for="skill in users.skills"> {{ skill }} </div></div>
                            </li>



                        </ul>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>

    <!-- Bootstrap  -->
    <script src="../assets/js/bootstrap.bundle.min.js"></script>

    <!-- Vue -->
    <script src="../assets/js/vue.global.js"></script>

    <!-- Axios -->
    <script src="../assets/js/axios.min.js"></script>

    <!-- Event Page Custom -->
    <script src="../assets/js/users_page.js"></script>

    </div>
  </body>
</html>
