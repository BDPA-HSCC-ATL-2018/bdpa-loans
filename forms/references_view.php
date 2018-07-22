<?php
  $page_title = "Reference View";
  include_once $_SERVER['DOCUMENT_ROOT'] . '/bdpa-loans/web-assets/tpl/app_header.php';
  include_once $_SERVER['DOCUMENT_ROOT'] . '/bdpa-loans/web-assets/tpl/app_nav.php';
  ?>
<div class="col-md-10">

      <?php

      $cust_id = $_SESSION['customer_id'];
        $view_ref_sql = <<<SQL
          SELECT * FROM customer_references WHERE customer_id = $cust_id;
SQL;
        $ref_result = $dbh->query($view_ref_sql);

        $ref_row = 0;
        if ($ref_result) {
          while ($row = $ref_result->fetch_assoc()) {
            $ref_echo = "
            <div class='card'>
                <div class='card-header'>Reference</div>
                <div class='card-body'>
                  <p class='card-text font-weight-bold'>
            Name: " . $row['ref_first_name'] . " " . $row['ref_last_name'] . "<br><br>
            Street Address: " . $row['address_line_one'] . "<br><br>
            City: " . $row['city_name'] . "<br><br>
            State: " . $row['state_cd'] . "<br><br>
            Zip Code: " . $row['postal_cd'] . "<br><br>
            </div>
          </div>  
            ";
            echo $ref_echo;
          }

        }
          ?>
