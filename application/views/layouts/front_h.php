<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Poll Management System</title>
    <!-- google-fonts -->
    <link href="//fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap"
          rel="stylesheet">
    <!-- //google-fonts -->
    <!-- Template CSS Style link -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>libraries/frontend/assets/css/style-starter.css">
<!--W3 Css-->
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>

<body>
<!--header-->
<header id="site-header" class="fixed-top">
    <div class="container">
        <nav class="navbar navbar-expand-lg stroke">
            <h1>
                <a class="navbar-brand" href="index.html">
                    <img class="img-fluid" src="<?php echo base_url(); ?>libraries/frontend/assets/images/logo.png" alt=" "> Poll Voting Syetem
                </a>
            </h1>
            <button class="navbar-toggler  collapsed bg-gradient" type="button" data-toggle="collapse"
                    data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false"
                    aria-label="Toggle navigation">
                <span class="navbar-toggler-icon fa icon-expand fa-bars"></span>
                <span class="navbar-toggler-icon fa icon-close fa-times"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <ul class="navbar-nav ml-lg-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="index.html">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.html">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.html">Contact Us</a>
                    </li>
                    <!-- search button -->
                    <div class="search-right">
                        <a href="<?php echo base_url(); ?>login" class="btn button-style" title="search"><?php if (!$this->session->has_userdata('auth')) {
                                echo "Login";
                            }else{
                            echo $this->session->userdata('name');
                            } ?></a>
                        <!-- search popup -->
                    </div>
                    <!-- //search button -->
                </ul>
            </div>
        </nav>
    </div>
</header>
<!--//header-->
