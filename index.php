<?php

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
    $username = $_REQUEST['username'];
    $pw = $_REQUEST['pw']; $pw = password_hash($pw, PASSWORD_DEFAULT);
    $lname = $_REQUEST['lname'];
    $fname = $_REQUEST['fname'];
    $address = $_REQUEST['address'];
    $city = $_REQUEST['city'];
    $state = $_REQUEST['state'];
    $zip = $_REQUEST['zip'];
    $telephone = $_REQUEST['telephone'];
    $cellphone = $_REQUEST['cellphone'];
    $company = $_REQUEST['company'];
    $compaddress = $_REQUEST['compaddress'];
    $compcity = $_REQUEST['compcity'];
    $compstate = $_REQUEST['compstate'];
    $compzip = $_REQUEST['compzip'];
    $comptele = $_REQUEST['comptele'];
    $cust_type = "old";
    $cust_yr_salary = $_REQUEST['yearlysalary'];

    $sql = <<<SQL
        INSERT INTO customer(cust_Username, cust_PW, cust_LastName, cust_FirstName, cust_Address, cust_City, cust_State, cust_Zip, cust_Telephone, cust_CellPhone, cust_Company, cust_Co_Address, cust_Co_City, cust_Co_State cust_Co_Zip, cust_Co_Telephone, cust_Type, cust_yr_Salary)
        VALUES('$username', '$pw','$lname', '$fname', '$address', '$city', '$state', '$zip', '$telephone', '$cellphone', '$company', '$compaddress', '$compcity', '$compstate', '$compzip');
SQL;

    $result = $dbh->query($sql);

    if ($result) {
        include_once $_SERVER['DOCUMENT_ROOT'] . "/bdpa-loans/forms/loanapp_f.php";
    } else {
//        include_once $_SERVER['DOCUMENT_ROOT'] . "/bdpa-loans/forms/signup.php";

    }
}

//Login Function
function login() {
    global $dbh;

    $username = $_REQUEST['username'];
    $pw = $_REQUEST['pw'];

    $sql = <<<SQL
        SELECT * FROM customer WHERE cust_Username = "$username";
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

    //Get needed info from cust. table
    $cust_sql = <<<SQL
        SELECT cust_Id, cust_yr_Salary, cust_type FROM customer;
SQL;

    $cust_result = $dbh->query($cust_sql);

    if ($cust_result) {
        while ($row = $result->fetch_assoc()) {
            $salary = $row['cust_yr_Salary'];
            $cust_type = $row['cust_type'];
            $cust_id = $row['cust_Id'];
            $Ref1_Firstname = $_REQUEST['ref1_first'];
            $Ref1_Lastname = $_REQUEST['ref1_last'];
            $Ref1_telephone = $_REQUEST['ref2_tel'];
            $Ref2_Firstname = $_REQUEST['ref2_first'];
            $Ref2_Lastname = $_REQUEST['ref2_last'];
            $Ref2_telephone = $_REQUEST['ref2_tel'];
            $L_Date = $_REQUEST['l_date'];
            $L_Term = $_REQUEST['l_term'];
            $L_Interest = $_REQUEEST['l_int'];
        }
        $loantype = $_REQUEST['loantype'];
        $amount = $_REQUEST['amount'];
        $loanterm = $_REQUEST['loanterm'];

        switch ($loantype) {
            case 'A':
                if (!($amount >= (.50 * $salary)))
                    //Then the loan can be made
                    if ($cust_type == "old") {
                        $amount = $amount * 1.0522;
                        $monthly_payment = $amount / $loanterm;
                    } else {
                        $amount = $amount * 1.0625;
                        $monthly_payment = $amount / $loanterm;
                    }
                break;
            case 'H':
                if (!($amount >= (.027 * $salary)))
                    //Then the loan can be made
                    if ($cust_type == "old") {
                        $amount = $amount * 1.0522;
                        $monthly_payment = $amount / $loanterm;
                    } else {
                        $amount = $amount * 1.0625;
                        $monthly_payment = $amount / $loanterm;
                    }
                break;
            case 'B':
                if (!($amount >= (.015 * $salary)))
                    //Then the loan can be made
                    if ($cust_type == "old") {
                        $amount = $amount * 1.0624;
                        $monthly_payment = $amount / $loanterm;
                    } else {
                        $amount = $amount * 1.0675;
                        $monthly_payment = $amount / $loanterm;
                    }
                break;
            case 'M':
                if (!($amount >= (.015 * $salary)))
                    //Then the loan can be made
                    if ($cust_type == "old") {
                        $amount = $amount * 1.05;
                        $montly_payment = $amount / $loanterm;
                    } else {
                        $amount = $amount * 1.0575;
                        $monthly_payment = $amount / $loanterm;
                    }
                break;
            case 'S':
                if (!($amount >= (.15 * $salary)))
                    //Then the loan can be made
                    if ($cust_type == "old") {
                        $amount = $amount * 1.05;
                        $monthly_payment = $amount / $loanterm;
                    } else {
                        $amount = $amount * 1.055;
                        $monthly_payment = $amount / $loanterm;
                    }
                break;
        }

        $math_sql = <<<SQL
        INSERT INTO loanapp(L_CustId, L_LoanType, Amt, MonthlyPayment, Ref1_Firstname, Ref1_Lastname, Ref1_Telephone, Ref2_Firstname, Ref2_Lastname, Ref2_Telephone, L_Date, L_Term, L_Interest)
    VALUES($cust_id,$loantype,$amount,'$monthly_payment','$loanterm','$Ref1_Firstname','$Ref1_Lastname','$Ref1_telephone','$Ref2_Firstname','$Ref2_Lastname','$Ref2_telephone','$L_Date','$L_Term','$L_Int')
SQL;
        $result = $dbh->query($math_sql);

        if ($result) {
            include_once $_SERVER['DOCUMENT_ROOT'] . "/bdpa-loans/dashbaord.php";
        } else {
            include_once $_SERVER['DOCUMENT_ROOT'] . "/bdpa-loans/forms/signup.php";
        }
    }

}
?>
