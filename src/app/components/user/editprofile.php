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
  <script type="text/javascript" src="<?= BASE_URL ?>/javascript/user/editprofile.js" defer></script>

</head>

<body>
  <div class="container">
    <header>Edit Profile</header>
    <p class="explain">Please leave the password blank if you do not want to change it.</p>
    <form id="form">
      <?php if (isset($this->data['user_id'])): ?>
        <p class="label">Username</p>
        <input type="text" id="username" name="username" value="<?= $this->data['username'] ?>">
        <p id="username-alert" class="alert hidden"></p>

        <p class="label">Name</p>
        <input type="text" id="name" name="name" value="<?= $this->data['name'] ?>">
        <p id="name-alert" class="alert hidden"></p>

        <p class="label">Password</p>
        <input type="password" id="password" name="password">
        <p id="password-alert" class="alert hidden"></p>

        <p class="label">Retype Password</p>
        <input type="password" id="retype" name="retype">
        <p id="password-alert" class="alert hidden"></p>

        <p id="result-alert" class="alert hidden"></p>

        <div class="button-group">
          <input type="button" class="button delete" value="Delete Account">
          <input type="submit" class="button save" value="Save">
        </div>
      <?php endif; ?>
    </form>
  </div>
</body>

</html>