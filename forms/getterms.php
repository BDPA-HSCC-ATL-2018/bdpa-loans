<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/bdpa-loans/db.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/bdpa-loans/web-assets/tpl/app_header.php';

$q = $_REQUEST['q'];

$sql = <<<SQL
  SELECT loan_term_months from loan_interest_terms WHERE loan_type_cd = "$q";
SQL;

$result = $dbh->query($sql);

if($result) {
  echo "<select class='form-control col-sm-4' name='loanlength'>";
  while ($row = $result->fetch_assoc()) {
    $value = $row['loan_term_months'];
    echo "<option value=\"$value\">$value</option>";
  }
echo "</select>";
}
include_once $_SERVER['DOCUMENT_ROOT'] . '/bdpa-loans/web-assets/tpl/app_footer.php';
?>
