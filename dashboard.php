<?php
$page_title = "Dashboard";
include_once $_SERVER['DOCUMENT_ROOT'] . '/bdpa-loans/web-assets/tpl/app_header.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/bdpa-loans/web-assets/tpl/app_nav.php';

if (!isset($_SESSION['customer_id'])) {
  header("Location: forms/signup.php");
}
?>

<div class="col-md-9" style="float: left;">
  <a class="btn btn-primary mx-4" href="/bdpa-loans/forms/references.php">Add Reference</a>
  <a class="btn btn-primary" href="/bdpa-loans/forms/loanapp_f.php">Create Loan</a>
  <br>
  <br>
  <div class='card-deck' style="float: left;">

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
        switch ($row['loan_type_cd']) {
          case 'A':
      			$img_sql = <<<SQL
      				select loan_type_image from loan_types where loan_type_cd = 'A';
SQL;
      			$img_result = $dbh->query($img_sql);
      			$img_row = $img_result->fetch_assoc();
      			$img = base64_encode($img_row['loan_type_image']);
                  $row['loan_type_cd'] = "Automobile";
                  break;
          case 'H':
      		  $img_sql = <<<SQL
      				select loan_type_image from loan_types where loan_type_cd = 'H';
SQL;
      			$img_result = $dbh->query($img_sql);
      			$img_row = $img_result->fetch_assoc();
      			$img = base64_encode($img_row['loan_type_image']);
                  $row['loan_type_cd'] = "House";
                  break;
          case 'M':
      		  $img_sql = <<<SQL
      				select loan_type_image from loan_types where loan_type_cd = 'M';
SQL;
      			$img_result = $dbh->query($img_sql);
      			$img_row = $img_result->fetch_assoc();
      			$img = base64_encode($img_row['loan_type_image']);
                  $row['loan_type_cd'] = "Motorcycle";
                  break;
          case 'B':
      		  $img_sql = <<<SQL
      				select loan_type_image from loan_types where loan_type_cd = 'B';
SQL;
      			$img_result = $dbh->query($img_sql);
      			$img_row = $img_result->fetch_assoc();
      			$img = base64_encode($img_row['loan_type_image']);
                  $row['loan_type_cd'] = "Boat";
                  break;
          case 'S':
      		  $img_sql = <<<SQL
      				select loan_type_image from loan_types where loan_type_cd = 'A';
SQL;
      			$img_result = $dbh->query($img_sql);
      			$img_row = $img_result->fetch_assoc();
      			$img = base64_encode($img_row['loan_type_image']);
                  $row['loan_type_cd'] = "Student";
                  break;
          default:
            $row['loan_type_cd'] = "Unidentified Loan";
            break;
        }
        $echo_statement =
        "
        <div class='card'>
          <img src='data:image/jpeg;base64,$img' class='card-img-top' style='max-width:300px;'>
          <div class='card-body'>" . $row['loan_type_cd'] . " Loan" ."<br>
            Amount: $" . round($row['loan_amount'] , 2) . "<br>
            Months to Pay: " . $row['loan_term_months']. "<br>
            Monthly Payment: $" . round($row['monthly_payment'] , 2) . "<br>
            Interest Rate: " . $row['interest_rate'] . "<br>
          </div>
        </div>
        <br>";
        echo $echo_statement;
        $i++;
      }
    } else {
      echo "<div class='alert alert-info my-4'>You currently have no loans.</div>";
    }

  ?>
  </div>
</div>

<div class="col-md-3" style="float: right">
  <div class="card">
    <div class="card-header">Personal Information</div>
    <div class="card-body">
      <p class="card-text font-weight-bold">
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

      ?></p>
    </div>
  </div>
</div>
