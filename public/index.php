<?php
$page = 'home';
include_once('../templates/header.php');
?>

<link rel="stylesheet" href="/css/home.css">
<main class="home">
  <section class="hero">
    <div class="container">
      <div class="hero-text-container">
        <div>
          <h1>Discover Your Ideal<br>Major with Confidence.</h1>
          <p>Take a short quiz and let <span class="primary-text">WhatNext</span> guide your academic journey</p>
        </div>
        <a class="button button-primary" href="./quiz.php">
          Take Quiz
        </a>
      </div>
      <div>
        <img
          src="./assets/images/hero-img-md.jpg"
          srcset="./assets/images/hero-img-sm.jpg 400w,
                    ./assets/images/hero-img-md.jpg 800w,
                    ./assets/images/hero-img-lg.jpg 1600w"
          sizes="(max-width: 768px) 100vw, 
                  (min-width: 769px) 50vw"
          alt="Hero image"
          class="hero-img" />
      </div>
    </div>
  </section>
  <section class="how-it-works">
    <div class="container">
      <h2>How it works</h2>
      <div class="steps-container">
        <div class="step-wrapper">
          <img src="../public/assets/images/icon-quiz.svg" class="step-icon" />
          <div class="step-text">
            <h3>Take the quiz</h3>
            <p>Answer a short set of multiple-choice questions designed to uncover your strengths, interests, and academic preferences.</p>
          </div>
        </div>
        <div class="step-wrapper">
          <img src="../public/assets/images/icon-result.svg" class="step-icon" />
          <div class="step-text">
            <h3>View Your Result</h3>
            <p>Get an instant overview of majors that align with you based on your quiz answers.</p>
          </div>
        </div>
        <div class="step-wrapper">
          <img src="../public/assets/images/icon-learn.svg" class="step-icon" />
          <div class="step-text">
            <h3>Learn About Majors</h3>
            <p>Chat with our AI assistant to explore each suggested major, understand career paths, and required skills.</p>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>
<script src="./assets/js/header.js"></script>
<?php include_once('../templates/footer.php'); ?>