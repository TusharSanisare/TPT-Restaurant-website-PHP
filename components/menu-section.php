<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<?php
include './database/db_config.php';
$current_page = basename($_SERVER['PHP_SELF']);
$error = null;

if (isset($_REQUEST['meal'])) {
  if ($_SERVER['REQUEST_METHOD'] == "GET" && $_REQUEST['meal'] == "dinner") {
    $select_stmt = $conn->prepare("SELECT * FROM tbl_food_items WHERE type_of_meal='Dinner'");
    $select_stmt->execute();
  } else if ($_SERVER['REQUEST_METHOD'] == "GET" && $_REQUEST['meal'] == "launch") {
    $select_stmt = $conn->prepare("SELECT * FROM tbl_food_items WHERE type_of_meal='Lunch'");
    $select_stmt->execute();
  } else if ($_SERVER['REQUEST_METHOD'] == "GET" && $_REQUEST['meal'] == "breakfast") {
    $select_stmt = $conn->prepare("SELECT * FROM tbl_food_items WHERE type_of_meal='Breakfast'");
    $select_stmt->execute();
  }
} else {
  if ($current_page == "index.php") {
    $select_stmt = $conn->prepare("SELECT * FROM tbl_food_items LIMIT 8");
    $select_stmt->execute();
  } else if ($current_page == "menu.php") {
    $select_stmt = $conn->prepare("SELECT * FROM tbl_food_items");
    $select_stmt->execute();
  }
}



$all_items = array();

$result = $select_stmt->get_result();
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $all_items[] = $row;
  }
} else {
  $error = "<p style='color:red'>No records found... for your search</p>";
}

$select_stmt->close();
$conn->close();

?>


<?php

?>

<body>
  <div class="container-xxl py-5">
    <div class="container">
      <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
        <h5 class="section-title ff-secondary text-center text-primary fw-normal">Food Menu</h5>
        <h1 class="mb-5">Most Popular Items</h1>
      </div>
      <div class="tab-class text-center wow fadeInUp" data-wow-delay="0.1s">
        <?php
        if ($current_page != "index.php") {
        ?>
          <ul class="nav nav-pills d-inline-flex justify-content-center border-bottom mb-5">
            <li class="nav-item">
              <a href="<?php echo $_SERVER['PHP_SELF'] ?>?meal=breakfast" class="d-flex align-items-center text-start mx-3 ms-0 pb-3">
                <i class="fa fa-coffee fa-2x text-primary"></i>
                <div class="ps-3">
                  <small class="text-body">Popular</small>
                  <h6 class="mt-n1 mb-0">Breakfast</h6>
                </div>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo $_SERVER['PHP_SELF'] ?>?meal=launch" class="d-flex align-items-center text-start mx-3 pb-3">
                <i class="fa fa-hamburger fa-2x text-primary"></i>
                <div class="ps-3">
                  <small class="text-body">Special</small>
                  <h6 class="mt-n1 mb-0">Launch</h6>
                </div>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo $_SERVER['PHP_SELF'] ?>?meal=dinner" class="d-flex align-items-center text-start mx-3 me-0 pb-3">
                <i class="fa fa-utensils fa-2x text-primary"></i>
                <div class="ps-3">
                  <small class="text-body">Lovely</small>
                  <h6 class="mt-n1 mb-0">Dinner</h6>
                </div>
              </a>
            </li>
          </ul>
        <?php
        }
        ?>
        <div class="tab-content">
          <div class="tab-pane fade show p-0 active">
            <div class="row g-4">
              <?php
              for ($i = 0; $i < count($all_items); $i++) {
                $item = $all_items[$i];
              ?>
                <div class="col-lg-6">
                  <div class="d-flex align-items-center">
                    <img class="flex-shrink-0 img-fluid rounded" src='<?php echo $item['image_url'] ?>' alt="" style="width: 80px; height: 80px;">
                    <div class="w-100 d-flex flex-column text-start ps-4">
                      <h5 class="d-flex justify-content-between border-bottom pb-2">
                        <span><?php echo $item['name'] ?></span>
                        <span class="text-primary"><?php echo "₹" . $item['price'] ?></span>
                      </h5>
                      <small class="fst-italic"><?php echo $item['description'] ?></small>
                      <p class="fst-italic"><?php echo $item['type_of_meal'] ?></p>
                    </div>
                  </div>
                </div>

              <?php
              }
              ?>



              <?php
              if ($current_page == "index.php") {
                echo "<div class='w-full my-5'><a href='menu.php' class='btn btn-primary py-2 px-4'>view more</a></div>";
              }
              ?>

              <?php
              if ($error) {
                echo $error;
              }
              ?>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</body>

</html>