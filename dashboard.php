<?php
session_start();
$page_title = "Dashboard";
include_once $_SERVER['DOCUMENT_ROOT'] . '/web-assets/tpl/app_header.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/web-assets/tpl/app_nav.php';
?>
<div class="col-md-10">
  <?php
  global $dbh;
    $email = $_SESSION['email'];
    $sql = <<<SQL
      SELECT * FROM loan_application WHERE email_id = "$email";
SQL;
    $result = $dbh->query($sql);

    //Get loans from customer.
    $i = 1;
    while($row = $result->fetch_assoc()) {
      $echo_statement = <<<ECHO
        "<div class='card'>
          <div class='card-header'>Loan . " $i . "</div>
          <div class='card-body'>
            //TODO Add loan type.
            Amount: " . "<br>
            Months to Pay: " . "<br>
            Interest Rate: " . "<br>
          </div>
        </div>"
ECHO;

    echo $echo_statement;
    $i++;
    }
  ?>
</div>

<div class="col-md-2">
</div>
