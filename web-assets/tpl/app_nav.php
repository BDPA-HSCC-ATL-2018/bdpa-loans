<?
//An attempt to get a logged-in name on the navbar.

/*if (isset($_SESSION['first_name']) && isset($_SESSION['last_name'])) {
    $logged_in_text = $_SESSION['first_name'] . " " . $_SESSION['last_name'];
  } else {
    $logged_in_text = "";
  }*/
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="/../../dashboard.php">Loan Application</a>
  <a class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" href="/bdpa-loans/index.php?action=logout">
    <span class="navbar-toggler-icon"></span>
  </button>

  <!-- <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      Dropdown
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#">Disabled</a>
      </li>
    </ul> -->
    <form class="form-inline my-2 my-lg-0">
      <a class="btn btn-secondary my-2 my-sm-0" href="index.php?action=destroy" style="position: absolute; right: 20px">Logout</a>
    </form>
  </div>
</nav>
<div class="container">
  <br>
