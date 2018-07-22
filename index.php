<?php
session_start();
include_once $_SERVER['DOCUMENT_ROOT'] . "/bdpa-loans/db.php";

$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : null;

$options = array (
    'signup' => 'signup',
    'login' => 'login',
    'loanapp' => 'loanapp',
    'references' => 'references',
    'logout' => 'logout'
);

if (array_key_exists($action, $options)) {
    $function = $options[$action];
    call_user_func($function);
} else {
    header("Location: forms/login.php");
}

//Valid Password
function validPassword($pw) {
  if (!preg_match_all('$\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])(?=\S*[\W])\S*$', $pw)) {
    return false;
  } else {
    return true;
  }
}

//Sign Up Form
function signup() {
    global $dbh;
    $email = $_REQUEST['email_id'];
    $pw = $_REQUEST['pw']; $pw = password_hash($pw, PASSWORD_DEFAULT);
    $fname = $_REQUEST['fname'];
    $lname = $_REQUEST['lname'];
    $address = $_REQUEST['address'];
    $city = $_REQUEST['city'];
    $state = $_REQUEST['state'];
    $zip = $_REQUEST['zip'];
    $telephone = $_REQUEST['telephone'];
    $cellphone = $_REQUEST['cellphone'];
    $company = $_REQUEST['company'];
    $cust_yr_salary = $_REQUEST['yearlysalary'];

    if (validPassword($pw)) {
      $sql = <<<SQL
      INSERT INTO customers(email_id, login_pw, first_name, last_name, address_line_one, city_name, state_cd, postal_cd, pri_phone, alt_phone, employer_name, annual_income)
      VALUES("$email", "$pw","$fname", "$lname", "$address", "$city", "$state", "$zip", "$telephone", "$cellphone", "$company", $cust_yr_salary);
SQL;

      $result = $dbh->query($sql);

      if ($result) {
        $_SESSION['email'] = $email;

        $customer_id_sql = <<<SQL
        SELECT customer_id FROM customers WHERE email_id = "$email";
SQL;
        $customer_id_result = $dbh->query($customer_id_sql);
        while ($customer_id_row = $customer_id_result->fetch_assoc()) {
          $_SESSION['customer_id'] = $customer_id_row['customer_id'];
        }

        header("Location: dashboard.php");
      } else {
        echo ("It didn't work.") . mysqli_error($dbh);
      }

    }

}

//Login Function
function login() {
    global $dbh;

    $email = $_REQUEST['email_id'];
    $pw = $_REQUEST['pw'];

    $sql = <<<SQL
        SELECT * FROM customers WHERE email_id = "$email";
SQL;

    $result = $dbh->query($sql);

    while ($row = $result->fetch_assoc()) {
        $hashed_pw = $row['login_pw'];
        $before_login_check_id = $row['customer_id'];
        $before_login_check_email = $row['email_id'];
    }

    if (!isset($hashed_pw)) {
      echo "The password was incorrect.";
    }

    if (password_verify($pw, $hashed_pw)) {
        header("Location: dashboard.php"); //Changed to a redirect because refreshing the page would cause issues.
        $_SESSION['customer_id'] = $before_login_check_id;
        $_SESSION['email'] = $before_login_check_email;
    } else {
        header("Location: forms/login.php?alert=wronglogin");
    }
}

//Loan App Function
function loanapp() {
    global $dbh;
    $email = $_SESSION['email'];

    //Get needed info from cust. table
    $cust_sql = <<<SQL
        SELECT customer_id, annual_income FROM customers WHERE email_id = "$email";
SQL;


    $cust_result = $dbh->query($cust_sql);

    if ($cust_result) {
        while ($row = $cust_result->fetch_assoc()) {
            $salary = $row['annual_income'];
            $cust_id = $row['customer_id'];
            $L_Term = $_REQUEST['loanlength'];
        }

    $loantype = $_REQUEST['loantype'];
    $amount = $_REQUEST['amount'];
    $loanterm = $_REQUEST['loanlength'];
    $L_Int = 0;


    $loan_interest_terms_sql = <<<SQL
      SELECT interest_rate FROM loan_interest_terms WHERE loan_type_cd = "$loantype" and loan_term_months = $loanterm;
SQL;

    $loan_interest_terms_result = $dbh->query($loan_interest_terms_sql);


    if ($loan_interest_terms_result) {
      $loan_interest_terms_row = $loan_interest_terms_result->fetch_assoc();
      $L_Int = $loan_interest_terms_row['interest_rate'];
    } else {
      echo mysqli_error($dbh);
    }

    var_dump($loantype);

    switch ("$loantype") {
        case 'A':
          $monthly_I = $amount * (($L_Int / 100) / 12); //Converts the interest rate to a decimal and adds 1 to it.
          $monthly_I_str = number_format($monthly_I, 2);
          $monthly_payment = (($amount / $loanterm) + $monthly_I);
          $monthly_payment_str = number_format($monthly_payment, 2);
          if (!$monthly_payment <= (.50 * $salary)) { //If the monthly payment is greater than half of the salary, the loan cannot be made.
            header("Location: forms/loanapp_f.php?alert=loantoobig&minrequirement=50&monthly_payment=$monthly_payment&loantype=automobile");
          }
            break;
        case 'H':
            if ($amount < (.027 * $salary)) {
              //Then the loan can be made
              $monthly_I = $amount * (($L_Int / 100) / 12); //Converts the interest rate to a decimal and adds 1 to it.
              $monthly_I_str = number_format($monthly_I, 2);
              echo '$monthly_I_str' . $monthly_I_str . '<br></br>';

              echo '$monthly_I: ' . $monthly_I . '<br></br>';
              echo '$L_Int' . $L_Int . '<br></br>';
              $monthly_payment = (($amount / $loanterm) + $monthly_I);
              $monthly_payment_str = number_format($monthly_payment, 2);
              echo '$monthly_payment_str' . $monthly_payment_str . '<br></br>';

              echo "H worked.";
            }
            break;
        case 'B':
            if ($amount < (.015 * $salary)) {
              //Then the loan can be made
              $monthly_I = $amount * (($L_Int / 100) / 12); //Converts the interest rate to a decimal and adds 1 to it.
              $monthly_I_str = number_format($monthly_I, 2);
              echo '$monthly_I_str' . $monthly_I_str . '<br></br>';

              echo '$monthly_I: ' . $monthly_I . '<br></br>';
              echo '$L_Int' . $L_Int . '<br></br>';
              $monthly_payment = (($amount / $loanterm) + $monthly_I);
              $monthly_payment_str = number_format($monthly_payment, 2);
              echo '$monthly_payment_str' . $monthly_payment_str . '<br></br>';

              echo "B worked.";
            }
            break;
        case 'M':
            if ($amount < (.015 * $salary)) {
              //Then the loan can be made
              $monthly_I = $amount * (($L_Int / 100) / 12); //Converts the interest rate to a decimal and adds 1 to it.
              $monthly_I_str = number_format($monthly_I, 2);
              echo '$monthly_I_str' . $monthly_I_str . '<br></br>';

              echo '$monthly_I: ' . $monthly_I . '<br></br>';
              echo '$L_Int' . $L_Int . '<br></br>';
              $monthly_payment = (($amount / $loanterm) + $monthly_I);
              $monthly_payment_str = number_format($monthly_payment, 2);
              echo '$monthly_payment_str' . $monthly_payment_str . '<br></br>';

            }
            break;
        case 'S':
            if ($amount < (.15 * $salary)) {
              //Then the loan can be made
              $monthly_I = $amount * (($L_Int / 100) / 12); //Converts the interest rate to a decimal and adds 1 to it.
              $monthly_I_str = number_format($monthly_I, 2);
              echo '$monthly_I_str' . $monthly_I_str . '<br></br>';

              echo '$monthly_I: ' . $monthly_I . '<br></br>';
              echo '$L_Int' . $L_Int . '<br></br>';
              $monthly_payment = (($amount / $loanterm) + $monthly_I);
              $monthly_payment_str = number_format($monthly_payment, 2);
              echo '$monthly_payment_str' . $monthly_payment_str . '<br></br>';

            }
            break;
        default:
          echo "None of the cases worked.";
        break;
    }

        echo '$L_Int: ' . $L_Int;
        $math_sql = <<<SQL
          INSERT INTO loan_application(customer_id, loan_type_cd, loan_amount, monthly_payment, loan_term_months, interest_rate)
          VALUES($cust_id, "$loantype", $amount, $monthly_payment, $loanterm, $L_Int);
SQL;

        $result = $dbh->query($math_sql);

        if ($result) {
          // header("Location: dashboard.php");
          echo "Customer ID: " . $cust_id;
          echo "<br> Loan Type: " . $loantype;
          echo "<br> Amount: " . $amount;
          echo "<br> Monthly Payment: " . $monthly_payment;
          echo "<br> Loan Term: " . $loanterm;
          echo "<br> Interest Rate: " . $L_Int;
          echo "<br> Salary: " . $salary;
        } else {
          echo ("It didn't work. (loanapp) <br>");
          var_dump($loantype == 'H');
        //  echo "<br> Error: " . mysqli_error($dbh);
      //  }+

    }
}

//Logout
function logout() {
  session_unset();
  session_destroy();
  header("Location: forms/login.php");
}

//References
function references() {
  global $dbh;
  $ref_first_name = $_REQUEST['ref_first_name'];
  $ref_last_name = $_REQUEST['ref_last_name'];
  $ref_phone = $_REQUEST['ref_phone'];
  $address_line_one = $_REQUEST['address_line_one'];
  $city_name = $_REQUEST['city_name'];
  $state_cd = $_REQUEST['state_cd'];
  $postal_cd = $_REQUEST['postal_cd'];
  $customer_id = $_SESSION['customer_id'];

  $sql = <<<SQL
  INSERT INTO customer_references(customer_id, ref_first_name, ref_last_name, ref_phone, address_line_one, city_name, state_cd, postal_cd)
  VALUES($customer_id, "$ref_first_name", "$ref_last_name", "$ref_phone", "$address_line_one", "$city_name", "$state_cd","$postal_cd");
SQL;

  $result = $dbh->query($sql);

  if ($result) {
    header("Location: dashboard.php");
  } else {
    echo mysqli_error($dbh);
  }
}
}
?>
