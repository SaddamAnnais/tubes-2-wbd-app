<!DOCTYPE html>
<!-- Coding By CodingNepal - codingnepalweb.com -->
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Page Not Found</title>
  <!---Custom CSS File--->
  <link rel="stylesheet" href="<?= BASE_URL ?>/styles/styles.css">
  <link rel="stylesheet" href="<?= BASE_URL ?>/styles/exception/exception.css">
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
  </div>
</body>

</html>
