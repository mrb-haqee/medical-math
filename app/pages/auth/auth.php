<?php
$root_auth = "/public/auth/";


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <!-- <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script> -->
  <link rel="stylesheet" href="<?= $root_auth ?>style.css" />
  <title>Auth</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/simple-notify@1.0.4/dist/simple-notify.css" />
  <style>
    .icon-form {
      color: #888888;
      display: flex;
      justify-content: center;
      align-items: center;
      font-size: x-large;
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="forms-container">
      <div class="signin-signup">
        <form action="#" class="sign-in-form" id="form-signin">
          <h2 class="title">Sign in</h2>
          <div class="input-field">
            <span class="icon-form">
              <i class="fas fa-user"></i>
            </span>
            <input type="text" placeholder="Email" name="email" />
          </div>
          <div class="input-field">
            <span class="icon-form">
              <i class="fas fa-lock"></i>
            </span>
            <input type="password" placeholder="Password" name="password" />
          </div>
          <input type="submit" value="Login" class="btn solid" />
          <p class="social-text">Or Sign in with social platforms</p>
          <div class="social-media">
            <a href="#" class="social-icon">
              <i class="fab fa-facebook-f"></i>
            </a>
            <a href="#" class="social-icon">
              <i class="fab fa-twitter"></i>
            </a>
            <a href="#" class="social-icon">
              <i class="fab fa-google"></i>
            </a>
            <a href="#" class="social-icon">
              <i class="fab fa-linkedin-in"></i>
            </a>
          </div>
        </form>
        <form action="#" class="sign-up-form" id="form-signup">
          <h2 class="title">Sign up</h2>
          <div class="input-field">
            <span class="icon-form">
              <i class="fas fa-user"></i>
            </span>
            <input type="text" placeholder="Username" name="username" />
          </div>
          <div class="input-field">
            <span class="icon-form">
              <i class="fas fa-envelope"></i>
            </span>
            <input type="email" placeholder="Email" name="email" />
          </div>
          <div class="input-field">
            <span class="icon-form">
              <i class="fas fa-lock"></i>
            </span>
            <input type="password" placeholder="Password" name="password" />
          </div>
          <input type="submit" class="btn" value="Sign up" />
          <p class="social-text">Or Sign up with social platforms</p>
          <div class="social-media">
            <a href="#" class="social-icon">
              <i class="fab fa-facebook-f"></i>
            </a>
            <a href="#" class="social-icon">
              <i class="fab fa-twitter"></i>
            </a>
            <a href="#" class="social-icon">
              <i class="fab fa-google"></i>
            </a>
            <a href="#" class="social-icon">
              <i class="fab fa-linkedin-in"></i>
            </a>
          </div>
        </form>
      </div>
    </div>

    <div class="panels-container">
      <div class="panel left-panel">
        <div class="content">
          <h3>New here ?</h3>
          <p>
            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Debitis,
            ex ratione. Aliquid!
          </p>
          <button class="btn transparent" id="sign-up-btn">
            Sign up
          </button>
        </div>
        <img src="<?= $root_auth ?>img/log.svg" class="image" alt="" />
      </div>
      <div class="panel right-panel">
        <div class="content">
          <h3>One of us ?</h3>
          <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum
            laboriosam ad deleniti.
          </p>
          <button class="btn transparent" id="sign-in-btn">
            Sign in
          </button>
        </div>
        <img src="<?= $root_auth ?>img/register.svg" class="image" alt="" />
      </div>
    </div>

  </div>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/simple-notify@1.0.4/dist/simple-notify.min.js"></script>
  <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
  <script src="<?= $root_auth ?>app.js"></script>
</body>

</html>