<?PHP

    $id = 0;
    if (isset($_SESSION['user'])) {
        $id = $_SESSION['user'];
    }
?>
<nav>
    <ul class="cd-primary-nav">
        <li><a href="home.php">Home</a></li>
        <li><a href="about.php">About</a></li>
        <li>
            <?PHP if ($id > 0) { ?>
                <a href="profile.php">Profile</a>
            <?php } else { ?>
                <a href="login.php">Login</a>
            <?php } ?>
        </li>
        <?PHP if ($id > 0) { ?>
            <li><a href="controller/logout.php?action=user">logout</a></li>
        <?php } ?>
    </ul>
</nav>


<div class="cd-overlay-nav">
    <span></span>
</div> <!-- cd-overlay-nav -->

<div class="cd-overlay-content">
    <span></span>
</div> <!-- cd-overlay-content -->

<a href="#0" class="cd-nav-trigger">Menu<span class="cd-icon"></span></a>
