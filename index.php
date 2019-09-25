<?php
    // session_start();
    // include_once 'pages/functions.php';
    // $_SESSION['date'] = date('Y-m-d');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reg & Log</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        
        <div class="row">
            <nav class="col-md-12">
                <?php include_once 'pages/menu.php'?>
            </nav>
        </div>
        <div class="row">
            <section class="col-md-12">
                <?php if(isset($_GET['page'])){
                    $page = $_GET['page'];
                    if($page == 1){
                        if(isset($_SESSION['user'])){
                            $user = $_SESSION['user'];
                            echo "<h4>Welcome User $user</h4>";
                        }
                        elseif (isset($_SESSION['admin'])) {
                            $admin = $_SESSION['admin'];
                            echo "<h4>Welcome Admin $admin</h4>";
                        }
                        else include_once 'pages/registration.php';
                    }
                    else if($page == 2){
                        include_once 'pages/login_form.php';
                    }
                    else if($page == 3){
                        if (isset($_SESSION['admin'])) {
                            include_once 'pages/admin.php';
                        }
                        else echo "<h4>Please log in as Admin</h4>";
                    }
                    else if($page == 4){
                        if (isset($_SESSION['admin']) || isset($_SESSION['user'])) {
                            include_once 'pages/rooms.php';
                        }
                        elseif(!isset($_SESSION['admin']) || !isset($_SESSION['user'])) echo "<h4>Please log in</h4>";
                    }
                    else if($page == 5){
                        if (isset($_SESSION['admin']) || isset($_SESSION['user'])) {
                            include_once 'pages/consults.php';
                        }
                        elseif(!isset($_SESSION['admin']) || !isset($_SESSION['user'])) echo "<h4>Please log in</h4>";
                    }
                }
                else{
                    include_once 'pages/registration.php';
                }
                ?>
            </section>
        </div>
        <div class="footer">NickUsov, company Step &copy; 2019</div>
    </div>
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/script.js"></script>
</body>
</html>