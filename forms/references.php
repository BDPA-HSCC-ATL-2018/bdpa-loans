<?php
$page_title = "Customer References";
include_once $_SERVER['DOCUMENT_ROOT'] . '/bdpa-loans/web-assets/tpl/app_header.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/bdpa-loans/web-assets/tpl/app_nav.php';

//Checks to see if the person has at least one reference.
$customer_id = $_SESSION['customer_id'];
$reference_check_sql = <<<SQL
  SELECT * FROM customer_references WHERE customer_id = "$customer_id";
SQL;
$reference_check_result = $dbh->query($reference_check_sql);
if ($reference_check_result->num_rows > 0) {
  //Continue with the page.
} else {
  echo "<div class='alert alert-info my-4' role='alert'>Add at least one customer reference below:</div>";
}
?>
<h1><?php echo $page_title ?></h1>
        <div class="card my-4 border-info">

            <div class="card-header">Customer References</div>
            <div class="card-body">
                <form action="/bdpa-loans/index.php?action=references" method="post">
                    <!--First Name-->
                    <div class="form-group row">
                        <label for="ref_first_name" class="col-sm-3">First Name</label>
                        <input type="text" class="form-control col-sm-9" name="ref_first_name" required>
                    </div>
                    <!--Last Name-->
                    <div class="form-group row">
                        <label for="ref_last_name" class="col-sm-3">Last Name</label>
                        <input type="text" class="form-control col-sm-9" name="ref_last_name" required>
                    </div>
                    <!--Telephone-->
                    <div class="form-group row">
                        <label for="ref_phone" class="col-sm-3">Phone</label>
                        <input type="text" class="form-control col-sm-9" name="ref_phone" required>
                    </div>
                    <!--Address-->
                    <div class="form-group row">
                        <label for="address_line_one" class="col-sm-3">Address</label>
                        <input type="text" class="form-control col-sm-9" name="address_line_one" required>
                    </div>
                    <!--City-->
                    <div class="form-group row">
                        <label for="city_name" class="col-sm-3">City</label>
                        <input type="text" class="form-control col-sm-9" name="city_name" required>
                    </div>
                    <!--State-->
                    <div class="form-group row">
                        <label for="state_cd" class="col-sm-3">State</label>
                        <input type="text" class="form-control col-sm-9" name="state_cd" required>
                    </div>
                    <!--Zip-->
                    <div class="form-group row">
                        <label for="postal_cd" class="col-sm-3">Zip Code</label>
                        <input type="text" class="form-control col-sm-9" name="postal_cd" required>
                    </div>

                    <div class="form-group row">
                      <div class= "col-md-6">
                        <button type="submit" class="btn btn-lg btn-primary">Add Reference</button>
                      </div>
                    </div>
            </div>
        </div>
<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . '/web-assets/tpl/app_footer.php';
?>
