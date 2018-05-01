<?php
    session_start();
    $id = 0;
    if (isset($_SESSION['user'])) {
        $id = $_SESSION['user'];
        if ($id != -1) {
            header("Location:index.php");
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">

    <link rel='stylesheet prefetch'
          href='https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons'>
    <link rel="stylesheet" href="css/login.css">
    <!-- Latest compiled and minified CSS -->


    <script src="https://use.fontawesome.com/48c08ae4fd.js"></script>
</head>
<body>

<div class="form">
    <div class="form-toggle"></div>
    <div class="form-panel one">
        <div class="form-header">
            <h1>Account Login</h1>
        </div>
        <div class="form-content">
            <form action="controller/userController.php"  method="post">
                <div class="form-group">
                    <label for="username">E-Mail</label>
                    <input type="text" id="username" name="userName" required data-validation="length" data-validation-length="max100"/>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required />
                </div>
                <div class="form-group">
                    <label class="form-remember">
                        <input type="checkbox"/>Remember Me

                </div>
                <div class="form-group">
                    <button type="submit" name="userLogin">Log In</button>
                </div>
            </form>
        </div>
    </div>
    <div class="form-panel two">
        <div class="form-header">
            <h1>Register Account</h1>
        </div>
        <div class="form-content">
            <form method="post" action="controller/userController.php">
                <div class="form-group">
                    <label for="username">Name</label>
                    <input type="text" id="username" name="name" required/>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="pass_confirmation" data-validation="strength"
                           data-validation-strength="2"/>
                </div>
                <div class="form-group">
                    <label for="cpassword">Confirm Password</label>
                    <input type="password" id="cpassword" name="pass" data-validation="confirmation" required="required"/>
                </div>
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" data-validation="email" required="required"/>
                </div>
                <div class="form-group">
                    <button type="submit" name="newUser">Register</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.js" integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="
        crossorigin="anonymous"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
<!-- Latest compiled and minified JavaScript -->

<script src="js/login.js"></script>

<script>

    $.validate({
        modules        : 'location, date, security, file',
        onModulesLoaded: function () {
            $('#country').suggestCountry();
        }
    });

    // Restrict presentation length
    $('#presentation').restrictLength($('#pres-max-length'));

</script>
</body>
</html>