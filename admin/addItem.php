<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Food Item</title>
</head>

<?php
if (empty($_SESSION['name'])) {
  header("Location: login.php");
}
?>

<body>
  <?php $temp_id = ""; ?>
  <div class="container-fluid px-1 py-5 mx-auto">
    <div class="row d-flex justify-content-center">
      <div class="col-xl-7 col-lg-8 col-md-9 col-11 ">
        <h1 class="text-center mb-4">Add Food Item In Menu</h1>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
          <input type="hidden" name="id" value="<?php echo $temp_id ? $temp_id : "" ?>">
          <div class="row justify-content-between text-left mb-4">
            <div class="form-group col-sm-6 flex-column d-flex">
              <label class="form-control-label px-3">Name<span class="text-danger"> *</span></label>
              <input type="text" name="name" required>
            </div>
            <div class="form-group col-sm-6 flex-column d-flex">
              <label class="form-control-label px-3">Price<span class="text-danger"> *</span></label>
              <input type="number" name="price" required>
            </div>
          </div>
          <div class="row justify-content-between text-left mb-4">
            <div class="form-group col-sm-6 flex-column d-flex">
              <label class="form-control-label px-3">Meal<span class="text-danger"> *</span></label>
              <select name="type_of_meal" required>
                <option value="Snacks">Snacks</option>
                <option value="Breakfast">Breakfast</option>
                <option value="Lunch">Lunch</option>
                <option value="Dinner">Dinner</option>
                <option value="Desserts">Desserts</option>
              </select>
            </div>
            <div class="form-group col-sm-6 flex-column d-flex">
              <label class="form-control-label px-3">Cuisine<span class="text-danger"> *</span></label>
              <select name="type_of_cuisine" required>
                <option value="Indian">Indian Cuisine</option>
                <option value="Italian">Italian Cuisine</option>
                <option value="French">French Cuisine</option>
                <option value="Chinese">Chinese Cuisine</option>
                <option value="Japanese">Japanese Cuisine</option>
                <option value="Thai">Thai Cuisine</option>
                <option value="Mexican">Mexican Cuisine</option>
                <option value="Korean">Korean Cuisine</option>
              </select>
            </div>
          </div>
          <div class="row justify-content-between text-left mb-4">
            <div class="form-group col-sm-6 flex-column d-flex">
              <label class="form-control-label px-3">Vegetarian<span class="text-danger"> *</span></label>
              <div class="d-flex gap-5">
                <div class="">
                  <input type="radio" name="vegetarian" value="1" required>
                  <label for="yes">Yes</label>
                </div>
                <div class="">
                  <input type="radio" name="vegetarian" value="0">
                  <label for="no">No</label>
                </div>
              </div>
            </div>
            <div class="form-group col-sm-6 flex-column d-flex">
              <!-- <label class="form-control-label px-3">Select Image<span class="text-danger"> *</span></label> -->
              <!-- <input type="file" name="image" required> -->
              <label class="form-control-label px-3">Image Url<span class="text-danger"> *</span></label>
              <input type="text" name="image" required>
            </div>
          </div>
          <div class="row justify-content-between text-left mb-4">
            <div class="form-group col-12 flex-column d-flex">
              <label class="form-control-label px-3">Description<span class="text-danger"> *</span></label>
              <textarea required name="description" id=""></textarea>
            </div>
          </div>
          <div class="row">
            <div class="form-group col-sm-12 flex-column d-flex">
              <input class="btn btn-primary py-2 px-4" type="submit" value="Add" name="action">
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>




</body>

</html>