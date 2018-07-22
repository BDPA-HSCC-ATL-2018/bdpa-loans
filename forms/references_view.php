<?php
  $page_title = "Reference View";
  include_once = $_SERVER['DOCUMENT_ROOT'] . '/bdpa-loans/web-assets/tpl/app_header.php';
  include_once = $_SERVER['DOCUMENT_ROOT'] . '/bdpa-loans/web-assets/tpl/app_nav';
  ?>
  <?php
  global $dbh;
    $email = $_SESSION['email'];
    $cust_id = $_SESSION['customer_id'];
    $sql = <<<SQL
      SELECT * FROM loan_application WHERE customer_id = $cust_id;
SQL;

    $result = $dbh->query($sql);

    if ($result->num_rows > 0) {
      $new_row = 0;
      while($row = $result->fetch_assoc()) {
        if ($new_row % 4 == 0) {
          echo "<div class='row'>";
        }
?>

<div class="col-md-10">
  <div class="card">
    <div class="card-header">Reference</div>
    <div class="card-body">
      <p class="card-text font-weight-bold">
      <?php
        $view_ref_sql = <<<SQL
          SELECT * FROM reference WHERE customer_id = $cust_id;
SQL;
        $ref_result = $dbh->query($view_ref_sql);

        $ref_row = 0;
        if ($ref_result) {
          while ($row = $ref_result->fetch_assoc()) {
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
