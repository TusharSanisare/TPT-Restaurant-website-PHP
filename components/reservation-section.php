<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>


<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && $_REQUEST['action'] == "booking") {

  $name = $_REQUEST['name'];
  $phone = $_REQUEST['phone'];
  $email = $_REQUEST['email'];
  $datetime = date('Y-m-d H:i:s', strtotime($_REQUEST['datetime']));
  $people = $_REQUEST['people'];
  $message = $_REQUEST['message'];

  // echo $name . " " . $email . " " . $datetime . " " . $people . " " . $message;

  include 'database/db_config.php';

  $stmt = $conn->prepare("INSERT INTO tbl_reservations (customer_name,customer_phone,customer_email,peoples,booking_date,customer_request) VALUES('$name','$phone','$email','$people','$datetime','$message')");
  $stmt->execute();


  $select_stmt = $conn->prepare("SELECT * FROM tbl_reservations WHERE customer_name = '$name' AND customer_email = '$email' AND booking_date = '$datetime'");
  $select_stmt->execute();

  $result = $select_stmt->get_result();
  if ($result->num_rows > 0) {
    echo "<div style='color:green; width:100%; display:flex; flex-direction: column; justify-content:center; align-items:center;'>
        <h1 style='color:green;'>Success!!</h1>
        <p>You will receive payment and confirmation Email on <a href='mailto:" . $email . "' style='color: blue; text-decoration: underline;'>" . $email . "</a> in 1-2 hours</p>
      </div>";
  } else {
    echo "<h1 style='color:red'>Opps something went wrong... try again!!</h1>";
  }

  $current_section = "add item";

  $stmt->close();
  $conn->close();
}
?>

<body>
  <div class="container-xxl py-5 px-0 wow fadeInUp" data-wow-delay="0.1s">
    <div class="row g-0">
      <div class="col-md-6">
        <div class="my-video">
          <button type="button" class="btn-play" data-bs-toggle="modal" data-src="https://www.youtube.com/embed/DWRcNpR6Kdc" data-bs-target="#videoModal">
            <span></span>
          </button>
        </div>
      </div>
      <div class="col-md-6 bg-dark d-flex align-items-center">
        <div class="p-5 wow fadeInUp" data-wow-delay="0.2s">
          <h5 class="section-title ff-secondary text-start text-primary fw-normal">Reservation</h5>
          <h1 class="text-white mb-4">Book A Table Online</h1>
          <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
            <div class="row g-3">
              <?php
              if (basename($_SERVER['PHP_SELF']) == "booking.php") {
              ?>
                <div class="col-md-6">
                  <div class="form-floating">
                    <input type="text" class="form-control" name="name" placeholder="Your Name" required>
                    <label for="name">Your Name</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-floating">
                    <input type="tel" class="form-control" name="phone" placeholder="Your Phone NO." maxlength="10" minlength="10" required>
                    <label for="phone">Your Phone NO.</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-floating">
                    <input type="email" class="form-control" name="email" placeholder="Your Email" required>
                    <label for="email">Your Email</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-floating date" id="date3" data-target-input="nearest">
                    <input type="datetime-local" class="form-control" name="datetime" placeholder="Date & Time" required />
                    <label for="datetime">Date & Time</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-floating">
                    <select class="form-select" name="people">
                      <option value="1">People 1</option>
                      <option value="2">People 2</option>
                      <option value="3">People 3</option>
                      <option value="4">People 4</option>
                      <option value="5">People 5</option>
                      <option value="6">People 6</option>
                      <option value="7">People 7</option>
                      <option value="8">People 8</option>
                      <option value="9">People 9</option>
                      <option value="10">People 10</option>
                    </select>
                    <label for="select1">No Of People</label>
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-floating">
                    <textarea class="form-control" placeholder="Special Request" name="message" style="height: 100px"></textarea>
                    <label for="message">Special Request (optional)</label>
                  </div>
                </div>
                <div class="col-12">
                  <button class="btn btn-primary w-100 py-3" type="submit" name="action" value="booking">Book Now</button>
                </div>

              <?php
              } else {
                echo '<a href="booking.php" class="btn btn-primary py-2 px-4">Book A Table</a>';
              }
              ?>

            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content rounded-0">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Youtube Video</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <!-- 16:9 aspect ratio -->
          <div class="ratio ratio-16x9">
            <iframe class="embed-responsive-item" src="" id="video" allowfullscreen allowscriptaccess="always" allow="autoplay"></iframe>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>