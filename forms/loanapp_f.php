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

<!-- This code allows the user to view all the loan terms for each loan type (Ajax code) -->
<script>
function termloan() {
  var str = document.getElementById("dropdown").value; //Get the value of the loan-type dropdown.
  if (str == "") { //If the string isn't equal to anything, set the element with loanl (the div above) to nothing.
    document.getElementById("loanl").innerHTML = "";
    return;
  } else {
    if (window.XMLHttpRequest) {
      xmlhttp = new XMLHttpRequest(); //Create a new XMLHttpRequest object and store it in xmlhttp.
    }
  }
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) { //If the website is prepared
      document.getElementById("loanl").innerHTML = this.responseText; //Set loanl equal to the response we get from the website. The response we get is equal to whatever the website puts out. In this case, it's the echo statements we have.
    }
  };
  xmlhttp.open("GET","getterms.php?q="+str,true); //This is like our form in HTML. We have our method, action, and then set the last one to true (I think it's asynchronicity. (I don't know if that's a word.)).
  xmlhttp.send();
}
</script>

        <div class="card my-4 mx-4">
            <div class="card-header">Take Out A Loan</div>
            <div class="card-body">
                <form action="/bdpa-loans/index.php?action=loanapp" method="post">
                    <!--Type-->
                    <div class="form-group row">
                        <label for="username" class="col-sm-3">Loan Type</label>
                        <select name="loantype" class="form-control col-sm-9" style="float:right" onchange="termloan()" id="dropdown" value="A">
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
                    <div class="form-group row" id="loanl">

                    </div>
                    <br/>
                    <!-- Optional Add-ons for a loan -->
                    <!-- extended warranty -->

                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <label class="input-group-text" for="loanaddon">Extended Warranty</label>
                      </div>
                      <select class="custom-select" id="ew">
                        <option selected>Choose</option>
                        <option value="y">Yes</option>
                        <option value="n">No</option>
                      </select>
                    </div>
                    <!-- payoff insurance -->

                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <label class="input-group-text" for="loanaddon">Payoff Insurance</label>
                      </div>
                      <select class="custom-select" id="pi">
                        <option selected>Choose</option>
                        <option value="y">Yes</option>
                        <option value="n">No</option>
                      </select>
                    </div>
                    <!-- Monthly Payment Insurance -->

                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <label class="input-group-text" for="loanaddon">Monthly Payment Insurance</label>
                      </div>
                      <select class="custom-select" id="mi">
                        <option selected>Choose</option>
                        <option value="y">Yes</option>
                        <option value="n">No</option>
                      </select>
                    </div>

                    <button class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>

        <script>
          termloan();
        </script>
    </body>
</html>
