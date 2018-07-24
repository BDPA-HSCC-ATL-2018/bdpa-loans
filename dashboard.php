<?php
$page_title = "Dashboard";
include_once $_SERVER['DOCUMENT_ROOT'] . '/bdpa-loans/web-assets/tpl/app_header.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/bdpa-loans/web-assets/tpl/app_nav.php';

if (!isset($_SESSION['customer_id'])) {
  header("Location: forms/signup.php");
}
?>


<div class="col-md-6">
  <div class="-static-md-right">
  <a class="btn btn-primary mx-4" href="/bdpa-loans/forms/references.php">Add Reference</a>
  <a class="btn btn-primary" href="/bdpa-loans/forms/loanapp_f.php">Create Loan</a>
  <br>
  <br>
  <div class='card-deck'>
</div>
</div>
</div>

<div class="col-lg-6 postion-static" >
  <div class="card">
    <div class="card-header">Personal Information</div>
    <div class="card-body">
      <p class="card-text font-weight-bold">
      <?php
        $personal_sql = <<<SQL
          SELECT * FROM customers WHERE customer_id = $cust_id;
SQL;
        $personal_result = $dbh->query($personal_sql);

        $new_row = 0;
        if ($personal_result) {
          while ($row = $personal_result->fetch_assoc()) {
            $personal_echo = "
            Name: " . $row['first_name'] . " " . $row['last_name'] . "<br><br>
            Email: " . $row['email_id'] . "<br><br>
            Street Address: " . $row['address_line_one'] . "<br><br>
            City: " . $row['city_name'] . "<br><br>
            State: " . $row['state_cd'] . "<br><br>
            Zip Code: " . $row['postal_cd'] . "<br><br>
            ";
          }
          echo $personal_echo;
          }
      ?></p>
    </div>
  </div>
  </div>
<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . '/bdpa-loans/web-assets/tpl/app_footer.php';
?>
