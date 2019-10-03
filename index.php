<?php
    session_start();
    include_once 'pages/classes.php';
    // $_SESSION['date'] = date('Y-m-d');
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Shop</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <?php include_once 'pages/menu.php'?>
    </header>
    <div class="container">
        <div class="row">
            <section class="col-md-12">
                <?php if(isset($_GET['page'])){
                    $page = $_GET['page'];
                    if($page == 1){
                        include_once 'pages/catalog.php';
                    }
                    else if($page == 2){
                        include_once 'pages/cart.php';
                    }
                    else if($page == 3){
                        if(isset($_SESSION['user'])){
                            $user = $_SESSION['user'];
                            echo "Welcome, user $user";
                        }
                        elseif(isset($_SESSION['admin'])){
                            $admin = $_SESSION['admin'];
                            echo "Welcome, admin $admin";
                        }
                        else{
                            include_once 'pages/registration.php';
                        }
                        
                    }
                    else if($page == 4){
                        if(isset($_SESSION['admin'])){
                             include_once 'pages/admin.php';
                        }
                        else{
                             echo 'Please, sign in as Admin';
                        }
                    }
                    else if($page == 5){
                        include_once 'pages/reports.php';
                    }
                }
                else{
                    include_once 'pages/catalog.php';
                }
                ?>
            </section>
        </div>
        <div class="footer">NickUsov, company Step &copy; 2019</div>
    </div>
    <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script> 
    <script  type="text/javascript" src="js/script.js"></script>
    
</body>
</html>