<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <?php
  $current_page = basename($_SERVER['PHP_SELF']);
  function isActive($page)
  {
    if ($page === $GLOBALS['current_page']) {
      return "active";
    } else {
      return "";
    }
  }
  ?>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4 px-lg-5 py-3 py-lg-0">
    <a href="" class="navbar-brand p-0">
      <h1 class="text-primary m-0"><i class="fa fa-utensils me-3"></i>TPT</h1>
      <!-- <img src="img/logo.png" alt="Logo"> -->
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
      <span class="fa fa-bars"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
      <div class="navbar-nav ms-auto py-0 pe-4">
        <a href="index.php" class="nav-item nav-link <?php echo isActive("index.php") ?>">Home</a>
        <a href="about.php" class="nav-item nav-link <?php echo isActive("about.php") ?>">About</a>
        <a href="service.php" class="nav-item nav-link <?php echo isActive("service.php") ?>">Service</a>
        <a href="menu.php" class="nav-item nav-link <?php echo isActive("menu.php") ?>">Menu</a>
        <a href="contact.php" class="nav-item nav-link <?php echo isActive("contact.php") ?>">Contact</a>
      </div>
      <a href="booking.php" class="btn btn-primary py-2 px-4">Book A Table</a>
    </div>
  </nav>
</body>

</html>