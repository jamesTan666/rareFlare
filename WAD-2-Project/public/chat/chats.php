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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css"></link>
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Custom Font -->
    <link rel="stylesheet" href="../assets/css/fonts.css"><link>
    <!-- Custom -->
    <link rel="stylesheet" href="../assets/css/chat.css">
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
                <a class="nav-link active side-icon" aria-current="page" href="../chat/chats.php">
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
                <a class="nav-link active side-icon d-inline-block mx-3 my-2 d-inline-flex align-items-center" aria-current="page" href="../chat/chats.php">
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
                <a class="nav-link active side-icon d-inline-block mx-3 my-2 d-inline-flex align-items-center" aria-current="page" href="../chat/chats.php">
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

    <div id="main-content">
        <div class="container-fluid main-content-card" id="chat-border">
            <div class="row" id="chat-container">
                <div class="col-4 d-flex flex-column align-items-center p-4" id="chat-menu-col">
                    <div class="container-fluid d-flex justify-content-center align-items-center pb-3">
                        <form class="d-flex">
                            <input class="form-control me-2 body-font" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-primary body-font chat-btn" type="submit">Search</button>
                        </form>
                    </div>
                    <div class="container-fluid pb-3">
                        <div class="row justify-content-between">
                            <div class="col">
                                <button class="btn btn-outline-primary chat-btn chat-search-btn body-font" type="submit" data-bs-toggle="tooltip" data-bs-placement="right" title="Add New Chat">
                                    <span class="d-flex justify-content-center align-items-center">Add Chat<span class="material-icons md-24 m-0">add</span></span>
                                </button>
                            </div>
                            <!-- <div class="col">
                                <button class="btn btn-outline-primary chat-search-btn body-font" type="submit">2</button>
                            </div> -->
                        </div>
                    </div>
                    <div class="container-fluid pb-3" id="chat-gutter">
                        <div class="side-chat-card active d-flex justify-content-between align-items-center p-2 mb-2">
                            <div class="d-flex justify-content-start align-items-center">
                                <div class="side-chat-card-img d-flex justify-content-center align-items-center me-3">
                                    <span class="material-icons md-24 d-inline-block d-flex justify-content-center align-items-center d-inline-block">account_circle</span>
                                </div>
                                <div class="side-chat-card-body">
                                    <p class="chat-card-title fw-bold mb-2">
                                        Card Title
                                    </p>
                                    <p class="chat-card-desc m-0" id="test1">
                                        Card Title
                                    </p>
                                </div>
                            </div>
                            <div class="side-chat-card-time d-flex align-items-start" id="test2">
                                1:34 PM
                            </div>
                        </div>
                        <div class="side-chat-card d-flex justify-content-between align-items-center p-2 mb-2">
                            <div class="d-flex justify-content-start align-items-center">
                                <div class="side-chat-card-img d-flex justify-content-center align-items-center me-3">
                                    <span class="material-icons md-24 d-inline-block d-flex justify-content-center align-items-center d-inline-block">account_circle</span>
                                </div>
                                <div class="side-chat-card-body">
                                    <p class="chat-card-title fw-bold mb-2">
                                        Ming Rong
                                    </p>
                                    <p class="chat-card-desc m-0">
                                        Sure!!
                                    </p>
                                </div>
                            </div>
                            <div class="side-chat-card-time d-flex align-items-start">
                                9:03 AM
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-8 d-flex flex-column justify-content-between" id="chat-col">
                    <div id="chat-header" class="container-fluid d-flex align-items-center bg-white justify-self-start">
                        <div class="d-flex align-items-center my-3">
                            <div class="d-flex justify-content-center align-items-center me-3" id="chat-header-img">
                                <span class="material-icons md-24 d-inline-block d-flex justify-content-center align-items-center d-inline-block">account_circle</span>
                            </div>
                            <h3 class="mb-0">Xin Yee</h3>
                        </div>
                        <!-- <div class="d-flex align-items-center position-relative">
                            <a id="profile-wrapper" class="d-inline-block me-3 ms-4" href="#" data-bs-toggle="dropdown">
                                <span id="profile" class="material-icons md-light md-24 d-inline-block d-flex justify-content-center align-items-center">account_circle</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuLink">
                                <li><a class="dropdown-item" href="../user/profile_page.php"><span>Delete Messages<span></a></li>
                                <li><a class="dropdown-item" href="../payment/payment.php">Delete Chat</a></li>
                            </ul>
                        </div> -->
                    </div>
                    <div id="chat-body" class="container-fluid d-flex flex-column p-3 ">
                        <div class="sender align-self-end py-2 px-3 mb-2 rounded-3 d-flex flex-column">
                            <p class="chat-msg mb-2">Hi</p>
                            <span class="chat-time align-self-end fst-italic">12:30 PM</span>
                        </div>
                        <div class="receiver align-self-start py-2 px-3 mb-2 rounded-3 d-flex flex-column">
                            <p class="chat-msg mb-2">Hi!</p>
                            <span class="chat-time align-self-end fst-italic">1:34 PM</span>
                        </div>
                    </div>
                    <div id="chat-footer" class="container-fluid d-flex py-2 px-0 align-items-center bg-white justify-self-end">
                        <div class="d-flex input-group">
                            <textarea class="form-control me-2 body-font chat-input-bar" placeholder="Enter your message here ..." v-model="currChat" aria-label="Chat Input"></textarea>
                            <button class="btn btn-outline-light d-inline-flex align-items-center search-bar-btn" type="submit" @click="sendMessage"><span class="material-icons md-24">send</span></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<!-- Bootstrap -->
<script src="../assets/js/bootstrap.bundle.min.js"></script>
<!-- Vue -->
<script src="../assets/js/vue.global.js"></script>
<!-- Axios -->
<script src="../assets/js/axios.min.js"></script>
<!-- Custom -->
<script src="../assets/js/chat.js"></script>
</html>