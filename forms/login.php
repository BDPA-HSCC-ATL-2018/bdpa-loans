<?php
$page_title = "Log In";
include_once $_SERVER['DOCUMENT_ROOT'] . '/web-assets/tpl/app_header.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/web-assets/tpl/app_nav.php';
?>
<h1><?php echo $page_title ?></h1>

<form id="login" method="post" action="/bdpa-loans/" class="needs-validation" novalidate>

  <div class="card border-info">
    <div class="card-header">Log In</div>
    <div class="card-body">
      <div class="alert alert-info">Please enter your email and password to log in</div>
      <div class="form-group row">
        <label for="email_id" class="col-sm-2">Email</label>
        <div class= "col-md-6">
          <input type="email" class="form-control" id="email_id" name="email_id" required>
        </div>
      </div>
      <div class="form-group row">
        <label for="pw" class="col-sm-2">Password</label>
        <div class= "col-md-6">
          <input type="password" class="form-control" id="pw" name="pw" required>
        </div>

      </div>

      <div class="form-group row">
        <div class= "col-md-6">
          <input type="hidden" name="action" value="login">
          <button type="submit" class="btn btn-lg btn-primary">Login</button>
        </div>
      </div>
    </div>
  </div>
</form>
