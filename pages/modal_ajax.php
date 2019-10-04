<?php
    include_once 'classes.php';
    $item_id = $_POST['item_id'];
    $item = Item::fromDb($item_id);
    $name = $item->Name;
    $price = $item->Price;
    $info = $item->Info;
    $pdo = Tools::connect();
    $ps = $pdo->prepare('select * from images where item_id = ?');
    $ps->execute([$item_id]);
    $str = "<h3>$name</h3><p>$info</p><p>$price</p><div class='row'>";
    while ($row = $ps->fetch()) {
        $path = $row['image_path'];
        $str .= "<div class='col-md-3'><img src='$path' class='gallery'></div>";
    }
    $str .= "</div><button class='btn btn-danger btn_close' id='btn_close'>Close</button>";
    echo $str;
?>