<?php
$page_title = "Create Loan";
include_once $_SERVER['DOCUMENT_ROOT'] . '/bdpa-loans/web-assets/tpl/app_header.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/bdpa-loans/web-assets/tpl/app_nav.php';

//Checks to see if the person has at least one reference.
$customer_id = $_SESSION['customer_id'];
$reference_check_sql = <<<SQL
  SELECT * FROM customer_references WHERE customer_id = "$customer_id";
SQL;
$reference_check_result = $dbh->query($reference_check_sql);
if ($reference_check_result->num_rows > 0) {
  //Continue with the page.
} else {
  header("Location: references.php");
}
?>


        <div class="card my-4 mx-4">
            <div class="card-header">Take Out A Loan</div>
            <div class="card-body">
                <form action="/bdpa-loans/index.php?action=loanapp" method="post">
                    <!--Type-->
                    <div class="form-group row">
                        <label for="username" class="col-sm-3">Loan Type</label>
                        <select name="loantype" class="form-control col-sm-9" style="float:right">
                            <option value="A">Automobile</option>
                            <option value="H">Home</option>
                            <option value="M">Motorcycle</option>
                            <option value="B">Boat</option>
                            <option value="S">Student Loans</option>
                        </select>
                    </div>
                    <!--Amount-->
                    <div class="form-group row">
                        <label for="username" class="col-sm-3">Loan Amount</label>
                        <input type="number" class="form-control col-sm-9" name="amount">
                    </div>
                    <!--Loan Length-->
                    <div class="form-group row">
                        <label for="loanlength" class="col-sm-3">Months to Pay Loan</label>
                        <input type="number" class="form-control col-sm-9" name="loanlength" id="loanlength">
                    </div>
                    <br/>
                    <!-- Optional Add-ons for a loan -->
                    <!-- extended warranty -->
                    <div class="form-group row">
                        <input type="checkbox" class="form-control col-sm-9" name="ew" id="ew">Extended Warranty
                    </div>
                    <!-- payoff insurance -->
                    <div class="form-group row">
                        <input type="checkbox" class="form-control col-sm-9" name="pi" id="pi">Payoff Insurance
                    </div>
                    <!-- Monthly Payment Insurance -->
                    <div class="form-group row">
                        <input type="checkbox" class="form-control col-sm-9" name="mi" id="mi">Monthly Payment Insurance
                    </div>

                    <button class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>

    </body>
</html>
