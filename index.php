<?php
session_start();
include_once $_SERVER['DOCUMENT_ROOT'] . "/bdpa-loans/db.php";

$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : null;

$options = array (
    'signup' => 'signup',
    'login' => 'login',
    'loanapp' => 'loanapp',
    'references' => 'references'
);

if (array_key_exists($action, $options)) {
    $function = $options[$action];
    call_user_func($function);
} else {
    include_once $_SERVER['DOCUMENT_ROOT'] . "/bdpa-loans/forms/signup.php";
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
        SELECT customer_id FROM customers WHERE email_id = "$email"
SQL;
        $customer_id_result = $dbh->query($customer_id_sql);
        while ($customer_id_row = $customer_id_result->fetch_assoc()) {
          $_SESSION['customer_id'] = $customer_id_row['customer_id'];
        }

        include_once $_SERVER['DOCUMENT_ROOT'] . "/bdpa-loans/dashboard.php";
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
        $_SESSION['cust_id'] = $row['customer_id'];
        $_SESSION['email'] = $row['email_id'];
    }

    if (password_verify($pw, $hashed_pw)) {
        include_once $_SERVER['DOCUMENT_ROOT'] . "/bdpa-loans/forms/dashboard.php";
    } else {
        var_dump(password_verify($pw, $hashed_pw));
        // include_once __DIR__ . "/index.php?action=signup"; //Go to the sign up page.
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

        switch ($loantype) {
            case 'A':
                if (!($amount >= (.50 * $salary)))
                    //Then the loan can be made
                    $L_Int = 1.0625;
                    $amount = $amount * 1.0625;
                    $monthly_payment = ($amount / $loanterm);
                break;
            case 'H':
                if (!($amount >= (.027 * $salary)))
                    //Then the loan can be made
                    $L_Int = 1.0625;
                    $amount = $amount * 1.0625;
                    $monthly_payment = ($amount / $loanterm);
                break;
            case 'B':
                if (!($amount >= (.015 * $salary)))
                    //Then the loan can be made
                    $L_Int = 1.0675;
                    $amount = $amount * 1.0675;
                    $monthly_payment = ($amount / $loanterm);
                break;
            case 'M':
                if (!($amount >= (.015 * $salary)))
                    //Then the loan can be made
                    $L_Int = 1.0575;
                    $amount = $amount * 1.0575;
                    $monthly_payment = ($amount / $loanterm);
                break;
            case 'S':
                if (!($amount >= (.15 * $salary)))
                    //Then the loan can be made
                    $L_Int = 1.055;
                    $amount = $amount * 1.055;
                    $monthly_payment = ($amount / $loanterm);
                break;
        }

        $math_sql = <<<SQL
        INSERT INTO loan_application(customer_id, loan_type_cd, loan_amount, monthly_payment, loan_term_months, interest_rate)
    VALUES($cust_id, "$loantype", $amount, $monthly_payment, $loanterm, $L_Int)
SQL;
        $result = $dbh->query($math_sql);

        if ($result) {
            include_once $_SERVER['DOCUMENT_ROOT'] . "/bdpa-loans/dashboard.php";
        } else {
            echo ("It didn't work. (loanapp) <br>");
            echo ($cust_id);
            echo $loantype;
            echo $amount;
            echo $monthly_payment;
            echo $loanterm;
            echo $L_Int;
        }
    }
}

//Logout
function logout() {
  session_unset();
  session_destroy();
  include __DIR__ . '/index.php?action=signup';
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
    include_once $_SERVER['DOCUMENT_ROOT'] . "/bdpa-loans/dashboard.php";
  } else {
    echo "nope. try again.";
  }
}
?>
