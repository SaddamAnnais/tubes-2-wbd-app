<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Login</title>
  <!---Custom CSS File--->
  <link rel="stylesheet" href="<?= BASE_URL ?>/styles/styles.css">
  <link rel="stylesheet" href="<?= BASE_URL ?>/styles/user/editprofile.css">
  <link rel="icon" type="image/png" sizes="64x64" href="<?= BASE_URL ?>/static/icon/logo-64x64.ico">
  <!-- Custom js file -->
  <!-- <script type="text/javascript" src="<?= BASE_URL ?>/javascript/user/login.js" defer></script> -->
</head>

<body>
  <div class="container">
    <header>Edit Profile</header>
    <form id="form">
      <p class="label">Username</p>
      <input type="text" id="username" name="username">
      <p id="username-alert" class="alert hidden"></p>

      <p class="label">Name</p>
      <input type="text" id="name" name="name">
      <p id="name-alert" class="alert hidden"></p>

      <p class="label">Password</p>
      <input type="password" id="password" name="password">
      <p id="password-alert" class="alert hidden"></p>

      <p class="label">Retype Password</p>
      <input type="password" id="password" name="password">
      <p id="password-alert" class="alert hidden"></p>

      <p id="result-alert" class="alert hidden"></p>

      <div class="button-group">
        <input type="button" class="button delete" value="Delete Account">
        <input type="submit" class="button save" value="Save">
      </div>
    </form>
  </div>
</body>
</html>