<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>TPT Restaurant & Cafe</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">

  <!-- Favicon -->
  <link href="img/favicon.ico" rel="icon">

  <!-- Google Web Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&family=Pacifico&display=swap" rel="stylesheet">

  <!-- Icon Font Stylesheet -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

  <!-- Libraries Stylesheet -->
  <link href="lib/animate/animate.min.css" rel="stylesheet">
  <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

  <!-- Customized Bootstrap Stylesheet -->
  <link href="../css/bootstrap.min.css" rel="stylesheet">

  <!-- Template Stylesheet -->
  <link href="../css/style.css" rel="stylesheet">
</head>

<?php
session_start();
if (empty($_SESSION['name'])) {
  header("Location: login.php");
  exit();
}

$current_section = "admin";
if (isset($_REQUEST['action'])) {
  $action = $_REQUEST['action'];
  if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if ($action == "AddItem") {
      $current_section = "add item";
    } else if ($action == "NewBookings") {
      $current_section = "new bookings";
    } else if ($action == "ViewItem") {
      $current_section = "view item";
    } else if ($action == "admin") {
      $current_section = "admin";
    }
  }
}
?>

<?php
include '../database/db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_REQUEST['action'])) {
  $action = $_REQUEST['action'];

  if ($action == "Add") {
    $id = $_REQUEST['id'];
    $name = $_REQUEST['name'];
    $description = $_REQUEST['description'];
    $price = $_REQUEST['price'];
    $image_url = $_REQUEST['image'];
    $type_of_meal = $_REQUEST['type_of_meal'];
    $type_of_cuisine = $_REQUEST['type_of_cuisine'];
    $vegetarian = $_REQUEST['vegetarian'];


    if (!empty($id)) {
      //uodate wala logic
    } else {
      $stmt = $conn->prepare("INSERT INTO `tbl_food_items`(`name`, `description`, `price`, `image_url`, `type_of_meal`, `type_of_cuisine`, `vegetarian`) VALUES ('$name','$description','$price','$image_url','$type_of_meal','$type_of_cuisine','$vegetarian')");
      $stmt->execute();

      if ($stmt->execute()) {
        echo "<h3 style='color:white;background:green; text-align:center;'>Item added successfully!!</h3>";
      } else {
        echo "<h3 style='color:white;background:red; text-align:center;'>Oops, something went wrong... try again!!</h3>";
      }
      $current_section = "add item";
    }
  }

  if ($action == "Confirm Booking") {

    $booked_table = $_REQUEST['booked_table'];
    $id = $_REQUEST['id'];

    $stmt = $conn->prepare("UPDATE tbl_reservations SET booked_table = '$booked_table' WHERE id = NULL");

    if ($stmt->execute()) {
      $select_stmt = $conn->prepare("SELECT * FROM tbl_reservations WHERE id = '$id'");
      $select_stmt->execute();
      $result = $select_stmt->get_result();
      $row = $result->fetch_assoc();


      // $to = "arvindkmrgpt@gmail.com";
      $to = "tsanisare@gmail.com";
      $subject = "Table Booking";
      $message = "Your table has been booked.";
      $headers = "MIME-Version: 1.0" . "\r\n";
      $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
      $headers .= 'From: tsanisare@gmail.com' . "\r\n"; // Replace with your email

      mail($to, $subject, $message, $headers);

      echo ("adoisjisahisuhdsih");
    }

    //   echo "<h3 style='color:white;background:green; text-align:center;'>Booking confirmation mail sended!!</h3>";
    // } else {
    //   echo "<h3 style='color:white;background:red; text-align:center;'>Oops, something went wrong... try again!!</h3>";
    // }
    $current_section = "new bookings";
  }

  if ($action == "Delete Booking") {
    $id = $_REQUEST['id'];
    $stmt = $conn->prepare("DELETE FROM tbl_reservations WHERE id = '$id'");
    if ($stmt->execute()) {
      echo "<h3 style='color:white;background:green; text-align:center;'>Booking deleted successfully</h3>";
    } else {
      echo "<h3 style='color:white;background:red; text-align:center;'>Failed to delete booking</h3>";
    }
    $stmt->close();
    $current_section = "new bookings";
  }

  $conn->close();
}
?>

<body>

  <div class="container-xxl bg-white p-0">
    <!-- Navbar & Hero Start -->
    <div class="container-xxl position-relative p-0">
      <!-- Navbar start -->
      <?php include './adminNavbar.php'; ?>
      <!-- Navbar end -->
      <div class="container-xxl py-5 bg-dark hero-header my-hero-header mb-5">
        <div class="container text-center my-5 pt-5 pb-4">
          <h1 class="display-3 text-white mb-3 animated slideInDown">Admin Dashboard</h1>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center text-uppercase">
              <li class="breadcrumb-item"><a href="#">Admin</a></li>
              <li class="breadcrumb-item"><a href="#">Pages</a></li>
              <li class="breadcrumb-item text-white active" aria-current="page"><?php echo $current_section ?></li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
    <!-- Navbar & Hero End -->

    <!-- ----------- mid section start ------------ -->
    <?php
    if ($current_section == "add item") {
      include "addItem.php";
    }
    if ($current_section == "new bookings") {
      include "newBookings.php";
    }
    ?>
    <!-- ------------ mid section end----------- -->

    <!-- Footer Start -->
    <?php include '../components/footer.php'; ?>
    <!-- Footer End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
  </div>

  <!-- JavaScript Libraries -->
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="lib/wow/wow.min.js"></script>
  <script src="lib/easing/easing.min.js"></script>
  <script src="lib/waypoints/waypoints.min.js"></script>
  <script src="lib/counterup/counterup.min.js"></script>
  <script src="lib/owlcarousel/owl.carousel.min.js"></script>
  <script src="lib/tempusdominus/js/moment.min.js"></script>
  <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
  <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

  <!-- Template Javascript -->
  <script src="../js/main.js"></script>
</body>

</html>