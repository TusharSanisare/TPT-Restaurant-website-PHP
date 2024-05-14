<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <style>
    html,
    body,
    .intro {
      height: 100%;
    }

    table td,
    table th {
      text-overflow: ellipsis;
      white-space: nowrap;
      overflow: hidden;
    }

    tbody td {
      font-weight: 500;
    }

    .header {
      font-size: 20px;
      font-weight: bolder;
      color: orange;
    }

    .text-black {
      color: #111;
    }

    .btn-confirm {
      background: green;
      color: white;
      border: none;
      border-radius: 3px;
      padding: 5px;
    }

    .btn-delete {
      background: red;
      color: white;
      border: none;
      border-radius: 3px;
      padding: 5px;
    }
  </style>
</head>

<?php

include '../database/db_config.php';

$all_items = array();

$select_stmt = $conn->prepare("SELECT * FROM tbl_reservations");
$select_stmt->execute();
$result = $select_stmt->get_result();

if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $all_items[] = $row;
  }
} else {
  $error = "<h1 style='color:orange; text-align:center'>No recent bookings!!</h1>";
  echo $error;
}

$select_stmt->close();
$conn->close();

?>





<body>
  <section class="intro">
    <div class="gradient-custom-1 h-100">
      <div class="mask d-flex align-items-center h-100">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-12">
              <div class="table-responsive bg-white">
                <table class="table mb-0">
                  <thead>
                    <tr>
                      <th class="header" scope="col">S.NO</th>
                      <th class="header" scope="col">CUSTOMER NAME</th>
                      <th class="header" scope="col">PHONE NO.</th>
                      <th class="header" scope="col">EMAIL</th>
                      <th class="header" scope="col">PEOPLES</th>
                      <th class="header" scope="col">BOOKING DATE</th>
                      <th class="header" scope="col">CUSTOMER REQUEST</th>
                      <th class="header" scope="col">ALLOTE TABLE</th>
                      <th class="header" scope="col"></th>
                      <th class="header" scope="col"></th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php
                    for ($i = 0; $i < count($all_items); $i++) {
                      $item = $all_items[$i];

                    ?>
                      <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                        <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
                        <tr>
                          <td class="text-black"><?php echo $i + 1; ?></td>
                          <td class="text-black"><?php echo $item['customer_name']; ?></td>
                          <td class="text-black"><?php echo $item['customer_phone']; ?></td>
                          <td class="text-black"><?php echo $item['customer_email']; ?></td>
                          <td class="text-black"><?php echo $item['peoples']; ?></td>
                          <td class="text-black"><?php echo date('Y-m-d H:i', strtotime($item['booking_date'])); ?></td>
                          <td class="text-black"><?php echo $item['customer_request']; ?></td>
                          <td>
                            <input type="text" name="booked_table">
                          </td>
                          <td>
                            <input class="btn-confirm" type="submit" name="action" value="Confirm Booking">
                          </td>
                          <td>
                            <input class="btn-delete" type="submit" name="action" value="Delete Booking">
                          </td>
                        </tr>
                      </form>
                    <?php
                    }
                    ?>

                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</body>

</html>