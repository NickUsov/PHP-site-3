 <?php
    include_once 'classes.php';
    $user_id = $_POST['user_id'];
    if($user_id == 0){
        $user_id = null;
    }
    $pdo = Tools::connect();
    $ps = $pdo->prepare('insert into sales(customer_id, item_id, quantity) values(?, ?, ?)');
    $result = json_decode($_POST['jsonData']);
    foreach ($result as $key => $value) {
        $ps->execute([$user_id, $value, 1]);
    }
    echo 'ok';
?> 