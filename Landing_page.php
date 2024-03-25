<?php
require ("db/db.php");
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing page </title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="landing_page.css">
</head>
<body>
<!--nav-->
<nav>
<div class="logo">CONNECTOR</div>
<div class="openMenu"><i class="bi bi-list"></i></div>
<ul class="menu">
 <li><a>Hi, there  <span><?php echo $_SESSION['username'] ?></a></li>
        <li><a href="landing_page.php">Find remote jobs</a></li>
        <i class="fa fa-camera-retro fa-lg"></i> 
        <div class="closeMenu"><i class="bi bi-x"></i></div>
        <li><a href="login_form.php">Log in</a></li>
</ul>
</nav>
<!--end of nav bar-->
<!--contents-->
<div class="content_container">
<div class="intro_text">Find your dream remote job without the hassle</div> <br>
<div class="intro_text2">Connector  is where top talents go to easily access active and fully  job opportunities from various employes  around the world. </div>
</div>
<!--end of contents-->
<!--start of btns container -->
<div class="btn_container">
<div class="worker_btn " ><a href="">For Workers</a></div>
<div class="worker_btn " ><a href="">For Employers</a></div>
</div>
<!--end of btn container-->
<!--servicess offered-->
<div class="services_offered_container">
<div class="services_text">Some of the services offered... </div>
<div class="job_cards_container">
<div class="card">
<i class="bi bi-code-slash"></i>
<p class="centerd_text ">App developer</p>
</div>
<div class="card">
<i class="bi bi-diagram-3"></i>
<p class="centerd_text">Graphics designer</p>
</div>
<div class="card">
<i class="bi bi-code-slash"></i>
<p class="centerd_text">Web developer</p>
</div>
<div class="card">

<p class="centered_text"><a href="jobs.php">see all jobs..</a></p>
</div>
</div>
</div>
<!-- end of servicess offered-->
<!--why us -->
<div class="why_us">
<p class="why_us_text">Why us ?</p>
<div class="why_header">Finding a  job is tough. Why? Because tons of companies have conducted layoffs in the recent years , Skill mismatch and lastly Lack of entrepreneurship and lifeskills education . But it’s still possible to land a  job easily usig our platform . </div>
<div class="reasons_text">
Here are our best tips to kickstart your remote job search:
<ul>
    <li>Never worked used web platform to get a job? we have simple user interface  and  experience   </li>
    <li>How to find a  job? Read stories of those who have done it!</li>
    <li>How much are employers  paying their staff? stated on each job description</li>
</ul>
</div>
</div>
<!--end of why us -->
<!--footer-->
<footer class="footer">
<div class="footer_row">
<div class="footer_col">
    <h1>Location</h1>
    <ul>
        <li>
            <a>
                <p>
                  Main HQ, <br>
                  Connector plaza , <br>
                  Upperhill, <br>
                  071234567
                </p>
            </a>
        </li>
    </ul>
</div>
<div class="footer_col">
    <h1>Follow Us</h1>
    <ul>
        <li>
        <a href=""><i class="bi bi-instagram"></i></a>
        </li>
        <li>
        <a href=""><i class="bi bi-twitter"></i></a>  
        </li>
        <li>
        <a href=""><i class="bi bi-facebook"></i></a>
        </li>
        <li>
        <a href=""><i class="bi bi-snapchat"></i></a> 
        </li>
        <li>
        <a href=""><i class="bi bi-telegram"></i></a>
        </li>
        <li>
        <a href=""><i class="bi bi-instagram"></i></a> 
        </li>
    </ul>
</div>
<div class="footer_col">
                    <h1>Top Jobs</h1>
                    <ul>
                        <li>
                            <a>It /Software engineering</a>
                        </li>
                        <li>
                            <a>Business</a>
                        </li>
                        <li>
                            <a>Hospitality</a>
                        </li>
                        <li>
                            <a>Writting</a>
                        </li>
                    </ul>
                </div>
</div>
<ul class="footer_end">
<li><a href="#">&#169; 2024 Connector- All Rights Reserved</a></li>
</ul>
</footer>
<!-- end of footer-->
</body>
<script src="index.js"></script>
</html>
