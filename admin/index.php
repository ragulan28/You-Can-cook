<?PHP
    session_start();
    if (isset($_SESSION['adminUser'])) {
        //echo $_SESSION['adminUser'];
        if ($_SESSION['adminUser'] != -1) {
            header("Location:home.php");
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link href="css/login.css" type="text/css" rel="stylesheet">
    <link href="css/bootstrap.css">


</head>
<body style="background-color: #901b1a;">
<div class="container">
    <div class="formBox level-login">
        <div class="box boxShaddow"></div>
        <div class="box loginBox ">
            <h2>LOGIN</h2>
            <form class="form" method="post" action="../controller/adminController.php">
                <div class="f_row">
                    <input type="email" class="input-field" required placeholder="Email" name="userName">
                    <u></u>
                </div>
                <div class="f_row last">

                    <input type="password" class="input-field" required placeholder="Password" name="password">
                    <u></u>
                </div>

                <button class="btn" name="adminLogin" type="submit"><span>GO</span><u></u>
                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg"
                         x="0px" y="0px" viewBox="0 0 415.582 415.582" xml:space="preserve">
                                <path d="M411.47,96.426l-46.319-46.32c-5.482-5.482-14.371-5.482-19.853,0L152.348,243.058l-82.066-82.064
                                      c-5.48-5.482-14.37-5.482-19.851,0l-46.319,46.32c-5.482,5.481-5.482,14.37,0,19.852l138.311,138.31
                                      c2.741,2.742,6.334,4.112,9.926,4.112c3.593,0,7.186-1.37,9.926-4.112L411.47,116.277c2.633-2.632,4.111-6.203,4.111-9.925
                                      C415.582,102.628,414.103,99.059,411.47,96.426z"></path>
                                </svg>
                </button>
                <div class="container">
                    <div class="f_row text-center">
                        <?PHP if (isset($_SESSION['adminUser'])) {
                            if ($_SESSION['adminUser'] == -1) {
                                echo 'Incorrect User name Password';
                            }
                        } ?></div>
                </div>

            </form>

        </div>

    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
<script src="js/login.js"></script>
</body>
</html>