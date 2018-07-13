<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/web-assets/tpl/app_header.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/web-assets/tpl/app_nav.php';
?>
        
        <div class="card my-4 mx-4">
            <div class="card-header">Sign Up</div>
            <div class="card-body">
                <form action="/loan_app/index.php?action=signup" method="post">
                    <!--Username-->
                    <div class="form-group row">
                        <label for="username" class="col-sm-3">Username</label>
                        <input type="text" class="form-control col-sm-9" name="username">
                    </div>
                    <!--Password-->
                    <div class="form-group row">
                        <label for="password" class="col-sm-3">Password</label>
                        <input type="password" class="form-control col-sm-9" name="pw">
                    </div>
                    <!--First Name-->
                    <div class="form-group row">
                        <label for="username" class="col-sm-3">First Name</label>
                        <input type="text" class="form-control col-sm-9" name="fname">
                    </div>
                    <!--Last Name-->
                    <div class="form-group row">
                        <label for="username" class="col-sm-3">Last Name</label>
                        <input type="text" class="form-control col-sm-9" name="lname">
                    </div>
                    <!--Address-->
                    <div class="form-group row">
                        <label for="username" class="col-sm-3">Address</label>
                        <input type="text" class="form-control col-sm-9" name="address">
                    </div>
                    <!--City-->
                    <div class="form-group row">
                        <label for="username" class="col-sm-3">City</label>
                        <input type="text" class="form-control col-sm-9" name="city">
                    </div>
                    <!--State-->
                    <div class="form-group row">
                        <label for="username" class="col-sm-3">State</label>
                        <input type="text" class="form-control col-sm-9" name="state">
                    </div>
                    <!--Zip-->
                    <div class="form-group row">
                        <label for="username" class="col-sm-3">Zip Code</label>
                        <input type="text" class="form-control col-sm-9" name="zip">
                    </div>
                    <!--Telephone-->
                    <div class="form-group row">
                        <label for="username" class="col-sm-3">Telephone</label>
                        <input type="text" class="form-control col-sm-9" name="telephone">
                    </div>
                    <!--Cell Phone-->
                    <div class="form-group row">
                        <label for="username" class="col-sm-3">Cell Phone</label>
                        <input type="text" class="form-control col-sm-9" placeholder="###-###-####" name="cellphone">
                    </div>
                    <!--Company-->
                    <div class="form-group row">
                        <label for="username" class="col-sm-3">Company</label>
                        <input type="text" class="form-control col-sm-9" name="company">
                    </div>
                    <!--Comp. Address-->
                    <div class="form-group row">
                        <label for="username" class="col-sm-3">Company Address</label>
                        <input type="text" class="form-control col-sm-9" name="compaddress">
                    </div>
                    <!--Comp. City-->
                    <div class="form-group row">
                        <label for="username" class="col-sm-3">Company City</label>
                        <input type="text" class="form-control col-sm-9" name="compcity">
                    </div>
                    <!--Comp. State-->
                    <div class="form-group row">
                        <label for="username" class="col-sm-3">Company State</label>
                        <input type="text" class="form-control col-sm-9" name="compstate">
                    </div>
                    <!--Comp. Zip-->
                    <div class="form-group row">
                        <label for="username" class="col-sm-3">Company Zip Code</label>
                        <input type="text" class="form-control col-sm-9" name="compzip">
                    </div>
                    <!--Company Telephone-->
                    <div class="form-group row">
                        <label for="username" class="col-sm-3">Company Telephone</label>
                        <input type="text" class="form-control col-sm-9" name="comptele">
                    </div>
                    <!--Yearly Salary-->
                    <div class="form-group row">
                        <label for="username" class="col-sm-3">Yearly Salary</label>
                        <input type="text" class="form-control col-sm-9" name="yearlysalary">
                    </div>
                    <input type="submit" class="btn btn-primary" style="float: right">
                </form>
            </div>
        </div>
<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . '/web-assets/tpl/app_footer.php';
?>
        
    
<!--

Username
Password
First Name
Last Na,e
Address
City
State
Zip
Telephone
Cellphone
company
comp adress
comp city
comp state
comp zip
comp tel
type
yearly salary

    [[[[[[[[[[[[[[[      ]]]]]]]]]]]]]]]
    [::::::::::::::      ::::::::::::::]
    [::::::::::::::      ::::::::::::::]
    [::::::[[[[[[[:      :]]]]]]]::::::]
    [:::::[                      ]:::::]
    [:::::[                      ]:::::]
    [:::::[                      ]:::::]
    [:::::[                      ]:::::]
    [:::::[     CODE THE WEB     ]:::::]
    [:::::[  http://brackets.io  ]:::::]
    [:::::[                      ]:::::]
    [:::::[                      ]:::::]
    [:::::[                      ]:::::]
    [:::::[                      ]:::::]
    [::::::[[[[[[[:      :]]]]]]]::::::]
    [::::::::::::::      ::::::::::::::]
    [::::::::::::::      ::::::::::::::]
    [[[[[[[[[[[[[[[      ]]]]]]]]]]]]]]]

-->
