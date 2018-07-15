<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="/bdpa-loans/dashboard.php">Loan Application</a>
  <a class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" href="/bdpa-loans/index.php?action=logout"></a>

    <form class="form-inline my-2 my-lg-0">
      <?php
        if (isset($_SESSION['customer_id'])) {
          echo "<a class='btn btn-secondary my-2 my-sm-0' href='/bdpa-loans/index.php?action=logout' style='position: absolute; right: 20px'>Logout</a>";
        }
      ?>
    </form>
  </div>
</nav>
<div class="container">
  <br>
