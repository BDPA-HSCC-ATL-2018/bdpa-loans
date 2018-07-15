<?php
$page_title = "Dashboard";
include_once $_SERVER['DOCUMENT_ROOT'] . '/bdpa-loans/web-assets/tpl/app_header.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/bdpa-loans/web-assets/tpl/app_nav.php';
?>


<div class="col-md-9" style="float: left;">
  <a class="btn btn-primary mx-4" href="/bdpa-loans/forms/references.php">Add Reference</a>
  <a class="btn btn-primary" href="/bdpa-loans/forms/loanapp_f.php">Create Loan</a>
  <?php
  global $dbh;
    $email = $_SESSION['email'];
    $cust_id = $_SESSION['customer_id'];
    $sql = <<<SQL
      SELECT * FROM loan_application WHERE customer_id = $cust_id;
SQL;

    $result = $dbh->query($sql);

    if ($result->num_rows > 0) {
      $i = 1;
      while($row = $result->fetch_assoc()) {
        $echo_statement =
        "<div class='card my-4'>
        <div class='card-header'>Loan " . $i . "</div>
        <div class='card-body'>
        Amount: " . $row['loan_amount'] . "<br>
        Months to Pay: " . $row['loan_term_months']. "<br>
        Interest Rate: " . $row['interest_rate'] . "<br>
        </div>
        </div>
        <br>";
      }
      echo $echo_statement;
      $i++;
    } else {
      echo "<div class='alert alert-info my-4'>You currently have no loans.</div>";
    }

  ?>
</div>

<div class="col-md-3" style="float: right">
  <div class="card">
    <div class="card-header">Personal Information</div>
    <div class="card-body">
      <?php
        $personal_sql = <<<SQL
          SELECT * FROM customers WHERE customer_id = $cust_id;
SQL;
        $personal_result = $dbh->query($personal_sql);

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

      ?>
    </div>
  </div>
</div>
