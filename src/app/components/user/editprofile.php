<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Edit Profile</title>
  <!---Custom CSS File--->
  <link rel="stylesheet" href="<?= BASE_URL ?>/styles/styles.css">
  <link rel="stylesheet" href="<?= BASE_URL ?>/styles/user/editprofile.css">
  <link rel="stylesheet" href="<?= BASE_URL ?>/styles/user/editprofilemodals.css">
  <link rel="stylesheet" type="text/css" href="/public/styles/templates/navbar.css">
  <link rel="icon" type="image/png" sizes="64x64" href="<?= BASE_URL ?>/static/icon/logo-64x64.ico">
  <!-- Custom js file -->
  <script type="text/javascript" src="<?= BASE_URL ?>/javascript/user/editprofile.js" defer></script>
  <script type="text/javascript" src="<?= BASE_URL ?>/javascript/user/editprofilemodals.js" defer></script>
  <script type="text/javascript" src="<?= BASE_URL ?>/javascript/templates/navbar.js" defer></script>

</head>

<body>
  <?php
  require_once __DIR__ . '/editprofilemodals.php';
  require_once __DIR__ . '/../templates/navbar.php';
  modals();
  navbar(false);
  ?>
  <div class="container">

    <header>Edit Profile</header>
    <p class="explain">Please leave the password blank if you do not want to change it.</p>
    <form id="form">
      <?php if (isset($this->data['user_id'])): ?>
        <label for="inputusername">Username</label>
        <input type="text" id="inputusername" name="inputusername" value="<?= $this->data['username'] ?>">
        <p id="username-alert" class="alert hidden"></p>

        <label for="inputname">Name</label>
        <input type="text" id="inputname" name="inputname" value="<?= $this->data['name'] ?>">
        <p id="name-alert" class="alert hidden"></p>

        <label for="password">Password</label>
        <input type="password" id="password" name="password">
        <p id="password-alert" class="alert hidden"></p>

        <label for="retype-password">Retype Password</label>
        <input type="password" id="retype-password" name="retype">
        <p id="retype-alert" class="alert hidden"></p>

        <p id="result-alert" class="alert hidden">Update successfully changed!</p>

        <div class="button-group">
          <input type="button" id="modals-button" class="button delete" value="Delete Account">
          <input type="submit" class="button save" value="Save">
        </div>
      <?php endif; ?>
    </form>
  </div>
</body>

</html>