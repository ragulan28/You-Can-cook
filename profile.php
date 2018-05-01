<?PHP include './db/OrderOpperation.php';
    include './db/UserOpperation.php';
    session_start();
    $conOrder = new OrderOpperation();
    $conUser = new UserOpperation();
    $id = 0;
    if (isset($_SESSION['user'])) {
        $id = $_SESSION['user'];
        if ($id == -1) {
            header("Location:home.php");
        }
    } else {
        header("Location:home.php");
    }
?>

<!DOCTYPE html>
<!--suppress ALL -->
<html>
<head>
    <meta charset="UTF-8">
    <title>Pure CSS Tabs</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">

    <link rel='stylesheet prefetch'
          href='https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons'>
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.6.1.min.js"></script>


    <link rel="stylesheet" href="css/order.css">
    <link rel="stylesheet" href="css/resetNav.css">
    <link rel="stylesheet" href="css/styleNav.css">
    <script src="js/modernizr.js"></script> <!-- Modernizr -->
    <link rel="stylesheet" href="css/order.css">
    <link href="css/bootstrap.css" rel="stylesheet">
    <style>
        body{
            background: rgba(255,121,77,1);
            background: -moz-radial-gradient(center, ellipse cover, rgba(255,121,77,1) 0%, rgba(255,121,77,1) 11%, rgba(203,76,37,1) 100%);
            background: -webkit-gradient(radial, center center, 0px, center center, 100%, color-stop(0%, rgba(255,121,77,1)), color-stop(11%, rgba(255,121,77,1)), color-stop(100%, rgba(203,76,37,1)));
            background: -webkit-radial-gradient(center, ellipse cover, rgba(255,121,77,1) 0%, rgba(255,121,77,1) 11%, rgba(203,76,37,1) 100%);
            background: -o-radial-gradient(center, ellipse cover, rgba(255,121,77,1) 0%, rgba(255,121,77,1) 11%, rgba(203,76,37,1) 100%);
            background: -ms-radial-gradient(center, ellipse cover, rgba(255,121,77,1) 0%, rgba(255,121,77,1) 11%, rgba(203,76,37,1) 100%);
            background: radial-gradient(ellipse at center, rgba(255,121,77,1) 0%, rgba(255,121,77,1) 11%, rgba(203,76,37,1) 100%);
            filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ff794d', endColorstr='#cb4c25', GradientType=1 );

        }
    </style>
</head>

<body>
<?PHP include 'navBar.php' ?>
<br>
<br>
<div class="container">
    <div class="tab-group">
        <section id="tab1" title="Profil">
            <?php
                $user = $conUser->getUserDataById($id);

            ?>
            <h3>
                <?php echo $user['name']; ?>
            </h3>
            <p>
                <?php echo $user['email']; ?>
            </p>
            <!-- Trigger the modal with a button -->
            <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#resetPassword">Reset
                                                                                                                 Password
            </button>
            <button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#edit">Edit Details
            </button>
        </section>
        <section id="tab2" title="My order">
            <div class="container">

                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th class="col-lg-4"><h2>Name</h2></th>
                        <th class="col-lg-4"><h2>Price</h2></th>
                        <th class="col-lg-4"><h2>No</h2></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?PHP
                        $orders = $conOrder->getOrderByUserId($id);
                        foreach ($orders

                                 as $order) {
                            echo <<<ASD
                            <tr >
                                <td >{$order['name']}</td >
                                <td >{$order['price']}</td >
                                <td >{$order['no']}</td >
                            </tr >
ASD;
                        }
                    ?>

                    </tbody>
                </table>
            </div>

        </section>
        <section id="tab3" title="Pending to Delivaty">
            <div class="container">

                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th class="col-lg-4"><h2>Name</h2></th>
                        <th class="col-lg-4"><h2>Price</h2></th>
                        <th class="col-lg-4"><h2>No</h2></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?PHP
                        $orders = $conOrder->getUnFinishedOrderByUserId($id);
                        foreach ($orders

                                 as $order) {
                            echo <<<AAA
                            <tr >
                                <td >{$order['name']}</td >
                                <td >{$order['price']}</td >
                                <td >{$order['no']}</td >
                            </tr >
AAA;
                        }
                    ?>

                    </tbody>
                </table>
            </div>
        </section>

    </div>
</div>

<!-- Modal resetPassword -->
<div class="modal fade" id="resetPassword" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Reset password</h4>
            </div>
            <div class="modal-body">
                <form action="controller/userController.php" method="post">
                    <div class="form-group">
                        <label for="pass">Password</label>
                        <input id="pass" type="password" name="password_confirmation" placeholder="Password"
                               class="form-control" data-validation="strength"
                               data-validation-strength="2">
                    </div>
                    <div class="form-group">
                        <label for="re-pass">Re-Password</label>
                        <input id="re-pass" type="password" name="password" placeholder="Re-Password"
                               class="form-control" data-validation="confirmation">
                    </div>
                    <button type="submit" class="btn btn-danger" name="reset">Reset</button>
                </form>
            </div>

        </div>
    </div>
</div>

<!-- Modal edit -->
<div class="modal fade" id="edit" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit</h4>
            </div>
            <div class="modal-body">
                <form action="controller/userController.php" method="post">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input id="email" type="email" name="email" class="form-control" placeholder="Email" data-validation="email"">
                    </div>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input id="name" type="text" name="name" class="form-control" placeholder="Name"
                               data-validation="length" data-validation-length="max100">
                    </div>
                    <button type="submit" class="btn btn-info" name="editUser">Submit</button>
                </form>
            </div>

        </div>
    </div>
</div>

<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
<link href='https://fonts.googleapis.com/css?family=Roboto:400,500,300,700' rel='stylesheet' type='text/css'>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src='http://code.jquery.com/ui/1.11.2/jquery-ui.js'></script>
<script src="js/profil.js"></script>
<script src="js/nav.js"></script>
<script src="js/velocity.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
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
