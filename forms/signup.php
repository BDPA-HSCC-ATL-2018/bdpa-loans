<?php
include_once '../web-assets/tpl/app_header.php';
include_once '../web-assets/tpl/app_nav.php';
?>

        <div class="card my-4 mx-4">
            <div class="card-header">Sign Up</div>
            <div class="card-body">
                <form action="/bdpa-loans/index.php?action=signup" method="post">
                    <!--Email-->
                    <div class="form-group row">
                        <label for="email" class="col-sm-3">Email</label>
                        <input type="email" class="form-control col-sm-9" name="email" required>
                    </div>
                    <!--Password-->
                    <div class="form-group row">
                        <label for="password" class="col-sm-3">Password</label>
                        <input type="password" class="form-control col-sm-9" name="pw" required>
                    </div>
                    <!--First Name-->
                    <div class="form-group row">
                        <label for="username" class="col-sm-3">First Name</label>
                        <input type="text" class="form-control col-sm-9" name="fname" required>
                    </div>
                    <!--Last Name-->
                    <div class="form-group row">
                        <label for="username" class="col-sm-3">Last Name</label>
                        <input type="text" class="form-control col-sm-9" name="lname" required>
                    </div>
                    <!--Address-->
                    <div class="form-group row">
                        <label for="username" class="col-sm-3">Address</label>
                        <input type="text" class="form-control col-sm-9" name="address" required>
                    </div>
                    <!--City-->
                    <div class="form-group row">
                        <label for="username" class="col-sm-3">City</label>
                        <input type="text" class="form-control col-sm-9" name="city" required>
                    </div>
                    <!--State-->
                    <div class="form-group row">
                        <label for="username" class="col-sm-3">State</label>
                        <input type="text" class="form-control col-sm-9" name="state" required>
                    </div>
                    <!--Zip-->
                    <div class="form-group row">
                        <label for="username" class="col-sm-3">Zip Code</label>
                        <input type="text" class="form-control col-sm-9" name="zip" required>
                    </div>
                    <!--Telephone-->
                    <div class="form-group row">
                        <label for="username" class="col-sm-3">Telephone</label>
                        <input type="text" class="form-control col-sm-9" name="telephone" required>
                    </div>
                    <!--Cell Phone-->
                    <div class="form-group row">
                        <label for="username" class="col-sm-3">Cell Phone</label>
                        <input type="text" class="form-control col-sm-9" placeholder="###-###-####" name="cellphone" required>
                    </div>
                    <!--Company-->
                    <div class="form-group row">
                        <label for="username" class="col-sm-3">Company</label>
                        <input type="text" class="form-control col-sm-9" name="company" required>
                    </div>
                    <!--Yearly Salary-->
                    <div class="form-group row">
                        <label for="username" class="col-sm-3">Yearly Salary</label>
                        <input type="text" class="form-control col-sm-9" name="yearlysalary" required>
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
