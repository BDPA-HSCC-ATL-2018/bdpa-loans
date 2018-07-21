<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="/bdpa-loans/dashboard.php">Loan Application</a>

  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="dashboard.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="references.php">References</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Profile
        </a>
  <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
    <a class="dropdown-item">
  <?php
  $cust_id = $_SESSION['customer_id'];
$display_sql = <<<SQL
SELECT * FROM customers WHERE customer_id = $cust_id;
SQL;
$display_result = $dbh->query($display_sql);

if ($display_result) {
while ($row = $display_result->fetch_assoc()) {
  $display_echo = "
  Name: " . $row['first_name'] . " " . $row['last_name'] . "
";
}
echo $display_echo;
}


   ?>
 </a>
       <a class="dropdown-item"><?php
         if (isset($_SESSION['customer_id'])) {
           echo "<a class='btn btn-secondary my-2 my-sm-0' href='/bdpa-loans/index.php?action=logout' style='position: absolute; right: 20px'>Logout</a>";
         }
       ?>
     </a>
       </div>
    <form class="form-inline my-2 my-lg-0">

    </form>
  </div>
</nav>
<div class="container">
  <br>
