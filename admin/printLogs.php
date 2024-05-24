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

    .btn-print {
      background: blue;
      color: white;
      border: none;
      border-radius: 3px;
      padding: 10px;
      margin: 10px 0;
      display: block;
      width: 200px;
      text-align: center;
    }

    .btn-excel {
      background: green;
      color: white;
      border: none;
      border-radius: 3px;
      padding: 10px;
      margin: 10px 0;
      display: block;
      width: 200px;
      text-align: center;
    }
  </style>
  <!-- Include html2pdf.js library -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>

  <!-- Include SheetJS library -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
</head>

<body>
  <?php
  include '../database/db_config.php';

  $all_items = array();

  $select_stmt = $conn->prepare("SELECT * FROM tbl_reservations WHERE booked_table IS NOT NULL");

  $select_stmt->execute();
  $result = $select_stmt->get_result();

  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $all_items[] = $row;
    }
  }

  $select_stmt->close();
  $conn->close();
  ?>

  <h1 style='color:orange; text-align:center'>Confirmed Bookings</h1>
  <section class="intro">
    <div class="gradient-custom-1 h-100">
      <div class="mask d-flex align-items-center h-100">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-12">
              <div class="table-responsive bg-white">
                <button class="btn-print" onclick="downloadPDF()">Download as PDF</button>
                <button class="btn-excel" onclick="downloadExcel()">Download as Excel</button>
                <div id="content">
                  <table class="table mb-0" id="table-content">
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
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      for ($i = 0; $i < count($all_items); $i++) {
                        $item = $all_items[$i];
                      ?>
                        <tr>
                          <td class="text-black"><?php echo $i + 1; ?></td>
                          <td class="text-black"><?php echo $item['customer_name']; ?></td>
                          <td class="text-black"><?php echo $item['customer_phone']; ?></td>
                          <td class="text-black"><?php echo $item['customer_email']; ?></td>
                          <td class="text-black"><?php echo $item['peoples']; ?></td>
                          <td class="text-black"><?php echo date('Y-m-d H:i', strtotime($item['booking_date'])); ?></td>
                          <td class="text-black"><?php echo $item['customer_request']; ?></td>
                          <td class="text-black"><?php echo $item['booked_table']; ?></td>
                        </tr>
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
    </div>
  </section>

  <script>
    function downloadPDF() {
      const element = document.getElementById('content');
      html2pdf(element, {
        margin: [10, 10, 10, 10],
        filename: 'confirmed_bookings.pdf',
        image: {
          type: 'jpeg',
          quality: 0.98
        },
        html2canvas: {
          scale: 2
        },
        jsPDF: {
          unit: 'mm',
          format: 'a4',
          orientation: 'portrait'
        }
      });
    }

    function downloadPDF() {
      const element = document.getElementById('content');
      html2pdf(element, {
        margin: [10, 10, 10, 10],
        filename: 'confirmed_bookings.pdf',
        image: {
          type: 'jpeg',
          quality: 0.98
        },
        html2canvas: {
          scale: 2
        },
        jsPDF: {
          unit: 'mm',
          format: 'a4',
          orientation: 'portrait'
        }
      });
    }

    function downloadExcel() {
      var wb = XLSX.utils.table_to_book(document.getElementById('table-content'), {
        sheet: "Sheet JS"
      });
      XLSX.writeFile(wb, 'confirmed_bookings.xlsx');
    }
  </script>
</body>

</html>
































<!-- <php
// Include database configuration
include '../database/db_config.php';

// Check if the download button is clicked
if (isset($_POST['download_pdf'])) {
  // Include TCPDF library
  require_once('../TCPDF/tcpdf.php');

  // Create new PDF document
  $pdf = new TCPDF();

  // Set document information
  $pdf->SetCreator(PDF_CREATOR);
  $pdf->SetAuthor('Your Name');
  $pdf->SetTitle('Confirmed Bookings');
  $pdf->SetSubject('Table Export');
  $pdf->SetKeywords('TCPDF, PDF, table');

  // Add a page
  $pdf->AddPage();

  // Fetch data for the table
  $all_items = array();
  $select_stmt = $conn->prepare("SELECT * FROM tbl_reservations WHERE booked_table IS NOT NULL");
  $select_stmt->execute();
  $result = $select_stmt->get_result();

  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $all_items[] = $row;
    }
  }

  $select_stmt->close();
  $conn->close();

  // Create HTML table
  $html = '<h1 style="color:orange; text-align:center">Confirmed Bookings</h1>';
  $html .= '<table border="1" cellspacing="0" cellpadding="5">';
  $html .= '<thead><tr><th>S.NO</th><th>CUSTOMER NAME</th><th>PHONE NO.</th><th>EMAIL</th><th>PEOPLES</th><th>BOOKING DATE</th><th>CUSTOMER REQUEST</th><th>ALLOTE TABLE</th></tr></thead>';
  $html .= '<tbody>';
  foreach ($all_items as $key => $item) {
    $html .= '<tr>';
    $html .= '<td>' . ($key + 1) . '</td>';
    $html .= '<td>' . $item['customer_name'] . '</td>';
    $html .= '<td>' . $item['customer_phone'] . '</td>';
    $html .= '<td>' . $item['customer_email'] . '</td>';
    $html .= '<td>' . $item['peoples'] . '</td>';
    $html .= '<td>' . date('Y-m-d H:i', strtotime($item['booking_date'])) . '</td>';
    $html .= '<td>' . $item['customer_request'] . '</td>';
    $html .= '<td>' . $item['booked_table'] . '</td>';
    $html .= '</tr>';
  }
  $html .= '</tbody>';
  $html .= '</table>';

  // Write the HTML table into the PDF
  $pdf->writeHTML($html, true, false, true, false, '');

  // Close and output PDF document
  $pdf->Output('confirmed_bookings.pdf', 'D'); // 'D' for download
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Confirmed Bookings</title>
</head>

<body>
  <form method="post">
    <button type="submit" name="download_pdf">Download PDF</button>
  </form>
</body>

</html> -->
















<!-- ---------------------------------------------------------------------------------------------- -->


<!-- <!DOCTYPE html>
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

<php

include '../database/db_config.php';

$all_items = array();

$select_stmt = $conn->prepare("SELECT * FROM tbl_reservations WHERE booked_table IS NOT NULL");

$select_stmt->execute();
$result = $select_stmt->get_result();

if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $all_items[] = $row;
  }
}

$select_stmt->close();
$conn->close();

?>





<body>
  <h1 style='color:orange; text-align:center'>Confirmed Bookings</h1>
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
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    for ($i = 0; $i < count($all_items); $i++) {
                      $item = $all_items[$i];
                    ?>
                      <tr>
                        <td class="text-black"><?php echo $i + 1; ?></td>
                        <td class="text-black"><?php echo $item['customer_name']; ?></td>
                        <td class="text-black"><?php echo $item['customer_phone']; ?></td>
                        <td class="text-black"><?php echo $item['customer_email']; ?></td>
                        <td class="text-black"><?php echo $item['peoples']; ?></td>
                        <td class="text-black"><?php echo date('Y-m-d H:i', strtotime($item['booking_date'])); ?></td>
                        <td class="text-black"><?php echo $item['customer_request']; ?></td>
                        <td class="text-black"><?php echo $item['booked_table']; ?></td>
                      </tr>
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


</html> -->