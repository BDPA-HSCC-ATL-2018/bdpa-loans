<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/web-assets/tpl/app_header.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/web-assets/tpl/app_nav.php';
?>


        <div class="card my-4 mx-4">
            <div class="card-header">Take Out A Loan</div>
            <div class="card-body">
                <form action="/loan_app/index.php?action=loanapp">
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
                        <input type="number" class="form-control col-sm-9" name="username">
                    </div>
                    <!--Ref1-->
                    <div class="card-sm">

                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="ref1_first" class="col-sm-3">Reference1 First Name</label>
                                    <input type="text" class="form-control col-sm-9" name="ref1_first">
                                </div>
                                <div class="form-group row">
                                    <label for="ref1_last" class="col-sm-3">Reference1 Last Name</label>
                                    <input type="text" class="form-control col-sm-9" name="ref1_last">
                                </div>
                                <div class="form-group row">
                                    <label for="ref1_tel" class="col-sm-3">Reference1 Telephone</label>
                                    <input type="tel" class="form-control col-sm-9" name="ref1_tel">
                                </div>
                                 <!--Ref2-->
                                <div class="form-group row">
                                    <label for="ref2_first" class="col-sm-3">Reference2 First Name</label>
                                    <input type="text" class="form-control col-sm-9" name="ref1_first">
                                </div>
                                <div class="form-group row">
                                    <label for="ref2_last" class="col-sm-3">Reference2 Last Name</label>
                                    <input type="text" class="form-control col-sm-9" name="ref1_last">
                                </div>
                                <div class="form-group row">
                                    <label for="ref2_tel" class="col-sm-3">Reference2 Telephone</label>
                                    <input type="tel" class="form-control col-sm-9" name="ref1_tel">
                                </div>
                        </div>
                    </div>

                    <br/>


                    <button class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>

    </body>
</html>
