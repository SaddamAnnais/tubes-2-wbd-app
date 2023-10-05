<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Login & Registration Form</title>
  <!---Custom CSS File--->
  <link rel="stylesheet" href="<?= BASE_URL ?>/styles/styles.css">
  <link rel="stylesheet" href="<?= BASE_URL ?>/styles/user/login-register.css">
  <link rel="icon" type="image/png" sizes="64x64" href="<?= BASE_URL ?>/static/icon/logo-64x64.ico">
  <!-- Custom js file -->
  <script type="text/javascript" src="<?= BASE_URL ?>/javascript/user/register.js" defer></script>
</head>

<body>
  <div class="container">
    <div class="banner">
      <img alt="logo" class="logo" src="<?= BASE_URL ?>/static/logo.png" />
      <header>Cooklyst</header>
    </div>
    <form id="form">
      <input type="text" id="username" name="username" placeholder="Enter your username...">
      <p id="username-alert" class="alert hidden"></p>
      <input type="text" id="name" name="name" placeholder="Enter your name...">
      <p id="name-alert" class="alert hidden"></p>
      <input type="password" id="password" name="password" placeholder="Enter your password...">
      <p id="password-alert" class="alert hidden"></p>
      <input type="password" id="retype-password" name="retype-password" placeholder="Retype your password...">
      <p id="retype-alert" class="alert hidden"></p>
      <input type="submit" class="button">
      <p id="result-alert" class="alert hidden"></p>
    </form>
    <p>Already have an account? <a href="<?= BASE_URL ?>/user/login">Login</a></p>
  </div>
</body>

</html>