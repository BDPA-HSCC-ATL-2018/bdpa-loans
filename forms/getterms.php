<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/bdpa-loans/db.php';

$q = $_REQUEST['q'];

$sql = <<<SQL
  SELECT loan_term_months from loan_interest_terms WHERE loan_type_cd = "$q"
SQL;

$result = $dbh->query($sql);

if($result) {
  echo "<select name='loanlength'>";
  while ($row = $result->fetch_assoc()) {
    $value = $row['loan_term_months'];
    echo "<option value=\"$value\">$value</option>";
  }
echo "</select>";
}

?>
