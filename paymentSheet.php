<?PHP
    session_start();
    $id=0;
    if(isset($_SESSION['user'])){
        $id= $_SESSION['user'];
        if($id<0){
            header('Location:login.php');
        }
    }else{
        header('Location:login.php');
    }

?>
<html>

<head>

    <title></title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css"
          integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <link href="css/patment.css" type="text/css" rel="stylesheet">

</head>
<body>
<div class="container">
    <div class="stepwizard">
        <div class="stepwizard-row setup-panel">
            <div class="stepwizard-step">
                <a href="#VerifyEmail-step" type="button" class="btn btn-success btn-circle" disabled="disabled">
                    <span class="glyphicon glyphicon-home"></span>
                </a>
                <p>Crete Card</p>
            </div>
            <div class="stepwizard-step">
                <a href="#ProfileSetup-step" type="button" class="btn btn-primary btn-circle" id="ProfileSetup-step-2">
                    <span class="glyphicon glyphicon-credit-card"></span>
                </a>
                <p>Shipping Address</p>
            </div>
            <div class="stepwizard-step">
                <a href="#Security-Setup-step" type="button" class="btn btn-success-2 btn-circle" disabled="disabled"
                   id="Security-Setup-step-3">
                    <span class="glyphicon glyphicon-ok"></span>
                </a>
                <p>Summer</p>
            </div>
        </div>
    </div>
    <form role="form" action="controller/orderController.php">
        <div class="row setup-content" id="VerifyEmail-step">
            <div class="col-xs-12">
                <div class="col-md-12">
                    <br/>
                    <div class="form-horizontal">
                        <form role="form">
                            <fieldset>
                                <legend>Enter Card Details</legend>
                                <br/>

                                <div class="form-group">

                                    <div class="col-sm-9">
                                        <input type="number" required="required" class="form-control" placeholder="Credit Card number"
                                               data-validation="creditcard" data-validation-allowing="visa, mastercard, amex"/>
                                    </div>
                                </div>
                                <div class="form-group">

                                    <div class="col-sm-3 col-sm-offset-1">
                                        <input maxlength="10" type="text" required="required" class="form-control"
                                               placeholder="CVV" data-validation="cvv"/>

                                    </div>
                                    <div class="col-sm-3 col-sm-offset-1">
                                        <input maxlength="10" type="text" required="required" class="form-control"
                                               placeholder="Expair date" data-validation="date" data-validation-format="mm/yy"/>

                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                    <button class="btn btn-primary nextBtn btn-lg pull-right" type="button">Setup Profile</button>
                </div>
            </div>
        </div>
        <div class="row setup-content" id="ProfileSetup-step">
            <div class="col-xs-12">
                <div class="col-md-12">
                    <br/>
                    <div class="form-horizontal">
                        <form role="form">
                            <fieldset>

                                <legend>Enter Shipping Information</legend>
                                <br/>

                                <div class="form-group">
                                    <div class="col-sm-9">
                                        <input id="name" maxlength="100" type="text" required="required" class="form-control"
                                               placeholder="Enter Name" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-9">
                                        <input  maxlength="10" type="number" required="required" class="form-control"
                                               placeholder="Enter Primary Phone Number"  data-validation="length" data-validation-length="max10"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-9">
                                        <input id="address" maxlength="100" type="text" required="required" class="form-control"
                                               placeholder="Enter Address" />
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <div class="col-sm-6" style="padding-left:0">
                                            <input id="city" maxlength="100" type="text" required="required" class="form-control"
                                                   placeholder="Enter City"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <div class="col-sm-6" style="padding:0">
                                            <input id="province" maxlength="100" type="text" required="required" class="form-control"
                                                   placeholder="Enter State/Province" />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-9">
                                        <input required="required" class="form-control" id="country"
                                               data-validation="country" placeholder="Country">
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                    <button class="btn btn-primary nextBtn btn-lg pull-right " id="last" type="button">Setup Profile</button>
                </div>
            </div>
        </div>
        <div class="row setup-content" id="Security-Setup-step">
            <div class="col-xs-12">
                <div class="col-md-12">


                    <div class="form-horizontal">
                        <form role="form">
                            <fieldset class="text-center">
                                <div id="totalPrice" style="color: #761c19; font-size: 30px"></div>
                                <div id="shippingAddress" style="color: #265a88; font-size: 20px"></div>
                            </fieldset>
                        </form>
                    </div>
                    <!--h3> You are all set!</h3>
                    <p>Welcome to MetroPago. We are glade to have you here.</p-->
                    <input class="btn btn-primary btn-lg pull-right nextBtn " id="pay" type="submit"
                           value="Conform to Pay">
                </div>
            </div>
        </div>
    </form>
</div>


<!-- Latest compiled and minified JavaScript -->
<script src="js/jquery-3.0.0.min.js" type="application/javascript"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
<script src="js/payment.js" type="application/javascript "></script>
<script>

    $.validate({
        modules: 'location, date, security, file',
        onModulesLoaded: function () {
            $('#country').suggestCountry();
        }
    });

    // Restrict presentation length
    $('#presentation').restrictLength($('#pres-max-length'));

</script>
</body>
</html>