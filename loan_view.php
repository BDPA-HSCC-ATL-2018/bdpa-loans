<?php
    $page_title = "Loan Board";
    include_once $_SERVER['DOCUMENT_ROOT'] . '/bdpa-loans/web-assets/tpl/app_header.php';
    include_once $_SERVER['DOCUMENT_ROOT'] . '/bdpa-loans/web-assets/tpl/app_nav.php';
    if (!isset($_SESSION['customer_id'])) {
      header("Location: forms/signup.php");
    }
?>
<html>
<head>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

  <style >
  body {
padding-top: 54px;
}

@media (min-width: 992px) {
body {
  padding-top: 56px;
}
}

.pagination {
margin-bottom: 15px;
}
@media (min-width: 768px)
.col-md-7 {
    -ms-flex: 0 0 58.333333%;
    flex: 0 0 58.333333%;
    max-width: 58.333333%;
}
@media (min-width: 768px)
.col-md-5 {
    -ms-flex: 0 0 41.666667%;
    flex: 0 0 41.666667%;
    max-width: 41.666667%;
}

  </style>
</head>
<body>

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
            select loan_type_image from loan_types where loan_type_cd = 'S';
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
      <div class='row'>
        <div class='col-md-7' style='width: 390px; height:263px'>
          <img src='data:image/jpeg;base64,$img' class='img-fluid rounded mb-3 mb-md-0'>
        </div>
        <div class='col-md-5' style='width: 270px; height: 263px;'>
          <h3>" . $row['loan_type_cd'] . " Loan" ."</h3>
          <p>
          Amount: $" . round($row['loan_amount'] , 2) . "<br>
            Months to Pay: " . $row['loan_term_months']. "<br>
            Monthly Payment: $" . round($row['monthly_payment'] , 2) . "<br>
            Interest Rate: " . $row['interest_rate'] . "<br></p>
          <a class='btn btn-primary' href='edit_loan.php'>Edit Loan</a>

        </div>
      </div>
      <hr></hr>
  ";
      echo $echo_statement;
      if ($new_row % 4 == 2) {
        echo "</div>"
        echo "<div class='alert alert-info my-4'>You have loans</div>";
      }
      $new_row++;
    } //End of While Loop
  } else {
    echo "<div class='alert alert-info my-4'>You currently have no loans.</div>";
  }

?>
<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . '/bdpa-loans/web-assets/tpl/app_footer.php';
?>
</body>
</html>
