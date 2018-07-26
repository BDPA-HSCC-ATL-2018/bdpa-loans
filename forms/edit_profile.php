<?php
  $page_title = "Edit Profile";
  include_once $_SERVER['DOCUMENT_ROOT'] . "/bdpa-loans/web-assets/tpl/app_header.php";
  include_once $_SERVER['DOCUMENT_ROOT'] . "/bdpa-loans/web-assets/tpl/app_nav.php";

  $customer_id = $_SESSION['customer_id'];

  $profile_sql = <<<SQL
    SELECT * FROM customers WHERE customer_id = $customer_id;
SQL;

  $profile_result = $dbh->query($profile_sql);

  if ($profile_result) {
    while ($profile_row = $profile_result->fetch_assoc()) {
      $email_id = $profile_row['email_id'];
      $first_name = $profile_row['first_name'];
      $last_name = $profile_row['last_name'];
      $address_line_one = $profile_row['address_line_one'];
      $city_name = $profile_row['city_name'];
      $state_cd = $profile_row['state_cd'];
      $postal_cd = $profile_row['postal_cd'];
      $pri_phone = $profile_row['pri_phone'];
      $alt_phone = $profile_row['alt_phone'];
      $employer_name = $profile_row['employer_name'];
      $annual_income = $profile_row['annual_income'];
    }

  } else {
    mysqli_error($dbh);
  }
?>

<div class="card my-4 mx- border-info">

    <div class="card-header">Edit Profile</div>
    <div class="card-body">
        <form action="/bdpa-loans/index.php?action=editprofile" method="post">
            <!--Email-->
            <div class="form-group row">
                <label for="email" class="col-sm-3">Email</label>
                <input type="email" class="form-control col-sm-9" name="email_id" value="<?php echo $email_id ?>" required>
            </div>
            <!--First Name-->
            <div class="form-group row">
                <label for="username" class="col-sm-3">First Name</label>
                <input type="text" class="form-control col-sm-9" name="fname" value="<?php echo $first_name ?>" required>
            </div>
            <!--Last Name-->
            <div class="form-group row">
                <label for="username" class="col-sm-3">Last Name</label>
                <input type="text" class="form-control col-sm-9" name="lname" value="<?php echo $last_name ?>" required>
            </div>
            <!--Address-->
            <div class="form-group row">
                <label for="username" class="col-sm-3">Address</label>
                <input type="text" class="form-control col-sm-9" name="address" value="<?php echo $address_line_one ?>" required>
            </div>
            <!--City-->
            <div class="form-group row">
                <label for="username" class="col-sm-3">City</label>
                <input type="text" class="form-control col-sm-9" name="city" value="<?php echo $city_name ?>" required>
            </div>
            <!--State-->
            <div class="form-group row">
                <label for="username" class="col-sm-3">State</label>
                <input type="text" class="form-control col-sm-9" name="state" value="<?php echo $state_cd ?>" required>
            </div>
            <!--Zip-->
            <div class="form-group row">
                <label for="username" class="col-sm-3">Zip Code</label>
                <input type="text" class="form-control col-sm-9" name="zip" value="<?php echo $postal_cd ?>" required>
            </div>
            <!--Telephone-->
            <div class="form-group row">
                <label for="username" class="col-sm-3">Telephone</label>
                <input type="text" class="form-control col-sm-9" name="telephone" value="<?php echo $pri_phone ?>" required>
            </div>
            <!--Cell Phone-->
            <div class="form-group row">
                <label for="username" class="col-sm-3">Cell Phone</label>
                <input type="text" class="form-control col-sm-9" placeholder="###-###-####" name="cellphone" value="<?php echo $alt_phone ?>" required>
            </div>
            <!--Company-->
            <div class="form-group row">
                <label for="username" class="col-sm-3">Company</label>
                <input type="text" class="form-control col-sm-9" name="company" value="<?php echo $employer_name ?>" required>
            </div>
            <!--Yearly Salary-->
            <div class="form-group row">
                <label for="username" class="col-sm-3">Yearly Salary</label>
                <input type="text" class="form-control col-sm-9" name="yearlysalary" value="<?php echo $annual_income ?>" required>
            </div>
            <div class="form-group row">
              <div class= "col-md-6">
                <button type="submit" class="btn btn-lg btn-primary">Edit Profile</button>
              </div>
            </div>
    </div>
</div>
