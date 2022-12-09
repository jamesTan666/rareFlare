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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css"></link>
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Custom Font -->
    <link rel="stylesheet" href="assets/css/fonts.css"><link>
    <!-- Home Page Custom -->
    <link rel="stylesheet" href="assets/css/home_page.css"><link>
</head>
<body id="app">
    <nav class="navbar navbar-light bg-light fixed-top" id="top-nav">
        <div class="container-fluid d-inline">
            <div class="row justify-content-between">
                <div class="col-4 col-md-3 text-start d-flex align-items-center">
                    <a id="logo-wrapper" class="d-inline-block ms-3 me-4" href="home.php">
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
                            <li><a class="dropdown-item" href="user/profile_page.php">Profile</a></li>
<li><a class="dropdown-item" href="payment/payment.php">Payment</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="logout.php">Log Out</a></li>
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
                <a class="nav-link active side-icon" aria-current="page" href="./home.php">
                    <span class="material-icons md-24 d-inline-flex justify-content-center align-items-center menu-option"
                        data-bs-toggle="tooltip" data-bs-placement="right" data-bs-template='<div class="tooltip" role="tooltip"><div class="tooltip-inner body-font"></div></div>' title="Home">
                        home
                    </span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link side-icon" aria-current="page" href="./match/matches.php">
                    <span class="material-icons md-24 d-inline-flex justify-content-center align-items-center menu-option"
                        data-bs-toggle="tooltip" data-bs-placement="right" data-bs-template='<div class="tooltip" role="tooltip"><div class="tooltip-inner body-font"></div></div>' title="Matches">
                        person_add
                    </span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link side-icon" aria-current="page" href="./connection/connections.php">
                    <span class="material-icons md-24 d-inline-flex justify-content-center align-items-center menu-option"
                        data-bs-toggle="tooltip" data-bs-placement="right" data-bs-template='<div class="tooltip" role="tooltip"><div class="tooltip-inner body-font"></div></div>' title="Connections">
                        person_search
                    </span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link side-icon" aria-current="page" href="./event/events_page.php">
                    <span class="material-icons md-24 d-inline-flex justify-content-center align-items-center menu-option"
                        data-bs-toggle="tooltip" data-bs-placement="right" data-bs-template='<div class="tooltip" role="tooltip"><div class="tooltip-inner body-font"></div></div>' title="Events">
                        emoji_events
                    </span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link side-icon" aria-current="page" href="./chat/chats.php">
                    <span class="material-icons md-24 d-inline-flex justify-content-center align-items-center menu-option"
                        data-bs-toggle="tooltip" data-bs-placement="right" data-bs-template='<div class="tooltip" role="tooltip"><div class="tooltip-inner body-font"></div></div>' title="Chats">
                        forum
                    </span>
                </a>
            </li>
<li class="nav-item">
                <a class="nav-link side-icon" aria-current="page" href="./group/groups.php">
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
                <a class="nav-link active side-icon d-inline-block mx-3 my-2 d-inline-flex align-items-center" aria-current="page" href="./home.php">
                    <span class="material-icons md-24 d-inline-flex justify-content-center align-items-center pe-2">
                        home
                    </span>
                    <span class="d-inline-flex justify-content-center align-items-center body-font icon-label">
                        Home
                    </span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link side-icon d-inline-block mx-3 my-2 d-inline-flex align-items-center" aria-current="page" href="./match/matches.php">
                    <span class="material-icons md-24 d-inline-flex justify-content-center align-items-center pe-2">
                        person_add
                    </span>
                    <span class="d-inline-flex justify-content-center align-items-center body-font icon-label">
                        Matches
                    </span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link side-icon d-inline-block mx-3 my-2 d-inline-flex align-items-center" aria-current="page" href="./connection/connections.php">
                    <span class="material-icons md-24 d-inline-flex justify-content-center align-items-center pe-2">
                        person_search
                    </span>
                    <span class="d-inline-flex justify-content-center align-items-center body-font icon-label">
                        Connections
                    </span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link side-icon d-inline-block mx-3 my-2 d-inline-flex align-items-center" aria-current="page" href="./event/events_page.php">
                    <span class="material-icons md-24 d-inline-flex justify-content-center align-items-center pe-2">
                        emoji_events
                    </span>
                    <span class="d-inline-flex justify-content-center align-items-center body-font icon-label">
                        Events
                    </span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link side-icon d-inline-block mx-3 my-2 d-inline-flex align-items-center" aria-current="page" href="./chat/chats.php">
                    <span class="material-icons md-24 d-inline-flex justify-content-center align-items-center pe-2">
                        forum
                    </span>
                    <span class="d-inline-flex justify-content-center align-items-center body-font icon-label">
                        Chats
                    </span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link side-icon d-inline-block mx-3 my-2 d-inline-flex align-items-center" aria-current="page" href="./group/groups.php">
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
            <a class="btn btn-primary body-font" id="mobile-top-btn-logout" href="./logout.php" role="button">Logout</a>
        </div>
        <div class="ps-4 body-font fs-5">Components</div>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active side-icon d-inline-block mx-3 my-2 d-inline-flex align-items-center" aria-current="page" href="./home.php">
                    <span class="material-icons md-24 d-inline-flex justify-content-center align-items-center pe-2">
                        home
                    </span>
                    <span class="d-inline-flex justify-content-center align-items-center body-font icon-label">
                        Home
                    </span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link side-icon d-inline-block mx-3 my-2 d-inline-flex align-items-center" aria-current="page" href="./match/matches.php">
                    <span class="material-icons md-24 d-inline-flex justify-content-center align-items-center pe-2">
                        person_add
                    </span>
                    <span class="d-inline-flex justify-content-center align-items-center body-font icon-label">
                        Matches
                    </span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link side-icon d-inline-block mx-3 my-2 d-inline-flex align-items-center" aria-current="page" href="./connection/connections.php">
                    <span class="material-icons md-24 d-inline-flex justify-content-center align-items-center pe-2">
                        person_search
                    </span>
                    <span class="d-inline-flex justify-content-center align-items-center body-font icon-label">
                        Connections
                    </span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link side-icon d-inline-block mx-3 my-2 d-inline-flex align-items-center" aria-current="page" href="./event/events_page.php">
                    <span class="material-icons md-24 d-inline-flex justify-content-center align-items-center pe-2">
                        emoji_events
                    </span>
                    <span class="d-inline-flex justify-content-center align-items-center body-font icon-label">
                        Events
                    </span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link side-icon d-inline-block mx-3 my-2 d-inline-flex align-items-center" aria-current="page" href="./chat/chats.php">
                    <span class="material-icons md-24 d-inline-flex justify-content-center align-items-center pe-2">
                        forum
                    </span>
                    <span class="d-inline-flex justify-content-center align-items-center body-font icon-label">
                        Chats
                    </span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link side-icon d-inline-block mx-3 my-2 d-inline-flex align-items-center" aria-current="page" href="./group/groups.php">
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
        <div class="container-fluid p-5" id="home-header">
            <span class="h1 d-inline-block pb-2">Welcome back, {{ user.name }}</span>
            <br />
            <span class="h5 body-font" id="subtitle">Have a look what the world's been up to</span>
        </div>
        <div class="container-fluid py-4">
            <div class="row main-content-card p-4 justify-content-between">
                <div class="col d-flex justify-content-center align-items-center pb-2 pb-md-0">
                    <span v-if="user.image_name == null" class="material-icons md-dark md-48 d-inline-block pe-2 d-flex justify-content-center align-items-center">
                        account_circle
                    </span>
                    <span v-else class="d-inline-block pe-2 d-flex justify-content-center align-items-center">
                        <img id="home-profile-img" class="rounded-circle d-inline-block" :src="'images/' + user.image_name" />
                    </span>
                    <span class="d-inline-block d-flex justify-content-center align-items-center">
                        <span class="h3 mb-0">{{ user.name }}</span>
                        &nbsp;
                        <span class="username-display gold align-self-end">@{{ user.username }}</span>
                    </span>
                </div>
                <div class="col d-flex justify-content-center align-items-center">
                    <span class="h4 gold d-inline-block d-flex justify-content-center align-items-center mb-0 pe-2">{{ user.numConnect }}</span>
                    <span class="d-inline-block d-flex justify-content-center align-items-center fw-bold">Connections</span>
                </div>
                <div class="col d-flex justify-content-center align-items-center">
                    <span class="h4 gold d-inline-block d-flex justify-content-center align-items-center mb-0 pe-2">{{ user.numGroup }}</span>
                    <span class="d-inline-block d-flex justify-content-center align-items-center fw-bold">Groups</span>
                </div>
            </div>
            <div class="row justify-content-between py-4">
                <div class="col-12 col-lg-3 px-0 order-1">
                    <div class="main-content-card p-4 mb-3">
                        <p class="h5 fw-bold">Upcoming Competitions</p>
                        <div class="d-flex flex-column justify-content-start align-items-start">
                            <div v-if="competitions.length !== 0" class="card-element pt-3 d-flex justify-content-start align-items-center" v-for="competition in competitions">
                                <span v-if="competition.image_name === ''" class="material-icons md-dark md-48 d-inline-block me-3">
                                    emoji_events
                                </span>
                                <span v-else class="d-inline-block me-3">
                                    <img :src="'images/' + competition.image_name" class="rounded-circle d-inline-block home-comp-img" alt="">
                                </span>
                                <span class="d-inline-block fw-bold">
                                    {{ competition.name }}
                                    <br />
                                    <span class="gold fw-light comp-date">
                                        Started on {{ getDate(competition.date_start) }}
                                    </span>
                                </span>
                            </div>
                            <div v-else class="d-flex flex-column justify-content-center align-items-center my-3">
                                <span class="material-icons md-48 mb-3 text-muted">
                                    mood_bad
                                </span>
                                <p class="text-center text-muted">
No ongoing or upcoming competitions
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="main-content-card p-4 mb-3">
                        <p class="h5 fw-bold">Top News for You</p>
                        <div class="d-flex flex-column justify-content-start align-items-start">
                            <div class="card-element pt-3 d-flex justify-content-start align-items-center news-box" v-for="article in news">
                                <a :href="article.link" target="_blank" class="text-decoration-none d-inline-block news-link">
                                    <span class="d-inline-block fw-bold news-container">
                                        <span class="news-title">
                                            {{ article.title }}
                                        </span>
                                        <br />
                                        <span class="gold fw-light news-summary">
                                            {{ article.summary }}
                                        </span>
                                        <p class="m-0 py-1 text-end fst-italic fw-light news-date">{{ article.published_date.split(" ")[0] }}</p>
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-5 p-5 order-last order-lg-2 " v-if="portfolio.length === 0">
                    <div class="d-flex flex-column justify-content-center align-items-center my-3">
                        <span class="material-icons md-48 mb-3 text-muted">
                            sentiment_dissatisfied
                        </span>
                        <p class="text-center text-muted">
                            Your connections have not posted...
                            <br />
                            <a href="match/matches.php" id="add-portfolio-link" class="text-muted">Make new connections today!</a>
                        </p>
                    </div>
                </div>
                <div class="col-5" v-else>
                    <div class="main-content-card p-4 mb-3" v-for="doc in portfolio">
                        <span class="fs-2">{{ doc.title }}</span>
                        <br />
                        <span class="mb-2" id="portfolio-summary">{{ doc.summary }}</span>
                        <br />
                        <span>By {{ doc.authors }}</span>
                        <br />
                        <div v-html="doc.doc"></div>
                    </div>
                </div>
                <div class="col-12 col-lg-3 order-3 px-0">
                    <div class="main-content-card p-4 mb-3">
                        <p class="h5 fw-bold">Potential Matches</p>
                        <div v-if="matches.length !== 0" class="d-flex flex-column justify-content-start align-items-start mb-3">
                            <div class="card-element pt-3 d-flex justify-content-start align-items-center" v-for="match in matches">
                                <span v-if="match.image_name == null" class="material-icons md-dark md-48 d-inline-block me-3">
                                    account_circle
                                </span>
                                <span v-else class="d-inline-block me-3">
                                    <img :src="'images/' + match.image_name" class="rounded-circle d-inline-block home-match-img" alt="">
                                </span>
                                <span class="d-inline-block fw-bold">
                                    {{ match.name }}
                                    <br />
                                    <span class="fw-light badge skill-badge d-inline-block me-1" v-for="(skill, idx) in match.skills">
                                        {{ skill }}
</span>
                                </span>
                            </div>
                        </div>
                        <div v-else class="d-flex flex-column justify-content-center align-items-center my-3">
                            <span class="material-icons md-48 mb-3 text-muted">
                                mood_bad
                            </span>
                            <p class="text-center text-muted">
                                No potential matches so far...
                            </p>
                        </div>
                    </div>
                    <div class="main-content-card p-4 mb-3">
                        <p class="h5 fw-bold">Recent Chats</p>
                        <div v-if="chats.length !== 0" class="d-flex flex-column justify-content-start align-items-start">
                            <div class="card-element pt-3 d-flex justify-content-start align-items-center" v-for="chat in chats">
                                <span v-if="chat.image_name === ''" class="material-icons md-dark md-48 d-inline-block me-3">
                                    account_circle
                                </span>
                                <span v-else class="d-inline-block me-3">
                                    <img :src="'images/' + chat.image_name" class="rounded-circle d-inline-block home-chat-img" alt="">
                                </span>
                                <span class="d-inline-block fw-bold">
                                    {{ chat.name }}
                                    <br />
                                    <span class="gold fw-light">
                                        {{ chat.message }}
                                    </span>
                                </span>
                            </div>
                        </div>
                        <div v-else class="d-flex flex-column justify-content-center align-items-center my-3">
                            <span class="material-icons md-48 mb-3 text-muted">
                                mood_bad
                            </span>
                            <p class="text-center text-muted">
                                No new chats so far...
                                <br />
                                <a href="chat/chats.php" id="add-chat-link" class="text-muted">Make new connections today!</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<!-- Bootstrap -->
<script src="assets/js/bootstrap.bundle.min.js"></script>
<!-- Vue -->
<script src="assets/js/vue.global.js"></script>
<!-- Axios -->
<script src="assets/js/axios.min.js"></script>
<!-- Home Page Custom -->
<script src="assets/js/home_page.js"></script>
</html>
