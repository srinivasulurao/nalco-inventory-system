<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nalco Inventory System</title>
    <link rel='stylesheet' href='<?php echo rootUrl("/assets/css/bootstrap/bootstrap.css"); ?>'>
    <link rel="stylesheet" href='<?php echo rootUrl("/assets/css/jquery-ui.css"); ?>'>
    <link rel="stylesheet" href='<?php echo rootUrl("/assets/css/styles.css"); ?>'>
    <link rel="shortcut icon" href="<?php echo rootUrl("/assets/images/favicon.png"); ?>" type="image/x-icon">

    <script src='<?php echo rootUrl("/assets/js/jquery.min.js"); ?>'></script>
    <script src='<?php echo rootUrl("/assets/js/jquery-ui.js"); ?>'></script>
    <script src='<?php echo rootUrl("/assets/js/bootstrap/bootstrap.js"); ?>'></script>
    <script src='<?php echo rootUrl("/assets/js/app.js"); ?>'></script>
    
</head>
<body>
    <nav class='navbar sticky-top navbar-light bg-light navbar-expand-lg'>
        <div class='container-fluid'>
        
            <a href='<?php echo rootUrl(); ?>'><img src='<?php echo rootUrl("/assets/images/logo.jpg"); ?>' style='height:50px'></a>

            <div class='profile_bar'>
                
                <?php if($_SESSION['isLoggedIn']==false): ?>
                    <ul class="navbar-nav mr-auto" >
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo rootUrl("/"); ?>">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo rootUrl("/user/login"); ?>">Login</a>
                    </li>
                </ul>    
                <?php endif; ?>
                <?php if($_SESSION['isLoggedIn']==true): ?>
                    <span class='greetings'><?php echo greetings(); ?></span>
                    <ul class="navbar-nav mr-auto">
                        <a class="btn btn-danger btn-sm" href="<?php echo rootUrl("/user/logout"); ?>">Logout</a>
                    </li>
                    <ul class="navbar-nav mr-auto" style='margin-left:85%'>
                <?php endif; ?>
                
            </div>
        </div>
    </nav>
<?php rootUrl(); ?>