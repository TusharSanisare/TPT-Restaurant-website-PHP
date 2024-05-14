<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <?php
  $current_page = isset($_REQUEST['action']) ? $_REQUEST['action'] : 'admin';
  function isActive($page)
  {
    if ($page === $GLOBALS['current_page']) {
      return "active";
    } else {
      return "";
    }
  }


  if ($_SERVER['REQUEST_METHOD'] == "GET" && isset($_REQUEST['action']) && $_REQUEST['action'] == "logout") {
    session_destroy();
    header("Location: index.php");
  }
  ?>



  <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4 px-lg-5 py-3 py-lg-0">
    <a href="" class="navbar-brand p-0">
      <h1 class="text-primary m-0"><i class="fa fa-utensils me-3"></i>TPT</h1>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
      <span class="fa fa-bars"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
      <div class="navbar-nav ms-auto py-0 pe-4">
        <a href="<?php echo $_SERVER['PHP_SELF']; ?>?action=admin" class="nav-item nav-link <?php echo isActive("admin") ?>">admin</a>
        <a href="<?php echo $_SERVER['PHP_SELF']; ?>?action=AddItem" class="nav-item nav-link <?php echo isActive("AddItem") ?>">Add Item</a>
        <a href="<?php echo $_SERVER['PHP_SELF']; ?>?action=ViewItem" class="nav-item nav-link <?php echo isActive("ViewItem") ?>">View Item</a>
        <a href="<?php echo $_SERVER['PHP_SELF']; ?>?action=NewBookings" class="nav-item nav-link <?php echo isActive("NewBookings") ?>">New Bookings</a>
      </div>
      <a href="<?php echo $_SERVER['PHP_SELF'] . '?action=logout' ?>" class="btn btn-primary py-2 px-4">Logout</a>
    </div>
  </nav>
</body>

</html>