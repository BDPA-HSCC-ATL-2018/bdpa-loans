<?php
session_start();
include_once $_SERVER['DOCUMENT_ROOT'] . "/bdpa-loans/db.php";

$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : null;

$options = array (
    'signup' => 'signup',
    'login' => 'login',
    'loanapp' => 'loanapp'
);

if (array_key_exists($action, $options)) {
    $function = $options[$action];
    call_user_func($function);
} else {
    include_once $_SERVER['DOCUMENT_ROOT'] . "/bdpa-loans/forms/signup.php";
}

//Signup Form
function signup() {
    global $dbh;
    $email = $_REQUEST['email'];
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

    $sql = <<<SQL
        INSERT INTO customers(email_id, login_pw, first_name, last_name, address_line_one, city_name, state_cd, postal_cd, pri_phone, alt_phone, employer_name, annual_income)
        VALUES("$email", "$pw","$fname", "$lname", "$address", "$city", "$state", "$zip", "$telephone", "$cellphone", "$company", $cust_yr_salary);
SQL;

    $result = $dbh->query($sql);

    if ($result) {
        $_SESSION['email'] = $email;
        include_once $_SERVER['DOCUMENT_ROOT'] . "/bdpa-loans/forms/loanapp_f.php";
    } else {
       echo ("It didn't work.");
    }
}

//Login Function
function login() {
    global $dbh;

    $email = $_REQUEST['email'];
    $pw = $_REQUEST['pw'];

    $sql = <<<SQL
        SELECT * FROM customers WHERE cust_email = "$email";
SQL;

    $result = $dbh->query($sql);

    while ($row = $result->fetch_assoc()) {
        $hashed_pw = $row['cust_PW'];
    }

    if (password_verify($pw, $hashed_pw)) {
        include_once $_SERVER['DOCUMENT_ROOT'] . "/bdpa-loans/dashboard.php";
    } else {
        include_once __DIR__ . '/bdpa-loans';
    }
}

//Loan App Function
function loanapp() {
    global $dbh;
    $email = $_SESSION['email'];

    //Get needed info from cust. table
    $cust_sql = <<<SQL
        SELECT cust_Id, cust_yr_Salary, cust_type FROM customers WHERE email = "$email";
SQL;

    $cust_result = $dbh->query($cust_sql);

    if ($cust_result) {
        while ($row = $result->fetch_assoc()) {
            $salary = $row['cust_yr_Salary'];
            $cust_type = $row['cust_type'];
            $cust_id = $row['cust_Id'];
            $L_Date = $_REQUEST['l_date'];
            $L_Term = $_REQUEST['l_term'];
            $L_Interest = $_REQUEEST['l_int'];
        }

    $loantype = $_REQUEST['loantype'];
    $amount = $_REQUEST['amount'];
    $loanterm = $_REQUEST['loanlength'];

        switch ($loantype) {
            case 'A':
                if (!($amount >= (.50 * $salary)))
                    //Then the loan can be made
                    $amount = $amount * 1.0625;
                    $monthly_payment = ($amount / $loanterm);
                break;
            case 'H':
                if (!($amount >= (.027 * $salary)))
                    //Then the loan can be made
                    $amount = $amount * 1.0625;
                    $monthly_payment = ($amount / $loanterm);
                break;
            case 'B':
                if (!($amount >= (.015 * $salary)))
                    //Then the loan can be made
                    $amount = $amount * 1.0675;
                    $monthly_payment = ($amount / $loanterm);
                break;
            case 'M':
                if (!($amount >= (.015 * $salary)))
                    //Then the loan can be made
                    $amount = $amount * 1.0575;
                    $monthly_payment = ($amount / $loanterm);
                break;
            case 'S':
                if (!($amount >= (.15 * $salary)))
                    //Then the loan can be made
                    $amount = $amount * 1.055;
                    $monthly_payment = ($amount / $loanterm);
                break;
        }

        $math_sql = <<<SQL
        INSERT INTO loanapp(customer_id, loan_type_cd, loan_amount, monthly_payment, loan_status_date, loan_term_months, interest_rate)
    VALUES($cust_id, "$loantype", $amount, $monthly_payment, $loanterm, $L_Date, $L_Term, $L_Int)
SQL;
        $result = $dbh->query($math_sql);

        if ($result) {
            include_once $_SERVER['DOCUMENT_ROOT'] . "/bdpa-loans/dashbaord.php";
        } else {
            echo ("It didn't work. (loanapp)");
            echo ($custid);
        }
    }

}
?>
