<!DOCTYPE html>
<!-- Coding By CodingNepal - codingnepalweb.com -->
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Login & Registration Form</title>
  <!---Custom CSS File--->
  <link rel="stylesheet" href="<?= BASE_URL ?>/styles/styles.css">
  <link rel="stylesheet" href="<?= BASE_URL ?>/styles/exception/404.css">
  <link rel="icon" type="image/png" sizes="32x32" href="<?= BASE_URL ?>/static/icon/logo-64x64.ico">
</head>

<body>
  <div class="container">
    <img alt="logo" class="logo" src="<?= BASE_URL ?>/static/logo-with-bg.png" />
    <header>Ooops!</header>
    <h2>404 - Page Not Found</h2>
    <form action="<?= BASE_URL?>/home">
      <input type="submit" class="button" value="Back to Home">
    </form>

    <!-- <div class="banner">
      <img alt="logo" class="logo" src="<?= BASE_URL ?>/static/logo.png" />
      <header>Cooklyst</header>
    </div>
    <form method="POST">
      <input type="text" id="uname" name="username" placeholder="Enter your username...">
      <input type="password" id="password" name="password" placeholder="Enter your password...">
      <input type="submit" class="button">
    </form>
    <p>Don't have an account? <a href="<?= BASE_URL ?>/user/register">Register</a></p> -->
  </div>
</body>

</html>