<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Login</title>
  <!---Custom CSS File--->
  <link rel="stylesheet" href="<?= BASE_URL ?>/styles/styles.css">
  <link rel="stylesheet" href="<?= BASE_URL ?>/styles/user/login-register.css">
  <link rel="icon" type="image/png" sizes="32x32" href="<?= BASE_URL ?>/static/icon/logo-64x64.ico">
  <!-- Custom js file -->
  <script type="text/javascript" src="<?= BASE_URL ?>/javascript/user/login.js" defer></script>
</head>

<body>
  <div class="container">
    <div class="banner">
      <img alt="logo" class="logo" src="<?= BASE_URL ?>/static/logo.png" />
      <header>Cooklyst</header>
    </div>
    <form id="form">
      <input type="text" id="username" name="username" placeholder="Enter your username...">
      <p id="username-alert" class="alert hidden">
      </p>
      <input type="password" id="password" name="password" placeholder="Enter your password...">
      <p id="password-alert" class="alert hidden">
      </p>
      <input type="submit" class="button">
      <p id="result-alert" class="alert hidden" />
    </form>
    <p>Don't have an account? <a href="<?= BASE_URL ?>/user/register">Register</a></p>
  </div>
</body>

</html>