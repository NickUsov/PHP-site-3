<?php
    include_once 'classes.php';
    $item_id = $_POST['item_id'];
    $item = Item::fromDb($item_id);
    $name = $item->Name;
    $price = $item->Price;
    $info = $item->Info;
    echo "<span>$name</span><br><span>$price</span><br><span>$info</span><br>";
?>