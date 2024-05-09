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

<style>
  body {
    width: 100%;
    height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #fff;
  }

  .form-div {
    /* background-color: whitesmoke; */
    padding: 20px;
    border-radius: 3px;
    border: 1px solid gray;


  }

  .input {
    margin-bottom: 5px;
    width: 300px;
    height: 40px;
  }

  .btn {
    background: orange;
    color: white;
  }
</style>

<?php
$error = null;
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $name = $_POST["name"];
  $email = $_POST["email"];
  $password = $_POST["password"];

  if ($name == 'admin' && $email == 'admin@gmail.com' && $password == '123') {
    session_start();
    $_SESSION["name"] = "admin";
    header("Location: index.php");
  } else {
    $error = "<p style='color:red'>Wrong information... try again!<p/>";
  }
}
?>

<body>

  <div class="">
    <?php
    echo $error ? $error : "";
    ?>

    <form method="post" action="login.php" class="">
      <div class="form-div">
        <h1>Login</h1>
        <div class="">
          <input class="input" type="text" name="name" placeholder="Enter name" required><br>
          <input class="input" type="email" name="email" placeholder="Enter email" required><br>
          <input class="input" type="password" name="password" placeholder="Enter password" required><br><br>
          <input class="btn" type="submit" value="login">
        </div>
      </div>
  </div>

  </form>


</body>

</html>