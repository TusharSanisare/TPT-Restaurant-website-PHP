<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>

  <?php
  $services = array(
    "Master Chefs" => "Meet our master chefs, culinary wizards who turn ingredients into works of art, delighting your taste buds with every dish they create.",
    "Quality Food" => "We ensure the use of high-quality products & ingredients to provide our customers with a first-class gourmet food experience.",
    "Online Order" => "Order online effortlessly! Browse our menu and place your order from anywhere, anytime, for a hassle-free dining experience.",
    "24/7 Service" => "Enjoy our service 24/7 for your convenience, ensuring that you can satisfy your cravings whenever they strike.",
    "Relaxed Atmosphere" => "Unwind in our relaxed atmosphere, where every visit feels like a retreat from the hustle and bustle of daily life, allowing you to savor every moment.",
    "Fast Delivery" => "Experience swift and efficient delivery services, ensuring that your favorite dishes reach you hot and fresh, wherever you are.",
    "Custom Catering" => "Let us cater to your special events! Our custom catering services ensure that every occasion is filled with delicious food and memorable moments.",
    "Health Conscious Options" => "Explore our range of health-conscious options, carefully crafted to satisfy your cravings while keeping your well-being in mind.",
    "Family-Friendly Atmosphere" => "Bring the whole family! Our family-friendly atmosphere welcomes guests of all ages, ensuring everyone enjoys a delightful dining experience.",
    "Seasonal Specials" => "Indulge in our seasonal specials, featuring fresh, locally sourced ingredients that capture the essence of each season, delivering a burst of flavor with every bite."
  );

  $current_page = basename($_SERVER['PHP_SELF']);
  $service_to_show = 0;

  if ($current_page == "index.php") {
    $service_to_show = 4;
  } else {
    $service_to_show = sizeOf($services);
  }


  ?>

  <div class="container-xxl py-5">
    <div class="container">
      <div class="row g-4">

        <?php
        foreach ($services as $x => $y) {
        ?>
          <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.3s">
            <div class="service-item rounded pt-3">
              <div class="p-4">
                <i class="fa fa-3x fa-headset text-primary mb-4"></i>
                <h5><?php echo $x ?></h5>
                <p><?php echo $y ?></p>
              </div>
            </div>
          </div>
        <?php
          if ($service_to_show == 1) {
            break;
          } else {
            $service_to_show--;
          }
        }
        ?>

        <!-- <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
          <div class="service-item rounded pt-3">
            <div class="p-4">
              <i class="fa fa-3x fa-user-tie text-primary mb-4"></i>
              <h5>Master Chefs</h5>
              <p>Meet our master chefs, culinary wizards who turn ingredients into works of art, delighting your taste buds with every dish they create.</p>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.3s">
          <div class="service-item rounded pt-3">
            <div class="p-4">
              <i class="fa fa-3x fa-utensils text-primary mb-4"></i>
              <h5>Quality Food</h5>
              <p>We ensure the use high- quality products & ingredients to provide our customers with first class gourmet food experience .</p>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.5s">
          <div class="service-item rounded pt-3">
            <div class="p-4">
              <i class="fa fa-3x fa-cart-plus text-primary mb-4"></i>
              <h5>Online Order</h5>
              <p>Order online effortlessly! Browse our menu and place your order from anywhere, anytime, for a hassle-free dining experience.</p>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.7s">
          <div class="service-item rounded pt-3">
            <div class="p-4">
              <i class="fa fa-3x fa-headset text-primary mb-4"></i>
              <h5>24/7 Service</h5>
              <p>Enjoy our service 24/7 for your convenience, ensuring that you can satisfy your cravings whenever they strike.</p>
            </div>
          </div>
        </div> -->
      </div>
    </div>
  </div>
</body>

</html>